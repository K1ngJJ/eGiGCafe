@extends('layouts.backend')

@section('navTheme')
{{ 'light' }}
@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

@section('content')
<div class="min-vh-100 d-flex align-items-start mt-5 pt-5vh">
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('reservations.index') }}"
                       class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Reservation List</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- First Name -->
                            <div class="sm:col-span-6">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <div class="mt-1">
                                    <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('first_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="sm:col-span-6">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <div class="mt-1">
                                    <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('last_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email" value="{{ $reservation->email }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('email')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="sm:col-span-6">
                                <label for="tel_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input type="text" id="tel_number" name="tel_number" value="{{ $reservation->tel_number }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('tel_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Reservation Date -->
                            <div class="sm:col-span-6">
                                <label for="res_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                                <div class="mt-1">
                                    <input type="datetime-local" id="res_date" name="res_date"
                                           value="{{ $reservation->res_date ? \Carbon\Carbon::parse($reservation->res_date)->format('Y-m-d\TH:i') : '' }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('res_date')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Guest Number -->
                            <div class="sm:col-span-6">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest Number</label>
                                <div class="mt-1">
                                    <input type="number" id="guest_number" name="guest_number" value="{{ $reservation->guest_number }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('guest_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- Venue Address -->
                             <div class="sm:col-span-6">
                                <label for="venue_address" class="block text-sm font-medium text-gray-700">Venue Address</label>
                                <div class="mt-1">
                                    <input type="text" id="venue_address" name="venue_address" value="{{ $reservation->venue_address }}"
                                           class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('venue_address')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- Package Selection -->
                             <div class="sm:col-span-6 pt-5">
                                <label for="package_id" class="block text-sm font-medium text-gray-700">Package</label>
                                <div class="mt-1">
                                    <select id="package_id" name="package_id" class="form-multiselect block w-full mt-1">
                                    <option class="small-option" value="" disabled selected>Select  Package</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                    {{ $package->id == $reservation->package_id ? 'selected' : '' }}>
                                                {{ $package->name }} ({{ $package->guest_number }} Guests)
                                            </option>
                                        @endforeach
                                        <option class="small-option" value="">Other</option>
                                    </select>
                                </div>
                                @error('package_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Catering Option -->
                            <div class="sm:col-span-6">
                                <label for="cateringoption_id" class="block text-sm font-medium text-gray-700">Catering Option</label>
                                <div class="mt-1">
                                    <select id="cateringoption_id" name="cateringoption_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($cateringOptions as $option)
                                            <option value="{{ $option->id }}"
                                                    {{ $option->id == $reservation->cateringoption_id ? 'selected' : '' }}>
                                                {{ $option->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('cateringoption_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Selection -->
                            <div class="sm:col-span-6">
                                <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                                <div class="mt-1">
                                    <select id="service_id" name="service_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                    {{ $service->id == $reservation->service_id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="sm:col-span-6 pt-5">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1">
                                    <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                        @foreach (\App\Enums\ReservationStatus::cases() as $status)
                                            <option value="{{ $status->value }}" {{ $status->value === $reservation->status ? 'selected' : '' }}>
                                                {{ $status->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                         <!-- Payment Status -->
                            <div class="sm:col-span-6 pt-5">
                                <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                <div class="mt-1">
                                    <select id="payment_status" name="payment_status" class="form-multiselect block w-full mt-1">
                                        @foreach (\App\Enums\PaymentStatus::cases() as $paymentStatus)
                                            <option value="{{ $paymentStatus->value }}" {{ $paymentStatus->value === $reservation->payment_status ? 'selected' : '' }}>
                                                {{ $paymentStatus->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('payment_status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Selection (Newly Added) -->
                            <div class="sm:col-span-6 pt-5">
                                <label for="payment_selection" class="block text-sm font-medium text-gray-700">Payment Selection</label>
                                <div class="mt-1">
                                    <select id="payment_selection" name="payment_selection" class="form-multiselect block w-full mt-1">
                                        <option class="small-option" value="" disabled selected>Select Payment Method</option>
                                        <option value="GCash" {{ $reservation->payment_selection === 'GCash' ? 'selected' : '' }}>GCash</option>
                                        <option value="Paypal" {{ $reservation->payment_selection === 'Paypal' ? 'selected' : '' }}>Paypal</option>
                                        <!-- Add other payment methods as needed -->
                                    </select>
                                </div>
                                @error('payment_selection')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Submit Button -->
                            <div class="mt-6 p-4">
                                <button type="submit"
                                        class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
