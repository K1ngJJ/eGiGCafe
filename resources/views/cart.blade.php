@extends('layouts.app')

@section('links')
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'cart' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
    <style>
    .gradient-hr {
        border: none; /* Remove default border */
        height: 8px; /* Increase height for a bolder appearance */
        background: linear-gradient(to right, #000000, #FF4500, #dc3545); /* Increase contrast by using a more intense orange */
        border-radius: 8px; /* Keep the rounded edges */
    }
    
    .border-gradient {
        border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
    }
    .menu-title {
        text-align: center;
        font-style: italic;
        color: black;
        font-size: 30px;
    }
    .remove-btn {
        font-size: 1.2em;
        color: #dc3545;
        cursor: pointer;
    }
    .policy-section {
    background-color: #f9f9f9;
    border-left: 4px solid #FF4500;
    border-radius: 6px;
    margin-top: 10px;
    padding: 15px;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
}

.policy-text {
    font-size: 0.875em;  /* Smaller text */
    color: #6c757d;
}

.policy-checkbox {
    font-size: 0.9em;  /* Slightly smaller font size */
    color: #333;
}

.policy-checkbox a {
    color: #FF4500;
    text-decoration: none;
    font-weight: bold;
}

.policy-checkbox a:hover {
    text-decoration: underline;
}

.policy-section h6 {
    color: #FF4500;
    font-weight: bold;
    font-size: 1em;  /* Slightly smaller header */
}

.policy-text.small {
    font-size: 0.85em;  /* Even smaller text for the body */
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.8em;  /* Smaller error text */
    margin-top: 5px;
}

.form-check-input {
    width: 1.25em;
    height: 1.25em;
}

    </style>
<section class="cart" style="margin-top: 20vh;">
    <div class="container">
         <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h6 class="d-flex justify-content-center menu-title ">CART</h2>
            <br>
        </div>
    </table>
 <hr class="my-2 gradient-hr">
        @if (session('success'))
        <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="alert alert-warning fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('error') }}
        </div>
        @endif
        @if ($cartItems->count())

            <div class="container py-5">
                <div class="card col-md-6 col-12 offset-md-3">
                    <div class="card-body">
                        <h4 class="card-title mb-5 mx-2">GigCafe Wishlist <span class="text-secondary h5">- {{ $cartItems->count() }} Items</span></h4>

                        @foreach ($cartItems as $item)
                            <div class="w-100 px-3 d-flex align-items-center py-3">
                                <div class="col-2">
                                    <img src="{{ asset('menuImages/' . $item->menu->image) }}" alt="cart item image" class="img-fluid">
                                </div>
                                <div class="col-6 px-4">
                                    <h5 class="text-dark">{{ $item->menu->name }}</h5>
                                    <h5 class="text-secondary">₱ {{ $item->menu->price * $item->quantity }}</h5>
                                </div>
                                <div class="col-4 d-flex align-items-center justify-content-end">
                                    <!-- Decrement button -->
                                    <form action="{{ route('cartUpdate', $item) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="cartAction" value="-">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary p-1" style="font-size: 1rem;">-</button>
                                    </form>
                                    &nbsp;
                                    <!-- Quantity -->
                                    <h5 class="mx-2" style="font-size: 1rem; font-weight: bold;">{{ $item->quantity }}</h5>
                                    &nbsp;
                                    <!-- Increment button -->
                                    <form action="{{ route('cartUpdate', $item) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="cartAction" value="+">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary p-1" style="font-size: 1rem;">+</button>
                                    </form>
                                    &nbsp;&nbsp;
                                    <!-- Remove button -->
                                    <form action="{{ route('cartRemove', $item) }}" method="post" class="d-inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn btn p-1" style="font-size: 1.1rem;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-between px-3 mt-5">
                            <h5 class="text-dark">Subtotal</h5>
                            <h5 class="text-dark">₱ {{ $subtotal }}</h5>
                        </div>

                        <!-- CHECKOUT ALONG WITH DISCOUNT CODE APPLICATION START -->
                        <form action="{{ route('cartCheckout') }}" method="post">
                            @csrf
                            <div class="d-flex flex-column px-3 mt-5 col-12 align-items-center">
                                <h5 class="text-secondary">Discount Code</h5>
                                <input type="text" class="form-control mt-3" name="discountCode" id="discountCode" placeholder="Place your discount code here...">
                            </div>

                            <h5 class="text-secondary mt-5 text-center">Order Date and Time</h5>
                            <div class="d-flex flex-column mt-4 px-3">
                                <!-- Select Date time (only applicable for dine in / take away, not dine in now) -->
                                <!-- Perform validation to ensure they don't select time that has passed -->
                                <input class="form-control @error('dateTime') is-invalid @enderror" 
                                name="dateTime" type="datetime-local" value="{{ old('dateTime') }}" required>
                                @error('dateTime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Dine in / dine in now / take away ==> radio -->
                            <h5 class="text-secondary mt-5 text-center">Order Type</h5>
                            <div class="d-flex justify-content-center mt-4">
                                <div class="form-check form-check-inline">
                                    <input value="Dine-In" class="form-check-input @error('type') is-invalid @enderror h5" type="radio" name="type" id="Dine-InRadio">
                                    <label class="form-check-label" for="Dine-InRadio">
                                        Dine In
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input value="Take-Out" class="form-check-input @error('type') is-invalid @enderror h5" type="radio" name="type" id="Take-OutRadio">
                                    <label class="form-check-label" for="Take-OutRadio">
                                        Take Out 
                                    </label>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                                        <!-- perhaps add a confirmation during checkout process - like a popup or smtg -->
                            <button type="submit" class="primary-btn mt-5 w-100">Checkout</button>
                            <!-- Cancellation/Non-refundable Policy Section -->
                            <div class="policy-section">
                                <div class="policy-checkbox d-flex align-items-center">
                                    <input class="form-check-input @error('agreement') is-invalid @enderror me-2" 
                                        type="checkbox" name="agreement" id="agreement" value="1" 
                                        {{ old('agreement') ? 'checked' : '' }} required style="transform: scale(0.8);">
                                    <label class="form-check-label" for="agreement" style="font-size: 0.700rem;">
                                        I agree to the <a href="#policyModal" data-bs-toggle="modal" class="text-decoration-none" style="font-size: 0.700rem;">non-refundable policy and terms of service</a>
                                    </label>
                                </div>


                                <!--p class="policy-text">Please note that once your order is placed, it is non-refundable. Kindly ensure that you are certain about your order before proceeding.</p-->
                                @error('agreement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Non-refundable Policy Modal -->
                            <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content rounded-3 shadow-lg border-0">
                                      
                                        <div class="modal-header bg-warning text-black rounded-top">
                                            <h5 class="modal-title" id="policyModalLabel">Order Policy</h5>
                                            <button type="button" class="btn-close text-black" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><b>&times;</b></span>
                                            </button>
                                        </div>
                                    
                                        <div class="modal-body">
                                            <div class="text-center mb-3">
                                                <h6 class="text-dark">Please Read Before Proceeding</h6>
                                                <p class="text-muted small">We want to ensure you're fully informed about our policies.</p>
                                            </div>
                                            <div class="policy-details">
                                            <p><strong class="text-danger">Non-refundable:</strong> Once an order is placed, it is non-refundable. Please double-check your order before confirming.</p>
                                            <p><strong class="text-primary">Terms & Conditions:</strong></p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-check-circle text-success"></i> Orders are subject to availability.</li>
                                                    <li><i class="fas fa-check-circle text-success"></i> Dine-In orders must be honored within 30 minutes of your selected time.</li>
                                                    <li><i class="fas fa-check-circle text-success"></i> Take-Out orders must be picked up on time. We are not responsible for any cold or spoiled items after the pickup time.</li>
                                                </ul>
                                                <p class="small text-muted">By proceeding, you agree to these terms.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="primary-btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <script>
                                // If you're not using Bootstrap’s JavaScript bundle, manually trigger the modal
                                var myModal = new bootstrap.Modal(document.getElementById('policyModal'), {
                                    keyboard: false
                                });
                            </script>


                        </form>
                        <!-- CHECKOUT END -->
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex justify-content-center">
                <div class="col-md-4 col-8">
                    <div class="col-12 mt-5 d-flex align-items-baseline">
                        <div class="col-2 px-2">
                            <img src="./images/cart.svg" alt="cart" class="img-fluid">
                        </div>
                        <div class="col-10">
                            <h4 class="m-3">Empty Cart</h4>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <p class="h5">Your cart is empty currently. <span><a href="{{ route('menu') }}" class="h5"><u>Add item now</u></a></span></p>
                    </div>
                    <div class="col-12 mt-4">
                        <a href="{{ route('menu') }}"><button class="primary-btn w-100 py-2">See Menu</button></a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection