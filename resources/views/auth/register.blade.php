@extends('layouts.auth')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'register' }}@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ '/images/Black Logo.png' }}@endsection


@section('content')
<section class="min-vh-100">
    <div class="bg-image" style="background-image: url('/images/login-bg.jpg'); background-size: cover; background-position: center;">
        <br>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center min-vh-100">
                <div class="col-lg-6 col-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center py-lg-2 py-1">Register Account</h5>
                        </div>
                        <div class="card-body py-3">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">+63</span>
                                            <input id="mobile_number" type="number" class="form-control form-control-sm @error('mobile_number') is-invalid @enderror" name="mobile_number" placeholder="Contact No." value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autofocus maxlength="10" pattern="\d{10}">
                                            @error('mobile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <input id="username" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 offset-md-3">
                                        <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-2 my-2">
                                        <button type="submit" class="primary-btn w-100 py-1 btn-sm">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}" class="btn btn-link btn-sm text-muted">Already have an account? Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Make placeholder text small and adjust color if needed */
    ::placeholder {
        font-size: 0.75rem; /* Adjust size as needed */
        color: #6c757d; /* Optional: Change the placeholder color */
    }
</style>
@endsection




