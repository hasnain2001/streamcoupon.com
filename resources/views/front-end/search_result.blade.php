@extends('layouts.master')

@section('title', __('search.meta_title', ['year' => date('Y')]))
@section('description', __('search.meta_description'))
@section('keywords', __('search.meta_keywords'))
@section('author', __('search.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/search-result.css') }}">
@endpush

@section('content')
<!-- Search Header -->
<div class="search-header">
    <div class="container">
        <div class="search-header-content">
            <h1>{{ __('search.page_title') }}</h1>
            <p class="lead">
                {{ __('search.found_results') }}
                <span class="search-query">"{{ $query }}"</span>
            </p>
            @if($searchType == 'all')
            <div class="search-stats">
                <div class="stat-item">
                    <i class="fas fa-store"></i>
                    <span class="stat-number">{{ $totalStores }}</span>
                    <span>{{ __('search.stores') }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-tag"></i>
                    <span class="stat-number">{{ $totalCoupons }}</span>
                    <span>{{ __('search.coupons') }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-folder"></i>
                    <span class="stat-number">{{ $totalCategories }}</span>
                    <span>{{ __('search.categories') }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-blog"></i>
                    <span class="stat-number">{{ $totalBlogs }}</span>
                    <span>{{ __('search.blogs') }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="container animate-fade-in">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url(app()->getLocale() . '/') }}">
                    <i class="fas fa-home me-1"></i>{{ __('home') }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('search.breadcrumb') }}</li>
        </ol>
    </nav>

    <!-- Search Filters -->
    <div class="card search-filters-card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h3 class="results-title mb-0">
                        <i class="fas fa-search text-primary me-2"></i>
                        {{ __('search.results_title') }}
                        <small>{{ __('search.for') }} "{{ $query }}"</small>
                    </h3>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('search_results') }}" class="d-flex gap-2">
                        <input type="hidden" name="query" value="{{ $query }}">
                        <select name="type" class="form-select type-select" onchange="this.form.submit()">
                            <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>{{ __('search.all_results') }}</option>
                            <option value="stores" {{ $searchType == 'stores' ? 'selected' : '' }}>{{ __('search.stores') }}</option>
                            <option value="coupons" {{ $searchType == 'coupons' ? 'selected' : '' }}>{{ __('search.coupons') }}</option>
                            <option value="categories" {{ $searchType == 'categories' ? 'selected' : '' }}>{{ __('search.categories') }}</option>
                            <option value="blogs" {{ $searchType == 'blogs' ? 'selected' : '' }}>{{ __('search.blogs') }}</option>
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
            <div class="summary-badges">
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'stores']) }}" class="text-decoration-none">
                    <span class="badge bg-primary">
                        <i class="fas fa-store me-1"></i>{{ __('search.stores') }}: {{ $totalStores }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'coupons']) }}" class="text-decoration-none">
                    <span class="badge bg-success">
                        <i class="fas fa-tag me-1"></i>{{ __('search.coupons') }}: {{ $totalCoupons }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'categories']) }}" class="text-decoration-none">
                    <span class="badge bg-warning">
                        <i class="fas fa-folder me-1"></i>{{ __('search.categories') }}: {{ $totalCategories }}
                    </span>
                </a>
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'blogs']) }}" class="text-decoration-none">
                    <span class="badge bg-info">
                        <i class="fas fa-blog me-1"></i>{{ __('search.blogs') }}: {{ $totalBlogs }}
                    </span>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Stores Results -->
    @if(($searchType == 'all' || $searchType == 'stores') && $stores->count() > 0)
    <div class="card result-section-card">
        <div class="card-header bg-primary">
            <h5>
                <i class="fas fa-store me-2"></i>{{ __('search.stores') }}
                @if($searchType == 'all')
                    ({{ $stores->count() }} {{ __('search.of') }} {{ $totalStores }})
                @else
                    ({{ $stores->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalStores > $stores->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'stores']) }}" class="view-all-btn">
                    {{ __('search.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-4 animate-stagger">
                @foreach ($stores as $store)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="store-card">
                            <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}">
                                <div class="store-image-wrapper">
                                    <img src="{{ $store->image_url }}"
                                         class="store-image"
                                         alt="{{ $store->name }}"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                </div>
                                <h6 class="store-name">{{ $store->name }}</h6>
                                @if($store->coupons_count > 0)
                                    <span class="offers-badge">
                                        {{ $store->coupons_count }} {{ __('search.offers') }}
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
        <div class="card-header bg-success">
            <h5>
                <i class="fas fa-tag me-2"></i>{{ __('search.coupons') }}
                @if($searchType == 'all')
                    ({{ $coupons->count() }} {{ __('search.of') }} {{ $totalCoupons }})
                @else
                    ({{ $coupons->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalCoupons > $coupons->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'coupons']) }}" class="view-all-btn">
                    {{ __('search.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3 animate-stagger">
                @foreach ($coupons as $coupon)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-card h-100">
                            <div class="card-body">
                                <div class="coupon-header">
                                    <h6 class="coupon-title">{{ $coupon->title ?? $coupon->name }}</h6>
                                    @if($coupon->code)
                                        <span class="coupon-code-badge">{{ $coupon->code }}</span>
                                    @endif
                                </div>
                                @if($coupon->description)
                                    <p class="coupon-description">{{ Str::limit($coupon->description, 80) }}</p>
                                @endif
                                <div class="coupon-store">
                                    @if($coupon->stores)
                                        <img src="{{ $coupon->stores->image_url }}" alt="{{ $coupon->stores->name }}" onerror="this.style.display='none'">
                                        <span>{{ $coupon->stores->name }}</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="coupon-expiry">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $coupon->ending_date ? \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') : __('search.no_expiry') }}
                                    </span>
                                    @if($coupon->code)
                                        <button class="btn btn-sm btn-primary" style="background: var(--primary-gradient); border: none; border-radius: 50px; font-size: 0.7rem; padding: 0.25rem 0.8rem;">
                                            <i class="fas fa-copy me-1"></i>{{ __('search.get_code') }}
                                        </button>
                                    @endif
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
        <div class="card-header bg-warning">
            <h5>
                <i class="fas fa-folder me-2"></i>{{ __('search.categories') }}
                @if($searchType == 'all')
                    ({{ $categories->count() }} {{ __('search.of') }} {{ $totalCategories }})
                @else
                    ({{ $categories->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalCategories > $categories->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'categories']) }}" class="view-all-btn dark">
                    {{ __('search.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3 animate-stagger">
                @foreach ($categories as $category)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}" class="text-decoration-none">
                            <div class="category-card h-100">
                                <div class="card-body">
                                    <div class="category-icon">
                                        <i class="fas fa-folder"></i>
                                    </div>
                                    <h6 class="category-name">{{ $category->name }}</h6>
                                    @if($category->stores_count > 0)
                                        <span class="category-count">
                                            {{ $category->stores_count }} {{ __('search.stores_plural') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
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
        <div class="card-header bg-info">
            <h5>
                <i class="fas fa-blog me-2"></i>{{ __('search.blogs') }}
                @if($searchType == 'all')
                    ({{ $blogs->count() }} {{ __('search.of') }} {{ $totalBlogs }})
                @else
                    ({{ $blogs->total() }})
                @endif
            </h5>
            @if($searchType == 'all' && $totalBlogs > $blogs->count())
                <a href="{{ route('search_results', ['query' => $query, 'type' => 'blogs']) }}" class="view-all-btn">
                    {{ __('search.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-4 animate-stagger">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-md-6">
                        <div class="blog-card h-100">
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                                <div class="blog-image-wrapper">
                                    <img src="{{ $blog->image_url ?? asset('assets/img/no-image-found.png') }}"
                                         alt="{{ $blog->name }}"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                    <span class="blog-date">
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="blog-title">{{ $blog->name }}</h5>
                                <p class="blog-excerpt">{{ Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $blog->user->name ?? __('search.admin') }}
                                    </small>
                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="read-more-btn">
                                        {{ __('common.read_more') }} <i class="fas fa-arrow-right ms-1"></i>
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
            <div class="no-results-icon">
                <i class="fas fa-search"></i>
            </div>
            <h4>{{ __('search.no_results_title') }}</h4>
            <p>{{ __('search.no_results_text', ['query' => $query]) }}</p>
            <a href="{{ url(app()->getLocale() . '/') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>{{ __('search.back_home') }}
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
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

        // Image error handling
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = '{{ asset("assets/img/no-image-found.png") }}';
            });
        });

        // Copy coupon code functionality
        document.querySelectorAll('.coupon-code-badge').forEach(badge => {
            badge.style.cursor = 'pointer';
            badge.addEventListener('click', function() {
                const code = this.textContent.trim();
                navigator.clipboard.writeText(code).then(() => {
                    const originalText = this.textContent;
                    this.textContent = '{{ __("search.copied") }}';
                    this.style.background = 'var(--secondary-gradient)';
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.background = '';
                    }, 2000);
                });
            });
        });
    });
</script>
@endpush