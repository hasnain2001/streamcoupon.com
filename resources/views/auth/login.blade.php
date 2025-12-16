@extends('layouts.master')
@section('title','Login | Access Your Account for Exclusive '. date('y') .'  Discounts & Deals')
@section('description', 'Sign in to your '.config('app.name').' account to unlock exclusive discount codes, special offers, and the best deals of '. date('Y').' Access your saved coupons and personalized recommendations.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
<section class="login-section">
    <div class="container">
        <div class="login-container">
            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success text-center" :status="session('status')" />

            <div class="login-card">
                <!-- Header -->
                <div class="login-header">
                    <h1 class="login-title">Welcome Back!</h1>
                    <a href="{{ url(app()->getLocale().'/') }}" class="d-block text-center">
                        <x-application-logo class="auth-logo"/>
                    </a>
                    <p class="login-subtitle">Sign in to access exclusive deals & discounts</p>
                </div>

                <!-- Body -->
                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password with toggle -->
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password"
                                       placeholder="Enter your password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="auth-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-login" id="loginBtn">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Sign In') }}
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span class="divider-text">New to {{ config('app.name') }}?</span>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0">Don't have an account?
                                @if (Route::has('register'))
                                    <a class="auth-link" href="{{ route('register') }}">
                                        {{ __('Create one now') }}
                                    </a>
                                @endif
                            </p>
                        </div>
                    </form>

                    <!-- Features -->
                    <div class="login-features">
                        <h4 class="features-title">Your Account Benefits</h4>
                        <ul class="features-list">
                            <li>Access exclusive member-only deals</li>
                            <li>Save your favorite stores & coupons</li>
                            <li>Personalized discount recommendations</li>
                            <li>Track your savings history</li>
                            <li>Early access to new offers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
<script>
// Password visibility toggle
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Form submission handler
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('loginBtn');

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = 'Signing In...';
});

// Input validation on blur
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value.trim() === '' && this.required) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});

// Auto-remove validation on input
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            this.classList.remove('is-invalid');
        }
    });
});

// Enter key submission
document.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('loginBtn');

        if (!submitBtn.disabled) {
            form.dispatchEvent(new Event('submit'));
        }
    }
});

// Add focus animations
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });

    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});
</script>
@endpush
@endsection
