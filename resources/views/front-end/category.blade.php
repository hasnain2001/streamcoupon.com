@extends('layouts.master')

@section('title', 'Best Categories & Brands Offers ' . date('Y') . ' - Voucherswell.com')
@section('description', 'Discover amazing categories with exclusive offers, discounts, and coupons. Find the best deals from top brands and stores in one place.')
@section('keywords', 'categories, brands, offers, discounts, coupons, deals, shopping, savings')
@section('author', 'Your Brand Name')
@push('styles')
<style>
    :root {
        /* Core Gold Colors */
        --white: white;
        --black: black;
        --primary: #d6a751;
        --primary-light: #f9e076;
        --primary-dark: #b8860b;
        --gold-highlight: #ffeb3b;

        /* Enhanced Gold Gradients */
        --primary-gradient: linear-gradient(135deg, #f9e076 0%, #d4af37 25%, #b8860b 50%, #d4af37 75%, #b8860b 100%);
        --gold-shimmer: linear-gradient(135deg, #fff9c4, #f9e076, #d4af37, #b8860b);
        --gold-radial: radial-gradient(circle at center, #fff9c4 0%, #f9e076 20%, #d4af37 60%, #b8860b 100%);
        --gold-metallic: linear-gradient(115deg, #ffeb3b 0%, #ffeb3b 10%, #d4af37 10%, #d4af37 40%, #b8860b 40%, #b8860b 60%, #d4af37 60%, #d4af37 90%, #ffeb3b 90%);

        /* Background Colors */
        --dark-bg: #145f59;
        --dark-bg-light: #1a7a72;
        --dark-bg-dark: #0f4a45;

        /* Gray Scale */
        --light-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --dark-gray: #343a40;

        /* Animation Properties */
        --gold-animation-shimmer: category-shimmer 5s ease infinite;
        --gold-animation-metallic: category-metallic-shift 6s ease-in-out infinite;

        /* Background Sizes */
        --bg-size-large: 200% 200%;
        --bg-size-extra-large: 300% 300%;
    }

    /* Gold Animations */
    @keyframes category-shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes category-metallic-shift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .main_content {
        background: var(--light-gradient);
        min-height: calc(100vh - 200px);
    }

    .page-header {
        background: var(--dark-bg);
        padding: 3rem 0;
        margin-bottom: 3rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--primary-gradient);
        opacity: 0.1;
        animation: var(--gold-animation-shimmer);
        background-size: var(--bg-size-large);
    }

    .page-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        position: relative;
        z-index: 1;
    }

    .page-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .category-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        overflow: hidden;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        height: 100%;
        position: relative;
        border: 2px solid transparent;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        background-size: var(--bg-size-large);
        animation: var(--gold-animation-shimmer);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(214, 167, 81, 0.3);
        border-color: var(--primary);
    }

    .category-card:hover::before {
        transform: scaleX(1);
    }

    .category-img-container {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: var(--light-gradient);
        flex-shrink: 0;
        transition: all 0.3s ease;
        border: 2px solid var(--medium-gray);
        overflow: hidden;
    }

    .category-card:hover .category-img-container {
        background: var(--primary-gradient);
        transform: scale(1.1) rotate(5deg);
        border-color: var(--primary);
    }

    .category-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-img {
        transform: scale(1.1);
    }

    .category-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark-bg);
        margin-bottom: 12px;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .category-card:hover .category-name {
        color: var(--primary-dark);
    }

    .store-count {
        font-size: 0.85rem;
        color: var(--dark-bg-light);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .store-count i {
        color: var(--primary);
    }

    .view-more-btn {
        background: var(--dark-bg);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        margin-top: auto;
        position: relative;
        overflow: hidden;
    }

    .view-more-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        transition: left 0.3s ease;
        z-index: 1;
    }

    .view-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(20, 95, 89, 0.4);
        color: white;
    }

    .view-more-btn:hover::before {
        left: 0;
    }

    .view-more-btn span {
        position: relative;
        z-index: 2;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 0 1rem;
    }

    .category-content-wrapper {
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 1.5rem;
    }

    .category-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .category-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .seo-content {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        margin-top: 3rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border-left: 4px solid var(--primary);
    }

    .seo-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-bg);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .seo-text {
        color: var(--dark-bg-light);
        line-height: 1.7;
        font-size: 1rem;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .breadcrumb {
        background: transparent;
        padding: 1rem 0;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--dark-bg);
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: var(--primary);
    }

    .breadcrumb-item.active {
        color: var(--dark-bg-light);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--primary);
    }

    /* Loading animation for images */
    .category-img-container {
        position: relative;
        overflow: hidden;
    }

    .category-img-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .category-card:hover .category-img-container::after {
        left: 100%;
    }

    /* Fallback for missing images */
    .category-img-container .fa-tag {
        font-size: 2rem;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .category-card:hover .category-img-container .fa-tag {
        color: white;
        transform: scale(1.2);
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
        }

        .categories-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 0 0.5rem;
        }

        .category-content-wrapper {
            padding: 1.25rem;
        }

        .category-header {
            gap: 0.75rem;
        }

        .category-img-container {
            width: 60px;
            height: 60px;
        }

        .category-img {
            width: 100%;
            height: 100%;
        }

        .category-name {
            font-size: 1rem;
        }

        .seo-content {
            padding: 1.5rem;
            margin: 2rem 0.5rem 0;
        }

        .seo-title {
            font-size: 1.25rem;
        }

        .seo-text {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .category-card {
            margin: 0 0.25rem;
        }

        .category-img-container {
            width: 50px;
            height: 50px;
        }

        .category-img-container .fa-tag {
            font-size: 1.5rem;
        }
    }

    /* Reduced motion for accessibility */
    @media (prefers-reduced-motion: reduce) {
        .category-card,
        .category-img-container,
        .category-img,
        .view-more-btn {
            transition: none;
        }

        .category-card:hover {
            transform: none;
        }

        .page-header::before,
        .category-card::before {
            animation: none;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .category-card {
            border: 2px solid #000;
        }

        .category-card:hover {
            border-color: var(--primary-dark);
        }
    }

    /* Print styles */
    @media print {
        .category-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .view-more-btn {
            display: none;
        }

        .page-header {
            background: white !important;
            color: black !important;
        }
    }
</style>
@endpush

@section('schema-ld')
<script type="application/ld+json">
@php
    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Product Categories',
        'description' => 'Explore our wide range of product categories with exclusive offers and discounts',
        'numberOfItems' => count($categories),
        'itemListElement' => []
    ];

    foreach ($categories as $index => $category) {
        $structuredData['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => [
                '@type' => 'CategoryCode',
                'name' => $category->name,
                'url' => route('category.detail', ['slug' => Str::slug($category->slug)]),
                'description' => "Browse {$category->name} category for exclusive deals and offers"
            ]
        ];
    }
@endphp
{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection

@section('content')
<!-- Schema.org Breadcrumb -->
<nav aria-label="breadcrumb" class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ url('/') }}" itemprop="item">
                    <span itemprop="name">Home</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">Categories</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </div>
</nav>

<!-- Page Header -->
<header class="page-header" role="banner">
    <div class="container">
        <h1 class="page-title" itemprop="headline">
            @lang('message.Best Discounts For Every Category')
        </h1>
        <p class="page-subtitle" itemprop="description">
            Discover exclusive offers and amazing deals across all our categories. Save big with our curated collection of discounts and coupons.
        </p>
    </div>
</header>

<!-- Main Content -->
<main class="main_content text-capitalize" role="main">
    <div class="container">
        <!-- Categories Grid -->
        <div class="categories-grid" itemscope itemtype="https://schema.org/ItemList">
            @foreach ($categories as $category)
                <article class="category-card" itemprop="itemListElement" itemscope itemtype="https://schema.org/CategoryCode">
                    <div class="category-content-wrapper">
                        <div class="category-header">
                            <!-- Category Image -->
                            <div class="category-img-container">
                                @if ($category->image && file_exists(public_path('storage/categories/' . $category->image)))
                                    <img src="{{ asset('storage/categories/' . $category->image) }}"
                                         class="category-img"
                                         alt="{{ $category->name }} - Category Image"
                                         itemprop="image"
                                         loading="lazy"
                                         width="80"
                                         height="80"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <i class="fas fa-tag fa-lg text-primary" aria-hidden="true" style="display: none;"></i>
                                @else
                                    <i class="fas fa-tag fa-lg text-primary" aria-hidden="true"></i>
                                @endif
                            </div>

                            <!-- Category Details -->
                            <div class="category-details">
                                <h2 class="category-name" itemprop="name">
                                    {{ $category->name }}
                                </h2>

                                <div class="store-count">
                                    <i class="fas fa-store"></i>
                                    <span>{{ $category->stores_count ?? 0 }} @lang('nav.stores')</span>
                                </div>

                                <meta itemprop="url" content="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">

                                <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}"
                                   class="view-more-btn"
                                   aria-label="Explore {{ $category->name }} category"
                                   itemprop="url">
                                    <span>@lang('message.View more')</span>
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
            <h2 id="seo-title" class="seo-title">Find the Best Deals Across All Categories</h2>
            <div class="seo-text">
                <p>Explore our comprehensive collection of categories featuring exclusive discounts, promotional offers, and money-saving coupons. Whether you're looking for electronics, fashion, home goods, or specialty items, we've curated the best deals from trusted retailers to help you save time and money.</p>
                <p>Our platform continuously updates offers across all categories to ensure you get access to the latest promotions and discount codes. Browse through our organized categories to find exactly what you're looking for with guaranteed savings.</p>
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

        // Add loading state for category cards
        const categoryCards = document.querySelectorAll('.category-card');
        categoryCards.forEach(card => {
            card.addEventListener('click', function() {
                this.style.opacity = '0.7';
                setTimeout(() => {
                    this.style.opacity = '1';
                }, 300);
            });
        });

        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            categoryCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        }
    });
</script>
@endpush
