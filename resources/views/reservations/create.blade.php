@extends('layouts.backend')

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

@section('content')
<section class="min-vh-100 d-flex align-items-start mt-5 pt-5vh">
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2 ">
                    <a href="{{ route('reservations.index') }}"
                        class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Reservation Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" action="{{ route('reservations.store') }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                                <div class="mt-1">
                                    <input type="text" id="first_name" name="first_name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                                <div class="mt-1">
                                    <input type="text" id="last_name" name="last_name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('email')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone number
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="tel_number" name="tel_number"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('tel_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date
                                </label>
                                <div class="mt-1">
                                    <input type="datetime-local" id="res_date" name="res_date"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('res_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                </label>
                                <div class="mt-1">
                                    <input type="number" id="guest_number" name="guest_number"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <br>

                            <div class="sm:col-span-6">
                                <label for="service_id" class="block text-sm font-medium text-gray-700">Services</label>
                                <div class="mt-1">
                                    <select id="service_id" name="service_id" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sm:col-span-6 pt-5">
                                <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                <div class="mt-1">
                                    <select id="payment_status" name="payment_status" class="form-multiselect block w-full mt-1">
                                            <option class="small-option" value="" disabled selected>Select Payment Mode</option>
                                            <option value="Full Payment">Full Payment</option>
                                            <option value="Down Payment">Down Payment</option>
                                            <option value="Cash on Delivery">Cash on Delivery</option>
                                    </select>
                                </div>
                                @error('payment_status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sm:col-span-6 pt-5">
                                <label for="catering_options" class="block text-sm font-medium text-gray-700">Catering Options</label>
                                <div class="mt-1">
                                    <select id="catering_options" name="catering_options" class="form-multiselect block w-full mt-1">
                                        <option class="small-option" value="" disabled selected>Select Types</option>
                                        @foreach ($cateringoptions as $cateringoption)
                                                        <option value="{{ $cateringoption->id }}">
                                                             {{ $cateringoption->name }}
                                                        </option>
                                                        @endforeach
                                    </select>
                                </div>
                                @error('catering_options')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6 p-4">
                                <button type="submit"
                                    class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection