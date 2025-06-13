@extends('layouts.app')

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection



@section('content')
<style>
.menu-title {
    text-align: center;
    font-style: italic;
    color: black;
    font-size: 30px;
}

.bg-custom-color {
    background-color: #CE3232;
}

.bg-custom-color:hover {
    background-color: #dfe1e2;
    transition-duration: 0.8s;
}

.text-custom {
    color: white;
}

.text-custom:hover {
    color: black;
    transition-duration: 0.8s;
}

.gradient-hr {
    border: none; /* Remove default border */
    height: 4px; /* Adjust height as needed */
    background: linear-gradient(to right, #000000, #FF8C00, #dc3545); /* Black to dark orange to danger red */
    border-radius: 8px;
}

.border-gradient {
    border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
}

.gradient-bg {
   /* background: linear-gradient(to right, rgba(0, 0, 0, 1) 80%, rgba(0, 0, 0, 1) 100%); */
    padding: 0.1rem; /* Thin padding */
}

</style>

    <!-- Button styling -->
    <style>
        .button-container a,
        .button-container button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container a {
            background-color: #CE3232;
            color: white;
        }

        .button-container a:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;
        }

        .button-container button {
            background-color: #CE3232;
            color: white;
        }

        .button-container button:hover {
            background-color: #dfe1e2;
            color: black;
            transition-duration: 0.8s;

            
        }

        .bold-divider {
            font-weight: bold; /* Make text bold */
            height: 2px; /* Increase height to make the line bolder */
            background-color: darkorange; /* Ensure the line is visible */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;

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

<style>
    /* Color change animation */
    .color-change {
        animation: colorChange 5s ease-out infinite;
    }

    /* Define the color change from black to orange to red */
    @keyframes colorChange {
        0% {
            background-color: rgba(0, 0, 0, 0); /* Black */
        }
        50% {
            background-color: rgba(255, 165, 0, 0.6); /* Orange */
        }
        100% {
            background-color: rgba(255, 0, 0, 0.4); /* Red */
        }
    }

    /* Fade-in color change animation */
    .fade-color {
        animation: fadeInColorChange 5s ease-out infinite;
    }

    /* Define the fade-in color change */
    @keyframes fadeInColorChange {
        0% {
            opacity: 1;
            background-color: rgba(255, 105, 97, 0.4); /* Red-orange */
        }
        50% {
            opacity: 1;
            background-color: rgba(255, 165, 0, 0.6); /* Orange */
        }
        100% {
            opacity: 1;
            background-color: rgba(255, 0, 0, 0.4); /* Red */
        }
    }
</style>

<section class="banner">
    
        <br><br><br><br><br>
        @if (Auth::check() && auth()->user()->role == 'customer')
        <div class="container w-full  mx-auto">
        <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h2 class="d-flex justify-content-center menu-title">MAKE RESERVATION</h2>
            <br>
        </div>
        </table>
        <hr class="my-4 gradient-hr">


<div class="container mx-auto py-6">
  <div class="row">
    <!-- Left Column: Form -->

    <div class="col-lg-6 col-12 mb-3  position-relative">
         
                <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                    <div class="flex flex-col md:flex-row">
                        <div class="flex-1">
                         
                                <div class="flex items-center justify-center p-6">
                                    <div class="w-full">
                                    <div class="w-full bg-gray-100 rounded-full border-1 border-transparent border-gradient">
                                            <div class="w-40 p-1 text-xs font-medium leading-none text-center rounded-full">
                                                Step 1
                                            </div>
                                        </div>
                                       <br>
                                       <form method="POST" action="{{ route('reservations.store.step.one') }}" class="w-full md:w-1/2">
                                @csrf
                                <!-- Email Input -->
                                <div class="sm:col-span-6">
                                    <div class="py-2 px-4 sm:py-3 sm:px-6 text-xs text-xs md:text-base lg:text-lg font-medium tracking-wider text-center text-gray-700 bg-gray-200 color-change alert-info">
                                        <strong>&nbsp;&nbsp;⚠️ Please ensure all your details are accurate. 😊&nbsp;&nbsp;</strong>
                                    </div>
                                    <hr class="my-0 mt-3 gradient-hr">
                                    <div class="p-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        <div class=" text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                        <svg class="w-6 h-6 mr-1" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class=" py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700">Email</span>
                                        </div>
                                    </label>
                                    <div class="mt-1 inline-flex flex-col items-center ">
                                        <div class="inline-flex items-center">
                                            <!-- Email Icon -->
                                            <svg class="fill-current h-6 w-6 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 14.016L4 9.96l1.415-1.414L12 13.186l6.585-5.64L20 9.96 12 16.016z" />
                                            </svg>
                                            <span class="input-group-text px-0.1 rounded-md gradient-bg ">
                                            <span class="inline-flex items-center px-2 py-2 border border-transparent text-xs leading-4 font-xs rounded-md text-gray-500 bg-white hover:text-gray-700 transition ease-in-out duration-150" style="width: 215px;">
                                                <div>{{ Auth::user()->email }}</div>
                                            </span>
                                            </span>
                                        </div>
                                        <div class="w-24 px-2 py-1 mt-1 text-xs font-medium leading-none text-center text-gray-700 bg-gray-200 rounded-md">Your Email Account</div>
                                    </div>
                                    </div>
                                </div>
                          
                              
                                    <!-- First Name Input -->
                                    <div class="flex-1">
                                        <hr class="my-1 mt-3 gradient-hr">
                                        <span class="py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;First Name&nbsp;&nbsp;</strong>
                                        </span>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700">
                                            <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                                <span class="input-group-text px-0.1 rounded-md gradient-bg">
                                                    <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name ?? '' }}" 
                                                        class="w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5" style="width: 215px;" />
                                                </span>
                                            </div>
                                        </label>
                                        @error('first_name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name Input -->
                                    <div class="flex-1">
                                        <hr class="my-1 mt-3 gradient-hr">
                                        <span class="py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;Last Name&nbsp;&nbsp;</strong>
                                        </span>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700">
                                            <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                                <span class="input-group-text px-0.1 rounded-md gradient-bg">
                                                    <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name ?? '' }}" 
                                                        class="w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5" style="width: 215px;" />
                                                </span>
                                            </div>
                                        </label>
                                        @error('last_name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>
                                

                               <!-- Phone Number Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-3 gradient-hr">
                                    <span class=" py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;Phone&nbsp;&nbsp;</strong>
                                    </span>
                                    <label for="tel_number" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <span class="input-group-text px-0.1 rounded-md gradient-bg">&nbsp;<h1 class="text-xs">+63</h1>&nbsp;&nbsp;
                                            <input type="text" id="tel_number" name="tel_number" value="{{ $reservation->tel_number ?? '' }}" 
                                                pattern="\d{10}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" 
                                                style="width: 178px;"
                                                class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5" />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('tel_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Guest Number Input -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-3 gradient-hr">
                                    <span class=" py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;Guest Count&nbsp;&nbsp;</strong>
                                    </span>
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-1" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <span class="input-group-text px-0.1 rounded-md gradient-bg ">
                                            <input type="number" id="guest_number" name="guest_number" value="{{ $reservation->guest_number ?? '' }}" 
                                            style="width: 215px;"
                                            class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5"  />
                                            </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex-1">
                                        <hr class="my-1 mt-3 gradient-hr">
                                        <span class="py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;Venue Address&nbsp;&nbsp;</strong>
                                        </span>
                                        <label for="venue_address" class="block text-sm font-medium text-gray-700">
                                            <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                                <span class="input-group-text px-0.1 rounded-md gradient-bg">
                                                    <input type="text" id="venue_address" name="venue_address" value="{{ $reservation->venue_address ?? '' }}" 
                                                        class="w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5" style="width: 215px;" />
                                                </span>
                                            </div>
                                        </label>
                                        @error('venue_address')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                        @enderror
                                    </div>

                                <!-- Reservation Date -->
                                <div class="sm:col-span-6">
                                    <hr class="my-1 mt-3 gradient-hr">
                                    <span class=" py-1 px-2 text-xs font-medium tracking-wider text-center text-gray-700 bg-gray-200 fade-color alert-info">
                                            <strong>&nbsp;&nbsp;Reservation Date &nbsp;&nbsp;</strong>
                                    </span>
                                    <label for="res_date" class="block text-sm font-medium text-gray-700">
                                        <div class="mt-0 p-1 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                            <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                            <span class="text-xs block text-sm font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <span class="input-group-text px-0.1 rounded-md gradient-bg ">
                                                <input type="datetime-local" id="res_date" name="res_date" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ optional($reservation)->res_date ? \Carbon\Carbon::parse($reservation->res_date)->format('Y-m-d\TH:i') : '' }}" class="w-full max-w-xs appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out text-xs sm:leading-5" />
                                                </span>
                                            </span>
                                        </div>
                                    </label>
                                    @error('res_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-0 p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex items-center">
                                <svg class="w-6 h-6 mr-2" style="color: #FF8C00;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M9 21h6a2 2 0 002-2v-4a8 8 0 10-8 0v4a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">Please choose the time between 08:00 AM and 10:00 PM.</span>
                                </div>
                                          
                                
                                            <div class="my-3 dropdown-divider bold-divider gradient-hr"></div>
                                             <!-- Cancellation/Non-refundable Policy Section -->
                                            <div class="policy-section">
                                                <div class="policy-checkbox d-flex align-items-center">
                                                    <input class="form-check-input @error('agreement') is-invalid @enderror me-2" 
                                                        type="checkbox" name="agreement" id="agreement" value="1" 
                                                        {{ old('agreement') ? 'checked' : '' }} required style="transform: scale(0.8);">
                                                    <label class="form-check-label" for="agreement" style="font-size: 0.700rem;">
                                                        I agree to the <a href="#policyModal" data-bs-toggle="modal" class="text-decoration-none" style="font-size: 0.700rem;">cancellation policy and terms of service</a>
                                                    </label>
                                                </div>


                                                <!--p class="policy-text">Please note that once your order is placed, it is non-refundable. Kindly ensure that you are certain about your order before proceeding.</p-->
                                                @error('agreement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        <!-- Cancellation Policy Modal -->
                                        <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content rounded-3 shadow-lg border-0">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-warning text-black rounded-top">
                                                        <h5 class="modal-title" id="policyModalLabel">
                                                            <i class="fas fa-info-circle me-2"></i>Cancellation Policy
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><b>&times;</b></span></button>
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
                                                    <div class="modal-footer justify-content-center border-top-0">
                                                        <button type="button" class="btn primary-btn btn-sm" data-bs-dismiss="modal">
                                                            <i class="fas fa-times-circle me-1"></i>Close
                                                        </button>

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
                                            <br>

                                            <div class="d-flex flex-wrap align-items-center gap-4">
   
                                            <a href="{{ route('cservices.index') }}" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0">Events</a>
   
                                            <button type="submit" class="px-4 py-2 btn btn-custom-color primary-btn flex-shrink-0 ms-auto" id="btnNext">Next</button>
                                                
                                            </div>


                                            
                                        </form>
                                 </div>
                          </div>
                   </div>
            </div>
      </div>
      <div id="best-month" class="col-lg-12 mt-4  col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #f7f7f7, #fdeaea); transition: transform 0.5s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 10%; left: 42.5%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div> 
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -20px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/menu.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">Note</span> 
        </h5>
        <div class="position-relative glow-on-hover" style="background: #ffffff; padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">
    <h2 class="my-2 apexcharts-yaxis-title  text-center" style="color: #000000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0);"> 
    <div class="flex items-center p-2 text-sm text-gray-700 bg-yellow-100 border-l-4 border-yellow-500 flex-grow min-w-0">
                                                    <svg class="mr-1" style="color: red; width: 40px; height: 40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M9.93 17h4.14c.72 0 1.29-.58 1.29-1.29l.73-8.07c.09-1-.74-1.81-1.76-1.81H9.2c-1.02 0-1.85.81-1.76 1.81l.73 8.07c.01.71.57 1.29 1.29 1.29z" />
                                                    </svg>
                                                   
                                                    <span class="text-xs xs:text-xs md:text-base">We will reach out to you promptly once your reservation is approved.</span>
                                                    
                                                    <svg class="mr-1" style="color: red; width: 40px; height: 40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M9.93 17h4.14c.72 0 1.29-.58 1.29-1.29l.73-8.07c.09-1-.74-1.81-1.76-1.81H9.2c-1.02 0-1.85.81-1.76 1.81l.73 8.07c.01.71.57 1.29 1.29 1.29z" />
                                                    </svg>
                                                </div>
    </h2>
</div>

        <p class="small text-muted text-center mt-3 position-relative" style="z-index: 1;">Please ensure all your details are accurate.</p>
    </div>
</div>
        @endif
     

          <!-- Right Column: Image -->
          <div class="col-lg-6">
            <div class="flex items-center justify-center min-h-screen">
         
            <div class="position-relative">
<div id="best-month" class="col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #f7f7f7, #fdeaea); transition: transform 0.5s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 10%; left: 42.5%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div> 
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -20px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">Best Month</span> <!-- Dark Red Color -->
        </h5>
        <div class="position-relative glow-on-hover" style="background: rgba(255, 255, 255, 0.95); padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">
            <h2 class="my-2 apexcharts-yaxis-title fw-bold text-center pulse" style="color: #8B0000;"> <!-- Dark Red Text -->
            @if($reservationMonthData)
                    @php
                        // Map month numbers to names
                        $months = [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                        ];
                        $monthName = $months[$reservationMonthData['month']] ?? 'Unknown';
                    @endphp
                    {{ $monthName }}
                @else
                    <span style="color: #8B0000;">No Data Available</span> <!-- Dark Red for No Data -->
                @endif
            </h2>
        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Month with the Most Reservations</p>
    </div>

    <div id="best-services" class="mt-4 col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
     style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #ffe5d4, #fdeaea); transition: transform 0.4s ease-in-out, box-shadow 0.3s ease;">
    <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -35px; left: -20px; opacity: 0.1; z-index: 0;">
        <img src="{{ asset('/images/White Logo.png') }}" style="height: 150px; width: 150px;">
    </div>
    <div class="icon-overlay animate-float" style="position: absolute; top: 1%; right: 80%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
        <img src="{{ URL::asset('/images/White Logo.png') }}" style="height: 150px; width: 150px;">
    </div>
    <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -25px; opacity: 0.1; z-index: 0;">
        <img src="{{ asset('/images/White Logo.png') }}" style="height: 150px; width: 150px;">
    </div>
    <h5 class="text-center mb-6 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">GiG Cafe</span> <!-- Dark Red Color -->
        </h5>
    <!-- Main Image -->
    <div class="gallery-item" style="position: relative; z-index: 1;">
        <img src="{{ asset('/images/Restaurant.jpeg') }}" alt="Gallery Image" 
             style="width: 95%; height: auto; object-fit: cover; border-radius: 15px; margin: 0 auto; display: block;">
    </div>

    <!-- Small Logo in Corner -->
    <div class="logo-overlay" style="position: absolute; top: 10px; left: 10px; z-index: 2;">
        <img src="{{ asset('/images/White Logo.png') }}" alt="Logo" style="height: 50px; width: 50px; border-radius: 50%;">
    </div>
    <p class="small text-muted text-center mt-6 position-relative" style="z-index: 1;">ALL IN RESTAURANT IN TOWN</p>
</div>

    </div>

<style>
    #best-services:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }

    .icon-overlay {
        transition: transform 0.5s ease-in-out;
    }

    .animate-float {
        animation: float 4s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .glow-on-hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .glow-on-hover:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .gallery-collage {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .gallery-item img {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item img:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .pulse {
        animation: pulseEffect 2s infinite;
    }

    @keyframes pulseEffect {
        0%, 100% {
            transform: scale(1);

        }
        50% {
            transform: scale(1.03);
         
        }
    }
</style>


<style>
    #best-month:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .icon-overlay {
        transition: transform 0.6s ease-in-out;
    }

    .icon-overlay:hover {
        transform: rotate(15deg);
    }

    .animate-spin-slow {
        animation: spin 20s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .glow-on-hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .glow-on-hover:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }

    .pulse {
        animation: pulseAnimation 1.5s infinite;
    }

    @keyframes pulseAnimation {
        0%, 100% {
            transform: scale(1);
           
        }
        50% {
            transform: scale(1.05);
         
        }
    }
</style>
            </div>
        </div>


</div>
</div>
</section>
<!--script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script-->
@endsection
    