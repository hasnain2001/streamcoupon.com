@extends('layouts.master')
@section('title','Login | Access Your Account for Exclusive '. date('y') .'  Discounts & Deals')
@section('description', 'Sign in to your '.config('app.name').' account to unlock exclusive discount codes, special offers, and the best deals of '. date('Y').' Access your saved coupons and personalized recommendations.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@section('content')
<section class="register-section">
    <div class="container">
        <div class="register-container">
            <div class="register-card">
                <!-- Header -->
                <div class="register-header">
                    <h1 class="register-title">Create Account</h1>
                    <p class="register-subtitle">Join thousands saving with exclusive deals</p>
                </div>

                <!-- Body -->
                <div class="register-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   placeholder="your@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Create a strong password"
                                       oninput="checkPasswordStrength(this.value)">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="strength-text" id="passwordStrengthText"></div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Confirm your password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Math CAPTCHA -->
                        <div class="math-captcha">
                            <div class="captcha-question" id="captchaQuestion">
                                <!-- Generated by JavaScript -->
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="number"
                                       id="captcha_answer"
                                       name="captcha_answer"
                                       class="form-control captcha-input"
                                       required
                                       placeholder="Answer">
                                <button type="button" class="refresh-captcha" onclick="generateMathCaptcha()" title="Refresh question">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <input type="hidden" id="captcha_result" name="captcha_result">
                            @error('captcha_answer')
                                <div class="invalid-feedback d-block text-center mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-register" id="registerBtn">
                                Create Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="login-link">Sign in here</a>
                            </p>
                        </div>
                    </form>

                    <!-- Features -->
                    <div class="form-features">
                        <h4 class="features-title">Why Join Us?</h4>
                        <ul class="features-list">
                            <li>Exclusive discount codes & deals</li>
                            <li>Personalized recommendations</li>
                            <li>Save your favorite stores</li>
                            <li>Early access to new offers</li>
                            <li>Track your savings</li>
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

// Password strength checker
function checkPasswordStrength(password) {
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    let strength = 0;
    let text = '';
    let barClass = '';

    // Check password length
    if (password.length >= 8) strength++;

    // Check for mixed case
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength++;

    // Check for numbers
    if (password.match(/([0-9])/)) strength++;

    // Check for special characters
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength++;

    // Update strength indicator
    switch(strength) {
        case 0:
        case 1:
            barClass = 'strength-weak';
            text = 'Weak password';
            break;
        case 2:
        case 3:
            barClass = 'strength-medium';
            text = 'Medium strength';
            break;
        case 4:
            barClass = 'strength-strong';
            text = 'Strong password';
            break;
    }

    strengthBar.className = 'strength-bar ' + barClass;
    strengthText.textContent = text;
}

// Math CAPTCHA Generator
function generateMathCaptcha() {
    const operations = ['+', '-', '*'];
    const operation = operations[Math.floor(Math.random() * operations.length)];

    let num1, num2, result;

    switch(operation) {
        case '+':
            num1 = Math.floor(Math.random() * 10) + 1;
            num2 = Math.floor(Math.random() * 10) + 1;
            result = num1 + num2;
            break;
        case '-':
            num1 = Math.floor(Math.random() * 15) + 5;
            num2 = Math.floor(Math.random() * 5) + 1;
            result = num1 - num2;
            break;
        case '*':
            num1 = Math.floor(Math.random() * 8) + 2;
            num2 = Math.floor(Math.random() * 5) + 1;
            result = num1 * num2;
            break;
    }

    document.getElementById('captchaQuestion').textContent = `What is ${num1} ${operation} ${num2}?`;
    document.getElementById('captcha_result').value = result;

    // Clear previous answer
    document.getElementById('captcha_answer').value = '';
}

// Form submission handler
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const captchaAnswer = document.getElementById('captcha_answer').value;
    const captchaResult = document.getElementById('captcha_result').value;
    const submitBtn = document.getElementById('registerBtn');

    if (!captchaAnswer) {
        e.preventDefault();
        alert('Please solve the math question to verify you are human.');
        return;
    }

    if (parseInt(captchaAnswer) !== parseInt(captchaResult)) {
        e.preventDefault();
        alert('Incorrect answer. Please try the math question again.');
        generateMathCaptcha();
        return;
    }

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = 'Creating Account...';
});

// Real-time password confirmation check
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    const formGroup = this.closest('.form-group');

    if (confirmPassword && password !== confirmPassword) {
        this.classList.add('is-invalid');
        if (!formGroup.querySelector('.confirm-error')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback confirm-error';
            errorDiv.textContent = 'Passwords do not match';
            formGroup.appendChild(errorDiv);
        }
    } else {
        this.classList.remove('is-invalid');
        const errorDiv = formGroup.querySelector('.confirm-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
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

// Generate CAPTCHA on page load
document.addEventListener('DOMContentLoaded', function() {
    generateMathCaptcha();

    // Add focus animations
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>
@endpush
@endsection
