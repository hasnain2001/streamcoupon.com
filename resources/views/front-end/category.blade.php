@extends('layouts.master')

@section('title', __('categories.meta_title', ['year' => date('Y')]))
@section('description', __('categories.meta_description'))
@section('keywords', __('categories.meta_keywords'))
@section('author', __('categories.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/categories.css') }}">
@endpush

@section('content')
<!-- Schema.org Breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ url('/') }}" itemprop="item">
                    <span itemprop="name">{{ __('common.home') }}</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{ __('common.categories') }}</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </div>
</nav>

<!-- Page Header -->
<header class="page-header" role="banner">
    <div class="container">
        <h1 class="page-title" itemprop="headline">
            {{ __('categories.page_title') }}
        </h1>
        <p class="page-subtitle" itemprop="description">
            {{ __('categories.page_subtitle') }}
        </p>
    </div>
</header>

<!-- Main Content -->
<main class="main_content" role="main">
    <div class="container">
        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <i class="fas fa-layer-group"></i>
                <div>
                    <strong>{{ count($categories) }}</strong>
                    <span>{{ __('categories.stat_categories') }}</span>
                </div>
            </div>

            <div class="stat-item">
                <i class="fas fa-tags"></i>
                <div>
                    <strong>{{ __('categories.stat_offers', ['year' => date('Y')]) }}</strong>
                    <span>{{ __('categories.stat_offers_label') }}</span>
                </div>
            </div>
            <div class="stat-item">
                <i class="fas fa-percent"></i>
                <div>
                    <strong>{{ __('categories.stat_verified') }}</strong>
                    <span>{{ __('categories.stat_discounts') }}</span>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid" itemscope itemtype="https://schema.org/ItemList">
            @foreach ($categories as $category)
                <article class="category-card" itemprop="itemListElement" itemscope itemtype="https://schema.org/CategoryCode">
                    <div class="category-content-wrapper">
                        <div class="category-header">
                            <!-- Category Image -->
                            <div class="category-img-container">
                                @if ($category->image && file_exists(public_path('storage/categories/' . $category->image_url)))
                                    <img src="{{ $category->image_url }}"
                                         class="category-img"
                                         alt="{{ $category->name }} - Category Image"
                                         itemprop="image"
                                         loading="lazy"
                                         width="80"
                                         height="80"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <i class="fas fa-tag fa-lg" aria-hidden="true" style="display: none;"></i>
                                @else
                                    <i class="fas fa-tag fa-lg" aria-hidden="true"></i>
                                @endif
                            </div>

                            <!-- Category Details -->
                            <div class="category-details">
                                <h2 class="category-name" itemprop="name">
                                    {{ $category->name }}
                                </h2>

                                <div class="store-count">
                                    <i class="fas fa-store"></i>
                                    <span>{{ $category->stores()->count() ?? 0 }} {{ __('common.stores') }}</span>
                                </div>

                                <meta itemprop="url" content="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">

                                <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}"
                                   class="view-more-btn"
                                   aria-label="{{ __('categories.view_more_aria', ['category' => $category->name]) }}"
                                   itemprop="url">
                                    <span>{{ __('common.view_more') }}</span>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content" aria-labelledby="seo-title">
            <h2 id="seo-title" class="seo-title">{{ __('categories.seo_title') }}</h2>
            <div class="seo-text">
                <p>{{ __('categories.seo_text_1') }}</p>
                <p>{{ __('categories.seo_text_2') }}</p>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image error handling
    document.querySelectorAll('.category-img').forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const fallbackIcon = this.nextElementSibling;
            if (fallbackIcon && fallbackIcon.classList.contains('fa-tag')) {
                fallbackIcon.style.display = 'flex';
                fallbackIcon.style.color = '#1E8A88';
            }
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
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

    // Add hover effect to category cards
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    // Add parallax effect to page header
    const pageHeader = document.querySelector('.page-header');
    if (pageHeader) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            pageHeader.style.backgroundPosition = `50% ${rate}px`;
        });
    }

    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0) scale(1)';
                }
            });
        }, {
            threshold: 0.1
        });

        // Observe stats bar
        const statsBar = document.querySelector('.stats-bar');
        if (statsBar) {
            statsBar.style.opacity = '0';
            statsBar.style.transform = 'translateY(20px)';
            statsBar.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(statsBar);
        }

        // Observe category cards
        const categoryGrid = document.querySelector('.categories-grid');
        if (categoryGrid) {
            const gridObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const cards = entry.target.querySelectorAll('.category-card');
                        cards.forEach((card, index) => {
                            card.style.animationDelay = `${index * 0.1}s`;
                        });
                        gridObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            gridObserver.observe(categoryGrid);
        }
    }

    // Add page load animation
    document.body.style.opacity = '0';
    window.requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    });

    // Add ripple effect to view more buttons
    const viewMoreButtons = document.querySelectorAll('.view-more-btn');
    viewMoreButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;
            
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
        
        .view-more-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush