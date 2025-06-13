@extends('layouts.thankyou')


@section('links')
        <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

@section('content')
<style>
         .payment-section {
            display: none;
        }

        .status-container {
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
            text-align: center;
            animation: pulse 1.5s ease infinite;
        }

        .status-text {
            text-transform: uppercase;
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
    .gradient-hr {
        border: none; /* Remove default border */
        height: 1px; /* Adjust height as needed */
        background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
        border-radius: 8px;
    }

    .dropdown-divider.bold-divider {
        background-color: black;
        height: 3px; 
    }

    .modal {
        display: none; /* Hidden by default */
    }

    .modal.active {
        display: flex;
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
    
<section class="banner kitchen-previous-orders min-vh-100 d-flex align-items-center mt-lg-0 mt-3">
    <div class="container">
    @if (session('success'))
    <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
        {{ session('success') }}
    </div>
    @endif
    <br>
    <br>
    <br>
        <div class="container w-full px-5 py-6 mx-auto">
            <table class="table table-hover">
                <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
                    <h6 class="d-flex justify-content-center menu-title">
                    LATEST RESERVATION
                    <!--span style="color: #FF8C00; margin-left: 5px;">RESERVATION</span-->
                    <!--span style="color: #dc3545; margin-left: 5px;">HISTORY</span-->
                    </h6>
                    <br>
                </div>
            </table>
                <hr class="my-4 gradient-hr">
                @if (Session::has('reservation_step_two_completed'))
                    <div class="w-full bg-gray-100 rounded-full border-1 border-transparent border-gradient">
                        <div class="w-40 p-1 text-xs font-medium leading-none text-center rounded-full">
                            Reservation Form Complete!
                        </div>
                    </div>
                @endif
                <div class="row my-3">
    @if ($latestReservation)
       
            <div class="flex justify-center">
                <div class="max-w-md mx-auto mb-2 rounded-lg shadow-lg">
                    <div class="p-4">
                    <div class="col-12 pt-2 h-100 shadow rounded bg-white">
                        <div class="d-flex justify-content-center">
                            <h5 style="font-size: 0.9rem; font-style: arial;" class="mb-2 font-semibold text-black-600 hover:text-black-400 text-xs tracking-wider uppercase">
                                &nbsp;{{ $latestReservation->cateringoption ? $latestReservation->cateringoption->name : 'No service associated' }}&nbsp;
                            </h5>
                        </div>
                    </div>
                        <div class="dropdown-divider bold-divider"></div>
                        <div class="text-sm text-gray-700">
                            <p><strong>Reso_ID:&nbsp;</strong>  <a href="#" class="view-details my-md-1 px-2 py-1 btn-sm primary-btn" data-toggle="modal" data-target="#viewReservation{{ $latestReservation->id }}">
                                &nbsp;&nbsp;{{ $latestReservation->id }}&nbsp;&nbsp;
                                </a></p>
                            <p><strong>Date:&nbsp;</strong> {{ \Carbon\Carbon::parse($latestReservation->res_date)->format('F j, Y') }}</p>
                            <p><strong>Time:&nbsp;</strong> {{ $latestReservation->res_date->format('h:i A') }}</p>
                            <p>
                                <!--strong>Status:</strong-->
                                <div class="rounded-full p-1 mt-1 status-container {{ 
                                    $latestReservation->status == 'Fulfilled' ? 'success' : '' 
                                }}{{ 
                                    $latestReservation->status == 'Declined' || $latestReservation->status == 'Cancelled' ? 'failed' : '' 
                                }}{{ 
                                    $latestReservation->status == 'In Progress' || $latestReservation->status == 'Not fulfilled' ? 'warning' : '' 
                                }}{{ 
                                    $latestReservation->status == 'Pending' ? 'pending' : '' 
                                }}{{ 
                                    $latestReservation->status == 'Approved' ? 'approved' : '' 
                                }}">
                                    {{ $latestReservation->status }}
                                </div>
                            </p>
                            <p>     
                                <!--strong>Payment Mode:</strong--> 
                                <div class="flex justify-between items-center">
                                <span class="p-4 alert {{ $latestReservation->payment_status == 'Full Payment' ? 'alert-success' : '' }} {{ $latestReservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }} {{ $latestReservation->payment_status == 'Cash on Delivery' ? 'alert-failed' : '' }} {{ $latestReservation->payment_status == 'Pay Online' ? 'alert-approved' : '' }}">
                                    {{ $latestReservation->payment_status }}
                                </span>
                                <div class="text-center">
                                    <small style="font-size: 0.45rem; color: #6c757d; display: block;">&nbsp;&nbsp;<b>Pay Online</b></small>
                                    <a href="#" class="view-details btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $latestReservation->id }}">
                                    <i class="fab fa-paypal alert-pay" style="font-size: 22px; animation: warning 2s infinite;"></i>

                                    </a>
                                    <small style="font-size: 0.45rem; color: #6c757d; display: block;">&nbsp;&nbsp;(click me)</small>
                                </div>
                                </div>
                            </p>
                        </div>
                        <div class="dropdown-divider bold-divider mt-1"></div>
                        <div class="flex justify-between items-center mt-2">
                            <div class="text-center">
                                <a href="#" class="view-details" data-toggle="modal" data-target="#viewReservation{{ $latestReservation->id }}">
                                    <i class="fas fa-info-circle custom-red-icon" style="font-size: 17px;"></i>
                                </a>
                                <small style="font-size: 0.65rem; color: #6c757d; display: block;">info</small>
                            </div>
                            

                            @if(in_array($latestReservation->status, ['Approved', 'In Progress', 'Fulfilled']) && $latestReservation->payment_status !== 'Cash on Delivery')
                                <div class="dropstart">
                                    <button type="button" class="custom-red-icon flex items-center px-2 py-1 text-blue-500 hover:text-blue-700 rounded cursor-not-allowed text-xs" onclick="toggleDropdown(this)">
                                    <i class="fa fa-receipt " style="font-size: 17px;"></i> 
                                    </button>
                                  
                                    <div class="dropdown-menu p-3">
                                        <form method="post" action="{{ route('receiptImage') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="reservation_id" value="{{ $latestReservation->id }}">

                                            <div class="mb-1">
                                                <label for="paymentmode" class="form-label" style="font-size: 0.65rem; font-style: arial; text-transform: uppercase;">
                                                    Upload your <strong>receipt</strong>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input id="image-upload-input-{{ $latestReservation->id }}" type="file" name="images[]" accept="image/*" multiple required style="display: none;" onchange="previewImages(this, {{ $latestReservation->id }})">
                                                    <label for="image-upload-input-{{ $latestReservation->id }}" class="btn btn-secondary" style="font-size: 0.65rem; font-style: italic;">
                                                        <i class="fas fa-camera"></i> Choose Images
                                                    </label>
                                                </div>

                                                <div id="image-previews-{{ $latestReservation->id }}" class="d-flex mt-2"></div>
                                            </div>

                                            <div class="dropdown-divider"></div>

                                            <button type="submit" class="btn btn-outline-success" style="font-size: 0.65rem; font-style: arial;">
                                                <i class="fas fa-upload" style="margin-right: 0.5rem;"></i> Upload
                                            </button>
                                        </form>
                                    </div>
                                    <small style="font-size: 0.65rem; color: #6c757d; display: block;">receipt</small>
                                </div>
                            @endif

                            @if(in_array($latestReservation->status, ['Approved', 'In Progress']))
    <!-- Cancellation Policy Section -->
    <div class="flex items-center px-2 py-1 bg-gray-300 rounded text-gray-500 cursor-not-allowed text-xs">
        <span class="text-darkgreen">Cancel</span>
        <a href="#" class="ml-1 text-darkgreen" title="View Cancellation Policy" onclick="openModal(event)">
            <i class="fas fa-question-circle"></i>
        </a>
    </div>
    @endif

    <!-- Cancellation Policy Modal -->
    <div id="cancellationModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-5 rounded-md shadow-lg max-w-sm text-center">
            <h2 class="text-lg font-semibold mb-2">Cancellation Not Available</h2>
            <p class="text-sm text-gray-700">You can still request a cancellation after approval through contacting support within 24 hours of approval.</p>
            <p class="text-sm text-gray-700 mt-2">For more details, please refer to our <a href="#" class="text-blue-500 underline" onclick="openCancellationPolicyModal(event)">cancellation policy</a>.</p>
            <button onclick="closeModal()" class="mt-4 primary-btn text-white py-1 px-4 rounded-lg">Got it!</button>
        </div>
    </div>

    <!-- Catering Reservation Cancellation Policy Modal -->
    <div id="cancellationPolicyModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content rounded-3 shadow-lg border-0">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-warning text-black rounded-top">
                                                        <h5 class="modal-title" id="policyModalLabel">
                                                            <i class="fas fa-info-circle me-2"></i>Cancellation Policy
                                                        </h5>
                                                        <button onclick="closeCancellationPolicyModal()" type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><b>&times;</b></span></button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body px-4 py-3">
                                                        <div class="text-center mb-4">
                                                            <div class="bg-success text-white rounded-circle mx-auto" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fas fa-check-circle" style="font-size: 36px;"></i>
                                                            </div>
                                                            <h6 class="mt-3 fw-bold text-dark">Important Cancellation Information</h6>
                                                            <p class="text-muted small">Please take a moment to review our cancellation policy below.</p>
                                                        </div>

                                                        <div class="policy-details">
                                                            <ul class="list-unstyled text-start text-sm">
                                                                <li class="d-flex align-items-start mb-2">
                                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                                    <div><strong>24-Hour Notice:</strong> Cancellations must be made at least 24 hours in advance of the reserved date and time to avoid any charges.</div>
                                                                </li>
                                                                <li class="d-flex align-items-start mb-2">
                                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                                    <div><strong>No Refund for Deposits:</strong> Any deposit paid to confirm your reservation is non-refundable but transferable to a future reservation within 6 months of the original booking date.</div>
                                                                </li>
                                                                <li class="d-flex align-items-start mb-2">
                                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                                    <div><strong>Late Cancellations:</strong> If you cancel within 24 hours of the reserved date and time, a cancellation fee of 50% of the total booking amount will be applied.</div>
                                                                </li>
                                                                <li class="d-flex align-items-start mb-2">
                                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                                    <div><strong>No Show:</strong> If the reservation is not honored and no notice is given, 100% of the total booking amount will be charged.</div>
                                                                </li>
                                                            </ul>
                                                            <p class="small text-muted text-center mt-3">By proceeding, you agree to these terms.</p>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer justify-content-center">
                                                        <button onclick="closeCancellationPolicyModal()" class="mt-1 primary-btn text-white py-1 px-4 rounded-lg">Got it!</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        function openModal(event) {
            event.preventDefault();
            document.getElementById('cancellationModal').classList.remove('hidden');
            document.getElementById('cancellationModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('cancellationModal').classList.remove('active');
            document.getElementById('cancellationModal').classList.add('hidden');
        }

        function openCancellationPolicyModal(event) {
            event.preventDefault();
            document.getElementById('cancellationPolicyModal').classList.remove('hidden');
            document.getElementById('cancellationPolicyModal').classList.add('active');
        }

        function closeCancellationPolicyModal() {
            document.getElementById('cancellationPolicyModal').classList.remove('active');
            document.getElementById('cancellationPolicyModal').classList.add('hidden');
        }
    </script>

                            @if($latestReservation->rating)
                                <div class="flex flex-col items-center">
                                    <button class="flex items-center py-2 px-3 bg-gray-500 rounded-lg text-white rated-btn" data-reservation-id="{{ $latestReservation->id }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <small style="font-size: 0.65rem; color: #6c757d; display: block;">Rated</small>
                                </div>
                            @elseif($latestReservation->status == 'Pending')
                                <form action="{{ route('reservations.cancel', $latestReservation->id) }}" method="POST" class="inline-block flex flex-col items-center" >
                                    @csrf
                                    <button type="submit" class="flex items-center px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                                        <i class="fas fa-times" style="margin-right: 0.5rem;"></i> Cancel 
                                    </button>
                                    <a href="#" class="mt-1 text-blue-500 underline" onclick="openCancellationPolicyModal(event)"><small  style="font-size: 0.65rem; color: black; display: block;">cancellation policy <i class="fas fa-question-circle"></i></small></a>
                                </form>
                            @elseif($latestReservation->status == 'Fulfilled' && !$latestReservation->rating && $latestReservation->receipt_image)
                                <div class="flex flex-col items-center">
                                    <button class="flex items-center  custom-red-icon rounded-lg text-black rate-btn" data-reservation-id="{{ $latestReservation->id }}" data-service-id="{{ $latestReservation->service_id }}" data-package-id="{{ $latestReservation->package_id }}">
                                        <i class="fas fa-star-half-alt" style="font-size: 17px;"></i> 
                                    </button>
                                    <small style="font-size: 0.65rem; color: #6c757d; display: block; ">Rate</small>
                                </div>
                            @elseif($latestReservation->rating)
                                <div class="flex flex-col items-center">
                                    <button class="flex items-center  custom-red-icon rounded-lg text-black rate-btn"  data-reservation-id="{{ $latestReservation->id }}" data-service-id="{{ $latestReservation->service_id }}" data-package-id="{{ $latestReservation->package_id }}">
                                        <i class="fas fa-star-half-alt" style="font-size: 17px;"></i>
                                    </button>
                                    <small style="font-size: 0.65rem; color: #6c757d; display: block;">Rate</small>
                                </div>
                            @endif

                            <script>
                                function toggleDropdown(button) {
                                    const dropdown = button.nextElementSibling;
                                    dropdown.classList.toggle("show");
                                }

                                function previewImages(input, reservationId) {
                                    const previewsContainer = document.getElementById('image-previews-' + reservationId);
                                    previewsContainer.innerHTML = '';
                                    
                                    if (input.files) {
                                        Array.from(input.files).forEach(file => {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                const img = document.createElement('img');
                                                img.src = e.target.result;
                                                img.classList.add('img-fluid', 'mr-2', 'mb-2');
                                                img.style.maxWidth = '100px';
                                                previewsContainer.appendChild(img);
                                            };
                                            reader.readAsDataURL(file);
                                        });
                                    }
                                }
                            </script>

                        </div>

                          <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $latestReservation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-body p-4 bg-light custom-modal-body">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    <div class="d-flex justify-content-center">
                                                    <div class="rounded-full p-2 mt-1 status-container  {{ 
                                                       $latestReservation->status == 'Fulfilled' ? 'success' : '' 
                                                    }}{{ 
                                                       $latestReservation->status == 'Declined' || $latestReservation->status == 'Cancelled' ? 'failed' : '' 
                                                    }}{{ 
                                                       $latestReservation->status == 'In Progress' || $latestReservation->status == 'Not fulfilled' ? 'warning' : '' 
                                                    }}{{ 
                                                       $latestReservation->status == 'Pending' ? 'pending' : '' 
                                                    }}{{ 
                                                       $latestReservation->status == 'Approved' ? 'approved' : '' 
                                                    }}">
                                                    Your Reservation is {{ $latestReservation->status }}!
                                                    </div>
                                                </div>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!--h2 class="text-center">MAKE YOUR PAYMENT</h2-->
                                    <div class="container">
                                                <form action="{{ url('charge') }}" method="post" id="paymentForm">
                                                    @csrf
                                                    <!--div class="dropdown-divider gradient-hr"></div-->
                                                    <!--label for="amount" class="form-text text-xs font-small">Reso ID</label-->
                                                    <!--label for="amount" class="form-text text-xs font-small">Your payment mode.</label-->
                                                    <input type="hidden" name="reservation_id" value="{{ $latestReservation->id }}">
                                                    
                                                    <div class="input-group mb-1">
                                                        <span class="input-group-text alert-warning">#{{ $latestReservation->id }}</span>
                                                        <span class="input-group-text alert-complete">{{ $latestReservation->payment_status }}</span>
                                                    </div>

                                                    @if($latestReservation->payment_status !== 'Cash on Delivery')
                                                    <div class="dropdown-divider bold-divider gradient-hr"></div>

                                                    <div class="row mb-3">
                                                            <div class="col text-center">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" id="gcash_radio{{ $latestReservation->id }}" name="payment_option" value="gcash" onclick="togglePaymentSections('{{ $latestReservation->id }}')">
                                                                    <label for="gcash_radio{{ $latestReservation->id }}" class="form-check-label">
                                                                        <img src="/images/gcash.png" alt="GCash" style="width: 70px; height: 18px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" id="paypal_radio{{ $latestReservation->id }}" name="payment_option" value="paypal" onclick="togglePaymentSections('{{ $latestReservation->id }}')">
                                                                    <label for="paypal_radio{{ $latestReservation->id }}" class="form-check-label">
                                                                        <img src="/images/paypal.png" alt="PayPal" style="width: 70px; height: 18px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="gcash_payment_section{{ $latestReservation->id }}" class="payment-section">
                                                            <label class="form-text text-xs font-small">(Click me for QR)</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text alert-info text-xs">
                                                                    <strong>Scan for GCash Payment</strong>
                                                                </span>
                                                                <button class="gcash-btn input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#gcashModal">
                                                                    <img src="/images/gcash.png" alt="GCash" style="width: 70px; height: 18px;">
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div id="paypal_payment_section{{ $latestReservation->id }}" class="payment-section">
                                                            <label class="form-text text-xs">(Enter Amount for Paypal payment)</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">
                                                                    <img src="/images/paypal.png" alt="PayPal" style="width: 70px; height: 18px;">
                                                                </span>
                                                                <input type="text" class="form-control" name="amount" placeholder="₱" />
                                                                <button class="paypal-btn input-group-text" type="submit" name="submit" value="Pay Now">
                                                                    <img src="/images/paypal-logo.jpg" alt="PayPal" style="width: 30px; height: 18px;">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="dropdown-divider bold-divider gradient-hr"></div>

                                                    @if($latestReservation->payment_status !== 'Cash on Delivery')
                                                        <div class="d-flex justify-content-center">
                                                            <div class="half alert-info" style="margin-top: 5px;">
                                                                <strong style="text-transform: uppercase;">We accept half downpayment.</strong>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <div class="form-text text-xs">Please enter the amount for PayPal.</div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <div class="form-text text-xs">Scan the QR code for GCash.</div>
                                                        </div>
                                                        <div class="text-center text-danger text-uppercase" style="font-size: 0.8rem; animation: pulse 1s infinite;">
                                                                Always! Remember your Reso ID: #{{ $latestReservation->id }}
                                                        </div>
                                                    @else
                                                        <!--div class="d-flex justify-content-center">
                                                            <div class="half alert-info">
                                                                <strong style="text-transform: uppercase; font-size: 13px;">Payment required at the Restaurant.</strong>
                                                            </div>
                                                        </div-->
                                                        <div class="d-flex justify-content-center">
                                                            <div class="form-text text-xs">No need to pay online.</div>
                                                        </div>
                                                        <div class="text-center text-danger text-uppercase" style="font-size: 0.8rem; animation: pulse 1s infinite;">
                                                                Always! Remember your Reso ID: #{{ $latestReservation->id }}
                                                        </div>
                                                    @endif
                                                </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark btn-md" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        <script>
                            function togglePaymentSections(reservationId) {
                                const gcashSection = document.getElementById(`gcash_payment_section${reservationId}`);
                                const paypalSection = document.getElementById(`paypal_payment_section${reservationId}`);
                                
                                // Reset both sections to hidden
                                gcashSection.style.display = 'none';
                                paypalSection.style.display = 'none';
                                
                                // Show the selected section
                                if (document.getElementById(`gcash_radio${reservationId}`).checked) {
                                    gcashSection.style.display = 'block';
                                } else if (document.getElementById(`paypal_radio${reservationId}`).checked) {
                                    paypalSection.style.display = 'block';
                                }
                            }
                        </script>


                               <!-- Modal for viewing reservation details -->
                                <div class="modal fade" id="viewReservation{{ $latestReservation->id }}" tabindex="-1" role="dialog" aria-labelledby="viewReservation{{ $latestReservation->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-body p-4 bg-light custom-modal-body">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewReservation{{ $latestReservation->id }}Label">Reservation Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4 bg-light custom-modal-body">
                                                <div class="d-flex justify-content-between">
                                                @if($latestReservation->status === 'Fulfilled')
                                                    <a href="{{ route('reservations.pdf', $latestReservation->id) }}" class="btn btn-dark btn-md mr-auto">
                                                        <i class="fa fa-download" style="font-size: 10px;"><p style="font-size: 10px; color: #6c757d; margin-top: 5px;">receipt</p></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-md mr-auto disabled" style="cursor: not-allowed;" 
                                                    title="Download is only available for fulfilled reservations">
                                                        <i class="fa fa-download" style="font-size: 10px; color: #6c757d;"><p style="font-size: 10px; color: #6c757d; margin-top: 5px;">receipt</p></i>
                                                    </a>
                                                @endif


                                                
                                                <span class="input-group-text py-1 px-2 text-xs font-small tracking-wider text-gray-700 uppercase custom-status-span w-100 w-md-auto d-flex align-items-center justify-content-center">
                                                    <h5 class="modal-title m-0">
                                                        <span class=" p-2 mt-1 status-container info-value {{ 
                                                                    $latestReservation->status == 'Fulfilled' ? 'success' : '' 
                                                                }}{{ 
                                                                    $latestReservation->status == 'Declined' || $latestReservation->status == 'Cancelled' ? 'failed' : '' 
                                                                }}{{ 
                                                                    $latestReservation->status == 'In Progress' || $latestReservation->status == 'Not fulfilled' ? 'warning' : '' 
                                                                }}{{ 
                                                                    $latestReservation->status == 'Pending' ? 'pending' : '' 
                                                                }}{{ 
                                                                    $latestReservation->status == 'Approved' ? 'approved' : '' 
                                                                }}">{{ $latestReservation->status }}
                                                        </span>&nbsp;Reservation
                                                    </h5>
                                                </span>
                                                </div>
                                                    
                                                

                                                <div class="dropdown-divider bold-divider"></div>

                                                <div class="reservation-info">
                                               
                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Reso ID</strong></p>
                                                    <span class="info-value text-sm"><strong>#{{ $latestReservation->id }}</strong></span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Name</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->first_name }} {{ $latestReservation->last_name }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Email</strong></p>
                                                    <span class="info-value text-gray-800 text-xs">{{ $latestReservation->email }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Mobile No.</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->tel_number }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Date</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->res_date->toDateString() }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Time</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->res_date->format('h:i A') }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Event</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->service ? $latestReservation->service->name : 'No event associated' }}</span>
                                                </div>

                                                <div class="info-comments d-flex justify-content-between">
                                                    <p class="text-xs text-gray-600">
                                                        <strong>Venue</strong>
                                                    </p>
                                                    <span class="info-comment text-xs text-end" style="white-space: normal;">
                                                        {{ $latestReservation->venue_address ? $latestReservation->venue_address : 'No venue address' }}
                                                    </span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Guests</strong></p>
                                                    <span class="info-value text-xs">{{ $latestReservation->guest_number }} People</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Theme</strong></p>
                                                    <span class="info-value text-xs">
                                                        @if($latestReservation->theme_type === 'custom')
                                                            Custom Theme
                                                        @else
                                                            {{ ucfirst($latestReservation->theme_type) }}
                                                        @endif
                                                    </span>
                                                </div>

                                                @if($latestReservation->theme_type === 'custom')
                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Main Color</strong></p>
                                                    <span class="info-value text-xs">{{ ucfirst($latestReservation->custom_main_color) }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Sub Color</strong></p>
                                                    <span class="info-value text-xs">{{ ucfirst($latestReservation->custom_sub_color) }}</span>
                                                </div>
                                                @else
                                                <div class="info-item flex items-center justify-center">
                                                    <p class="text-xs text-gray-600 text-center mr-2"><strong>Main Color</strong></p>
                                                    <div class="h-6 w-6 rounded-full border border-gray-400" style="background-color: {{ $latestReservation->main_color ?? '#ffffff' }};"></div>
                                                </div>

                                                <div class="info-item flex items-center justify-center">
                                                    <p class="text-xs text-gray-600 text-center mr-2"><strong>Sub Color</strong></p>
                                                    <div class="h-6 w-6 rounded-full border border-gray-400" style="background-color: {{ $latestReservation->sub_color ?? '#ffffff' }};"></div>
                                                </div>
                                                @endif

                                                @if($latestReservation->theme_comments)
                                                <div class="info-themecomments">
                                                    <p class="text-xs text-gray-600 text-left">
                                                        <strong>Additional Theme Details</strong>
                                                    </p>
                                                    <span class="info-themecomment text-xs" style="word-wrap: break-word; display: block; text-align: center;">
                                                        {{ $latestReservation->theme_comments }}
                                                    </span>
                                                </div>
                                                @endif

                                                    <!--div class="info-item">
                                                    <p class="text-xs text-gray-600 text-center"><strong>Package</strong></p>
                                                    @if($latestReservation->package)
                                                            <span class="info-value text-xs text-gray-800">{{ $latestReservation->package->name }}</span>
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
                                                                            
                                                                          
                                                                            <tr class="bg-gray-50">
                                                                            <td colspan="3" class="px-2 py-1 text-sm text-gray-600 text-center">
                                                                                    {{ $latestReservation->cateringoption ? $latestReservation->cateringoption->name : 'No service associated' }}
                                                                                </td>
                                                                            </tr>
                                                                            @if ($latestReservation->cateringoption_id && $latestReservation->cateringoption->name == 'Full Catering')
                                                                            <th colspan="3" class="dropdown-divider bold-divider"></th>
                                                                            <tr class="bg-gray-500">
                                                                                <th colspan="3" class="px-2 py-1 tracking-wider text-xs text-white text-center">
                                                                                    <strong>Package</strong>
                                                                            </th>
                                                                            
                                                                            </tr>
                                                                            <tr class="bg-gray-50">
                                                                            <td colspan="3">
                                                                            {{ $latestReservation->package ? $latestReservation->package->name : 'No package associated' }}
                                                                        
                                                                                </td>
                                                                            </tr>
                                                                            @endif

                                                                            @if($latestReservation->supply_details && $latestReservation->supply_details != '[]')
                                                                                <th colspan="3" class="dropdown-divider bold-divider"></th>
                                                                                <tr>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase border-r">Supplies</th>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase border-r">Quantity</th>
                                                                                    <th class="px-2 py-1 text-xs font-semibold text-gray-600 uppercase">Total Price</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white divide-y">
                                                                                    @php
                                                                                        $supplyDetails = json_decode($latestReservation->supply_details, true);
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
                                                                                        <td class="px-2 py-1 text-xs text-gray-700">₱{{ number_format($latestReservation->supply_total, 2) }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            @else
                                                                                @if (!($latestReservation->cateringoption_id && in_array($latestReservation->cateringoption->name, ['Service-Only Catering', 'Full Catering'])))
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
                                                                        
                                                                                {{ $latestReservation->payment_status == 'Full Payment' ? 'alert-success' : '' }} 
                                                                                {{ $latestReservation->payment_status == 'Down Payment' ? 'alert-warning' : '' }}
                                                                                {{ $latestReservation->payment_status == 'Cash on Delivery' ? 'alert-failed' : '' }}
                                                                                {{ $latestReservation->payment_status == 'Pay Online' ? 'alert-approved' : '' }}">
                                                                                {{ $latestReservation->payment_status }}
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
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <button type="button" class="btn btn-dark btn-md" data-dismiss="modal">Close</button>

                                                    <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 d-flex align-items-center ml-3">
                                                        <span class="text-xs">
                                                            Download receipt when the reservation is <strong>Fulfilled</strong> 😊
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
         
       
    @endif
</div>
<!-- GCash Modal -->
<div class="modal fade" id="gcashModal" tabindex="-1" aria-labelledby="gcashModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gcashModalLabel"><img src="/images/gcash.png" alt="GCash QR Code" class="img-fluid mx-auto d-block" style="max-width: 100px;"></h5>
                <button type="button" class="btn btn-dark btn-md mr-auto" odata-bs-dismiss="modal" onclick="refreshPage()">Close</button>
            </div>
            <div class="modal-body">
                <div class="half alert-info" style="margin-top: 5px; font-size: 0.8em; text-align: center;">
                    <strong style="text-transform: uppercase;">
                        Please scan the QR code to complete your GCash payment.
                    </strong>
                </div>
                <img src="/gcash_qr/QR.jpg" alt="GCash QR Code"  class="img-fluid">
            </div>
            <div class="modal-footer">
                <!--button type="button" class="btn btn-primary" odata-bs-dismiss="modal" onclick="refreshPage()">Close</button-->
            </div>
        </div>
    </div>
</div>
<!-- End GCash Modal -->


<!-- Rating Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editModalLabel">Rate Reservation</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Hidden fields to store reservation and rating data -->
                <input type="hidden" id="reserv_id" name="reserv_id">
                <input type="hidden" id="serviceId" name="service_id">
                <input type="hidden" id="packageId" name="package_id">

                <!-- Service Rating -->
                <div class="form-group">
                    <label>Service</label><br>
                    <div class="stars" id="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0"> 
                </div>

                <!-- Food Rating -->
                <div class="form-group">
                    <label>Food</label><br>
                    <div class="stars" id="qualityStars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" name="qualityRating" id="qualityRating" value="0"> 
                </div>

                <!-- Overall Rating Display -->
                <hr>
                <div class="form-group">
                    <label>Overall Rating:</label>
                    <span id="averageRating"></span>
                    <div id="overallRatingStars" class="stars"></div>
                </div>

                <!-- Comments Section -->
                <div class="form-group">
                    <label>Comments:</label>
                    <textarea id="comment" class="form-control" rows="3" required></textarea>
                    <small id="commentError" class="text-danger" style="display: none;">Please enter a comment.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="submitRating">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="mt-2 flex justify-center">
    <a href="{{ route('reservations.history') }}" class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn me-2">
        <i class="fa fa-history mr-2"></i> History
    </a>
    <a href="{{ route('reservations.step.one') }}" class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn">
        <i class="fas fa-calendar-plus me-2"></i>Book Again
    </a>
</div>

<style>
    @keyframes warning {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(-5px);
        }
    }
</style>

<script>
function refreshPage() {
    // Reload the page
    window.location.reload();
}

// Reset modal fields
function resetModalFields() {
    $('#stars .star').removeClass('selected');
    $('#qualityStars .star').removeClass('selected');
    $('#rating').val('0');
    $('#qualityRating').val('0');
    $('#comment').val('');
    $('#commentError').hide();
    $('#overallRatingStars').empty();
    $('#averageRating').text('');
}

$(document).ready(function () {
    // Show rating modal and populate hidden fields
    $('.rate-btn').click(function () {
        var reservationId = $(this).data('reservation-id');
        var serviceId = $(this).data('service-id');
        var packageId = $(this).data('package-id') || null;

        $('#reserv_id').val(reservationId);
        $('#serviceId').val(serviceId);
        if (packageId) {
            $('#packageId').val(packageId).show();
        } else {
            $('#packageId').val('').hide();
        }

        resetModalFields(); // Reset modal fields before showing
        $('#rateModal').modal('show');
    });

    // Service rating click event
    $('#stars .star').click(function () {
        var rating = $(this).data('value');
        $('#rating').val(rating);
        $('#stars .star').removeClass('selected');
        $(this).prevAll().addBack().addClass('selected');
        updateOverallRating();
    });

    // Food quality rating click event (optional for packages)
    $('#qualityStars .star').click(function () {
        var qualityRating = $(this).data('value');
        $('#qualityRating').val(qualityRating);
        $('#qualityStars .star').removeClass('selected');
        $(this).prevAll().addBack().addClass('selected');
        updateOverallRating();
    });

    // Calculate and update overall rating
    function updateOverallRating() {
        var serviceRating = parseInt($('#rating').val()) || 0;
        var qualityRating = parseInt($('#qualityRating').val()) || 0;
        var totalRating = (serviceRating + qualityRating) > 0 ? (serviceRating + qualityRating) / 2 : serviceRating;

        $('#overallRatingStars').empty();
        for (var i = 1; i <= 5; i++) {
            var starClass = i <= totalRating ? 'selected' : '';
            $('#overallRatingStars').append('<span class="star ' + starClass + '">&#9733;</span>');
        }
        $('#averageRating').text(totalRating.toFixed(1));
    }

    // Ajax setup with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit rating via AJAX
    $('#submitRating').click(function () {
        var reservationId = $('#reserv_id').val();
        var serviceId = $('#serviceId').val();  // Should always be present
        var serviceRating = $('#rating').val();  // Rating from the service
        var comment = $('#comment').val().trim();

        // Validate service rating
        if (serviceRating === '0') {
            alert('Please rate the service.');
            return;
        }

        $.ajax({
            url: '{{ route("submit_rating") }}',
            method: 'POST',
            data: {
                reserv_id: reservationId,
                service_id: serviceId,
                service_rating: serviceRating,
                // package_id is omitted from submission
                // package_rating is not submitted
                comment: comment
            },
            success: function (response) {
                $('#rateModal').modal('hide');
                resetModalFields();
                location.reload();  // Reload page to reflect changes
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});

</script>
</section>
</html>
@endsection
