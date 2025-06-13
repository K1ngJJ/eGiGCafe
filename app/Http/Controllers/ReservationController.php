<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Enums\PackageStatus;
use App\Enums\ReservationStatus;
use App\Models\Package;
use App\Models\Service;
use App\Models\Inventory;
use App\Models\CateringOptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifReservation;
use App\Notifications\ReservationStatusNotification;
use App\Models\User;

class ReservationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }

        $services = Service::all();
        $packages = Package::all();
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations', 'services', 'packages'));
    }

    public function create()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        $services = Service::all();
        $inventories = Inventory::all();
        $cateringoptions = CateringOptions::all(); // Assuming you have a CateringOption model
    
        return view('reservations.create', compact( 'inventories', 'services', 'cateringoptions'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
    
        try {
            // Validate the guest number against the selected service (if needed)
            // Assuming you may want to validate guest numbers with a service or catering option
    
            // Create and fill the reservation with validated data
            $reservation = new Reservation();
            $reservation->fill($request->validated());
    
            // Set the status to Pending by default
            $reservation->status = ReservationStatus::Pending;
    
            // Save the reservation to the database
            $reservation->save();
    
            // If there are no inventory supplies, simply set this to an empty string or remove if not needed
            $reservation->inventory_supplies = ''; // You can remove this line if inventory supplies are no longer relevant
            $reservation->save(); // Save again if you modified any attributes
    
            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'An error occurred while creating the reservation.');
        }
    }
    

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $reservation = Reservation::with(['service', 'package'])->findOrFail($id);
    return response()->json($reservation);
}


    /**
     * Show the form for editing the specified resource.
     */
    // ReservationController.php
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id); // Retrieve single reservation by ID
        $services = Service::all();
        $packages = Package::all();
        $inventories = Inventory::all();
        $cateringOptions = CateringOptions::all(); // Assuming your model is named CateringOption
        $paymentStatuses = \App\Enums\PaymentStatus::cases(); // Retrieve payment status cases if using an enum
    
        return view('reservations.edit', compact('reservation', 'packages', 'services', 'inventories', 'cateringOptions', 'paymentStatuses'));
    }
    


    /**
     * Update the specified resource in storage.
     * */
    public function update(Request $request, $id)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staff.');
    }

    try {
        $reservation = Reservation::findOrFail($id);
        $status = $request->input('status');
        $reservation->payment_selection = $request->input('payment_selection');


        // Fill and update reservation fields, excluding inventory supplies only
        $reservation->fill($request->except(['inventory_supplies']));

        // Update package_id if it is present in the request; set to null if the "None" option was selected
        $reservation->package_id = $request->input('package_id') ?: null;

          // Validate status
          if (in_array($status, ['Pending', 'Approved', 'Declined', 'Cancelled', 'Fulfilled', 'In Progress'])) {
            $reservation->status = $status;
            $reservation->save();

            // Notify the customer
            $customer = User::find($reservation->user_id);
            if ($customer && $customer->role === 'customer') {
                $customer->notify(new ReservationStatusNotification($reservation, $status));
            }
        }

        // Update reservation status if provided and valid
        if ($request->has('status') && in_array($request->status, \App\Enums\ReservationStatus::cases())) {
            $reservation->status = \App\Enums\ReservationStatus::from($request->status);
        }

        // Save the updated reservation
        $reservation->save();

        // Send notification email for specified statuses
        if (in_array($reservation->status, ['Declined', 'Approved', 'Pending', 'In Progress', 'Fulfilled'])) {
            Mail::to($reservation->email)->send(new NotifReservation($reservation->status));
        }

        // Store the updated reservation in the session
        $request->session()->put('reservation', $reservation);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    } catch (ModelNotFoundException $e) {
        return back()->with('error', 'Reservation not found.');
    }
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staffs.');
        }
        
        $reservation->delete();

        return redirect()->route('reservations.index')->with('warning', 'Reservation deleted successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        if (auth()->user()->role == 'customer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $reservation = Reservation::findOrFail($id);
            $status = $request->input('status');

                  // Validate status
          if (in_array($status, ['Pending', 'Approved', 'Declined', 'Cancelled', 'Fulfilled', 'In Progress'])) {
            $reservation->status = $status;
            $reservation->save();

            // Notify the customer
            $customer = User::find($reservation->user_id);
            if ($customer && $customer->role === 'customer') {
                $customer->notify(new ReservationStatusNotification($reservation, $status));
            }
        }

            // Check if the provided status is valid
            if (in_array($status, array_column(ReservationStatus::cases(), 'value'))) {
                $reservation->status = $status;
                $reservation->save();

                // Optionally send an email notification if required
                if (in_array($reservation->status, ['Declined', 'Approved', 'Fulfilled', 'Cancelled', 'Pending', 'In Progress'])) {
                    Mail::to($reservation->email)->send(new NotifReservation($reservation->status));
                }

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Invalid status'], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }
    }

    public function filterReservation(Request $request)
    {
        $query = Reservation::query();

        // Filter by ID
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // Filter by date range
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $query->whereBetween('res_date', [$request->startDate, $request->endDate]);
        }

        // Filter by time range
        if ($request->filled('startTime') && $request->filled('endTime')) {
            $query->whereTime('res_date', '>=', $request->startTime)
                ->whereTime('res_date', '<=', $request->endTime);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment_status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by service
        if ($request->filled('service')) {
            $query->whereHas('service', function($q) use ($request) {
                $q->where('name', $request->service);
            });
        }

        // Filter by package
        if ($request->filled('package')) {
            $query->whereHas('package', function($q) use ($request) {
                $q->where('name', $request->package);
            });
        }

        $reservations = $query->get();

        // Fetch services and packages for the filter form
        $services = Service::all();
        $packages = Package::all();

        return view('reservations.index', compact('reservations', 'services', 'packages'));
    }

    public function deleteReceiptImage(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        if ($reservation) {
            // Decode the JSON array
            $images = json_decode($reservation->receipt_image, true);

            // Remove the specified image
            if (($key = array_search($request->image, $images)) !== false) {
                unset($images[$key]);
            }

            // Reindex array and update JSON column
            $reservation->receipt_image = json_encode(array_values($images));
            $reservation->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

}
