<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Reservation;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        
        if (env('PAYPAL_MODE') === 'live') {
            $this->gateway->setClientId(env('PAYPAL_LIVE_CLIENT_ID'));
            $this->gateway->setSecret(env('PAYPAL_LIVE_CLIENT_SECRET'));
        } else {
            $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
            $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        }
    
        $this->gateway->setTestMode(env('PAYPAL_MODE') !== 'live'); // Set to 'false' for live mode
        $this->middleware('auth');
    }
    

    /**
     * Display pending reservations for the customer.
     */
    public function index()
    {
        $user = auth()->user();
    
        // Check if the user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        // Retrieve the latest reservation belonging to the current customer
        $latestReservation = Reservation::where('email', $user->email)->where('status', '!=', 'Fulfilled')->latest()->first();
    
        // Pass the latest reservation and its payment status to the view
        $paymentStatus = $latestReservation ? $latestReservation->payment_status : null;
        return view('reservations.thankyou', ['latestReservation' => $latestReservation, 'paymentStatus' => $paymentStatus]);
    }
    

    /**
     * Initiate a payment on PayPal.
     */
    public function charge(Request $request)
    {
        if (auth()->user()->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }

        // Validate request data
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Get the selected reservation ID from the form
        $reservationId = $request->input('reservation_id');

        if ($request->input('submit')) {
            try {
                $response = $this->gateway->purchase([
                    'amount' => $request->input('amount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error'),
                ])->send();

                if ($response->isRedirect()) {
                    // Save payment details and reservation ID in session
                    $request->session()->put('payment_details', [
                        'amount' => $request->input('amount'),
                        'reservation_id' => $reservationId,
                    ]);

                    $response->redirect(); // Forward the customer to PayPal
                } else {
                    // Payment initiation failed
                    return back()->withErrors(['error' => $response->getMessage()]);
                }
            } catch (Exception $e) {
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Handle successful payment and store the transaction.
     */
    public function success(Request $request)
    {
        if (auth()->user()->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }
    
        // Retrieve payment and reservation details from session
        $paymentDetails = $request->session()->get('payment_details');
    
        if ($request->input('paymentId') && $request->input('PayerID') && $paymentDetails) {
            try {
                $transaction = $this->gateway->completePurchase([
                    'payer_id' => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId'),
                ])->send();
    
                if ($transaction->isSuccessful()) {
                    // Payment was successful
                    $data = $transaction->getData();
    
                    // Save transaction data to the database
                    $payment = new Payment();
                    $payment->payment_id = $data['id'];
                    $payment->payer_id = $data['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $data['payer']['payer_info']['email'];
                    $payment->amount = $paymentDetails['amount'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $data['state'];
                    $payment->reservation_id = $paymentDetails['reservation_id'];
                    $payment->save();
    
                    // Update the reservation status based on the payment status
                    $reservation = Reservation::find($paymentDetails['reservation_id']);
                    $reservation->payment_status = $paymentDetails['payment_status'];
                    $reservation->save();
    
                    return redirect()->route('reservations.thankyou')->with('success', 'Payment successful! Transaction ID: ' . $data['id']);
                } else {
                    return back()->withErrors(['error' => $transaction->getMessage()]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {
            return back()->withErrors(['error' => 'Transaction declined or invalid session data.']);
        }
    }
    

    /**
     * Handle payment cancellation.
     */
    public function error()
    {
        if (auth()->user()->role !== 'customer') {
            abort(403, 'This route is only meant for customers.');
        }

        return redirect()->route('reservations.thankyou')->with('error', 'User cancelled the payment.');
    }
}
