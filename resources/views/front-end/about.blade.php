@extends('layouts.master')
@section('title','About Us - Best Deals and Discounts ' . date('Y') . ' | ' . config('app.name'))
@section('description','Learn more aboutVoucherswell, your go-to source for the best deals and discounts. Discover our mission, values, and how we help you save more.')
@section('keywords','deals, discounts, coupons, savings, affiliate marketing')

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

    /* About Header */
    .about-header {
        background: var(--gradient-teal);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .about-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .about-header-content {
        position: relative;
        z-index: 2;
    }

    .about-header h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .about-header .lead {
        font-size: 1.2rem;
        opacity: 0.95;
        font-weight: 300;
        max-width: 600px;
        margin: 0 auto;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* Breadcrumb */
    .breadcrumb-custom {
        background: var(--light-gradient);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .breadcrumb-item a {
        color: var(--dark-teal);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    /* About Content */
    .about-content {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 5px 30px rgba(0,0,0,0.08);
        margin-bottom: 3rem;
    }

    .page-heading {
        color: var(--dark-teal);
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    /* Section Styling */
    .about-section {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .about-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .about-section h2 {
        color: var(--dark-teal);
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .about-section h2:before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 30px;
        background: var(--gradient-gold);
        border-radius: 2px;
        margin-right: 1rem;
    }

    .about-section h3 {
        color: var(--dark-teal);
        font-weight: 600;
        font-size: 1.4rem;
        margin: 2rem 0 1rem 0;
        padding-left: 1.5rem;
        border-left: 3px solid var(--gold-primary);
    }

    .about-section p {
        color: #555;
        line-height: 1.7;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0;
    }

    .feature-list li {
        padding: 1rem 1rem 1rem 3rem;
        margin-bottom: 1rem;
        background: var(--light-gradient);
        border-radius: 10px;
        border-left: 4px solid var(--gold-primary);
        position: relative;
        transition: all 0.3s ease;
    }

    .feature-list li:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .feature-list li:before {
        content: '✓';
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
        background: var(--gradient-gold);
        color: #000;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
    }

    /* Stats Section */
    .stats-section {
        background: var(--gradient-teal);
        color: white;
        padding: 4rem 0;
        margin: 4rem 0;
        border-radius: 20px;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .stat-item {
        padding: 2rem 1rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--gold-light);
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 500;
    }

    /* Mission Vision Section */
    .mission-vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .mission-card, .vision-card {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-top: 4px solid var(--gold-primary);
        text-align: center;
        transition: all 0.3s ease;
    }

    .mission-card:hover, .vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .mission-card i, .vision-card i {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .mission-card h3, .vision-card h3 {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 1rem;
        border: none;
        padding: 0;
    }

    /* Values Section */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .value-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        text-align: center;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .value-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.12);
        border-color: var(--gold-primary);
    }

    .value-card i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--dark-teal);
    }

    .value-card h4 {
        color: var(--dark-teal);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .value-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    /* CTA Section */
    .cta-section {
        background: var(--light-gradient);
        padding: 3rem;
        border-radius: 15px;
        text-align: center;
        margin-top: 3rem;
        border: 1px solid #e9ecef;
    }

    .cta-section h3 {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 1rem;
        border: none;
        padding: 0;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .cta-btn {
        padding: 0.8rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .cta-btn.primary {
        background: var(--gradient-teal);
        color: white;
        border: none;
    }

    .cta-btn.primary:hover {
        background: var(--dark-teal-light);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(20, 95, 89, 0.3);
    }

    .cta-btn.secondary {
        background: white;
        border: 2px solid var(--dark-teal);
        color: var(--dark-teal);
    }

    .cta-btn.secondary:hover {
        background: var(--dark-teal);
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .about-header {
            padding: 3rem 0;
        }

        .about-header h1 {
            font-size: 2.2rem;
        }

        .about-content {
            padding: 2rem;
        }

        .page-heading {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .mission-vision-grid {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .cta-btn {
            width: 100%;
            max-width: 250px;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .about-header {
            padding: 2.5rem 0;
        }

        .about-header h1 {
            font-size: 1.8rem;
        }

        .about-content {
            padding: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- About Header -->
<div class="about-header">
    <div class="container">
        <div class="about-header-content">
            <h1>@lang('about.heading-1')</h1>
            <p class="lead">@lang('about.heading-2')</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>@lang('nav.home')
                </a>
            </li>
            <li class="breadcrumb-item active text-secondary" aria-current="page">@lang('nav.about')</li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="about-content">
        <h1 class="page-heading">Welcome toVoucherswell</h1>

        <!-- Introduction Section -->
        <section class="about-section">
            <h2>@lang('about.heading-3')</h2>
            <p>@lang('about.heading-4')</p>
        </section>

        <!-- Mission & Vision -->
        <div class="mission-vision-grid">
            <div class="mission-card">
                <i class="fas fa-bullseye"></i>
                <h3>Our Mission</h3>
                <p>@lang('about.heading-6')</p>
            </div>
            <div class="vision-card">
                <i class="fas fa-eye"></i>
                <h3>Our Vision</h3>
                <p>@lang('about.heading-19')</p>
            </div>
        </div>

        <!-- What Sets Us Apart -->
        <section class="about-section">
            <h2>@lang('about.heading-5')</h2>
            <p>@lang('about.heading-6')</p>

            <h3>@lang('about.heading-7')</h3>
            <p>@lang('about.heading-8')</p>

            <h3>@lang('about.heading-9')</h3>
            <p>@lang('about.heading-10')</p>

            <h3>@lang('about.heading-11')</h3>
            <p>@lang('about.heading-12')</p>

            <h3>@lang('about.heading-13')</h3>
            <p>@lang('about.heading-14')</p>
            <p>@lang('about.heading-15')</p>
        </section>

        <!-- Why ChooseVoucherswell -->
        <section class="about-section">
            <h2>@lang('about.heading-16')</h2>
            <p>@lang('about.heading-17')</p>

            <ul class="feature-list">
                <li>@lang('about.Access promotions you wont find anywhere else')</li>
                <li>@lang('about.Tailored deals based on your preferences.')</li>
                <li>@lang('about.Stay ahead with the latest and most up-to-date coupons.')</li>
                <li>@lang('about. Connect with fellow savers, share tips, and celebrate your successes.')</li>
            </ul>
        </section>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="container">
                <h2 style="color: white; border: none; justify-content: center;">Our Impact in Numbers</h2>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Join thousands of satisfied users who trustVoucherswell for their savings journey
                </p>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" data-count="10000">10,000+</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="5000">5,000+</div>
                        <div class="stat-label">Exclusive Deals</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="1000">$1M+</div>
                        <div class="stat-label">Total Savings</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="200">200+</div>
                        <div class="stat-label">Partner Stores</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Values -->
        <section class="about-section">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4>Maximum Savings</h4>
                    <p>We're committed to helping you save as much as possible on every purchase</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Trust & Reliability</h4>
                    <p>All our deals are verified and updated regularly to ensure they work</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-users"></i>
                    <h4>Community First</h4>
                    <p>We believe in building a community of smart shoppers who help each other save</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-rocket"></i>
                    <h4>Innovation</h4>
                    <p>Constantly improving our platform to provide the best user experience</p>
                </div>
            </div>
        </section>

        <!-- Join Community -->
        <section class="about-section">
            <h2>@lang('about.heading-18')</h2>
            <p>@lang('about.heading-19')</p>

            <h2>@lang('about.heading-20')</h2>
            <p>@lang('about.heading-21')</p>
            <p>@lang('about.heading-22')</p>
        </section>

        <!-- CTA Section -->
        <div class="cta-section">
            <h3>Ready to Start Saving?</h3>
            <p>Join thousands of smart shoppers who trustVoucherswell for the best deals and discounts</p>
            <div class="cta-buttons">
                <a href="{{ route('stores') }}" class="cta-btn primary">
                    <i class="fas fa-store me-2"></i>Explore Stores
                </a>
                <a href="{{ route('coupons') }}" class="cta-btn secondary">
                    <i class="fas fa-tag me-2"></i>View All Coupons
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats counter
        const statNumbers = document.querySelectorAll('.stat-number');

        const animateValue = (element, start, end, duration) => {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value.toLocaleString() + (element.getAttribute('data-count') > 1000 ? '+' : '');
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        };

        // Intersection Observer for stats animation
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const finalValue = parseInt(element.getAttribute('data-count'));
                    animateValue(element, 0, finalValue, 2000);
                    statsObserver.unobserve(element);
                }
            });
        }, { threshold: 0.5 });

        statNumbers.forEach(stat => {
            statsObserver.observe(stat);
        });

        // Add smooth animations to sections
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.about-section, .mission-card, .vision-card, .value-card').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            sectionObserver.observe(section);
        });

        // Add hover effects to feature list items
        document.querySelectorAll('.feature-list li').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px)';
            });
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endpush
