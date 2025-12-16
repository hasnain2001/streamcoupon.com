@extends('layouts.master')
@section('title', 'Terms and Conditions | ' . config('app.name'))
@section('description', 'Read our terms and conditions to understand your rights and responsibilities while using our services.')
@section('keywords', 'terms, conditions, user agreement')
@section('author', 'John Doe')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/terms.css') }}">
@endpush

@section('content')
<!-- Terms Header -->
<div class="terms-header">
    <div class="container">
        <div class="terms-header-content">
            <h1>Terms and Conditions</h1>
            <p class="lead">Understand your rights and responsibilities when using our services</p>
            <div class="last-updated">
                <i class="fas fa-calendar-alt me-2"></i>Last updated on {{ date('F j, Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Main Terms Card -->
            <div class="card terms-card">
                <!-- Card Header -->
                <div class="card-header terms-card-header">
                    <i class="fas fa-balance-scale terms-icon"></i>
                    <h2>Legal Agreement & User Terms</h2>
                </div>

                <!-- Card Body -->
                <div class="card-body terms-card-body">
                    <!-- Information Alert -->
                    <div class="alert terms-alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3"></i>
                            <div>
                                <strong>Important:</strong> By accessing or using our services, you agree to be bound by these terms. Please read them carefully before proceeding.
                            </div>
                        </div>
                    </div>

                    <!-- Terms Sections -->
                    <div class="terms-content">
                        <!-- Acceptance of Terms -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 class="section-title">1. Acceptance of Terms</h3>
                            </div>
                            <div class="section-content">
                                <p>By accessing or using our website, mobile application, or any services provided by {{ config('app.name') }} (collectively, the "Services"), you confirm that you have read, understood, and agree to be bound by these Terms and Conditions.</p>
                                <div class="info-card">
                                    <p class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i> If you do not agree with any part of these terms, you must immediately discontinue your use of our Services.</p>
                                </div>
                            </div>
                        </section>

                        <!-- User Responsibilities -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon success">
                                    <i class="fas fa-user-lock"></i>
                                </div>
                                <h3 class="section-title">2. User Responsibilities</h3>
                            </div>
                            <div class="section-content">
                                <p>As a user of our Services, you are solely responsible for:</p>
                                <ul>
                                    <li>Maintaining the confidentiality and security of your account credentials</li>
                                    <li>All activities, transactions, and content associated with your account</li>
                                    <li>Providing accurate, current, and complete information during registration</li>
                                    <li>Complying with all applicable local, state, national, and international laws</li>
                                    <li>Ensuring that your use of our Services does not violate any third-party rights</li>
                                </ul>
                                <div class="warning-card">
                                    <p class="mb-0"><i class="fas fa-shield-alt me-2"></i> You agree to notify us immediately of any unauthorized access to or use of your account at <strong>security@Streamcoupon.com</strong>.</p>
                                </div>
                            </div>
                        </section>

                        <!-- Prohibited Activities -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon danger">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <h3 class="section-title">3. Prohibited Activities</h3>
                            </div>
                            <div class="section-content">
                                <p>When using our Services, you must not engage in any of the following activities:</p>

                                <div class="activity-grid">
                                    <div class="activity-card">
                                        <i class="fas fa-gavel"></i>
                                        <h5>Illegal Activities</h5>
                                        <p>Use our Services for any unlawful purpose or in violation of any applicable laws</p>
                                    </div>
                                    <div class="activity-card">
                                        <i class="fas fa-user-secret"></i>
                                        <h5>Unauthorized Access</h5>
                                        <p>Attempt to gain unauthorized access to systems, accounts, or networks</p>
                                    </div>
                                    <div class="activity-card">
                                        <i class="fas fa-bug"></i>
                                        <h5>Harmful Content</h5>
                                        <p>Post, transmit, or share harmful, offensive, or infringing content</p>
                                    </div>
                                    <div class="activity-card">
                                        <i class="fas fa-network-wired"></i>
                                        <h5>Service Disruption</h5>
                                        <p>Disrupt, interfere with, or overload the Services' performance</p>
                                    </div>
                                    <div class="activity-card">
                                        <i class="fas fa-robot"></i>
                                        <h5>Automated Access</h5>
                                        <p>Use bots, scrapers, or other automated means to access our Services</p>
                                    </div>
                                    <div class="activity-card">
                                        <i class="fas fa-chart-line"></i>
                                        <h5>Commercial Use</h5>
                                        <p>Use our Services for commercial purposes without explicit authorization</p>
                                    </div>
                                </div>

                                <div class="warning-card">
                                    <p class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i> Violation of these prohibitions may result in immediate termination of your account and legal action.</p>
                                </div>
                            </div>
                        </section>

                        <!-- Intellectual Property -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon warning">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h3 class="section-title">4. Intellectual Property</h3>
                            </div>
                            <div class="section-content">
                                <p>All content, features, and functionality available through our Services, including but not limited to text, graphics, logos, icons, images, audio clips, digital downloads, data compilations, and software, are the exclusive property of {{ config('app.name') }} and its licensors.</p>

                                <div class="highlight-box">
                                    <p class="mb-0"><i class="fas fa-lightbulb text-warning me-2"></i> These materials are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>
                                </div>

                                <p>You may not:</p>
                                <ul>
                                    <li>Reproduce, distribute, or create derivative works</li>
                                    <li>Modify, adapt, or reverse engineer any portion of our Services</li>
                                    <li>Remove any copyright, trademark, or other proprietary notices</li>
                                    <li>Use our intellectual property without express written permission</li>
                                </ul>
                            </div>
                        </section>

                        <!-- Disclaimer of Warranties -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon danger">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <h3 class="section-title">5. Disclaimer of Warranties</h3>
                            </div>
                            <div class="section-content">
                                <div class="warning-card">
                                    <p class="mb-0"><i class="fas fa-info-circle me-2"></i> Our Services are provided "as is" and "as available" without warranties of any kind, either express or implied. To the fullest extent permissible by law, we disclaim all warranties, including but not limited to implied warranties of merchantability, fitness for a particular purpose, and non-infringement.</p>
                                </div>
                                <p class="mt-3">We do not guarantee that:</p>
                                <ul>
                                    <li>Our Services will be uninterrupted, secure, or available at any particular time or location</li>
                                    <li>Any errors or defects will be corrected</li>
                                    <li>Our Services are free of viruses or other harmful components</li>
                                    <li>The results of using our Services will meet your requirements</li>
                                </ul>
                                <p><strong>Your use of our Services is solely at your own risk.</strong></p>
                            </div>
                        </section>

                        <!-- Limitation of Liability -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon info">
                                    <i class="fas fa-hand-paper"></i>
                                </div>
                                <h3 class="section-title">6. Limitation of Liability</h3>
                            </div>
                            <div class="section-content">
                                <p>To the maximum extent permitted by applicable law, {{ config('app.name') }} shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation:</p>
                                <ul>
                                    <li>Loss of profits, revenue, or data</li>
                                    <li>Loss of use, goodwill, or other intangible losses</li>
                                    <li>Damages resulting from unauthorized access to or alteration of your transmissions</li>
                                    <li>Any conduct or content of any third party on the Services</li>
                                </ul>

                                <div class="highlight-box">
                                    <h5 class="h6 mb-2 fw-semibold">In no event shall our total liability exceed:</h5>
                                    <div class="d-flex align-items-center flex-wrap">
                                        <span class="liability-badge">
                                            <i class="fas fa-dollar-sign me-1"></i>100
                                        </span>
                                        <span class="small">or the amount you paid us in the last 12 months, whichever is greater.</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Governing Law -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon secondary">
                                    <i class="fas fa-globe-americas"></i>
                                </div>
                                <h3 class="section-title">7. Governing Law & Jurisdiction</h3>
                            </div>
                            <div class="section-content">
                                <p>These Terms shall be governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law provisions.</p>

                                <div class="info-card">
                                    <div class="d-flex">
                                        <i class="fas fa-gavel me-3 mt-1" style="color: var(--primary);"></i>
                                        <div>
                                            <p class="mb-1 fw-semibold">Exclusive Jurisdiction</p>
                                            <p class="mb-0 small">Any legal suit, action, or proceeding arising out of or related to these Terms shall be instituted exclusively in the courts located in [Your Jurisdiction]. You consent to the personal jurisdiction of such courts.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Changes to Terms -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon warning">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <h3 class="section-title">8. Changes to Terms</h3>
                            </div>
                            <div class="section-content">
                                <div class="warning-card">
                                    <div class="d-flex">
                                        <i class="fas fa-bell me-3 mt-1" style="color: #ffc107;"></i>
                                        <div>
                                            <p class="mb-1 fw-semibold">We reserve the right to modify these Terms at any time.</p>
                                            <p class="mb-0 small">When we do, we will revise the "last updated" date at the top of this page. We may also provide additional notice (such as adding a statement to our homepage or sending you a notification). Your continued use of our Services after such modifications constitutes your acceptance of the new Terms.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Contact Information -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="section-title">9. Contact Information</h3>
                            </div>
                            <div class="section-content">
                                <p>For questions, concerns, or notices about these Terms and Conditions, please contact us through any of the following methods:</p>

                                <div class="contact-buttons">
                                    <a href="mailto:contact@Streamcoupon.com" class="contact-btn">
                                        <i class="fas fa-envelope me-2"></i>Email Legal Team
                                    </a>
                                    <a href="{{ url('contact') }}" class="contact-btn">
                                        <i class="fas fa-comment-alt me-2"></i>Contact Form
                                    </a>
                                    <a href="#" class="contact-btn">
                                        <i class="fas fa-map-marker-alt me-2"></i>Visit Our Office
                                    </a>
                                </div>

                                <div class="info-card mt-3">
                                    <p class="mb-0"><i class="fas fa-clock me-2"></i> We typically respond to legal inquiries within 2-3 business days.</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="home-btn">
                            <i class="fas fa-home me-2"></i>Back to Homepage
                        </a>
                        <button onclick="window.print()" class="print-btn">
                            <i class="fas fa-print me-2"></i>Print Terms
                        </button>
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

        // Observe all terms sections
        document.querySelectorAll('.terms-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Smooth scroll when clicking section headers
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('click', function() {
                const section = this.parentElement;
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Print functionality
        const printBtn = document.querySelector('.print-btn');
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                window.print();
            });
        }

        // Add hover effects to activity cards
        document.querySelectorAll('.activity-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush