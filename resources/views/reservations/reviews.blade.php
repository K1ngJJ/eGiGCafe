@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}
@endsection

@section('navTheme')
{{ 'light' }}
@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

@section('content')
<style>

.btn-dark {
    background-color: black;
    color: white;
} 

.btn-dark:hover {
    background-color: white;
    color: black;
} 

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: darkorange; 
    color: white;
} 

.btn-warning:hover {
    background-color: white; /* Changing background color on hover */
    color: black; /* Changing text color on hover */
}

.btn-success {
    color: green;
    background-color: transparent; /* Setting the background-color to transparent */
    border-color: green; /* Adding border color for better visibility */
}

.btn-success:hover {
    background-color: white; /* Changing background color on hover */
    color: white; /* Changing text color on hover */
}

.bold-divider {
    font-weight: bold; /* Make text bold */
    height: 2px; /* Increase height to make the line bolder */
    background-color: black; /* Ensure the line is visible */
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.custom-status-span {
    background-color: maroon; /* Red background */
    color: white; /* White text */
    padding: 0.25rem 0.5rem; /* Padding for some spacing */
    font-size: 0.75rem; /* Small font size */
    font-weight: bold; /* Bold text */
    text-transform: uppercase; /* Uppercase text */
    letter-spacing: 0.05em; /* Tracking wider */
    border-color: white;
}

.custom-id-span {
    background-color: #ff9800; /* Orange background for warning */
    color: white; /* White text */
    padding: 0.25rem 0.5rem; /* Padding for spacing */
    font-size: 0.75rem; /* Small font size */
    font-weight: bold; /* Bold text */
    text-transform: ; /* Uppercase text */
    letter-spacing: 0.05em; /* Tracking wider */
    border: 1px solid #ffc107; /* Light yellow border for contrast */
    border-radius: 4px; /* Rounded corners for smoother look */
}

.custom-resoid-span {
    background-color: white; /* Orange background for warning */
    color: black; /* White text */
    padding: 0.25rem 0.5rem; /* Padding for spacing */
    font-size: 0.75rem; /* Small font size */
    font-weight: bold; /* Bold text */
    text-transform: ; /* Uppercase text */
    letter-spacing: 0.05em; /* Tracking wider */
    border: 1px solid #ffc107; /* Light yellow border for contrast */
    border-radius: 4px; /* Rounded corners for smoother look */
}

.custom-psid-span {
    background-color: white; /* Orange background for warning */
    color: blue; /* White text */
    padding: 0.25rem 0.5rem; /* Padding for spacing */
    font-size: 0.75rem; /* Small font size */
    font-weight: bold; /* Bold text */
    text-transform: ; /* Uppercase text */
    letter-spacing: 0.05em; /* Tracking wider */
    border: 1px solid white; /* Light yellow border for contrast */
    border-radius: 4px; /* Rounded corners for smoother look */
}


.custom-red-icon {
    color: black; /* Red color */
    border: 2px solid darkred; /* Red border */
    padding: 4px; /* Padding for spacing between border and icon */
    border-radius: 5px; /* Rounded corners */
    transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
}

.custom-red-icon:hover {
    color: white; /* Change icon color on hover */
    border-color: white; /* Change border color on hover */
    background-color: darkred; /* Add background color on hover */
}

.alert-failed{
    color: #400200; 
    border: 1px solid #C54644;
    padding: 4px;
    border-radius: 5px;
    background-color: #f3d3d9;
}

.alert-pending{
    color: solid lightgray; 
    border: 1px solid gray;
    padding: 4px;
    border-radius: 5px;
    background-color: lightgray;
}

.alert-approved {
            color: #003366;
            border: 1px solid #99ccff;
            padding: 8px;
            border-radius: 5px;
            background-color: #e6f7ff;
        }

.modal-body {
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .reservation-info h5 {
        font-size: 1.25rem;
        color: #007bff;
    }
    .reservation-info .table {
        margin-bottom: 0; /* Remove margin below the table */
    }
    .reservation-info .table th {
        background-color: #f1f1f1; /* Light grey background for table headers */
        font-weight: 600; /* Bold headers */
    }
    .reservation-info .table td, .reservation-info .table th {
        padding: 0.75rem;
    }.custom-modal-body {
        border-radius: 15px;
        background-color: #fdfdfd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .reservation-info h5 {
        font-size: 1.5rem;
        color: #007bff;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: bold;
        color: #495057;
    }
    .info-value {
        color: #212529;
    }
    
</style>

   <style>
    .status-container {
        padding: 5px 10px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 20px;
        text-align: center;
        animation: pulse 1.5s ease infinite;
    }
        
    .success {
        background-color: #4CAF50;
        color: white;
        box-shadow: 0px 2px 4px rgba(76, 175, 80, 0.2);
    }
        
    .failed {
        background-color: #F44336;
        color: white;
        box-shadow: 0px 2px 4px rgba(244, 67, 54, 0.2);
    }
        
    .warning {
        background-color: #FFC107;
        color: #333;
        box-shadow: 0px 2px 4px rgba(255, 193, 7, 0.2);
    }
        
   .pending {
        background-color: #FFFF00; /* Light yellow */
        color: #333;
        box-shadow: 0px 2px 4px rgba(33, 150, 243, 0.2);
    }
    
    .approved {
        background-color: #2196F3;
        color: white;
        box-shadow: 0px 2px 4px rgba(33, 150, 243, 0.2);
    }
                                            
    @keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

<style>
.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 10px;
    margin-top: 15px;
}
.image-container {
    position: relative;
}
.previewImage {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s ease;
}
.previewImage:hover {
    transform: scale(1.05);
}
.delete-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(255, 0, 0, 0.7);
    color: white;
    border: none;
    padding: 5px;
    cursor: pointer;
    border-radius: 3px;
    font-size: 0.8rem;
}
.preview-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}
.preview-modal img.fullImage {
    max-width: 90%;
    max-height: 90%;
}

    .comment {
        border: 2px blue; /* Adds a white border */
        padding: 5px; /* Optional: adds padding inside the border */
        border-radius: 0%; /* Optional: makes the border circular */
        background-color: #e8f5e9; 
    }

    .ratings {
  
    padding: 5px; /* Optional: adds padding inside the border */
    border-radius: 0%; /* Optional: makes the border circular */
    background-color: #FFECB3; /* Mild orange background color */
}


</style>


<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
<div class="container">
        <div class="mt-4 container w-full px-5 py-6 mx-auto">
        <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <h6 class=" d-flex justify-content-center" style="font-size: 1.0rem;font-style: italic;">REVIEWS</h6>
        <br>
        </div>
        </table>
        <div class="row my-3">
        
    
        @foreach ($reservations as $reservation)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> <!-- Adjusted to fit 4 cards -->
            <div class="flex justify-center">
                <div class="max-w-md mx-auto mb-2 rounded-lg shadow-lg">
                    <div class="p-4">
                    <div class="col-14 pt-2 h-100 shadow rounded bg-white">
                        <div class="d-flex justify-content-center">
                            <h5 style="font-size: 0.6rem; font-style: arial;" class="mb-2 font-semibold text-black-600 hover:text-black-400 text-xs tracking-wider uppercase">
                            &nbsp;{{ $reservation->cateringoption ? $reservation->cateringoption->name : 'No service associated' }}&nbsp;
                            </h5>
                        </div>
                    </div>
                        <div class="dropdown-divider bold-divider"></div>
                        <div class="text-sm text-gray-700">
                            <p><strong>Reso_ID:&nbsp;</strong>  <a href="#" class="view-details my-md-1 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                &nbsp;&nbsp;{{ $reservation->id }}&nbsp;&nbsp;
                                </a></p>
                                <p>
                                <!--strong>Status:</strong-->
                                <div class="rounded-full p-1 mt-1 status-container {{ 
                                    $reservation->status == 'Fulfilled' ? 'success' : '' 
                                }}{{ 
                                    $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'failed' : '' 
                                }}{{ 
                                    $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'warning' : '' 
                                }}{{ 
                                    $reservation->status == 'Pending' ? 'pending' : '' 
                                }}{{ 
                                    $reservation->status == 'Approved' ? 'approved' : '' 
                                }}">
                                    {{ $reservation->status }}
                                </div>
                            </p>
                                @if ($reservation->serviceRating)
                                    <div class="ratings service-rating">
                                    <strong>Service&nbsp;</strong> 
                                        <span class="text-yellow-500">★</span> {{ number_format($reservation->serviceRating, 1) }}
                                    </div>
                                @else
                                    <div class="service-rating">
                                        <span>No rating yet for service</span>
                                    </div>
                                @endif
                                @if ($reservation->packageRating)
                                    <div class="ratings package-rating">
                                        <strong>Food&nbsp;</strong> 
                                        <span class="text-yellow-500">★</span> {{ number_format($reservation->packageRating, 1) }}
                                    </div>
                                @else
                                    <div class="package-rating">
                                        <span>No reviews yet</span>
                                    </div>
                                @endif


                                @if ($reservation->ratingComment)
                                    <div class="comment rating-comment">
                                        <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#commentModal{{ $reservation->id }}">
                                            <strong style="font-size: 0.65rem;">Comment</strong>
                                        </button>
                                    </div>

                                    <!-- Comment Modal -->
                                    <div class="modal fade" id="commentModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $reservation->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="commentModalLabel{{ $reservation->id }}">Reservation #{{ $reservation->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                    <p><strong>Comment:</strong></p>
                                                    <p style="white-space: pre-wrap; word-wrap: break-word;">{{ $reservation->ratingComment }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                        </div>
                        <div class="dropdown-divider bold-divider mt-1"></div>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-center">
                                <a href="#" class="view-details" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                    <i class="fas fa-info-circle custom-red-icon" style="font-size: 17px;"></i>
                                </a>
                                <small style="font-size: 0.65rem; color: #6c757d; display: block;">info</small>
                            </div>

                            @if($reservation->rating)
                                <div class="flex flex-col items-center">
                                    <button class="flex items-center py-2 px-3 bg-gray-500 rounded-lg text-white rated-btn" data-reservation-id="{{ $reservation->id }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <small style="font-size: 0.65rem; color: #6c757d; display: block;">Rated</small>
                                </div>
                            @endif
                            <div class="flex flex-col items-center">
                            <button type="button" class="bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                <i class="fa fa-trash" style="font-size: 17px;"></i>
                            </button>
                            </div>
                        </div>

                              <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $reservation->id }}">Delete Reservation</h5>
                                
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this <strong>reservation #{{ $reservation->id }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- End Delete Modal -->

        

                               <!-- Modal for viewing reservation details -->
                                <div class="modal fade" id="viewReservation{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $reservation->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-body p-4 bg-light custom-modal-body">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewReservation{{ $reservation->id }}Label">Reservation Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4 bg-light custom-modal-body">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('reservations.pdf', $reservation->id) }}" class="btn btn-dark btn-md mr-auto">
                                                        <i class="fa fa-download" style="font-size: 15px;"></i>
                                                    </a>
                                                
                                                    <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-gray-700 uppercase custom-status-span w-100 w-md-auto d-flex align-items-center justify-content-center">
                                                <h5 class="modal-title m-0">Reservation is <span class=" p-2 mt-1 status-container info-value {{ 
                                                            $reservation->status == 'Fulfilled' ? 'success' : '' 
                                                        }}{{ 
                                                            $reservation->status == 'Declined' || $reservation->status == 'Cancelled' ? 'failed' : '' 
                                                        }}{{ 
                                                            $reservation->status == 'In Progress' || $reservation->status == 'Not fulfilled' ? 'warning' : '' 
                                                        }}{{ 
                                                            $reservation->status == 'Pending' ? 'pending' : '' 
                                                        }}{{ 
                                                            $reservation->status == 'Approved' ? 'approved' : '' 
                                                        }}">{{ $reservation->status }}</span>
                                                </div></h5>
                                            </span>
                                            </span>

                                                <div class="dropdown-divider bold-divider"></div>

                                                
                                                <div class="reservation-info">
                                               
                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Reso ID</strong></p>
                                                   <span class="info-value text-sm"><strong>#{{ $reservation->id }}</strong></span>
                                               </div>
                                               

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Name</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->first_name }} {{ $reservation->last_name }}</span>
                                               </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Email</strong></p>
                                                   <span class="info-value text-gray-800 text-xs">{{ $reservation->email }}</span>
                                               </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Mobile No.</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->tel_number }}</span>
                                               </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Date</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->res_date->toDateString() }}</span>
                                               </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Time</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->res_date->format('h:i A') }}</span>
                                               </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Event</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->service ? $reservation->service->name : 'No event associated' }}</span>
                                               </div>

                                               <div class="info-item">
                                                <p class="text-xs text-gray-600 text-center"><strong>Venue</strong></p>
                                                    <span class="info-value text-xs">{{ $reservation->venue_address ? $reservation->venue_address : 'No venue address' }}</span>
                                                </div>

                                               <div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Guests</strong></p>
                                                   <span class="info-value text-xs">{{ $reservation->guest_number }} People</span>
                                               </div>

                                               <!--div class="info-item">
                                               <p class="text-xs text-gray-600 text-center"><strong>Package</strong></p>
                                               @if($reservation->package)
                                                       <span class="info-value text-xs text-gray-800">{{ $reservation->package->name }}</span>
                                                   @else
                                                       <p class="text-xs text-gray-600 text-center">No package associated</p>
                                                   @endif
                                               </div-->
                                               <div class="info-item flex flex-col sm:flex-row sm:justify-between w-full max-w-xs sm:max-w-md lg:max-w-lg">
                                                        <div class="overflow-x-auto">
                                                            <div class="inline-block min-w-full">
                                                                <div class="overflow-hidden border border-gray-300 rounded-lg">
                                                                    <table class="min-w-full table-auto text-center">
                                                                        <thead class="bg-gray-200 border-b">
                                                                            
                                                                            <tr class="bg-gray-500">
                                                                                <th colspan="3" class="px-2 py-1 tracking-wider text-xs text-white text-center">
                                                                                    <strong>Service Type</strong>
                                                                            </th>
                                                                            
                                                                            </tr>
                                                                           
                                                                            <tr class="bg-gray-50">
                                                                            <td colspan="3" class="px-2 py-1 text-sm text-gray-600 text-center">
                                                                                    {{ $reservation->cateringoption ? $reservation->cateringoption->name : 'No service associated' }}
                                                                                </td>
                                                                            </tr>
                                                                            @if ($reservation->cateringoption_id && $reservation->cateringoption->name == 'Full Catering')
                                                                            <th colspan="3" class="dropdown-divider bold-divider"></th>
                                                                            <tr class="bg-gray-500">
                                                                                <th colspan="3" class="px-2 py-1 tracking-wider text-xs text-white text-center">
                                                                                    <strong>Package</strong>
                                                                            </th>
                                                                            
                                                                            </tr>
                                                                            <tr class="bg-gray-50">
                                                                            <td colspan="3">
                                                                            {{ $reservation->package ? $reservation->package->name : 'No package associated' }}
                                                                        
                                                                                </td>
                                                                            </tr>
                                                                            @endif

                                                                            @if($reservation->supply_details && $reservation->supply_details != '[]')
                                                                                <th colspan="3" class="dropdown-divider bold-divider"></th>
                                                                                <tr>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase border-r">Supplies</th>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase border-r">Quantity</th>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase">Total Price</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white divide-y">
                                                                                    @php
                                                                                        $supplyDetails = json_decode($reservation->supply_details, true);
                                                                                    @endphp
                                                                                    @foreach($supplyDetails as $index => $supply)
                                                                                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                                                                            <td class="px-2 py-1 text-xs text-gray-700 border-r">{{ $supply['name'] }}</td>
                                                                                            <td class="px-2 py-1 text-xs text-gray-700 border-r">{{ $supply['quantity'] }}</td>
                                                                                            <td class="px-2 py-1 text-xs text-gray-700">₱{{ number_format($supply['total_price'], 2) }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                    <tr class="bg-gray-100 font-semibold">
                                                                                        <td colspan="2" class="px-2 py-1 text-right text-xs text-gray-700 border-r">Grand Total</td>
                                                                                        <td class="px-2 py-1 text-xs text-gray-700">₱{{ number_format($reservation->supply_total, 2) }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            @else
                                                                                @if (!($reservation->cateringoption_id && in_array($reservation->cateringoption->name, ['Service-Only Catering', 'Full Catering'])))
                                                                                    <tr>
                                                                                        <td colspan="3" class="px-2 py-1 text-xs text-gray-600 text-center">No supplies associated</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endif

                                                                            <th colspan="3" class="dropdown-divider bold-divider"></th>
                                                                            <tr class="bg-gray-500">
                                                                                <th colspan="3" class="px-2 py-1 tracking-wider text-xs text-white text-center">
                                                                                    <strong>Payment Mode</strong>
                                                                            </th>
                                                                            
                                                                            </tr>
                                                                            <tr class="bg-gray-50">
                                                                            <td colspan="3" class="px-2 py-1 text-sm text-gray-600 text-center
                                                                        
                                                                                {{ $reservation->payment_status == 'Full Payment' ? 'alert-success' : '' }} 
                                                                                {{ $reservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                                                                                {{ $reservation->payment_status == 'Cash on Delivery' ? 'alert-failed' : '' }}
                                                                                {{ $reservation->payment_status == 'Pay Online' ? 'alert-approved' : '' }}">
                                                                                {{ $reservation->payment_status }}
                                                                        
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider bold-divider"></div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-dark btn-md mr-auto" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>

@endsection


