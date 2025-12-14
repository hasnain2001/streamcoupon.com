@extends('layouts.master')
@section('title', 'Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals On ' . config('app.name'))
@section('description', 'Discover amazing stores with exclusive offers, discounts, and coupons. Find the best deals from top brands in one place.')
@section('keywords', 'stores, offers, discounts, coupons, deals, shopping, brands, savings')
@section('author', 'Your Brand Name')
@section('content')

@push('styles')
<style>
    :root {
        --primary: #d6a751;
        --primary-light: #f9e076;
        --primary-dark: #b8860b;
        --dark-teal: #145f59;
        --dark-teal-light: #1a7a72;
        --gradient-gold: linear-gradient(135deg, #f9e076 0%, #d4af37 50%, #b8860b 100%);
        --gradient-teal: linear-gradient(135deg, #145f59 0%, #1a7a72 100%);
    }

    .page-header {
        background: var(--gradient-teal);
        padding: 3rem 0;
        margin-bottom: 2rem;
        color: white;
        text-align: center;
    }

    .page-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .page-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    .breadcrumb-custom {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(214, 167, 81, 0.1);
    }

    .breadcrumb-item a {
        color: var(--dark-teal);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary);
    }

    .breadcrumb-item.active {
        color: var(--dark-teal-light);
        font-weight: 600;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--primary);
        font-weight: bold;
    }

    .store-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: 100%;
        position: relative;
    }

    .store-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient-gold);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .store-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .store-card:hover::before {
        transform: scaleX(1);
    }

    .store-image-container {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .store-image {
        width: 100%;
        height: 120px;
        object-fit: contain;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .store-card:hover .store-image {
        transform: scale(1.05);
    }

    .store-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: var(--gradient-gold);
        color: #2c3e50;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(214, 167, 81, 0.3);
    }

    .store-content {
        padding: 1rem;
        text-align: center;
        background: white;
    }

    .store-name {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark-teal);
        margin-bottom: 0.5rem;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .store-card:hover .store-name {
        color: var(--primary-dark);
    }

    .store-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: var(--dark-teal-light);
    }

    .store-meta i {
        color: var(--primary);
    }

    .no-stores-card {
        background: linear-gradient(135deg, #fff9e6 0%, #fff3d9 100%);
        border: 2px dashed var(--primary);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .no-stores-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .pagination-custom .page-link {
        border: none;
        color: var(--dark-teal);
        font-weight: 500;
        border-radius: 10px;
        margin: 0 4px;
        transition: all 0.3s ease;
    }

    .pagination-custom .page-link:hover {
        background: var(--gradient-gold);
        color: #2c3e50;
        transform: translateY(-2px);
    }

    .pagination-custom .page-item.active .page-link {
        background: var(--gradient-gold);
        color: #2c3e50;
        border: none;
        box-shadow: 0 4px 15px rgba(214, 167, 81, 0.3);
    }

    .stores-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1.5rem;
    }

    .stats-bar {
        background: var(--gradient-teal);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .stat-item i {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1rem;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-custom {
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
        }

        .stores-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
        }

        .store-image {
            height: 100px;
            padding: 1rem;
        }

        .store-content {
            padding: 0.75rem;
        }

        .store-name {
            font-size: 0.85rem;
        }

        .stats-bar {
            padding: 0.75rem 1rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .stores-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.75rem;
        }

        .store-image {
            height: 80px;
            padding: 0.75rem;
        }

        .store-name {
            font-size: 0.8rem;
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .store-card,
        .store-image,
        .pagination-custom .page-link {
            transition: none;
        }

        .store-card:hover {
            transform: none;
        }
    }
</style>
@endpush
<main class="container py-2 text-capitalize">
    <!-- Page Header -->
<header class="page-header">
    <div class="container">
        <h1 class="page-title">@lang('nav.stores')</h1>
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
            @php
                $language = $store->language->code;
                $storeSlug = Str::slug($store->slug);

                // Conditionally generate the URL based on the language
                $storeurl = $store->slug
                    ? ($language === 'en'
                        ? route('store.detail', ['slug' => $storeSlug])
                        : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))
                    : '#';
            @endphp

            <a href="{{ $storeurl }}" class="text-decoration-none">
                <div class="store-card">
                    <div class="store-image-container">
                        <img
                            src="{{ $store->image ? asset('storage/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                            class="store-image"
                            alt="{{ $store->name }}"
                            loading="lazy"
                        />
                        @if($store->top_store)
                            <div class="store-badge">
                                <i class="fas fa-crown me-1"></i>Top
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
@endsection
