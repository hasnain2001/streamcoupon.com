@extends('layouts.master')
{{-- 🏷️ Page Title --}}
@section('title')
@if (!empty($category->meta_title))
    {{ ucwords($category->meta_title) }} | {{ date('Y') }} Coupons, Deals & Offers
@elseif (!empty($category->title))
    {{ ucwords($category->title) }} | {{ date('Y') }} Coupons & Discount Codes
@else
    {{ ucwords($category->name) }} | {{ date('Y') }} Deals, Offers & Promo Codes
@endif
@endsection

{{-- 📝 Meta Description --}}
@section('description')
@if (!empty($category->meta_description))
    {{ ucfirst($category->meta_description) }}
@else
    Find the best {{ ucwords($category->name) }} deals and verified discount codes for {{ date('Y') }}.
    Save money with exclusive {{ strtolower($category->name) }} coupons, vouchers, and promo offers updated daily.
@endif
@endsection

{{-- 🔑 Meta Keywords --}}
@section('keywords')
@if (!empty($category->meta_keywords))
    {{ strtolower($category->meta_keywords) }}
@else
    {{ strtolower($category->name) }}, {{ strtolower($category->name) }} coupons,
    {{ strtolower($category->name) }} promo codes, {{ strtolower($category->name) }} vouchers,
    discount offers, {{ strtolower($category->name) }} deals, save money online
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/category-detail.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getlocale().'/') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>@lang('nav.home')
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="text-decoration-none">
                        @lang('nav.cateories')
                    </a>
                </li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">
                    {{ $category->name }}
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="category-header">
            <div class="overlay">
                <h1 class="text-uppercase">{{ $category->name }}</h1>
                <div class="stats-badge">
                    <i class="fas fa-store"></i>
                    {{ $stores->count() }} Stores Available
                </div>
            </div>
        </div>

        <!-- Store Count -->
        <div class="store-count">
            <i class="fas fa-tags"></i>
            @lang('message.total store') <strong>{{ $stores->count() }}</strong>
        </div>

        <!-- Stores Grid -->
        <section>
            <div class="stores-grid">
                @forelse ($stores as $store)
                    <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none">
                        <div class="store-card">
                            <div class="store-img-container">
                                <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                    class="store-img"
                                    alt="{{ $store->name }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                            </div>
                            <h5 class="store-title">{{ $store->name ?: "Title not found" }}</h5>
                        </div>
                    </a>
                @empty
                    <div class="col-12">
                        <div class="no-stores-alert">
                            <div class="no-stores-icon">
                                <i class="fas fa-store-slash"></i>
                            </div>
                            <h4 class="text-dark mb-3">@lang('message.No stores found in this category!Explore new')</h4>
                            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="explore-stores-link">
                                <i class="fas fa-external-link-alt"></i>
                                @lang('nav.stores')
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Blog Section -->
        @if($relatedblogs->count() > 0)
            <section class="blog-section">
                <h2 class="section-title">@lang('message.Shopping Hacks & Savings Tips & Tricks')</h2>
                <div class="blog-grid">
                    @foreach ($relatedblogs as $blog)
                        <article class="blog-card">
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" 
                                     class="blog-img" 
                                     alt="{{ $blog->title }}"
                                     loading="lazy">
                            </a>
                            <div class="blog-content">
                                <h5 class="blog-title">{{ $blog->title }}</h5>
                                <button class="read-more-btn" onclick="window.location.href='{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}'">
                                    @lang('welcome.Read More')
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image error handling
    document.querySelectorAll('.store-img').forEach(img => {
        img.addEventListener('error', function() {
            this.src = '{{ asset("assets/img/no-image-found.png") }}';
        });
    });

    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        // Observe store cards
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

        // Observe store count
        const storeCount = document.querySelector('.store-count');
        if (storeCount) {
            const countObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, {
                threshold: 0.5
            });
            
            countObserver.observe(storeCount);
        }

        // Observe blog section
        const blogSection = document.querySelector('.blog-section');
        if (blogSection) {
            const blogObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, {
                threshold: 0.3
            });
            
            blogObserver.observe(blogSection);
        }
    }

    // Add hover effect to store cards
    const storeCards = document.querySelectorAll('.store-card');
    storeCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    // Add parallax effect to category header
    const categoryHeader = document.querySelector('.category-header');
    if (categoryHeader) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            categoryHeader.style.backgroundPosition = `50% ${rate}px`;
        });
    }

    // Add page load animation
    document.body.style.opacity = '0';
    window.requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    });

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.read-more-btn, .explore-stores-link');
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
        
        .read-more-btn,
        .explore-stores-link {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush