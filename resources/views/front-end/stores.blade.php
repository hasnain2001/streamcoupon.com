@extends('layouts.master')
@section('title', 'Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals On ' . config('app.name'))
@section('description', 'Discover amazing stores with exclusive offers, discounts, and coupons. Find the best deals from top brands in one place.')
@section('keywords', 'stores, offers, discounts, coupons, deals, shopping, brands, savings')
@section('author', 'Your Brand Name')
@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/stores.css') }}">
@endpush

<main class="container py-4">
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title floating-text">@lang('nav.stores')</h1>
            <p class="page-subtitle">
                Discover amazing stores with exclusive offers and discounts. Find the best deals from trusted brands.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>@lang('nav.home')
                    </a>
                </li>
                <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
                    <span class="mx-2 text-muted">
                        <i class="fas fa-chevron-right small"></i>
                    </span>
                    <i class="fas fa-store me-2 text-primary"></i>
                    @lang('nav.stores')
                </li>
            </ol>
        </nav>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-item">
                <i class="fas fa-store"></i>
                <span>{{ $stores->total() }} Stores</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-tags"></i>
                <span>Latest {{ date('Y') }} Deals</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-star"></i>
                <span>Verified Offers</span>
            </div>
        </div>

        <!-- Stores Grid -->
        <div class="stores-grid">
            @forelse ($stores as $store)
                <a href="{{route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none">
                    <div class="store-card">
                        <div class="store-image-container">
                            <img
                                src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                                class="store-image"
                                alt="{{ $store->name }}"
                                loading="lazy"
                            />
                            @if($store->top_store)
                                <div class="store-badge">
                                    <i class="fas fa-crown me-1"></i>Top Store
                                </div>
                            @endif
                        </div>
                        <div class="store-content">
                            <h5 class="store-name">
                                {{ $store->name ?: 'Store Name' }}
                            </h5>
                            <div class="store-meta">
                                <i class="fas fa-tag"></i>
                                <span>{{ $store->coupons_count ?? '0'}} Offers</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-12">
                    <div class="no-stores-card">
                        <div class="no-stores-icon">
                            <i class="fas fa-store-slash"></i>
                        </div>
                        <h4 class="text-dark mb-3">No Stores Available</h4>
                        <p class="text-muted mb-0">
                            @lang('message.No stores found in this category!Explore new')
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($stores->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Stores pagination">
                    <ul class="pagination pagination-custom">
                        {{ $stores->links('pagination::bootstrap-5') }}
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add scroll animation for stats bar
    const statsBar = document.querySelector('.stats-bar');
    if (statsBar) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.5
        });
        
        observer.observe(statsBar);
    }

    // Add hover effect to store cards with delay for better performance
    const storeCards = document.querySelectorAll('.store-card');
    
    storeCards.forEach(card => {
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

    // Add lazy loading animation for images
    const images = document.querySelectorAll('.store-image');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.add('loaded');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => {
        if (!img.classList.contains('loaded')) {
            imageObserver.observe(img);
        }
    });

    // Add page load animation
    document.body.style.opacity = '0';
    window.requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    });

    // Add ripple effect to pagination buttons
    const paginationLinks = document.querySelectorAll('.page-link');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
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

    // Add scroll animation for store cards
    const storeGrid = document.querySelector('.stores-grid');
    if (storeGrid) {
        const gridObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const cards = entry.target.querySelectorAll('.store-card');
                    cards.forEach((card, index) => {
                        card.style.animationDelay = `${index * 0.1}s`;
                    });
                    gridObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        gridObserver.observe(storeGrid);
    }
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
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .page-link {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
@endpush

@endsection