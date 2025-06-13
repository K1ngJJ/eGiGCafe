<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\User;
use App\Enums\UtensilStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Events\InventoryStockUpdated;


class InventoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staff.');
        }
        $inventories = Inventory::all();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staff.');
        }
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'initial_stock' => 'required|integer', // Added validation for initial_stock
            'status' => 'required|string|in:Available,Unavailable',
            'price' => 'required|numeric|min:0.00|max:10000.00',
        ]);
    
        // Create inventory item
        Inventory::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'initial_stock' => $request->initial_stock, // Save initial stock
            'status' => $request->status,
            'price' => $request->price,
        ]);
    
        return redirect()->route('inventory.index')->with('success', 'Item created successfully.');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return response()->json($inventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staff.');
        }
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'initial_stock' => 'required|integer', // Validate initial stock
            'status' => 'required|string|in:Available,Unavailable',
            'price' => 'required|numeric|min:0.00|max:10000.00',
        ]);
    
        // Find the inventory item and update
        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'initial_stock' => $request->initial_stock, // Update initial stock
            'status' => $request->status,
            'price' => $request->price,
        ]);

        $request->validate([
            'quantity' => 'required|integer|min:0', // Validate quantity input
        ]);
    
        $inventory = Inventory::findOrFail($id);
        $inventory->quantity = $request->quantity;

        // Fire the event for stock update
        event(new InventoryStockUpdated($inventory));

        
        // Update the status based on the new quantity
        $inventory->status = $inventory->quantity > 0 ? 'Available' : 'Unavailable';
        $inventory->save();
    
    
        return redirect()->route('inventory.index')->with('success', 'Item updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staff.');
        }
        $inventory->delete();
        return redirect()->route('inventory.index')->with('danger', 'Item deleted successfully.');
    }

    /**
     * Get available utensils for a given catering option.
     */
    

    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role == 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $inventory = Inventory::findOrFail($id);
            $status = $request->input('status');

            // Check if the provided status is valid
            if (in_array($status, array_column(UtensilStatus::cases(), 'value'))) {
                $inventory->status = $status;
                $inventory->save();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Invalid status'], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Inventory item not found'], 404);
        }
    }

    /**
 * Update the status of the specified inventory item.
 */
public function utensilStatus(Request $request, $id)
{
    if (auth()->user()->role == 'customer') {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $request->validate([
        'status' => 'required|string|in:Available,Unavailable',
    ]);

    try {
        $inventory = Inventory::findOrFail($id);
        $status = $request->input('status');

        // Update the status
        $inventory->status = $status;
        $inventory->save();

        return response()->json(['success' => true, 'status' => $status]);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Inventory item not found'], 404);
    }
}


public function updateQuantity(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:0', // Validate quantity input
    ]);

    $inventory = Inventory::findOrFail($id);
    $inventory->quantity = $request->quantity;

    // Fire the event for stock update
    event(new InventoryStockUpdated($inventory));

    // Update the status based on the new quantity
    $inventory->status = $inventory->quantity > 0 ? 'Available' : 'Unavailable';
    
    $inventory->save();

    return response()->json([
        'success' => true,
        'quantity' => $inventory->quantity,
        'status' => $inventory->status,
    ]);
}




}
