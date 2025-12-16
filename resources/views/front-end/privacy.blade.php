@extends('layouts.master')
@section('title', 'Privacy Policy')
@section('description', 'Read our privacy policy to understand how we handle your data and protect your privacy.')
@section('keywords', 'privacy, policy, data protection')
@section('author', 'John Doe')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/privacy.css') }}">
@endpush

@section('content')
<!-- Privacy Header -->
<div class="privacy-header">
    <div class="container">
        <div class="privacy-header-content">
            <h1>Privacy Policy</h1>
            <p class="lead">Your privacy is important to us. Learn how we protect and handle your data.</p>
            <div class="last-updated">
                <i class="fas fa-calendar-alt me-2"></i>Last updated on {{ now()->format('F d, Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Main Policy Card -->
            <div class="card policy-card">
                <!-- Card Header -->
                <div class="card-header policy-card-header">
                    <i class="fas fa-shield-alt policy-icon"></i>
                    <h2>Your Data Protection & Privacy</h2>
                </div>

                <!-- Card Body -->
                <div class="card-body policy-card-body">
                    <!-- Information Alert -->
                    <div class="alert policy-alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3"></i>
                            <div>
                                <strong>Transparency Matters:</strong> This policy explains how we collect, use, and protect your information in clear, simple terms.
                            </div>
                        </div>
                    </div>

                    <!-- Policy Sections -->
                    <div class="privacy-content">
                        <!-- Information Collection -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h3 class="section-title">Information We Collect</h3>
                            </div>
                            <div class="section-content">
                                <p>We collect information that helps us provide better services and improve your experience. This includes:</p>
                                <ul>
                                    <li><strong>Personal Information:</strong> Name, email address, and contact details when you register or contact us</li>
                                    <li><strong>Usage Data:</strong> How you interact with our website, pages visited, and features used</li>
                                    <li><strong>Technical Information:</strong> Browser type, device information, and IP address for security purposes</li>
                                    <li><strong>Communication Data:</strong> Messages, feedback, and inquiries you send to us</li>
                                </ul>
                                <p>We only collect information that's necessary to provide our services and enhance your experience.</p>
                            </div>
                        </div>

                        <!-- Information Usage -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon success">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <h3 class="section-title">How We Use Your Information</h3>
                            </div>
                            <div class="section-content">
                                <p>Your information helps us deliver excellent service and improve our platform. We use it to:</p>
                                <ul>
                                    <li>Respond to your inquiries and provide personalized customer support</li>
                                    <li>Process transactions and deliver the services you request</li>
                                    <li>Improve our website functionality and user experience</li>
                                    <li>Send important updates about our services (you can opt-out anytime)</li>
                                    <li>Protect against fraud and ensure platform security</li>
                                    <li>Analyze usage patterns to enhance our offerings</li>
                                </ul>
                                <p class="highlight-text">We do not and will never sell your personal information to third parties.</p>
                            </div>
                        </div>

                        <!-- Data Security -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon warning">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h3 class="section-title">Data Security & Protection</h3>
                            </div>
                            <div class="section-content">
                                <p>We take your data security seriously and implement robust measures to protect it:</p>
                                <ul>
                                    <li><strong>Encryption:</strong> All sensitive data is encrypted during transmission and storage</li>
                                    <li><strong>Secure Servers:</strong> Your information is stored on protected servers with limited access</li>
                                    <li><strong>Access Controls:</strong> Strict internal policies control who can access your data</li>
                                    <li><strong>Regular Audits:</strong> We conduct security assessments to maintain protection standards</li>
                                    <li><strong>Employee Training:</strong> Our team is trained in data protection best practices</li>
                                </ul>
                                <p>While we implement industry-standard security measures, no method of transmission over the internet is 100% secure. We recommend using strong passwords and keeping your login information confidential.</p>
                            </div>
                        </div>

                        <!-- Cookies -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon info">
                                    <i class="fas fa-cookie-bite"></i>
                                </div>
                                <h3 class="section-title">Cookies & Tracking Technologies</h3>
                            </div>
                            <div class="section-content">
                                <p>We use cookies and similar technologies to enhance your browsing experience:</p>
                                <ul>
                                    <li><strong>Essential Cookies:</strong> Required for the website to function properly</li>
                                    <li><strong>Performance Cookies:</strong> Help us understand how visitors use our site</li>
                                    <li><strong>Functional Cookies:</strong> Remember your preferences and settings</li>
                                    <li><strong>Analytics Cookies:</strong> Provide insights to improve our services</li>
                                </ul>
                                <p>You can manage cookie preferences through your browser settings. However, disabling essential cookies may affect website functionality.</p>
                            </div>
                        </div>

                        <!-- Third-Party Links -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon danger">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                                <h3 class="section-title">Third-Party Links & Services</h3>
                            </div>
                            <div class="section-content">
                                <p>Our website may contain links to external sites and services. Important notes:</p>
                                <ul>
                                    <li>We carefully select our partners but cannot control their privacy practices</li>
                                    <li>External sites have their own privacy policies we don't control</li>
                                    <li>We're not responsible for content or practices of linked websites</li>
                                    <li>We recommend reviewing third-party privacy policies before sharing information</li>
                                </ul>
                                <p>When you leave our site through these links, our privacy policy no longer applies to your activities on those external sites.</p>
                            </div>
                        </div>

                        <!-- Policy Updates -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon secondary">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <h3 class="section-title">Policy Updates & Changes</h3>
                            </div>
                            <div class="section-content">
                                <p>We may update this privacy policy to reflect changes in our practices or legal requirements:</p>
                                <ul>
                                    <li>Significant changes will be notified via email or prominent website notice</li>
                                    <li>Continued use of our services after changes constitutes acceptance</li>
                                    <li>We maintain version history of all policy updates</li>
                                    <li>The "Last Updated" date at the top indicates the latest revision</li>
                                </ul>
                                <p>We encourage you to review this policy periodically to stay informed about how we're protecting your information.</p>
                            </div>
                        </div>

                        <!-- Contact Section -->
                        <div class="contact-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="section-title">Questions & Contact Information</h3>
                            </div>
                            <div class="section-content">
                                <p>We're committed to being transparent about our privacy practices. If you have questions or concerns:</p>
                                <ul>
                                    <li><strong>Email:</strong> <a href="mailto:contact@Streamcoupon.com" class="contact-email">contact@Streamcoupon.com</a></li>
                                    <li><strong>Data Protection Officer:</strong> John Smith</li>
                                    <li><strong>Mail:</strong> 123 Privacy Lane, Data City, DC 12345</li>
                                    <li><strong>Response Time:</strong> We aim to respond within 48 hours</li>
                                </ul>
                                <p>You have the right to access, correct, or delete your personal information. Contact us to exercise these rights.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="text-center mt-5">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="back-btn">
                            <i class="fas fa-arrow-left me-2"></i> Return to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations to sections
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all policy sections
        document.querySelectorAll('.policy-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add click animation to back button
        const backBtn = document.querySelector('.back-btn');
        if (backBtn) {
            backBtn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        }
    });
</script>
@endpush