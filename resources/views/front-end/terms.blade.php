@extends('layouts.master')
@section('title', 'Terms and Conditions | ' . config('app.name'))
@section('description', 'Read our terms and conditions to understand your rights and responsibilities while using our services.')
@section('keywords', 'terms, conditions, user agreement')
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

    /* Terms Header */
    .terms-header {
        background: var(--gradient-teal);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .terms-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .terms-header-content {
        position: relative;
        z-index: 2;
    }

    .terms-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .terms-header .lead {
        font-size: 1.2rem;
        opacity: 0.95;
        font-weight: 300;
        margin-bottom: 1rem;
    }

    .last-updated {
        background: var(--gradient-gold);
        color: #000;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* Main Terms Card */
    .terms-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 3rem;
    }

    .terms-card-header {
        background: var(--gradient-gold);
        padding: 2.5rem;
        text-align: center;
        border: none;
    }

    .terms-card-header h2 {
        color: #000;
        font-weight: 800;
        margin: 0;
        font-size: 2rem;
    }

    .terms-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
        color: #000;
    }

    .terms-card-body {
        padding: 3rem;
    }

    /* Alert Styling */
    .terms-alert {
        background: rgba(20, 95, 89, 0.1);
        border: none;
        border-radius: 12px;
        border-left: 4px solid var(--dark-teal);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .terms-alert i {
        color: var(--dark-teal);
        font-size: 1.2rem;
    }

    /* Terms Sections */
    .terms-section {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f0f0f0;
        position: relative;
    }

    .terms-section:last-of-type {
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
    .section-icon.danger { background: rgba(220, 53, 69, 0.15); color: #dc3545; }
    .section-icon.info { background: rgba(23, 162, 184, 0.15); color: #17a2b8; }
    .section-icon.secondary { background: rgba(108, 117, 125, 0.15); color: #6c757d; }

    .section-icon i {
        font-size: 1.5rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .section-header:hover {
        transform: translateX(5px);
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
        position: relative;
    }

    .section-content li:before {
        content: "•";
        color: var(--gold-primary);
        font-weight: bold;
        font-size: 1.2rem;
        position: absolute;
        left: -1rem;
    }

    .section-content p {
        color: #555;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    /* Prohibited Activities Grid */
    .activity-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .activity-card {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border-left: 4px solid #dc3545;
    }

    .activity-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-left-color: var(--gold-primary);
    }

    .activity-card i {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #dc3545;
    }

    .activity-card:hover i {
        color: var(--gold-primary);
    }

    .activity-card h5 {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .activity-card p {
        font-size: 0.9rem;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    /* Warning Cards */
    .warning-card {
        background: rgba(220, 53, 69, 0.05);
        border: 1px solid rgba(220, 53, 69, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1rem 0;
        border-left: 4px solid #dc3545;
    }

    .info-card {
        background: rgba(20, 95, 89, 0.05);
        border: 1px solid rgba(20, 95, 89, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1rem 0;
        border-left: 4px solid var(--dark-teal);
    }

    .highlight-box {
        background: var(--light-gradient);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1rem 0;
        border: 1px solid #e9ecef;
    }

    .liability-badge {
        background: var(--gradient-gold);
        color: #000;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        margin-right: 1rem;
    }

    /* Contact Buttons */
    .contact-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .contact-btn {
        background: white;
        border: 2px solid var(--dark-teal);
        color: var(--dark-teal);
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .contact-btn:hover {
        background: var(--dark-teal);
        color: white;
        transform: translateY(-2px);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .home-btn {
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

    .home-btn:hover {
        background: var(--dark-teal-light);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(20, 95, 89, 0.3);
    }

    .print-btn {
        background: white;
        border: 2px solid var(--dark-teal);
        color: var(--dark-teal);
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .print-btn:hover {
        background: var(--dark-teal);
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .terms-header {
            padding: 3rem 0;
        }

        .terms-header h1 {
            font-size: 2.2rem;
        }

        .terms-card-body {
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

        .terms-card-header {
            padding: 2rem 1.5rem;
        }

        .terms-card-header h2 {
            font-size: 1.7rem;
        }

        .activity-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
            align-items: center;
        }

        .contact-buttons {
            flex-direction: column;
        }
    }

    @media (max-width: 576px) {
        .terms-header {
            padding: 2.5rem 0;
        }

        .terms-header h1 {
            font-size: 1.8rem;
        }

        .terms-card-body {
            padding: 1.5rem;
        }
    }

    /* Print Styles */
    @media print {
        .terms-header,
        .action-buttons,
        .contact-buttons {
            display: none !important;
        }

        .terms-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>
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
                                    <p class="mb-0"><i class="fas fa-shield-alt me-2"></i> You agree to notify us immediately of any unauthorized access to or use of your account at <strong>security@example.com</strong>.</p>
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
                                        <i class="fas fa-gavel text-primary me-3 mt-1"></i>
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
                                        <i class="fas fa-bell text-warning me-3 mt-1"></i>
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
                                    <a href="mailto:contact@voucherswell.com" class="contact-btn">
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
