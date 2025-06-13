@extends('layouts.auth')

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
                        <div class="card-header"><h3 class="text-center py-3">GigCafe Login</h3></div>

                        <div class="card-body py-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                    <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4 d-flex align-items-center">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember" style="font-size: 0.7rem;">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        
                                        @if (Route::has('password.request'))
                                            <a class="btn-link small-text" href="{{ route('password.request') }}" style="font-size: 0.60rem; padding: 0;">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="primary-btn w-100 my-2 py-2">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="{{ route('register') }}" class="btn btn-link btn-sm text-muted">Don't have an account? Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


