@extends('layouts.master')
@section('title', 'Imprint - Legal Information | ' . config('app.name'))
@section('description', 'Legal information, company details, and contact information for ' . config('app.name') . '. Find our imprint, disclaimer, and legal notices.')
@section('keywords', 'imprint, legal information, company details, contact, disclaimer, copyright, ' . config('app.name'))
@section('author', config('app.name'))
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
    }

    .imprint-hero {
        background: var(--gradient-teal);
        padding: 4rem 0;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .imprint-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    .imprint-hero-content {
        position: relative;
        z-index: 2;
    }

    .imprint-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: -50px;
        position: relative;
        z-index: 3;
    }

    .imprint-header-gold {
        background: var(--gradient-gold);
        color: #2c3e50;
        padding: 2.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .imprint-header-gold::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
        animation: imshimmer 3s infinite;
    }

    @keyframes imshimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .info-section {
        padding: 2rem 2.5rem;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .info-section:hover {
        background: linear-gradient(90deg, rgba(214, 167, 81, 0.05) 0%, transparent 100%);
        transform: translateX(10px);
    }

    .info-section:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-gold);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: white;
        font-size: 1.25rem;
        box-shadow: 0 4px 15px rgba(214, 167, 81, 0.3);
    }

    .info-title {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .info-content {
        color: #6c757d;
        line-height: 1.6;
    }

    .info-content a {
        color: var(--gold-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .info-content a:hover {
        color: var(--dark-teal);
        text-decoration: underline;
    }

    .btn-golden {
        background: var(--gradient-gold);
        color: #2c3e50;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(214, 167, 81, 0.3);
    }

    .btn-golden:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(214, 167, 81, 0.4);
        color: #2c3e50;
    }

    .legal-badge {
        background: var(--gradient-teal);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .contact-highlight {
        background: linear-gradient(135deg, #fff9e6 0%, #fff3d9 100%);
        border-left: 4px solid var(--gold-primary);
        padding: 1.5rem;
        border-radius: 0 12px 12px 0;
        margin: 1.5rem 0;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .imprint-hero {
            padding: 3rem 1rem;
        }

        .imprint-card {
            margin: -30px 1rem 0;
            border-radius: 15px;
        }

        .imprint-header-gold {
            padding: 2rem 1.5rem;
        }

        .info-section {
            padding: 1.5rem;
        }

        .info-section:hover {
            transform: none;
        }
    }

    @media (max-width: 480px) {
        .imprint-hero {
            padding: 2rem 1rem;
        }

        .info-section {
            padding: 1.25rem;
        }

        .contact-highlight {
            padding: 1rem;
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .imprint-hero::before,
        .imprint-header-gold::before {
            animation: none;
        }

        .info-section:hover {
            transform: none;
        }

        .btn-golden:hover {
            transform: none;
        }
    }
</style>
@endpush
@section('content')
<main>
    <!-- Hero Section -->
    <section class="imprint-hero">
        <div class="container">
            <div class="imprint-hero-content">
                <h1 class="display-5 fw-bold mb-3">Legal Imprint</h1>
                <p class="lead mb-0">Company details, legal information, and contact details</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="imprint-card">
                    <!-- Card Header -->
                    <div class="imprint-header-gold">
                        <h2 class="h4 mb-2 fw-bold"><i class="fas fa-scale-balanced me-2"></i>Legal Information</h2>
                        <p class="mb-0 opacity-75">Required by German law (§5 TMG) and for your information</p>
                    </div>

                    <!-- Company Information -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="info-title">Company Details</h3>
                        <div class="info-content">
                            <p class="mb-2"><strong>VoucherWell Ltd.</strong></p>
                            <p class="mb-0">Your trusted partner for deals and coupons</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="info-title">Registered Address</h3>
                        <div class="info-content">
                            <p class="mb-1">3000 Hoffman Drive</p>
                            <p class="mb-1">Plano, TX 75074</p>
                            <p class="mb-0">United States of America</p>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="info-title">Contact Information</h3>
                        <div class="info-content">
                            <div class="contact-highlight">
                                <p class="mb-2">
                                    <strong>Email:</strong>
                                    <a href="mailto:voucherwell@gmail.com">voucherwell@gmail.com</a>
                                </p>
                                <p class="mb-0">
                                    <strong>Phone:</strong>
                                    <a href="tel:+">+</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Legal Details -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h3 class="info-title">Legal Representation</h3>
                        <div class="info-content">
                            <p class="mb-2"><strong>Managing Director:</strong> John Doe</p>
                            <p class="mb-2"><strong>Commercial Register:</strong> Plano County, HRB 123456</p>
                            <p class="mb-0"><strong>VAT Identification Number:</strong> US123456789</p>
                        </div>
                    </div>

                    <!-- Professional Indemnity -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="info-title">Professional Indemnity Insurance</h3>
                        <div class="info-content">
                            <p class="mb-2"><strong>Insurance Provider:</strong> Example Insurance Co.</p>
                            <p class="mb-2"><strong>Territorial Coverage:</strong> Worldwide</p>
                            <p class="mb-0"><strong>Policy Number:</strong> EI-987654321</p>
                        </div>
                    </div>

                    <!-- Disclaimer -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3 class="info-title">Disclaimer</h3>
                        <div class="info-content">
                            <span class="legal-badge">Important Legal Notice</span>
                            <p class="mb-3">The information contained on this website is for general information purposes only. While we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose.</p>
                            <p class="mb-0">Any reliance you place on such information is therefore strictly at your own risk. In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.</p>
                        </div>
                    </div>

                    <!-- External Links -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <h3 class="info-title">External Links Disclaimer</h3>
                        <div class="info-content">
                            <p class="mb-3">Through this website you are able to link to other websites which are not under the control of VoucherWell Ltd. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>
                            <p class="mb-0">Every effort is made to keep the website up and running smoothly. However, VoucherWell Ltd. takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</p>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <h3 class="info-title">Copyright Notice</h3>
                        <div class="info-content">
                            <p class="mb-3">© {{ date('Y') }} VoucherWell Ltd. All rights reserved.</p>
                            <p class="mb-0">All content, including but not limited to text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of VoucherWell Ltd. or its content suppliers and protected by international copyright laws.</p>
                        </div>
                    </div>

                    <!-- Updates -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3 class="info-title">Updates & Changes</h3>
                        <div class="info-content">
                            <p class="mb-3">We reserve the right to update or change our imprint information at any time. Any changes will be posted on this page with an updated revision date.</p>
                            <p class="mb-1"><strong>Last Updated:</strong> {{ date('F j, Y') }}</p>
                            <p class="mb-0"><strong>Effective Date:</strong> January 1, 2023</p>
                        </div>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <a href="{{ url('/') }}" class="btn-golden">
                            <i class="fas fa-home me-2"></i>Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
