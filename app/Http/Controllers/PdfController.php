<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    
    public function orderstxnPdf(Request $request)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staff.');
    }

    ini_set('memory_limit', '512M'); // Increase memory limit
    ini_set('max_execution_time', 300); // Increase execution time limit

    // Handle date range filters
    $fromDate = $request->query('from');
    $toDate = $request->query('to');
    $typeFilter = $request->query('type'); // Added type filter

    // Base query for completed orders only
    $query = Transaction::with(['order.user', 'discount'])
        ->whereHas('order', function ($query) {
            $query->where('completed', 1); // Only include completed orders
        });

    // Apply type filter if provided (Dine-In or Take-Out)
    if ($typeFilter) {
        $query->whereHas('order', function ($query) use ($typeFilter) {
            $query->where('type', $typeFilter); // Filter by Dine-In or Take-Out
        });
    }

    // Apply date range if provided
    if ($fromDate && $toDate) {
        $query->whereBetween('created_at', [$fromDate, $toDate]);
    }

    // Get filtered orders
    $orderstxn = $query->get()->map(function ($transaction) {
        $transaction->discount_id = $transaction->discount_id ?? 'No Discount';
        return $transaction;
    });

    $data = [
        'title' => 'Transactions Report',
        'date' => date('m/d/Y'),
        'orderstxn' => $orderstxn,
    ];

    $pdf = Pdf::loadView('reports.generate-orderstxn-pdf', $data);

    if ($request->query('preview')) {
        return $pdf->stream('OrdersTxn-data.pdf'); // Streams the PDF with a toolbar
    }

    return $pdf->download('OrdersTxn-data.pdf'); // Download as default
}

    
    
    
public function reservationstxnPdf(Request $request)
{
    if (auth()->user()->role == 'customer') {
        abort(403, 'This route is only meant for restaurant staff.');
    }

    $query = Reservation::with('service', 'package');

    // Apply date range filter
    if ($request->filled('fromDate') && $request->filled('toDate')) {
        $query->whereBetween('res_date', [$request->fromDate, $request->toDate]);
    }

    // Apply event type filter
    if ($request->filled('eventType') && $request->eventType != 'all') {
        $query->where('service_id', $request->eventType);
    }

    // Apply event type filter
    if ($request->filled('serviceType') && $request->serviceType != 'all') {
        $query->where('cateringoption_id', $request->serviceType);
    }

    // Apply payment mode filter
    if ($request->filled('paymentMode') && $request->paymentMode != 'all') {
        $query->where('payment_status', $request->paymentMode);
    }

    $reservationstxn = $query->get();

    $data = [
        'title' => 'Reservations Report',
        'date' => date('m/d/Y'),
        'reservationstxn' => $reservationstxn,
    ];

    $pdf = Pdf::loadView('reports.generate-reservationstxn-pdf', $data)
              ->setPaper('a4', 'landscape');

    // If preview is requested, stream the PDF for inline viewing
    if ($request->query('preview')) {
        return $pdf->stream('ReservationsTxn-data.pdf'); // Streams the PDF with a toolbar
    }

    return $pdf->download('ReservationsTxn-data.pdf'); // Download as default
}

    
    
    

    public function reservationPdf($id)
    {
        // Find the reservation with related service and package
        $reservation = Reservation::with('service', 'package')->findOrFail($id);
    
        // Prepare data for PDF including inventory supplies
        $data = [
            'title' => 'Reservation Report',
            'date' => date('m/d/Y'),
            'reservation' => $reservation,
        ];
    
        // Generate PDF with custom page size (Half Letter) and portrait orientation
        $pdf = Pdf::loadView('reports.generate-reservation-pdf', $data)
                  ->setPaper([0, 0, 337, 840], 'portrait');
    
        // Download PDF
        return $pdf->download("Reservation-{$reservation->id}.pdf");
    }
    

    public function transactionPdf($id)
    {
        // Fetch the transaction with related models
        $transactions = Transaction::with('order.user', 'order.cartItems.menu')->findOrFail($id);
    
        // Prepare data for the PDF view
        $data = [
            'title' => 'Transaction Report',
            'date' => date('m/d/Y'),
            'transactions' => $transactions,
        ];
    
        // Set DomPDF options for HTML5 parsing and Unicode support
        \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isUnicode' => true]);
    
        // Load the view with data and generate the PDF
        $pdf = \PDF::loadView('reports.generate-order-transaction-pdf', $data)
            ->setPaper([0, 0, 267, 500]); // Set custom paper size for receipt (portrait, small)
    
        // Download the generated PDF
        return $pdf->download("Transaction-{$transactions->id}.pdf");
    }
    
    

    
    
}
