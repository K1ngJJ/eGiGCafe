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
.info-comments {
    display: flex;
    justify-content: space-between; /* Aligns items to opposite ends */
    align-items: center; /* Vertically centers items */
    padding: 0.5rem 0;
    margin-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
}

.info-comments:last-child {
    border-bottom: none;
}

.info-comment {
    text-align: right; /* Ensures the text aligns to the right */
    word-wrap: break-word; /* Breaks long words if necessary */
    max-width: 70%; /* Optional: limits the width of the venue value */
}

.info-comment {
    text-align: left; /* Ensures the text aligns to the right */
    word-wrap: break-word; /* Breaks long words if necessary */
    max-width: 70%; /* Optional: limits the width of the venue value */
}
.info-themecomments {
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-themecomments p {
    font-weight: bold;
    text-align: left; /* Center the label */
}

.info-themecomments .info-themecomment {
    white-space: pre-wrap; /* Preserve line breaks */
    word-wrap: break-word; /* Handle long words */
    text-align: left; /* Center the comments */
    display: block; /* Ensure it starts on a new line */
}
</style>


<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container mt-lg-0 mt-5">
        <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Catering Reservations</h2>
    <div class="row my-5 justify-content-between">
    <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
        <!-- Buttons for Catering Services and Catering Options -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('packages.index') }}">
                <i class="fa fa-th-large" style="font-size: 17px;"></i>
                <!--span>Catering Packages</span-->
            </a>
            <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('cateringoptions.index') }}">
                <i class="fas fa-cogs" style="font-size: 17px;"></i>
                <!--span>Catering Options</span-->
            </a>
        </div>
        
    
        <!-- Filter Reservations Dropdown -->
        <div class="dropstart">
            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
            <!-- Triggering Modal and PDF Preview -->
<a href="#" class="btn btn-dark btn-sm" id="previewPdfBtn" data-toggle="modal" data-target="#previewModal">
    <i class="fa fa-download"></i>
</a>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header warning">
                <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <!-- Date Range Picker -->
                 <div class="row mb-3">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="startDate" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">From Date</label>
                            <label for="endDate" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">To Date</label>
                        </div>
                        <div class="input-group">
                            <input type="date" name="fromDate" class="form-control form-control-sm text-xs" id="fromDate" aria-label="Start Date">
                            <span class="input-group-text text-xs">~</span>
                            <input type="date" name="toDate" class="form-control form-control-sm text-xs" id="toDate" aria-label="End Date">
                        </div>
                        <div class="input-group mt-2">
                        <span class="input-group-text text-xs primary-btn" style="height: 30px; padding: 0 3px;"></span>
                       
                        <select id="eventType" class="form-control form-control-sm" style="height: 30px; font-size: 0.65rem;">
                            <option value="all">All Event</option>
                            <option value="28">Wedding</option>
                            <option value="29">Birthday</option>
                        </select>

                  
                        <span class="input-group-text text-xs dark" style="height: 30px; padding: 0 3px;"></span>
                        <select id="serviceType" class="form-control form-control-sm" style="height: 30px; font-size: 0.65rem;">
                            <option value="all">All Service</option>
                            <option value="35">Full Catering </option>
                            <option value="36">Service-Only Catering</option>
                            <option value="37">Equipment Rental</option>
                        </select>
                        <span class="input-group-text text-xs dark" style="height: 30px; padding: 0 3px;"></span>
                        <select id="paymentMode" class="form-control form-control-sm" style="height: 30px; font-size: 0.61rem;">
                            <option value="all">All Payment</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Down Payment">Down Payment</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                        </select>
                        <span class="input-group-text text-xs primary-btn" style="height: 30px; padding: 0 3px;"></span>
                        </div>
                    </div>
                </div>
                <!-- PDF Preview -->
                <iframe id="pdfPreview" src="" style="width: 100%; height: 70vh; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <a href="{{ route('ReservationsTxn.Pdf') }}" class="btn btn-dark btn-sm">
                    <i class="fa fa-download"></i> PDF
                </a>
                <button type="button" class="btn primary-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('previewPdfBtn').addEventListener('click', function () {
        updateIframe();
    });

    // Update iframe on filter change
    document.getElementById('fromDate').addEventListener('change', updateIframe);
    document.getElementById('toDate').addEventListener('change', updateIframe);
    document.getElementById('eventType').addEventListener('change', updateIframe);
    document.getElementById('serviceType').addEventListener('change', updateIframe);
    document.getElementById('paymentMode').addEventListener('change', updateIframe);

    function updateIframe() {
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;
        const eventType = document.getElementById('eventType').value;
        const serviceType = document.getElementById('serviceType').value;
        const paymentMode = document.getElementById('paymentMode').value;

        const previewIframe = document.getElementById('pdfPreview');
        const queryParams = new URLSearchParams({
            preview: true,
            fromDate,
            toDate,
            eventType,
            serviceType,
            paymentMode,
        });

        previewIframe.src = "{{ route('ReservationsTxn.Pdf') }}?" + queryParams.toString();
    }
</script>


                            
            <!-- Button for creating new reservations -->
            <a href="{{ route('reservations.create') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
             <!-- Filter Modal -->
            <div class="dropdown-menu p-2" style="width: 80%; max-width: 300px; min-width: 200px; background-color: white;">
                <form method="get" action="{{ route('filterReservation') }}" class="w-100">    
                    <div class="mb-1">
                        <label for="id" class="form-label text-xs">Reservation ID</label>
                        <select name="id" class="form-select form-select-sm text-xs" id="id">
                            <option value="" disabled selected>Select Reservation ID</option>
                            @foreach ($reservations as $reservation)
                                <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="dropdown-divider"></div>
    
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="startDate" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">From Date</label>
                            <label for="endDate" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">To Date</label>
                        </div>
                        <div class="input-group">
                            <input type="date" name="startDate" class="form-control form-control-sm text-xs" id="startDate" aria-label="Start Date">
                            <span class="input-group-text text-xs">~</span>
                            <input type="date" name="endDate" class="form-control form-control-sm text-xs" id="endDate" aria-label="End Date">
                        </div>
                    </div>
    
                    <div class="dropdown-divider"></div>
    
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="startTime" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">From Time</label>
                            <label for="endTime" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">To Time</label>
                        </div>
                        <div class="input-group">
                            <input type="time" name="startTime" class="form-control form-control-sm text-xs" id="startTime" aria-label="Start Time">
                            <span class="input-group-text text-xs">~</span>
                            <input type="time" name="endTime" class="form-control form-control-sm text-xs" id="endTime" aria-label="End Time">
                        </div>
                    </div>
    
                    <div class="dropdown-divider"></div>
    
                    <div class="mb-1">
                        <label for="status" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">Status</label>
                        <select name="status" class="form-select form-select-sm text-xs" id="status">
                            <option value="" disabled selected>Select Status</option>
                            <option value="Fulfilled">Fulfilled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
    
                    <div class="mb-1">
                        <label for="payment_status" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">Payment Status</label>
                        <select name="payment_status" class="form-select form-select-sm text-xs" id="payment_status">
                            <option value="" disabled selected>Select Payment Status</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Down Payment">Down Payment</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                        </select>
                    </div>
    
                    <div class="mb-1">
                        <label for="service" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">Service</label>
                        <select name="service" class="form-select form-select-sm text-xs" id="service">
                            <option value="" disabled selected>Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark w-100 btn-sm">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Filter Reservations Dropdown aligned to the right -->
    </div>

  


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="px-4">Reso ID</div></th>
                        <th scope="col">
                            <div class="px-4">Date</div></th>
                        <th scope="col">
                            <div class="px-4">Time</div></th>
                        <th scope="col">
                            <div class="px-4">Status</div></th>
                        <th scope="col">
                            <div class="px-4">Payment Mode</div></th>
                        <!--th scope="col">Service</th>
                        <th scope="col">Package</th>
                        <th scope="col">Supply</th>
                        <th scope="col">Guests</th-->       
                        <th scope="col">
                        <div class="px-4">
                           Receipt
                        </div>
                    </th>
                    <script>
                        document.getElementById('pdfDownloadBtn').addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default action

                            // Show the modal
                            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                            loadingModal.show();

                            // Start the PDF download
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '{{ route('ReservationsTxn.Pdf') }}', true);
                            xhr.responseType = 'blob';

                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = 'ReservationsTxn.pdf';
                                    link.click();

                                    // Hide the modal after download starts
                                    loadingModal.hide();

                                    // Reload the page after a delay (e.g., 2 seconds)
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000); // Adjust the delay (in milliseconds) as needed
                                } else {
                                    console.error('Failed to download PDF');
                                    // Hide the modal if an error occurs
                                    loadingModal.hide();
                                }
                            };

                            xhr.onerror = function() {
                                console.error('Network error occurred');
                                // Hide the modal if a network error occurs
                                loadingModal.hide();
                            };

                            xhr.send();
                        });
                    </script>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <th class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <a href="#" class="view-details my-md-1 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                            #{{ $reservation->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-eye my-md-1 px-2 py-1 " style="font-size: 15px;"></i>&nbsp; 
                            </a>

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

                                            <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase custom-status-span">
                                                Status
                                            </span>
                                            <select id="reservationStatus{{ $reservation->id }}" class="form-control">
                                                @foreach(\App\Enums\ReservationStatus::cases() as $status)
                                                        <option value="{{ $status->value }}" {{ $reservation->status === $status->value ? 'selected' : '' }}>{{ $status->value }}</option>
                                                @endforeach
                                            </select>

                                            @if($reservation->status !== 'Fulfilled')
                                                <button onclick="window.location.href='{{ route('reservations.edit', $reservation->id) }}'" class="btn-md btn btn-warning ml-auto">
                                                    <i class="fa fa-edit" style="font-size: 20px;"></i>
                                                </button>
                                            @endif
                                            
                                            <!--span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-left text-gray-700 uppercase custom-status-span">
                                                Payment Status
                                            </span>
                                            <select id="paymentStatus{{ $reservation->id }}" class="form-control">
                                                @foreach(\App\Enums\PaymentStatus::cases() as $payment_status)
                                                        <option value="{{ $payment_status->value }}" {{ $reservation->payment_status === $payment_status->value ? 'selected' : '' }}>{{ $payment_status->value }}</option>
                                                @endforeach
                                            </select-->

                                            </div>

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

                                                <div class="info-comments d-flex justify-content-between">
                                                    <p class="text-xs text-gray-600">
                                                        <strong>Venue</strong>
                                                    </p>
                                                    <span class="info-comment text-xs text-end" style="white-space: normal;">
                                                        {{ $reservation->venue_address ? $reservation->venue_address : 'No venue address' }}
                                                    </span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Guests</strong></p>
                                                    <span class="info-value text-xs">{{ $reservation->guest_number }} People</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Theme</strong></p>
                                                    <span class="info-value text-xs">
                                                        @if($reservation->theme_type === 'custom')
                                                            Custom Theme
                                                        @else
                                                            {{ ucfirst($reservation->theme_type) }}
                                                        @endif
                                                    </span>
                                                </div>

                                                @if($reservation->theme_type === 'custom')
                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Main Color</strong></p>
                                                    <span class="info-value text-xs">{{ ucfirst($reservation->custom_main_color) }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Sub Color</strong></p>
                                                    <span class="info-value text-xs">{{ ucfirst($reservation->custom_sub_color) }}</span>
                                                </div>
                                                @else
                                                <div class="info-item flex items-center justify-center">
                                                    <p class="text-xs text-gray-600 text-center mr-2"><strong>Main Color</strong></p>
                                                    <div class="h-6 w-6 rounded-full border border-gray-400" style="background-color: {{ $reservation->main_color ?? '#ffffff' }};"></div>
                                                </div>

                                                <div class="info-item flex items-center justify-center">
                                                    <p class="text-xs text-gray-600 text-center mr-2"><strong>Sub Color</strong></p>
                                                    <div class="h-6 w-6 rounded-full border border-gray-400" style="background-color: {{ $reservation->sub_color ?? '#ffffff' }};"></div>
                                                </div>
                                                @endif

                                                @if($reservation->theme_comments)
                                                <div class="info-themecomments">
                                                    <p class="text-xs text-gray-600 text-left">
                                                        <strong>Additional Theme Details</strong>
                                                    </p>
                                                    <span class="info-themecomment text-xs" style="word-wrap: break-word; display: block; text-align: center;">
                                                        {{ $reservation->theme_comments }}
                                                    </span>
                                                </div>
                                                @endif

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
                        </th>
                        <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <div class="my-md-1 px-2 py-1">
                                {{ \Carbon\Carbon::parse($reservation->res_date)->format('F j, Y') }} <!-- Format as 'Month Day, Year' -->
                            </div>
                        </td> <!-- Display date -->
                        <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <div class="my-md-1 px-2 py-1">{{ $reservation->res_date->format('h:i A') }}</div>
                        </td>
                        <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                       <div class="status-container mt-1 {{ 
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
                        </td>
                        <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                        <div class="mt-1 px-2 alert 
                            {{ $reservation->payment_status == 'Full Payment' ? 'alert-success' : '' }} 
                            {{ $reservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                            {{ $reservation->payment_status == 'Cash on Delivery' ? 'alert-failed' : '' }}
                            {{ $reservation->payment_status == 'Pay Online' ? 'alert-approved' : '' }}">
                            &nbsp;&nbsp;{{ $reservation->payment_status }}&nbsp;&nbsp;
                        </div>
                        </td> 
                        <!--td>{{ $reservation->service ? $reservation->service->name : 'No service associated' }}</td>
                        <td>{{ $reservation->package ? $reservation->package->name : 'No package associated' }}</td>
                        <td class="email">{{ $reservation->inventory_supplies }}</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $reservation->guest_number }}</-->

                        <!--td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <div class=" d-flex ">
                                <a href="#" class="view-details btn-sm" data-toggle="modal" data-target="#viewReservation{{ $reservation->id }}">
                                    <i class="fas fa-eye px-3 py-1 custom-red-icon" style="font-size: 17px;"></i> 
                                </a>
                                @if(!in_array($reservation->status, ['Approved', 'In Progress', 'Fulfilled']))
                                    <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                        <i class="fa fa-trash" style="font-size: 17px;"></i>
                                    </button>
                                @endif
                            </div>
                        </td-->    

                        <td class="py-3 px-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                            <div class=" d-flex ">
                                <a href="#" class="view-details btn-sm " data-toggle="modal" data-target="#viewReceipt{{ $reservation->id }}">
                                    <i class="fas fa-image custom-red-icon" style="font-size: 17px;"></i>
                                </a>
                                @if(!in_array($reservation->status, ['Approved', 'In Progress', 'Fulfilled']))
                                    <button type="button" class="my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}">
                                        <i class="fa fa-trash" style="font-size: 17px;"></i>
                                    </button>
                                @endif
                            </div>
                        </td>    
                        
                    </tr>

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
                </div>
            </div>
                    <!-- End Delete Modal -->


                    
                    <!-- Delete Receipt Image Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="z-index: 1060;">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Remove Receipt</h5>
                                </div>
                                <div class="modal-body" style="background-color: black; color: white;">
                                    Are you sure you want to remove this receipt?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn primary-btn" onclick="deleteImage()">
                                        <i class="fa fa-trash" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Receipt Image Modal -->

                   <!-- Receipt Image Modal -->
                    <div class="modal fade" id="viewReceipt{{ $reservation->id }}" tabindex="-1" aria-labelledby="viewReceiptLabel{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!--h5 class="modal-title" id="viewReceiptLabel{{ $reservation->id }}">Proof of Payment for Reservation #{{ $reservation->id }}</h5-->
                                    <h5 class="modal-title" id="viewReceiptLabel{{ $reservation->id }}">Proof of Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-4 bg-light custom-modal-body text-center">
                                    <div class="d-flex flex-column flex-md-row align-items-stretch justify-content-center text-center text-md-left">
                                        <!--a href="{{ route('reservations.pdf', $reservation->id) }}" class="btn btn-dark btn-md mb-2 mb-md-0 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-download" style="font-size: 15px;"></i>
                                        </a-->
                                        <a href="{{ route('reservations.pdf', $reservation->id) }}" class="btn btn-dark btn-md d-flex align-items-center justify-content-center">
                                            <i class="fa fa-download" style="font-size: 15px;"></i>
                                            </a>

                                        <span class="input-group-text py-1 px-2 text-xs text-black font-small tracking-wider text-gray-700 custom-resoid-span w-100 w-md-auto d-flex align-items-center justify-content-center">
                                            <h5 class="modal-title m-0" id="viewReceiptLabel{{ $reservation->id }}">Reso ID : # {{ $reservation->id }}</h5>
                                        </span>

                                        <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-gray-700 uppercase custom-status-span w-100 w-md-auto d-flex align-items-center justify-content-center">
                                            <h5 class="modal-title m-0" id="viewReceiptLabel{{ $reservation->id }}">Customer #{{ $reservation->user_id }} Reciept</h5>
                                        </span>

                                        <span class="input-group-text py-1 px-2 text-xs text-black font-small tracking-wider text-gray-700 custom-psid-span w-100 w-md-auto d-flex align-items-center justify-content-center">
                                            @if ($reservation->payment_selection === 'GCash')
                                            <img src="/images/gcash.png" alt="GCash" style="width: 70px; height: 18px;" class="h-6 w-6 mr-2">
                                            @elseif ($reservation->payment_selection === 'Paypal')
                                            <img src="/images/paypal.png" alt="PayPal" style="width: 70px; height: 18px;" class="h-6 w-6 mr-2">
                                            @endif
                                            <!--h5 class="modal-title m-0 custom-psid-span" id="viewReceiptLabel{{ $reservation->id }}">
                                                {{ $reservation->payment_selection ? $reservation->payment_selection : 'N/A' }}
                                            </h5-->
                                        </span>

                                    </div>
                                    <div class="dropdown-divider bold-divider"></div>
                                    <div class="image-grid">
                                        @if($reservation->receipt_image)
                                            @php
                                                // Decode JSON array from the receipt_image column
                                                $images = json_decode($reservation->receipt_image, true);
                                            @endphp

                                            @if(count($images) > 0)
                                                @foreach($images as $image)
                                                    <div class="image-container">
                                                        <!-- Image Thumbnail with Preview Functionality -->
                                                        <img src="{{ asset('receipts/' . $image) }}" alt="Receipt Image" class="img-fluid previewImage" onclick="openPreview(this)">

                                                        <!-- Delete Button Overlay -->
                                                        <button class="delete-btn my-md-1 px-2 py-1 bg-red-500 btn-sm primary-btn d-flex flex-md-row flex-column justify-content-md-between" onclick="confirmDelete('{{ $reservation->id }}', '{{ $image }}')">
                                                            <i class="fa fa-trash" style="font-size: 17px;"></i>
                                                        </button>

                                                        <!-- Full-size Image Preview Modal -->
                                                        <div class="preview-modal" onclick="closePreview(event)">
                                                            <img src="{{ asset('receipts/' . $image) }}" alt="Full-size Receipt Image" class="fullImage">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No receipt image uploaded for this reservation.</p>
                                            @endif
                                        @else
                                            <p>No receipt image uploaded for this reservation.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <!--@if($reservation->receipt_image)
                                        <a href="{{ asset('receipts/' . $reservation->receipt_image) }}" class="btn btn-dark" download>
                                            <i class="fa fa-download" style="font-size: 15px;"></i> Download Receipt
                                        </a>
                                    @endif-->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>




<script>
    let reservationId, imageToDelete;

    function openPreview(image) {
        const modal = image.nextElementSibling.nextElementSibling;
        modal.style.display = 'flex';
    }

    function closePreview(event) {
        if (event.target.classList.contains('preview-modal')) {
            event.target.style.display = 'none';
        }
    }

    function confirmDelete(resId, image) {
        reservationId = resId;
        imageToDelete = image;
        $('#deleteModal').modal('show');
    }

    function deleteImage() {
        $.ajax({
            url: '/delete-receipt-image',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                reservation_id: reservationId,
                image: imageToDelete
            },
            success: function(response) {
                if(response.success) {
                    $('img[src$="' + imageToDelete + '"]').closest('.image-container').remove();
                    $('#deleteModal').modal('hide');
                } else {
                    alert('Failed to delete the image. Please try again.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="reservationStatus"]').forEach(function (selectElement) {
        selectElement.addEventListener('change', function () {
            const reservationId = selectElement.id.replace('reservationStatus', '');
            const newStatus = selectElement.value;

            fetch(`/reservations/${reservationId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensure you have the CSRF token for the request
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully');
                    location.reload();  // Refresh the page
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

  //  document.addEventListener('DOMContentLoaded', function () {
    // Match the correct ID prefix
//    document.querySelectorAll('[id^="paymentStatus"]').forEach(function (selectElement) {
//        selectElement.addEventListener('change', function () {
//            const reservationId = selectElement.id.replace('paymentStatus', ''); // Correct prefix
//            const newStatus = selectElement.value;

//           fetch(`/reservations/${reservationId}/status`, {
//                method: 'PATCH',
//                headers: {
//                    'Content-Type': 'application/json',
//                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensure you have the CSRF token for the request
//                },
//                body: JSON.stringify({ status: newStatus })
//            })
//            .then(response => response.json())
//            .then(data => {
//                if (data.success) {
//                    alert('Status updated successfully');
//                   location.reload();  // Refresh the page
//                } else {
//                    alert('Failed to update status');
//                }
//            })
//            .catch(error => console.error('Error:', error));
//        });
//    });
//});

</script>

<script>
document.getElementById('pdfDownloadBtn').addEventListener('click', function() {
// Show loading modal
$('#loadingModal').modal('show');
// Show loading style (e.g., spinner)
// You can add your loading animation here

// Optionally, you can add a delay before starting the download
// setTimeout(function() {
//     // Start the download
//     window.location.href = "{{ route('ReservationsTxn.Pdf') }}";
// }, 1000); // 1000 milliseconds delay

// Or, you can directly start the download without delay
window.location.href = "{{ route('ReservationsTxn.Pdf') }}";

// To prevent the default behavior (i.e., following the link) and handle the download manually
// You can uncomment the following line if you want to prevent the default behavior
// return false;
});
</script>
@endsection


