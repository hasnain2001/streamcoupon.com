@extends('layouts.master')
@section('title','About Us - Best Deals and Discounts ' . date('Y') . ' | ' . config('app.name'))
@section('description','Learn more about streamcoupon, your go-to source for the best deals and discounts. Discover our mission, values, and how we help you save more.')
@section('keywords','deals, discounts, coupons, savings, affiliate marketing')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
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

<div class="container text-capitalized ">
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
        <h1 class="page-heading">Welcome to streamcoupon</h1>

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

        <!-- Why Choose streamcoupon -->
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
                <h2 style="color: white; border: none; justify-content: center; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                    Our Impact in Numbers
                </h2>
                <p style="color: rgba(255,255,255,0.95); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Join thousands of satisfied users who trust streamcoupon for their savings journey
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
            <p>Join thousands of smart shoppers who trust streamcoupon for the best deals and discounts</p>
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

        // Intersection Observer for sections
        const sections = document.querySelectorAll('.about-section');
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => {
            sectionObserver.observe(section);
        });

        // Intersection Observer for cards
        const cards = document.querySelectorAll('.mission-card, .vision-card, .value-card');
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.2 });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            cardObserver.observe(card);
        });

        // Intersection Observer for content
        const aboutContent = document.querySelector('.about-content');
        const ctaSection = document.querySelector('.cta-section');
        const contentObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, { threshold: 0.1 });

        if (aboutContent) contentObserver.observe(aboutContent);
        if (ctaSection) contentObserver.observe(ctaSection);

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.cta-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
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
            
            .cta-btn {
                position: relative;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endpush