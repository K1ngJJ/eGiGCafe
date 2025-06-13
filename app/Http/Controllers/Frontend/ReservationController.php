<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifReservation;
use Illuminate\Support\Facades\Session;
use App\Enums\PackageStatus;
use App\Enums\UtensilStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Package;
use App\Models\Service;
use App\Models\CateringOptions;
use App\Models\User;
use App\Models\Inventory;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use App\Models\Transaction;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Events\InventoryStockUpdated;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Rules\OneReservationPerDay;
use App\Rules\UniqueReservationDate;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function history()
    {
        $user = auth()->user();
    
        // Check if the user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        // Retrieve reservations belonging to the current customer, excluding those with a status of "Cancelled"
        $reservations = Reservation::where('email', $user->email)
                                   ->where('status', '!=', 'Cancelled')
                                   ->with('rating')
                                   ->get();
    
        return view('reservations.history', [
            'reservations' => $reservations // Pass reservations to the view
        ]);
    }
    
    

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = auth()->user();
    
        // Check if the reservation belongs to the logged-in user
        if ($reservation->email !== $user->email) {
            abort(403, 'Unauthorized action.');
        }
    
        // Soft delete the reservation
        $reservation->delete();
    
        return redirect()->route('reservations.history')->with('success', 'Reservation has been cancelled and removed.');
    }
    





    public function stepOne(Request $request)
    {
        if (auth()->user()->role != 'customer')
        abort(403, 'This route is only meant for customers.');

           // Best Reservation Month
           $bestReservationMonth = Reservation::selectRaw('MONTH(res_date) as month, COUNT(*) as count')
           ->where('status', 'Fulfilled')
           ->groupBy('month')
           ->orderByDesc('count')
           ->first();
   
            // Format data for JavaScript
           $reservationMonthData = $bestReservationMonth ? [
               'month' => $bestReservationMonth->month,
               'count' => $bestReservationMonth->count,
           ] : null;
   
          // General variables useful for all charts / graphs
          $lastMonthDate = Carbon::now()->subDays(30)->toDateTimeString();
          $today = Carbon::today()->toDateString();
          $oneMonthTransactions = Transaction::where('created_at', '>=', $lastMonthDate)->get();
          

        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date', "reservationMonthData"));
    }

    public function storeStepOne(Request $request)
{
    // Ensure only customers can access this route
    if (auth()->user()->role != 'customer') {
        abort(403, 'This route is only meant for customers.');
    }

    $user = auth()->user(); // Get the authenticated user

    // Validate the request
    $validated = $request->validate([
        'first_name' => ['required'],
        'last_name' => ['required'],
        'res_date' => ['required', 'date', new OneReservationPerDay($user->email), new TimeBetween(), new UniqueReservationDate($user->role)],
//      'res_date' => ['required', 'date', new DateBetween(), new OneReservationPerDay($user->email), new TimeBetween(), new UniqueReservationDate($user->role)],
        'tel_number' => ['required'],
        'guest_number' => ['required', 'integer', 'min:1'],
        'venue_address' => ['required'],
        'agreement' => ['accepted'],
    ]);

    // Add user's email and ID to the validated data
    $validated['email'] = $user->email;
    $validated['user_id'] = $user->id;
    $validated['role'] = $user->role;

    // Check if reservation session data exists, and store it
    if (empty($request->session()->get('reservation'))) {
        $reservation = new Reservation();
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    } else {
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    }

    return redirect()->route('reservations.step.two');
}


    

    public function stepTwo(Request $request)
    {
        if (auth()->user()->role != 'customer') {
            abort(403, 'This route is only meant for customers.');
        }

           // Best Reservation Month
           $bestReservationMonth = Reservation::selectRaw('MONTH(res_date) as month, COUNT(*) as count')
           ->where('status', 'Fulfilled')
           ->groupBy('month')
           ->orderByDesc('count')
           ->first();
   
            // Format data for JavaScript
           $reservationMonthData = $bestReservationMonth ? [
               'month' => $bestReservationMonth->month,
               'count' => $bestReservationMonth->count,
           ] : null;
    
        $reservation = $request->session()->get('reservation');
    
        // Define $res_package_ids
        $res_package_ids = [];
        if ($reservation && $reservation->packages) {
            $res_package_ids = $reservation->packages->pluck('id')->toArray();
        }
    
        // Fetch inventories, excluding those with status 'Unavailable'
        $inventories = Inventory::where('status', '!=', UtensilStatus::Unavailable->value)->get();

        // Your existing code for fetching packages and services
        $packages = Package::where('status', PackageStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_package_ids)
            ->get();
    
        $services = Service::all(); // Fetch services

        $cateringoptions = CateringOptions::all();

    
        return view('reservations.step-two', compact('reservation', 'packages', 'services', 'inventories', 'cateringoptions', "reservationMonthData"));
    }
    
    public function storeStepTwo(Request $request)
{
    if (auth()->user()->role !== 'customer') {
        abort(403, 'This route is only meant for customers.');
    }

    $validated = $request->validate([
        'package_id' => ['nullable', 'exists:packages,id'],
        'service_id' => ['required', 'exists:services,id'],
        'cateringoption_id' => ['required', 'exists:catering_options,id'],
        'payment_status' => ['nullable', 'string'],
        'payment_selection' => ['nullable', 'string'],
        'theme_type' => ['nullable', 'string'], // Added theme type validation
        'main_color' => ['nullable', 'string'], // Added main color validation
        'sub_color' => ['nullable', 'string'], // Added sub color validation
        'custom_main_color' => ['nullable', 'string'], // Added custom main color validation
        'custom_sub_color' => ['nullable', 'string'], // Added custom sub color validation
        'theme_comments' => ['nullable', 'string'], // Added comments validation
        'agreement' => ['accepted'],
    ]);

    $reservation = $request->session()->get('reservation');

    if (!$reservation) {
        return redirect()->route('reservations.step.one')->withErrors('Reservation data is missing.');
    }

    // Fill in the validated fields including the new theme fields
    $reservation->fill($validated);
    $reservation->package_id = $request->input('package_id') ?: null;
    $reservation->payment_selection = $request->input('payment_selection') ?: null;
    $reservation->receipt_image = json_encode([]);

    // Handle utensil selections and inventory updates (existing code)
    $utensils = $request->input('utensils', []);
    $supplyDetails = [];
    $totalPrice = 0;
    $hasUtensilsSelected = false;

    if (is_array($utensils)) {
        foreach ($utensils as $utensilId => $utensilData) {
            if (!empty($utensilData['selected'])) {
                $quantity = isset($utensilData['quantity']) ? (int)$utensilData['quantity'] : 0;

                if ($quantity > 0) {
                    $hasUtensilsSelected = true;
                    $inventory = Inventory::find($utensilId);

                    if ($inventory) {
                        $totalPriceForUtensil = $quantity * $inventory->price;
                        $totalPrice += $totalPriceForUtensil;

                        if ($inventory->quantity >= $quantity) {
                            $inventory->quantity -= $quantity;
                            $inventory->save();

                            if ($inventory->quantity <= 0 || $inventory->quantity <= ($inventory->initial_stock * 0.3)) {
                                event(new InventoryStockUpdated($inventory));
                            }

                            $supplyDetails[] = [
                                'name' => $inventory->name,
                                'quantity' => $quantity,
                                'total_price' => $totalPriceForUtensil
                            ];
                        } else {
                            return redirect()->route('reservations.step.two')
                                             ->withErrors("Insufficient stock for {$inventory->name}");
                        }
                    }
                }
            }
        }
    }

    if (!$hasUtensilsSelected) {
        $supplyDetails = [];
    }

    // Save utensil details and pricing
    $reservation->supply_details = json_encode($supplyDetails);
    $reservation->supply_total = $totalPrice;

    // Save theme data (including custom colors and comments)
    $reservation->theme_type = $request->input('theme_type');
    $reservation->main_color = $request->input('main_color');
    $reservation->sub_color = $request->input('sub_color');
    $reservation->custom_main_color = $request->input('custom_main_color');
    $reservation->custom_sub_color = $request->input('custom_sub_color');
    $reservation->theme_comments = $request->input('theme_comments');

    // Save reservation
    $reservation->save();

    // Mark step two as completed and clear session data
    Session::put('reservation_step_two_completed', true);
    $request->session()->forget('reservation');

    // Redirect to the thank you page
    return redirect()->route('reservations.thankyou');
}

    
    
    
    

    
    


    

  
    



    
public function show($id)
{
    $reservation = Reservation::with(['service', 'package'])->findOrFail($id);
    return response()->json($reservation);
}


public function thankyou()
{
    $user = auth()->user();

    // Check if the notification flag is set in the session
    if (!Session::has('reservation_notification_sent')) {
        // Check if the user is a customer
        if ($user->role != 'customer') {
            abort(403, 'This route is only meant for customers.');
        }

        // Notify the user
        //notify()->success('Your reservation has been sent to staff for confirmation!');

        // Optionally, send a notification email
        // Mail::to($user->email)->send(new NotifReservation());

        // Set the notification flag in the session to prevent duplicate notifications
        Session::put('reservation_step_two_completed', false);
        Session::flash('reservation_notification_sent', true);
    }

    // Fetch the latest reservation for the authenticated user
    $latestReservation = Reservation::where('email', $user->email)
                                    ->where('status', '!=', 'Fulfilled')
                                    ->latest()
                                    ->first();
                        
    // Pass the latest reservation and payment method to the view
    return view('reservations.thankyou', [
        'latestReservation' => $latestReservation,
        'payment_status' => $latestReservation ? $latestReservation->payment_status : null,
    ]);
}
}
