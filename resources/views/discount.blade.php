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
@if (!$discounts->count())
<!-- No previous orders -->
<section class="empty-order min-vh-100 d-flex flex-column justify-content-center align-items-center pt-5 text-center">
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="hero-wrapper mb-4">
            <img src="{{ URL::asset('/images/empty_order.svg') }}" alt="" class="img-fluid">
        </div>
        <h3 class="mt-4 mb-2">No Discount Vouchers Yet.</h3>
        <p class="text-muted">There seems to be no discount vouchers for now...</p>
        <div class="d-flex mt-3 justify-content-center">
        <div class="d-flex">
        <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('menu') }}">
            <i class="fa fa-book" style="font-size: 17px;"></i>
            <!--span>Menu</span-->
        </a>
        <a href="{{ route('createDiscount') }}" class="primary-btn mx-3">Create Discount</a>
        <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn flex-md-row flex-column justify-content-md-between me-2" href="{{ route('gallery') }}">
            <i class="fa fa-picture-o" style="font-size: 17px;"></i>
            <!--span>Gallery</span-->
        </a>
        </div>
        </div>
    </div>
</section>
@else
<section class="min-vh-100 d-flex flex-column align-items-start mt-5 pt-18vh">
    <div class="container-fluid px-3 px-md-5">
    <h2 class="mt-2 mb-4" style="font-size: 1.0rem;font-style: italic;">Discount Codes</h2>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <small>{{ session('success') }}</small>
        </div>
        @endif
        <div class="row my-5 justify-content-between">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
<div class="d-flex justify-content-between align-items-center mb-4">
    <!-- Buttons for Menu and Gallery on the left -->
    <div class="d-flex">
        <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('menu') }}">
            <i class="fa fa-book" style="font-size: 17px;"></i>
            <!-- <span>Menu</span> -->
        </a>
        <a class="my-md-1 px-3 py-2 bg-red-500 btn-sm primary-btn d-flex justify-content-between align-items-center me-2" href="{{ route('gallery') }}">
            <i class="fa fa-picture-o" style="font-size: 17px;"></i>
            <!-- <span>Gallery</span> -->
        </a>
    </div>

    <!-- Create Discount Button on the right -->
    <a href="{{ route('createDiscount') }}" class="my-md-1 px-3 py-2 bg-green-500 btn-sm primary-btn d-flex justify-content-between align-items-center">
        <i class="fa fa-plus" aria-hidden="true" style="font-size: 10px;"></i>&nbsp;<i class="fa fa-tag" aria-hidden="true" style="font-size: 17px;"></i>
    </a>
</div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Min Spend</th>
                        <th scope="col">Cap</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                        <tr>
                            <th scope="row"><a href="{{ route('specificDiscount', $discount->id) }}">{{ $discount->discountCode }}</a></th>
                            <td>{{ $discount->percentage }}%</td>
                            <td>₱{{ number_format($discount->minSpend, 2) }}</td>
                            <td>₱{{ number_format($discount->cap, 2) }}</td>
                            <td>{{ $discount->startDate }}</td>
                            <td>{{ $discount->endDate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</section>
@endif

@endsection