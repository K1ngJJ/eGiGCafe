@extends('layouts.verify')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'register' }}@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ '/images/White Logo.png' }}@endsection


@section('content')
<section class="min-vh-100">
      <div class="bg-image" style="background-image: url('/images/login-bg.jpg'); background-size: cover; background-position: center;">
  <br>
    <div class="container">
            <div class="row d-flex align-items-center justify-content-center min-vh-100">
                <div class="col-lg-6 col-10">
                    <div class="card">
                        <div  class="card-body py-4">
                            <h2 class="d-flex justify-content-center menu-title">VERIFY YOUR ACCOUNT!</h2>
                                <hr class="my-4">
                                <x-slot name="logo">
                                    <a href="/">
                                        <!--x-application-logo class="w-20 h-20 fill-current text-gray-500" /-->
                                    </a>
                                </x-slot>
                
                                <div class="mb-4 text-sm text-gray-600">
                                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                </div>
                
                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif
                        
                                <div class="mt-4 flex items-center justify-between">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                        
                                        <div>
                                            <button class="primary-btn w-100 my-2 py-2">
                                                {{ __('Resend Verification Email') }}
                                            </button>
                                        </div>
                                    </form>
                        
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                        
                                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    @endsection
