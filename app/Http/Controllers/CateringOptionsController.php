<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CateringOptionsStoreRequest;
use App\Models\CateringOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CateringOptionsController extends Controller
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
        $cateringoptions = CateringOptions::all();
        return view('cateringoptions.index', compact('cateringoptions'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('cateringoptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(CateringOptionsStoreRequest $request)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staffs.');
    }

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|mimes:jpg,png,jpeg|max:10240'
    ]);

    $newImageName = time() . '-' . $request->image->getClientOriginalName();
    $request->image->move(public_path('cateringoptionsImages'), $newImageName);

    $cateringoptions = new CateringOptions();
    $cateringoptions->name = $request->name;
    $cateringoptions->description = $request->description;
    $cateringoptions->image = $newImageName;
    $cateringoptions->save();

    return redirect()->route('cateringoptions.index')->with('success', 'Catering option created successfully.');
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
    public function edit(CateringOptions $cateringoption)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('cateringoptions.edit', compact('cateringoption'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, CateringOptions $cateringoption)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staffs.');
    }

    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|mimes:jpg,png,jpeg|max:10240'
    ]);

    $image = $cateringoption->image;

    if ($request->hasFile('image')) {
        // Delete the old image if a new one is uploaded
        if ($image && File::exists(public_path('cateringoptionsImages/' . $image))) {
            File::delete(public_path('cateringoptionsImages/' . $image));
        }
        
        $newImageName = time() . '-' . $request->image->getClientOriginalName();
        $request->image->move(public_path('cateringoptionsImages'), $newImageName);
        $image = $newImageName;
    }

    $cateringoption->update([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $image
    ]);

    return redirect()->route('cateringoptions.index')->with('success', 'Catering option updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CateringOptions $cateringoption)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        Storage::delete($cateringoption->image);
        //$cateringoption->packages()->detach();
        $cateringoption->delete();

        return redirect()->route('cateringoptions.index')->with('danger', 'service deleted successfully.');
    }
}
