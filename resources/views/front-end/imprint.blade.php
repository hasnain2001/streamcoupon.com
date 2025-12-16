@extends('layouts.master')
@section('title', 'Imprint - Legal Information | ' . config('app.name'))
@section('description', 'Legal information, company details, and contact information for ' . config('app.name') . '. Find our imprint, disclaimer, and legal notices.')
@section('keywords', 'imprint, legal information, company details, contact, disclaimer, copyright, ' . config('app.name'))
@section('author', config('app.name'))
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/imprint.css') }}">
@endpush
@section('content')
<main>
    <!-- Hero Section -->
    <section class="imprint-hero">
        <div class="container">
            <div class="imprint-hero-content">
                <h1>Legal Imprint</h1>
                <p>Company details, legal information, and contact details</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="imprint-card">
                    <!-- Card Header -->
                    <div class="imprint-header">
                        <div class="imprint-header-content">
                            <h2><i class="fas fa-scale-balanced"></i>Legal Information</h2>
                            <p>Required by German law (§5 TMG) and for your information</p>
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="info-title">Company Details</h3>
                        <div class="info-content">
                            <p class="mb-2"><strong>Streamcoupon Ltd.</strong></p>
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
                            <p class="mb-1">3000 Hoffman Dr,</p>
                            <p class="mb-1">Plano, Tx USA 75074</p>
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
                                    <a href="mailto:contact@streamcoupon.com">contact@streamcoupon.com</a>
                                </p>
                                <p class="mb-0">
                                    <strong>Phone:</strong>
                                    <a href="tel:+17473651163">+17473651163</a>
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
                            <p class="mb-3">Through this website you are able to link to other websites which are not under the control of Streamcoupon Ltd. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>
                            <p class="mb-0">Every effort is made to keep the website up and running smoothly. However, Streamcoupon Ltd. takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.</p>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="info-section">
                        <div class="info-icon">
                            <i class="fas fa-copyright"></i>
                        </div>
                        <h3 class="info-title">Copyright Notice</h3>
                        <div class="info-content">
                            <p class="mb-3">© {{ date('Y') }} Streamcoupon Ltd. All rights reserved.</p>
                            <p class="mb-0">All content, including but not limited to text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software, is the property of Streamcoupon Ltd. or its content suppliers and protected by international copyright laws.</p>
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
                    <div class="back-home-section">
                        <a href="{{ url('/') }}" class="btn-primary-custom">
                            <i class="fas fa-home"></i>Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const sections = document.querySelectorAll('.info-section');
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        sections.forEach(section => {
            sectionObserver.observe(section);
        });

        // Observe main card
        const imprintCard = document.querySelector('.imprint-card');
        const backHomeSection = document.querySelector('.back-home-section');
        
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.1
        });

        if (imprintCard) cardObserver.observe(imprintCard);
        if (backHomeSection) cardObserver.observe(backHomeSection);
    }

    // Add ripple effect to button
    const backButton = document.querySelector('.btn-primary-custom');
    if (backButton) {
        backButton.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                background: rgba(255, 255, 255, 0.7);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
                z-index: 1;
            }
            
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Add page load animation
    document.body.style.opacity = '0';
    window.requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    });

    // Highlight email and phone on hover
    const contactLinks = document.querySelectorAll('.contact-highlight a');
    contactLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.textDecoration = 'none';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.textDecoration = 'none';
        });
    });
});
</script>
@endpush