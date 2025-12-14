@extends('layouts.master')
@section('title', 'Privacy Policy')
@section('description', 'Read our privacy policy to understand how we handle your data and protect your privacy.')
@section('keywords', 'privacy, policy, data protection')
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

    /* Privacy Header */
    .privacy-header {
        background: var(--gradient-teal);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .privacy-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .privacy-header-content {
        position: relative;
        z-index: 2;
    }

    .privacy-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .privacy-header .lead {
        font-size: 1.2rem;
        opacity: 0.95;
        font-weight: 300;
    }

    .last-updated {
        background: var(--gradient-gold);
        color: #000;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
        margin-top: 1rem;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* Main Policy Card */
    .policy-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .policy-card-header {
        background: var(--gradient-gold);
        padding: 2.5rem;
        text-align: center;
        border: none;
    }

    .policy-card-header h2 {
        color: #000;
        font-weight: 800;
        margin: 0;
        font-size: 2rem;
    }

    .policy-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
    }

    .policy-card-body {
        padding: 3rem;
    }

    /* Alert Styling */
    .policy-alert {
        background: rgba(20, 95, 89, 0.1);
        border: none;
        border-radius: 12px;
        border-left: 4px solid var(--dark-teal);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .policy-alert i {
        color: var(--dark-teal);
        font-size: 1.2rem;
    }

    /* Policy Sections */
    .policy-section {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .policy-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .section-icon.primary { background: rgba(214, 167, 81, 0.15); color: var(--gold-dark); }
    .section-icon.success { background: rgba(40, 167, 69, 0.15); color: #28a745; }
    .section-icon.warning { background: rgba(255, 193, 7, 0.15); color: #ffc107; }
    .section-icon.info { background: rgba(23, 162, 184, 0.15); color: #17a2b8; }
    .section-icon.danger { background: rgba(220, 53, 69, 0.15); color: #dc3545; }
    .section-icon.secondary { background: rgba(108, 117, 125, 0.15); color: #6c757d; }

    .section-icon i {
        font-size: 1.5rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        color: var(--dark-teal);
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0;
    }

    .section-content {
        margin-left: 75px;
    }

    .section-content ul {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .section-content li {
        margin-bottom: 0.8rem;
        line-height: 1.6;
        color: #555;
    }

    .section-content p {
        color: #555;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .highlight-text {
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
    }

    /* Contact Section */
    .contact-section {
        background: var(--light-gradient);
        border-radius: 15px;
        padding: 2.5rem;
        margin-top: 2rem;
        border-left: 4px solid var(--gold-primary);
    }

    .contact-email {
        color: var(--dark-teal);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-email:hover {
        color: var(--gold-primary);
    }

    /* Back Button */
    .back-btn {
        background: var(--gradient-teal);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .back-btn:hover {
        background: var(--dark-teal-light);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(20, 95, 89, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .privacy-header {
            padding: 3rem 0;
        }

        .privacy-header h1 {
            font-size: 2.2rem;
        }

        .policy-card-body {
            padding: 2rem;
        }

        .section-header {
            flex-direction: column;
            text-align: center;
        }

        .section-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .section-content {
            margin-left: 0;
            text-align: left;
        }

        .policy-card-header {
            padding: 2rem 1.5rem;
        }

        .policy-card-header h2 {
            font-size: 1.7rem;
        }
    }

    @media (max-width: 576px) {
        .privacy-header {
            padding: 2.5rem 0;
        }

        .privacy-header h1 {
            font-size: 1.8rem;
        }

        .policy-card-body {
            padding: 1.5rem;
        }

        .contact-section {
            padding: 2rem 1.5rem;
        }
    }
</style>
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
                                    <li><strong>Email:</strong> <a href="mailto:contact@voucherswell.com" class="contact-email">contact@voucherswell.com</a></li>
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
