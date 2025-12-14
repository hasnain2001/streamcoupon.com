@extends('layouts.master')
@section('title','search | Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')

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

    /* Search Header */
    .search-header {
        background: var(--gradient-teal);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .search-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    .search-header-content {
        position: relative;
        z-index: 2;
    }

    .search-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .search-query {
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
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

    /* Search Filters */
    .search-filters-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .search-filters-card .card-body {
        padding: 1.5rem;
    }

    .results-title {
        color: var(--dark-teal);
        font-weight: 800;
        font-size: 1.5rem;
    }

    .type-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem;
        font-weight: 500;
        color: var(--dark-teal);
        transition: all 0.3s ease;
    }

    .type-select:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 0.2rem rgba(214, 167, 81, 0.25);
    }

    /* Results Summary */
    .summary-badges .badge {
        font-size: 0.9rem;
        padding: 0.6rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .summary-badges .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Result Cards */
    .result-section-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .result-section-card .card-header {
        background: var(--gradient-teal);
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
    }

    .result-section-card .card-body {
        padding: 1.5rem;
    }

    .view-all-btn {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-all-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-1px);
    }

    /* Store Cards */
    .store-card {
        text-align: center;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
    }

    .store-card:hover {
        transform: translateY(-5px);
    }

    .store-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .store-card:hover .store-image {
        border-color: var(--gold-primary);
        box-shadow: 0 8px 25px rgba(214, 167, 81, 0.3);
    }

    .store-name {
        color: var(--dark-teal);
        font-weight: 700;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .offers-badge {
        background: var(--gradient-gold);
        color: #000;
        font-weight: 600;
        border-radius: 15px;
        padding: 0.3rem 0.8rem;
        font-size: 0.8rem;
    }

    /* Coupon Cards */
    .coupon-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        background: white;
    }

    .coupon-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }

    .coupon-code {
        background: var(--gradient-gold);
        color: #000;
        font-weight: 700;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .expiry-badge {
        background: var(--light-gradient);
        color: #666;
        font-weight: 500;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.8rem;
        border: 1px solid #e9ecef;
    }

    /* Category Cards */
    .category-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
        background: white;
    }

    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }

    /* Blog Cards */
    .blog-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        overflow: hidden;
        background: white;
    }

    .blog-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
    }

    .blog-card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover img {
        transform: scale(1.05);
    }

    .blog-card .card-body {
        padding: 1.5rem;
    }

    .blog-title {
        color: var(--dark-teal);
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .read-more-btn {
        background: var(--gradient-teal);
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        background: var(--dark-teal-light);
        transform: translateY(-1px);
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
    }

    .no-results img {
        max-width: 200px;
        opacity: 0.6;
        margin-bottom: 1.5rem;
    }

    .no-results h4 {
        color: var(--dark-teal);
        margin-bottom: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .search-header {
            padding: 2rem 0;
        }

        .search-header h1 {
            font-size: 2rem;
        }

        .search-filters-card .card-body {
            padding: 1rem;
        }

        .results-title {
            font-size: 1.3rem;
        }

        .store-image {
            width: 100px;
            height: 100px;
        }
    }

    @media (max-width: 576px) {
        .search-header h1 {
            font-size: 1.7rem;
        }

        .breadcrumb-custom {
            padding: 0.8rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Search Header -->
<div class="search-header">
    <div class="container">
        <div class="search-header-content">
            <h1>Search Results</h1>
            <p class="lead mb-0">Found results for: <span class="search-query">"{{ $query }}"</span></p>
        </div>
    </div>
</div>

<div class="container animate-fade-in">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        </ol>
    </nav>

    <!-- Search Filters -->
    <div class="card search-filters-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h3 class="results-title mb-0">
                        Search Results
                        <small class="text-muted fs-6">for "{{ $query }}"</small>
                    </h3>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('search_results') }}">
                        <input type="hidden" name="query" value="{{ $query }}">
                        <select name="type" class="form-select type-select" onchange="this.form.submit()">
                            <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>All Results</option>
                            <option value="stores" {{ $searchType == 'stores' ? 'selected' : '' }}>Stores</option>
                            <option value="coupons" {{ $searchType == 'coupons' ? 'selected' : '' }}>Coupons</option>
                            <option value="categories" {{ $searchType == 'categories' ? 'selected' : '' }}>Categories</option>
                            <option value="blogs" {{ $searchType == 'blogs' ? 'selected' : '' }}>Blogs</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Summary -->
    @if($searchType == 'all')
    <div class="row mb-4">
        <div class="col-12">
            <div class="summary-badges d-flex flex-wrap gap-3">
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'stores']) }}" class="text-decoration-none">
                    <span class="badge bg-primary">
                        <i class="fas fa-store me-1"></i>Stores: {{ $totalStores }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'coupons']) }}" class="text-decoration-none">
                    <span class="badge bg-success">
                        <i class="fas fa-tag me-1"></i>Coupons: {{ $totalCoupons }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'categories']) }}" class="text-decoration-none">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-folder me-1"></i>Categories: {{ $totalCategories }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'blogs']) }}" class="text-decoration-none">
                    <span class="badge bg-info">
                        <i class="fas fa-blog me-1"></i>Blogs: {{ $totalBlogs }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Stores Results -->
    @if(($searchType == 'all' || $searchType == 'stores') && $stores->count() > 0)
    <div class="card result-section-card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-store me-2"></i>Stores
                @if($searchType == 'all')
                    ({{ $stores->count() }} of {{ $totalStores }})
                @else
                    ({{ $stores->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalStores > $stores->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'stores']) }}" class="view-all-btn">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-4">
                @foreach ($stores as $store)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="store-card">
                            @php
                                $language = $store->language ? $store->language->code : 'en';
                                $storeSlug = Str::slug($store->slug);
                                $storeurl = $store->slug
                                    ? ($language === 'en'
                                        ? route('store.detail', ['slug' => $storeSlug])
                                        : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))
                                    : '#';
                            @endphp
                            <a href="{{ $storeurl }}" class="text-decoration-none">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="{{ $store->image ? asset('storage/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                         class="store-image rounded-circle"
                                         alt="{{ $store->name }}"
                                         loading="lazy">
                                </div>
                                <h6 class="store-name">{{ $store->name }}</h6>
                                @if($store->offers_count > 0)
                                    <span class="offers-badge">
                                        {{ $store->offers_count }} {{ Str::plural('offer', $store->offers_count) }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($searchType == 'stores' && $stores->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $stores->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Coupons Results -->
    @if(($searchType == 'all' || $searchType == 'coupons') && $coupons->count() > 0)
    <div class="card result-section-card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-tag me-2"></i>Coupons
                @if($searchType == 'all')
                    ({{ $coupons->count() }} of {{ $totalCoupons }})
                @else
                    ({{ $coupons->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalCoupons > $coupons->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'coupons']) }}" class="view-all-btn">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach ($coupons as $coupon)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card coupon-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="card-title text-dark fw-bold mb-0">{{ $coupon->title }}</h6>
                                    <span class="coupon-code">{{ $coupon->code }}</span>
                                </div>
                                <p class="card-text text-muted small mb-3">{{ Str::limit($coupon->description, 100) }}</p>

                                @if($coupon->store)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-store text-primary me-2 small"></i>
                                        <small class="text-primary">{{ $coupon->store->name }}</small>
                                    </div>
                                @endif

                                @if($coupon->name)
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-tag text-success me-2 small"></i>
                                        <small class="text-success">{{ $coupon->name }}</small>
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <span class="expiry-badge">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $coupon->ending_date ? $coupon->ending_date->format('M d, Y') : 'No expiry' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($searchType == 'coupons' && $coupons->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $coupons->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Categories Results -->
    @if(($searchType == 'all' || $searchType == 'categories') && $categories->count() > 0)
    <div class="card result-section-card">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-folder me-2"></i>Categories
                @if($searchType == 'all')
                    ({{ $categories->count() }} of {{ $totalCategories }})
                @else
                    ({{ $categories->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalCategories > $categories->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'categories']) }}" class="view-all-btn" style="color: #000; background: rgba(0,0,0,0.1);">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach ($categories as $category)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card category-card h-100">
                            <div class="card-body">
                                <a href="{{ route('category.detail', [Str::slug($category->slug)]) }}" >
                                <div class="mb-3">
                                    <i class="fas fa-folder text-warning" style="font-size: 2rem;"></i>
                                </div>
                                <h6 class="card-title text-dark fw-bold mb-2">{{ $category->name }}</h6>
                                @if($category->stores_count > 0)
                                    <span class="badge bg-primary">
                                        {{ $category->stores_count }} {{ Str::plural('store', $category->stores_count) }}
                                    </span>
                                @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($searchType == 'categories' && $categories->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Blogs Results -->
    @if(($searchType == 'all' || $searchType == 'blogs') && $blogs->count() > 0)
    <div class="card result-section-card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-blog me-2"></i>Blog Posts
                @if($searchType == 'all')
                    ({{ $blogs->count() }} of {{ $totalBlogs }})
                @else
                    ({{ $blogs->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalBlogs > $blogs->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'blogs']) }}" class="view-all-btn">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-md-6">
                        <div class="card blog-card h-100">
                            @if($blog->image)
                             <a href="{{ route('blog.detail', $blog->slug) }}" >
                                <img src="{{ asset('storage/blogs/' . $blog->image) }}"
                                     class="card-img-top"
                                     alt="{{ $blog->title }}"
                                     loading="lazy">
                               </a>
                            @endif
                            <div class="card-body">
                                <h5 class="blog-title">{{ $blog->title }}</h5>
                                <p class="card-text text-muted mb-3">{{ Str::limit($blog->excerpt, 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </small>
                                    <a href="{{ route('blog.detail', $blog->slug) }}" class="read-more-btn">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($searchType == 'blogs' && $blogs->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- No Results -->
    @if($stores->isEmpty() && $coupons->isEmpty() && $categories->isEmpty() && $blogs->isEmpty())
        <div class="no-results">
            <img src="{{ asset('assets/img/no-image-found.png') }}"
                 alt="No results"
                 class="img-fluid">
            <h4 class="mt-3">No results found for "{{ $query }}"</h4>
            <p class="text-secondary mb-4">Try adjusting your search criteria and try again</p>
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Add smooth animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on scroll
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

        // Observe all result cards
        document.querySelectorAll('.store-card, .coupon-card, .category-card, .blog-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Copy protection with nicer alerts
        document.addEventListener('copy', function(e) {
            e.preventDefault();
            // You can add a SweetAlert here if you have it included
            console.log('Copying disabled on this page');
        });

        document.addEventListener('contextmenu', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
                console.log('Right-click disabled for images');
            }
        });
    });
</script>
@endpush
