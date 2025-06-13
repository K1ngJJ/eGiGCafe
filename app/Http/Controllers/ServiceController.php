<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceStoreRequest $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);
        
        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('eventImages'), $newImageName);
    
        $Event = new Service();
        $Event->name = $request->name;
        $Event->description = $request->description;
        $Event->image = $newImageName;
        $Event->save();


        return redirect()->route('services.index')->with('success', 'event uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10240'
        ]);
    
        // Update the service instance
        $service->name = $validatedData['name'];
        $service->description = $validatedData['description'];
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('eventImages'), $newImageName);
            $service->image = $newImageName; // Update the image only if a new one is uploaded
        }
    
        // Save the updated service
        $service->save();
        
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        Storage::delete($service->image);
        $service->packages()->detach();
        $service->delete();

        return redirect()->route('services.index')->with('danger', 'service deleted successfully.');
    }
}
