<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;
use App\Models\Service;
use App\Models\Package;
use App\Enums\PackageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $package = Package::all();
        return view('packages.index', compact('package'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $services = Service::all();
        return view('packages.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(PackageStoreRequest $request)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staffs.');
    }

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|mimes:jpg,png,jpeg|max:10240',
        'guest_number' => 'required|integer',
        'status' => 'required',
        'price' => 'required|numeric'
    ]);

    $newImageName = time() . '-' . $request->image->getClientOriginalName();
    $request->image->move(public_path('packagesImages'), $newImageName);

    $package = new Package();
    $package->name = $request->name;
    $package->description = $request->description;
    $package->image = $newImageName;
    $package->guest_number = $request->guest_number;
    $package->status = $request->status;
    $package->price = $request->price;
    $package->save();

    if ($request->has('services')) {
        $package->services()->attach($request->services);
    }

    return redirect()->route('packages.index')->with('success', 'Package created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = Package::with(['package'])->findOrFail($id);
        return response()->json($package);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $packages = Package::where('status', PackageStatus::Available)->get();
        $services = Service::all();
        return view('packages.edit', compact('package', 'services', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Package $package)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staffs.');
    }

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'guest_number' => 'required|integer',
        'status' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|mimes:jpg,png,jpeg|max:10240'
    ]);

    $image = $package->image;

    if ($request->hasFile('image')) {
        // Delete the old image if a new one is uploaded
        if ($image && File::exists(public_path('packagesImages/' . $image))) {
            File::delete(public_path('packagesImages/' . $image));
        }

        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('packagesImages'), $newImageName);
        $image = $newImageName;
    }

    $package->update([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $image,
        'guest_number' => $request->guest_number,
        'status' => $request->status,
        'price' => $request->price
    ]);

    if ($request->has('services')) {
        $package->services()->sync($request->services);
    }

    return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        Storage::delete($package->image);
        $package->services()->detach();
        $package->delete();
        return redirect()->route('packages.index')->with('danger', 'Package deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
{
    // Check if the user is a customer
    if (auth()->user()->role == 'customer') {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    try {
        // Find the package by its ID
        $package = Package::findOrFail($id);
        $status = $request->input('status');

        // Check if the provided status is valid
        if (in_array($status, array_column(PackageStatus::cases(), 'value'))) {
            // Update the package status
            $package->status = $status;
            $package->save();

            // Optionally send an email notification for certain status changes
            if (in_array($package->status, ['Available', 'Unavailable'])) {
                // Example: send an email to the owner/admin (adjust email and mail logic accordingly)
                // Mail::to($package->owner_email)->send(new PackageStatusUpdated($package));
            }

            // Return a successful response
            return response()->json(['success' => true]);
        } else {
            // Return an error response if the status is invalid
            return response()->json(['error' => 'Invalid status'], 400);
        }
    } catch (ModelNotFoundException $e) {
        // Return an error response if the package is not found
        return response()->json(['error' => 'Package not found'], 404);
    }
}

}
