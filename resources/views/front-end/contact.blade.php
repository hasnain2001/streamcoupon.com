@extends('layouts.master')

@section('title', 'Contact Us')
@section('description', 'Get in touch with us for any inquiries or support.')
@section('keywords', 'contact, support, inquiries')
@section('author', 'John Doe')

@push('styles')
<style>
    :root {
        --gold-primary: #d6a751;
        --gold-light: #f9e076;
        --gold-dark: #b8860b;
        --dark-teal: #145f59;
        --dark-teal-light: #1a7a72;
        --dark-teal-dark: #0f4a45;
        --gradient-gold: linear-gradient(135deg, #f9e076 0%, #d4af37 50%, #b8860b 100%);
        --gradient-teal: linear-gradient(135deg, #145f59 0%, #1a7a72 100%);
        --light-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    /* Page Header */
    .contact-header {
        background: var(--gradient-teal);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .contact-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .contact-header-content {
        position: relative;
        z-index: 2;
    }

    .contact-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .contact-header .lead {
        font-size: 1.2rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
        font-weight: 300;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* Contact Card */
    .contact-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 3rem;
    }

    .contact-card .card-header {
        background: var(--gradient-teal) !important;
        border: none;
        padding: 2rem;
    }

    .contact-card .card-header h1 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .contact-card .card-body {
        padding: 2.5rem;
    }

    /* Form Styles */
    .form-label {
        font-weight: 600;
        color: var(--dark-teal);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 0.2rem rgba(214, 167, 81, 0.25);
    }

    .btn-submit {
        background: var(--gradient-teal);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 1rem 2rem;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: var(--dark-teal-light);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(20, 95, 89, 0.3);
    }

    /* Contact Info Cards */
    .info-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .info-card .card-body {
        padding: 2rem 1.5rem;
    }

    .info-card i {
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .info-card .card-title {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .info-card .card-text {
        color: #666;
        font-size: 1rem;
    }

    /* Success Message */
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: none;
        border-radius: 8px;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .contact-header {
            padding: 3rem 0;
        }

        .contact-header h1 {
            font-size: 2.2rem;
        }

        .contact-card .card-body {
            padding: 2rem 1.5rem;
        }

        .contact-card .card-header {
            padding: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .contact-header {
            padding: 2.5rem 0;
        }

        .contact-header h1 {
            font-size: 1.8rem;
        }

        .contact-card .card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Contact Header -->
<div class="contact-header">
    <div class="container">
        <div class="contact-header-content">
            <h1>@lang('contact.h1')</h1>
            <p class="lead">@lang('contact.p1')</p>
        </div>
    </div>
</div>

<!-- Contact Form Section -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card contact-card border-0">
                <div class="card-header bg-success text-white py-4">
                    <h1 class="h3 mb-0 text-center">@lang('contact.h1')</h1>
                </div>
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted text-center mb-4">@lang('contact.p1')</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="name" class="form-label">@lang('contact.Name') *</label>
                                <input type="text" class="form-control py-3 @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required
                                       placeholder="@lang('contact.Your name')">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">@lang('contact.Email') *</label>
                                <input type="email" class="form-control py-3 @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" required
                                       placeholder="your.email@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label">@lang('contact.Subject')</label>
                            <input type="text" class="form-control py-3 @error('subject') is-invalid @enderror"
                                   id="subject" name="subject" value="{{ old('subject') }}"
                                   placeholder="@lang('contact.Subject placeholder')">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">@lang('contact.Message') *</label>
                            <textarea class="form-control py-3 @error('message') is-invalid @enderror"
                                      id="message" name="message" rows="6" required
                                      placeholder="@lang('contact.Message placeholder')">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-submit btn-lg text-white py-3">
                                <i class="fas fa-paper-plane me-2"></i> @lang('contact.Send Message')
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information Cards -->
            <div class="row mt-5">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card info-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title">@lang('contact.Our Location')</h5>
                            <p class="card-text text-muted">123 Main Street<br>City, Country 12345</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card info-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-phone-alt mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title">@lang('contact.Call Us')</h5>
                            {{-- <p class="card-text text-muted">+1 (123) 456-7890<br>+1 (098) 765-4321</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card info-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope mb-3" style="font-size: 2.5rem;"></i>
                            <h5 class="card-title">@lang('contact.email us')</h5>
                            <p class="card-text text-muted">contact@voucherswell.com<br>support@voucherswell.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea');

        // Add focus effects
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Form submission enhancement
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';
            submitBtn.disabled = true;

            // Re-enable after 5 seconds if still processing (fallback)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });
    });
</script>
@endpush
