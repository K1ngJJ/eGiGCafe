<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Menu;
use App\Models\Rating;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\PackageStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    
    public function index()
{
    if (auth()->check()) {
        $user = Auth::user();
        $packages = $user->availablePackages()->get();
    } else {
        // If the user is not authenticated, you may choose to handle it differently,
        // such as redirecting them to the login page or showing a message.
        $packages = collect(); // Empty collection if the user is not authenticated
    }
    
    $services = Service::all();

    $serviceRatings = Rating::selectRaw('service_id, AVG(service_rating) as average_rating')
    ->groupBy('service_id')
    ->get()
    ->pluck('average_rating', 'service_id');
    
    return view('cservices.index', compact('packages', 'services', 'serviceRatings'));
}


    public function show(Service $service)
    {
        // Get the authenticated user if available
        $user = Auth::user();

        // Fetch only the packages that are available for the given service
        $availablePackages = $service->packages()->where('status', PackageStatus::Available)->get();
        
        // Proceed with the rest of the logic
        $availablePackages = Package::where(function ($query) use ($user) {
                $query->whereNull('user_id'); // Packages without a user_id
                if ($user !== null) {
                    $query->orWhere('user_id', $user->id);
                }
            })
            ->whereHas('services', function ($query) use ($service) {
                $query->where('services.id', $service->id);
            })
            ->where('status', PackageStatus::Available)
            ->get();

            $packageRatings = Rating::selectRaw('package_id, AVG(package_rating) as average_rating')
            ->groupBy('package_id')
            ->get()
            ->pluck('average_rating', 'package_id');
        
        $menus = Menu::all();
        $services = Service::all(); 
        $selectedId = $service->id; 
        
        return view('cservices.show', compact('service', 'availablePackages', 'menus', 'services', 'selectedId', 'packageRatings'));
    }
    

    public function store(PackageStoreRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10240', // Make image nullable
            'guest_number' => 'required|integer',
            'status' => 'required',
            'price' => 'required|numeric',
        ]);
    
        // Check if an image was uploaded, otherwise use a default image
        $newImageName = 'White Logo.png'; // Replace with your actual default image filename
        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('packagesImages'), $newImageName);
        }
    
        // Create the package
        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $newImageName,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);
    
        // Attach services if provided
        if ($request->has('services')) {
            $package->services()->attach($request->services);
        }
    
        // Get the ID of the first service attached (if any)
        $firstServiceId = $package->services->first()->id ?? null;
    
        // Redirect with success message
        return redirect()->route('cservices.show', $firstServiceId)->with('success', 'Package created successfully.');
    }
    

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
        'price' => $request->price,
        'user_id' => Auth::id(), // Optional: Keep track of the user who updated
    ]);

    if ($request->has('services')) {
        $package->services()->sync($request->services);
    }

    $firstServiceId = $package->services->first()->id ?? null;

    return redirect()->route('cservices.show', $firstServiceId)->with('success', 'Package updated successfully.');
}


    
    public function destroy(Package $package)
    {
        $firstServiceId = $package->services->first()->id;
    
        Storage::delete($package->image);
        $package->services()->detach();
        $package->delete();
    
        return redirect()->route('cservices.show', $firstServiceId)->with('danger', 'Package deleted successfully.');
    }
    
    
}

