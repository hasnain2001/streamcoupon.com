@extends('layouts.master')

@section('title', __('about.meta_title', ['year' => date('Y'), 'app' => config('app.name')]))
@section('description', __('about.meta_description'))
@section('keywords', __('about.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
<!-- About Header -->
<div class="about-header">
    <div class="container">
        <div class="about-header-content">
            <h1>{{ __('about.header_title') }}</h1>
            <p class="lead">{{ __('about.header_subtitle') }}</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>{{ __('home') }}
                </a>
            </li>
            <li class="breadcrumb-item active text-secondary" aria-current="page">{{ __('about.breadcrumb') }}</li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="about-content">
        <h1 class="page-heading">{{ __('about.page_heading') }}</h1>

        <!-- Introduction Section -->
        <section class="about-section">
            <h2>{{ __('about.intro_heading') }}</h2>
            <p>{!! __('about.intro_text') !!}</p>
            <p>{!! __('about.intro_text_2') !!}</p>
        </section>

        <!-- Mission & Vision -->
        <div class="mission-vision-grid">
            <div class="mission-card">
                <i class="fas fa-bullseye"></i>
                <h3>{{ __('about.mission_title') }}</h3>
                <p>{!! __('about.mission_text') !!}</p>
            </div>
            <div class="vision-card">
                <i class="fas fa-eye"></i>
                <h3>{{ __('about.vision_title') }}</h3>
                <p>{!! __('about.vision_text') !!}</p>
            </div>
        </div>

        <!-- What Sets Us Apart -->
        <section class="about-section">
            <h2>{{ __('about.different_heading') }}</h2>
            <p>{{ __('about.different_intro') }}</p>

            <h3>{{ __('about.detectives_title') }}</h3>
            <p>{{ __('about.detectives_text') }}</p>

            <h3>{{ __('about.community_title') }}</h3>
            <p>{{ __('about.community_text') }}</p>

            <h3>{{ __('about.sauce_title') }}</h3>
            <p>{{ __('about.sauce_text') }}</p>

            <h3>{{ __('about.beyond_title') }}</h3>
            <p>{!! __('about.beyond_text') !!}</p>
        </section>

        <!-- Why Choose streamcoupon -->
        <section class="about-section">
            <h2>{{ __('about.why_heading') }}</h2>
            <p>{{ __('about.why_intro') }}</p>

            <ul class="feature-list">
                @foreach(__('about.features') as $feature)
                    <li>{!! $feature !!}</li>
                @endforeach
            </ul>
        </section>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="container">
                <h2 style="color: white; border: none; justify-content: center; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                    {{ __('about.stats_title') }}
                </h2>
                <p style="color: rgba(255,255,255,0.95); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    {{ __('about.stats_subtitle') }}
                </p>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" data-count="10000">10,000+</div>
                        <div class="stat-label">{{ __('about.stat_shoppers') }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="5000">5,000+</div>
                        <div class="stat-label">{{ __('about.stat_deals') }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="1000">$1M+</div>
                        <div class="stat-label">{{ __('about.stat_savings') }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="200">200+</div>
                        <div class="stat-label">{{ __('about.stat_partners') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Values -->
        <section class="about-section">
            <h2>{{ __('about.values_heading') }}</h2>
            <div class="values-grid">
                @foreach(__('about.values') as $value)
                    <div class="value-card">
                        <i class="fas {{ $value['icon'] }}"></i>
                        <h4>{{ $value['title'] }}</h4>
                        <p>{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- The Future -->
        <section class="about-section">
            <h2>{{ __('about.future_heading') }}</h2>
            <p>{{ __('about.future_intro') }}</p>
            
            <div style="background: var(--light-gradient); padding: 2rem; border-radius: 12px; margin: 2rem 0;">
                <h4 style="color: var(--primary); margin-bottom: 1rem;">{{ __('about.future_badge') }}</h4>
                <ul style="color: var(--text-secondary); line-height: 1.8;">
                    @foreach(__('about.future_list') as $item)
                        <li>{!! $item !!}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- Your Story Awaits -->
        <section class="about-section">
            <h2>{{ __('about.story_heading') }}</h2>
            <p>{{ __('about.story_text') }}</p>
            
            <div style="border-left: 4px solid var(--secondary); padding-left: 2rem; margin: 2rem 0;">
                <p style="font-style: italic; color: var(--text-secondary);">
                    {!! __('about.testimonial') !!}
                </p>
            </div>
        </section>

        <!-- CTA Section -->
        <div class="cta-section">
            <h3>{{ __('about.cta_title') }}</h3>
            <p>{{ __('about.cta_text') }}</p>
            <div class="cta-buttons">
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="cta-btn primary">
                    <i class="fas fa-store me-2"></i>{{ __('about.cta_primary') }}
                </a>
                <a href="{{ route('coupons', ['lang' => app()->getLocale()]) }}" class="cta-btn secondary">
                    <i class="fas fa-gift me-2"></i>{{ __('about.cta_secondary') }}
                </a>
            </div>
            <p class="mt-3" style="color: var(--text-light); font-size: 0.9rem;">
                {!! __('about.cta_ps') !!}
            </p>
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