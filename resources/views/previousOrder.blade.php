@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'previousOrder' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


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

    .btn-success {
        background-color: black;
        color: white;
    } 
    .btn-success:hover {
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


    .bold-divider {
        font-weight: bold; /* Make text bold */
        height: 2px; /* Increase height to make the line bolder */
        background-color: black; /* Ensure the line is visible */
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .custom-red-icon {
        color: black; /* Red color */
        border: 2px solid darkred; /* Red border */
        padding: 5px; /* Padding for spacing between border and icon */
        border-radius: 4px; /* Rounded corners */
        transition: color 0.3s ease, border-color 0.3s ease; /* Smooth transition for hover effect */
    }

    .custom-red-icon:hover {
        color: white; /* Change icon color on hover */
        border-color: white; /* Change border color on hover */
        background-color: darkred; /* Add background color on hover */
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
    .warning {
        background-color: #FFC107;
        color: #333;
        box-shadow: 0px 2px 4px rgba(255, 193, 7, 0.2);
    }

</style>


@if (!$previousOrders->count())
<!-- no previous orders -->
<section class="empty-order min-vh-100 flex-center pt-5">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="hero-wrapper">
            <img src="{{ URL::asset('/images/empty_order.svg') }}" alt="">
        </div>
        <h3 class="mt-4 mb-2">No Previous Orders Yet.</h3>
        <p class="text-muted">There seems to be no previous customer orders for now...</p>
        <div class="mt-5 d-flex justify-content-center align-items-center flex-wrap">
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
                <i class="fa fa-picture-o" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>
            
            <a href="{{ route('kitchenOrder') }}" class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2">
                <i class="fa fa-list-alt" style="font-size: 17px;"></i>&nbsp;Active Orders
            </a>
        
            <a href="{{ route('dashboard') }}" class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2">
                <i class="fa fa-tachometer" style="font-size: 17px;"></i>&nbsp;View Dashboard
            </a>
            
            <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
                <i class="fa fa-book" style="font-size: 17px;"></i>
                <!-- You can add a span or text here if needed -->
            </a>
        </div>

    </div>
</section>
@else
<section class="kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container mt-lg-0 mt-5">
        <h2 class="mt-5 mb-4" style="font-size: 1.0rem;font-style: italic;">Previous Orders</h2>

  <div class="row my-5 justify-content-between">
    <div class="col-12 pt-3 h-100 shadow rounded bg-white">
           <!-- Buttons for Catering Services and Catering Options -->
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                  <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
                        <i class="fa fa-picture-o" style="font-size: 17px;"></i>
                        <!-- You can add a span or text here if needed -->
                    </a>
                 <!-- Menu Button -->
                    <a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
                        <i class="fa fa-book" style="font-size: 17px;"></i>
                        <!-- You can add a span or text here if needed -->
                    </a>
            </div>
        
            <!-- Filter Reservations Dropdown -->
            <div class="dropstart">    
            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu p-2" style="min-width: 260px; background-color: white;"> <!-- Set minimum width and white background -->
                <form method="get" action="{{ route('filterPreviousOrders') }}" class="w-100">    
                    <div class="mb-1">
                        <label for="orderID" class="form-label text-xs">Order ID</label>
                        <select name="orderID" class="form-select form-select-sm text-xs" id="orderID">
                            <option value="" disabled selected>Select Reservation ID</option>
                            @foreach ($previousOrders as  $order)
                                <option value="{{  $order->id }}">{{  $order->id }}</option>
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
                        <label for="orderType" class="py-1 text-xs tracking-wider text-gray-700 uppercase dark:text-gray-400">Order Type</label>
                        <select name="orderType" class="form-control form-control-sm text-xs" id="orderType">
                            <option value="">All</option>
                            <option value="Dine-In">Dine In</option>
                            <option value="Take-Out">Take Out</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="sortField" value="{{ Request::get('sortField') }}">
                    <input type="hidden" name="sortOrder" value="{{ Request::get('sortOrder') }}">
                    
                    <div class="dropdown-divider col-12 mb-2"></div>
        
                    <button type="submit" class="btn btn-outline-dark btn-xs w-100">Filter</button>
                </form>
            </div>
        </div>
    </div>
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                  <tr>
                    <th scope="col">
                    <a href="#" class="btn btn-dark btn-sm" id="previewPdfBtnOrders" data-toggle="modal" data-target="#previewOrdersModal">
    <i class="fa fa-download"></i>
</a>

<div class="modal fade" id="previewOrdersModal" tabindex="-1" role="dialog" aria-labelledby="previewOrdersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header warning">
                <h6 class="modal-title" id="previewOrdersModalLabel">Preview</h6>
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
                            <input type="date" name="startDate" class="form-control form-control-sm text-xs" id="fromDate" aria-label="Start Date">
                            <span class="input-group-text text-xs">~</span>
                            <input type="date" name="endDate" class="form-control form-control-sm text-xs" id="toDate" aria-label="End Date">
                        </div>
                        <div class="input-group mt-2">
                        <span class="input-group-text text-xs" style="height: 30px; padding: 0 3px;"></span>
                        <button id="fetchAllBtn" class="btn-dark btn-xs" data-type="all" style="height: 30px; padding: 5px 10px;">All Orders</button>
                        <span class="input-group-text text-xs" style="height: 30px; padding: 0 5px;">~</span>
                        <button id="fetchDineInBtn" class="primary-btn btn-xs" data-type="Dine-In" style="height: 30px; padding: 5px 10px;">Dine-In</button>
                        <span class="input-group-text text-xs" style="height: 30px; padding: 0 3px;"></span>
                        <button id="fetchTakeOutBtn" class="primary-btn btn-xs" data-type="Take-Out" style="height: 30px; padding: 5px 10px;">Take-Out</button>
                        <span class="input-group-text text-xs" style="height: 30px; padding: 0 3px;"></span>
                        </div>
                    </div>
                </div>
                <!-- PDF Preview -->
                <iframe id="pdfPreviewOrders" src="" style="width: 100%; height: 70vh; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <a href="{{ route('OrdersTxn.Pdf') }}" class="btn btn-dark btn-sm">
                    <i class="fa fa-download"></i> PDF
                </a>
                <button type="button" class="btn primary-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('previewPdfBtnOrders').addEventListener('click', function () {
        const previewIframe = document.getElementById('pdfPreviewOrders');
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;

        if (fromDate && toDate) {
            previewIframe.src = `{{ route('OrdersTxn.Pdf') }}?preview=true&from=${fromDate}&to=${toDate}`;
        } else {
            previewIframe.src = `{{ route('OrdersTxn.Pdf') }}?preview=true`;
        }
    });

    document.getElementById('fetchAllBtn').addEventListener('click', function () {
        const previewIframe = document.getElementById('pdfPreviewOrders');
        previewIframe.src = `{{ route('OrdersTxn.Pdf') }}?preview=true`;
        document.getElementById('fromDate').value = '';
        document.getElementById('toDate').value = '';
    });

    document.getElementById('fromDate').addEventListener('change', function () {
        updatePreviewIframe();
    });

    document.getElementById('toDate').addEventListener('change', function () {
        updatePreviewIframe();
    });

    function updatePreviewIframe() {
        const previewIframe = document.getElementById('pdfPreviewOrders');
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;

        if (fromDate && toDate) {
            previewIframe.src = `{{ route('OrdersTxn.Pdf') }}?preview=true&from=${fromDate}&to=${toDate}`;
        }
    }
</script>

<script>
    // Handle button clicks to update the iframe based on filter selection
    document.getElementById('fetchAllBtn').addEventListener('click', function() {
        updateIframe('');
    });

    document.getElementById('fetchDineInBtn').addEventListener('click', function() {
        updateIframe('Dine-In');
    });

    document.getElementById('fetchTakeOutBtn').addEventListener('click', function() {
        updateIframe('Take-Out');
    });

    function updateIframe(type) {
        const previewIframe = document.getElementById('pdfPreviewOrders');
        let url = "{{ route('OrdersTxn.Pdf') }}?preview=true";
        
        if (type) {
            url += "&type=" + type; // Append the type filter to the URL
        }

        previewIframe.src = url; // Update iframe source
    }
</script>


                    </th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'id', 'sortOrder' => (Request::get('sortField') == 'id' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Order ID</a></th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'dateTime', 'sortOrder' => (Request::get('sortField') == 'dateTime' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Date</a></th>
                    <th scope="col"><a href="{{ route('filterPreviousOrders', ['sortField' => 'dateTime', 'sortOrder' => (Request::get('sortField') == 'dateTime' && Request::get('sortOrder') == 'asc') ? 'desc' : 'asc']) }}">Time</a></th>
                    <th scope="col">FinalPrice</th>
                    <th scope="col">
                        Status
                    </th>

                    <!-- Modal -->
                    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loadingModalLabel">Preparing PDF</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Please wait while the PDF is being prepared for download...
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('pdfDownloadBtnOrders').addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default action

                            // Show the modal
                            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                            loadingModal.show();

                            // Start the PDF download
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '{{ route('OrdersTxn.Pdf') }}', true);
                            xhr.responseType = 'blob';

                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                                    var link = document.createElement('a');
                                    link.href = window.URL.createObjectURL(blob);
                                    link.download = 'OrdersTxn.pdf';
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
                @foreach ($previousOrders as $order)
                    <tr>
                        <td><a href="#" class="view-details" data-toggle="modal" data-target="#viewOrderModal{{ $order->id }}">
                            <i class="fas fa-eye px-1 custom-red-icon" style="font-size: 12px;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('specificKitchenOrder', $order->id) }}" class="my-md-2 mt-4 mb-5 px-3 py-1 btn-sm btn-warning flex-md-row "><strong>#</strong>{{ $order->id }}</a>
                            </td>
                        <td> {{ \Carbon\Carbon::parse($order->getOrderDate())->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->getOrderTime())->format('h:i A') }}</td>
                        <td>₱{{ $order->getTotalFromScratch() }}</td>
                        <td>
                            @if ($order->completed)
                                <div class="px-3 alert alert-success">
                                    Fulfilled
                                </div>  
                            @else
                                <div class="px-3 alert alert-warning">
                                    Not fulfilled
                                </div>  
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

    <div class="mt-5 d-flex justify-content-start align-items-center flex-wrap">
          
            <!--a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
                <i class="fa fa-picture-o" style="font-size: 17px;"></i>
            </a-->

            <!-- Active Orders Button -->
            <a href="{{ route('kitchenOrder') }}" class="primary-btn">Active Orders</a>
            <!-- Pagination Links (activeOrders links) -->
            <div class="my-1 me-2">
                {{ $previousOrders->links() }}
            </div>

          
            <!--a class="my-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
                <i class="fa fa-book" style="font-size: 17px;"></i>
            </a-->

        </div>
    </div>
</section>

@endif

<!-- Modal markup -->
@foreach ($previousOrders as $order)
<div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="viewOrderModal{{ $order->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModal{{ $order->id }}Label">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 bg-light custom-modal-body">
                <div class="d-flex justify-content-between">
                    @if ($order->transaction)
                        <a href="{{ route('transactions.pdf', $order->transaction->id) }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-download" style="font-size: 15px;"></i></a>
                    @endif
                </div>

                <div class="dropdown-divider bold-divider"></div>

                <div class="reservation-info">
                    <div class="info-item">
                        <span class="info-label">Order ID:</span> <span class="info-value">#{{ $order->id }}</span>
                    </div>
                    @if ($order->user)
                        <div class="info-item">
                            <span class="info-label">Customer:</span> <span class="info-value">{{ $order->user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span> <span class="info-value">{{ $order->user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Mobile Number:</span> <span class="info-value">{{ $order->user->mobile_number }}</span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">Order Type:</span> <span class="info-value">{{ $order->type }}</span>
                    </div>
                    <!-- Add other order details here -->
                    <!-- Example: -->
                    <div class="info-item">
                        <span class="info-label">Date:</span> <span class="info-value">{{ $order->getOrderDate() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Time:</span> <span class="info-value">{{ \Carbon\Carbon::parse($order->getOrderTime())->format('h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Final Price:</span> <span class="info-value">₱ {{ $order->getTotalFromScratch() }}</span>
                    </div>
                    <!-- End of example -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

