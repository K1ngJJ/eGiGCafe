<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Package;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function index()
    {
        if (auth()->user()->role == 'customer') {
            abort(403, 'This route is only meant for restaurant staff.');
        }
    
        // Get all services and packages
        $services = Service::all();
        $packages = Package::all();
    
        // Get reservations with ratings, including the service and package ratings, and their comments
        $reservations = Reservation::with(['ratings' => function($query) {
            $query->select('service_id', 'package_id', 'service_rating', 'package_rating', 'comment', 'reserv_id');
        }])->whereHas('ratings')->get();
    
        // Process each reservation to get the ratings and comments for service and package
        foreach ($reservations as $reservation) {
            $rating = $reservation->ratings->first(); // Assuming each reservation has one rating record
    
            // Store the service and package ratings and comments
            $reservation->serviceRating = $rating->service_rating ?? null;
            $reservation->packageRating = $rating->package_rating ?? null;
            $reservation->ratingComment = $rating->comment ?? null; // Get the comment from the rating
        }
    
        return view('reservations.reviews', compact('reservations', 'services', 'packages'));
    }
    
    
    

    public function submitRating(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'reserv_id' => 'required|exists:reservations,id',  // Ensure reservation exists
            'service_id' => 'required|exists:services,id',  // Ensure service exists
            'package_id' => 'nullable|exists:packages,id',  // Package is optional
            'service_rating' => 'required|integer|min:1|max:5',  // Service rating is required
            'package_rating' => 'nullable|integer|min:1|max:5',  // Package rating is optional
            'comment' => 'nullable|string',  // Comment is optional
        ]);
    
        // Create the new rating
        Rating::create([
            'reserv_id' => $request->input('reserv_id'),
            'user_id' => Auth::id(),  // Get the authenticated user's ID
            'service_id' => $request->input('service_id'),
            'package_id' => $request->input('package_id') ?? null,  // If no package, set to null
            'service_rating' => $request->input('service_rating'),
            'package_rating' => $request->input('package_rating') ?? null,  // If no package rating, set to null
            'comment' => $request->input('comment')?? null,  // Optional comment
            'rated' => 1,  // Indicate that the rating has been submitted
        ]);
    
        return response()->json(['message' => 'Rating submitted successfully'], 200);
    }
    


    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'images.*' => 'required|mimes:jpg,png,jpeg|max:10240', // Validate each image
        ]);
    
        $reservation = Reservation::find($request->input('reservation_id'));
    
        // Initialize an array to store the image paths
        $uploadedImages = [];
    
        // Handle each uploaded image
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('receipts'), $imageName);
                $uploadedImages[] = $imageName;
            }
        }
    
        // Decode existing images if any, and merge with new ones
        $existingImages = $reservation->receipt_image ? json_decode($reservation->receipt_image, true) : [];
        $allImages = array_merge($existingImages, $uploadedImages);
    
        // Update the reservation's receipt_image column with the JSON encoded array
        $reservation->update([
            'receipt_image' => json_encode($allImages),
        ]);
    
        return redirect()->back()->with('success', 'Receipts uploaded successfully!');
    }
    



    public function stores(Request $request)
    {
        // Ensure only staff can upload receipts
    
        // Validate input
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'image' => 'required|mimes:jpg,png,jpeg|max:10240',
            //'paymentmode' => 'required|string'
        ]);
    
        // Handle image upload
        $newImageName = time() . '-' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('receipts'), $newImageName);
    
        // Find the reservation and update the receipt_image column
        $reservation = Reservation::find($request->input('reservation_id'));
        $reservation->update([
            'receipt_image' => $newImageName,
            //'payment_status' => $request->input('paymentmode'),
        ]);
    
        return redirect()->back()->with('success', 'Receipt uploaded successfully!');
    }
    
    
    

}
