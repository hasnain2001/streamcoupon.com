@extends('layouts.master')
@section('title')
    @if ($store->title)
    {{ $store->title }} - {{ config('app.name') }}
    @else
    {{ $store->name }} - Coupons & Promo Codes {{ date('Y') }} - {{ config('app.name') }}
    @endif
@endsection

    @section('description')
        @if ($store->meta_description)
            {{ $store->meta_description }}
        @else
            Save money at {{ $store->name }} with exclusive promo codes, vouchers, and special offers. Get the best deals and discounts verified by Vouchersweell.com.
        @endif
    @endsection

    @section('keywords')
        @if ($store->meta_keyword)
            {{ $store->meta_keyword }}, {{ $store->name }} discounts, {{ $store->name }} promo codes
        @else
            {{ $store->name }}, {{ $store->name }} coupons, {{ $store->name }} vouchers, discount codes, promo offers, save money, online deals
        @endif
    @endsection
    @section('content')
    <main class="main container-fluid">
        @php
        $codeCount = 0;
        $dealCount = 0;
        foreach ($coupons as $coupon) {
        if ($coupon->code) {
        $codeCount++;
        } else {
        $dealCount++;
        }
        }
        $totalCount = $codeCount + $dealCount;
        @endphp

        <!-- Breadcrumb Section -->
        <section class="breadcrumb-section py-3 bg-light">
            <div class="container">
                <nav class="breadcrumb-nav" aria-label="breadcrumb">
                    <div class="breadcrumb-container">
                        <a href="{{ url(app()->getLocale() . '/') }}" class="breadcrumb-item">
                            <span class="breadcrumb-text">@lang('nav.home')</span>
                        </a>
                        <div class="breadcrumb-item">
                            @if($store->category && $store->category->title)
                                <a class="breadcrumb-link" href="{{ route('category.detail', ['slug' => Str::slug($store->category->title)]) }}">
                                    <span class="breadcrumb-text">{{ $store->category->title }}</span>
                                </a>
                            @elseif(!empty($store->category))
                                <a href="{{ route('category.detail', ['slug' => Str::slug($store->category->slug)]) }}" class="breadcrumb-link">
                                    <span class="breadcrumb-text">{{ $store->category->title }}</span>
                                </a>
                            @else
                                <span class="breadcrumb-text">No Category</span>
                            @endif
                        </div>

                        <span class="breadcrumb-separator">›</span>

                        <a href="{{ route('stores',['lang' => app()->getLocale()]) }}" class="breadcrumb-item">
                            <span class="breadcrumb-text">@lang('nav.stores')</span>
                        </a>

                        <span class="breadcrumb-separator">›</span>

                        <span class="breadcrumb-item current">
                            <span class="breadcrumb-text">{{ $store->name }}</span>
                        </span>
                    </div>
                </nav>
            </div>
        </section>
        <!-- Store Header Section - Mobile Optimized -->
        <section class="store-header-section py-4 bg-white card shadow">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image on left for all screens -->
                    <div class="col-md-2 col-3">
                        <img src="{{ asset('storage/stores/' . $store->image) }}"
                            class="store-logo rounded-3 shadow-sm w-100"
                            alt="{{ $store->name }}"
                            style="max-width: 80px;">
                    </div>

                    <!-- Store info on right for mobile, full width for desktop -->
                    <div class="col-md-10 col-9">
                        <div class="store-info text-md-start text-end">
                            <h1 class="store-title mb-1">{{ $store->name }}</h1>
                            <div class="store-rating d-flex align-items-center justify-content-md-start justify-content-end mb-1">
                                <div class="stars text-warning me-2">
                                    ⭐⭐⭐⭐⭐
                                </div>
                                <span class="text-muted small">(4.8/5)</span>
                            </div>
                            <p class="store-tagline text-muted mb-2 mb-md-0 small d-none d-md-block">
                            {{ $store->description }}
                            </p>
                        </div>
                        <!-- Visit Store Button - Full width on mobile, aligned right on desktop -->
                    <div class="">
                        <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden btn-sm px-4 rounded-pill">
                            <i class="fas fa-external-link-alt me-2"></i>@lang('message.Visit Store')
                        </a>
                    </div>
                    </div>


                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section class="store-content-section py-5">
            <div class="container-fluid">
                <div class="row">
                    <!-- Coupons Grid -->
                    <div class="col-lg-9 col-12 order-1 order-lg-1">
                        <!-- Stats Bar -->
                        <div class="stats-bar mb-4 p-3 bg-light rounded-3 d-none d-lg-block">
                            <div class="row text-center g-3">
                                <div class="col-md-4 col-4">
                                    <div class="stat-item">
                                        <h6 class="stat-number text-golden mb-1">{{ $totalCount }}</h6>
                                        <p class="stat-label text-muted mb-0">Total Offers</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="stat-item">
                                        <h6 class="stat-number text-success mb-1">{{ $codeCount }}</h6>
                                        <p class="stat-label text-muted mb-0">Coupon Codes</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="stat-item">
                                        <h6 class="stat-number text-info mb-1">{{ $dealCount }}</h6>
                                        <p class="stat-label text-muted mb-0">Deals</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Tabs - Mobile Optimized -->
                        <div class="filter-section mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <h4 class="filter-title h5 mb-0 d-none d-md-block">Filter Offers</h4>

                                <!-- Mobile Filter Dropdown -->
                                <div class="dropdown d-md-none">
                                    <button class="btn btn-outline-golden dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item {{ !request()->has('sort') ? 'active' : '' }}" href="{{ url()->current() }}">
                                                All <span class="badge bg-golden ms-2">{{ $totalCount }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request('sort') == 'codes' ? 'active' : '' }}" href="{{ url()->current() }}?sort=codes">
                                                Codes <span class="badge bg-success ms-2">{{ $codeCount }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request('sort') == 'deals' ? 'active' : '' }}" href="{{ url()->current() }}?sort=deals">
                                                Deals <span class="badge bg-info ms-2">{{ $dealCount }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Coupons Grid -->
                        @if($coupons->isEmpty())
                        <div class="empty-state text-center py-5">
                            <div class="empty-icon mb-4">
                                <i class="fas fa-tag fa-4x text-muted"></i>
                            </div>
                            <h3 class="empty-title mb-3">@lang('message.Oops! No Coupons Available')</h3>
                            <p class="empty-text text-muted mb-4">@lang('message.Dont worry, you can still explore amazing deals from our partnered brands.')</p>
                            <a href="{{ route('stores') }}" class="btn btn-golden btn-lg px-4 rounded-pill">
                                @lang('message.Explore Brands')<i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                        @else
                        <div class="row g-3">
                            @foreach ($coupons as $coupon)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                <div class="coupon-card card h-100 border-0 shadow-sm hover-lift position-relative" style="border-radius: 16px; overflow: hidden;">
                                    <!-- Premium Badge -->
                                    @if (!empty($coupon->authentication) && $coupon->authentication !== 'No Auth' && $coupon->authentication !== 'On Sale')
                                    <div class="premium-badge position-absolute top-0 start-0 m-2">
                                        <span class="badge bg-warning text-dark px-3 py-2" style="font-size: 0.7rem; border-radius: 20px;">
                                            <i class="fas fa-crown me-1"></i>{{ $coupon->authentication }}
                                        </span>
                                    </div>
                                    @endif

                                    <!-- Hot Offer Ribbon -->
                                    @if($coupon->clicks > 50)
                                    <div class="hot-offer-ribbon position-absolute top-0 end-0">
                                        <div class="ribbon bg-danger text-white px-3 py-1" style="transform: rotate(45deg) translate(25px, -10px); font-size: 0.7rem;">
                                            <i class="fas fa-fire me-1"></i>HOT
                                        </div>
                                    </div>
                                    @endif

                                    <div class="card-body p-3 d-flex flex-column">
                                        <!-- Coupon Header -->
                                        <div class="coupon-header mb-2">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="coupon-type badge {{ $coupon->code ? 'bg-success' : 'bg-golden' }} px-3 py-2" style="border-radius: 20px; font-size: 0.75rem;">
                                                    <i class="fas {{ $coupon->code ? 'fa-tag' : 'fa-percent' }} me-1"></i>
                                                    {{ $coupon->code ? 'Code' : 'Deal' }}
                                                </span>
                                            </div>
                                            <div class="text-center mb-3">
                                                <div class="store-image-container position-relative d-inline-block">
                                                    <img src="{{ asset('storage/stores/' . $store->image) }}"
                                                        class="coupon-store-image rounded-circle shadow border-3 border-white"
                                                        alt="{{ $store->name }}"
                                                        width="60"
                                                        height="60"
                                                        style="object-fit: fill;">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Coupon Content -->
                                        <div class="coupon-content flex-grow-1">
                                            <h6 class="coupon-title mb-2 fw-bold" style="font-size: 0.9rem; line-height: 1.3;">
                                                {{ Str::limit($coupon->name, 60) }}
                                            </h6>

                                            @if($coupon->description)
                                            <p class="coupon-description text-muted small mb-3 d-none d-sm-block" style="font-size: 0.8rem; line-height: 1.4;">
                                                {{ Str::limit($coupon->description, 80) }}
                                            </p>
                                            @endif

                                            <div class="coupon-meta d-flex justify-content-between align-items-center mb-3">
                                                <span class="ending-date small {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-muted' }}" style="font-size: 0.75rem;">
                                                    <i class="fas fa-clock me-1"></i>
                                                    <span class="d-none d-sm-inline">Ends:</span>
                                                    {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                                                </span>
                                                <span class="used-count small text-muted" style="font-size: 0.75rem;">
                                                    <i class="fas fa-users me-1"></i>
                                                    <span id="usedCount{{ $coupon->id }}">{{ $coupon->clicks }}</span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Coupon Action -->
                                        <div class="coupon-action mt-auto">
                                            @if ($coupon->code)
                                            <button class="w-100 get-code-btn py-2 border-0 rounded-pill fw-bold position-relative overflow-hidden"

                                                    onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('storage/stores/' . $store->image) }}', '{{ $store->destination_url }}', '{{ $coupon->store->name }}')">
                                                <span class="reveal-text position-relative z-2">
                                                    <i class="fas fa-gift me-2"></i>Get Code
                                                </span>
                                                <span class="coupon-code d-none">{{ $coupon->code }}</span>
                                                <div class="btn-shine position-absolute top-0 left-0 w-100 h-100" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); transform: skewX(-20deg);"></div>
                                            </button>
                                            @else
                                            <a href="{{ $store->destination_url }}"
                                            target="_blank"
                                            class="deal-btn w-100 py-2 border-0 rounded-pill fw-bold text-decoration-none text-center d-block position-relative overflow-hidden"
                                            onclick="updateClickCount('{{ $coupon->id }}')">
                                                <span class="position-relative z-2">
                                                    <i class="fas fa-bolt me-2"></i>View Deal
                                                </span>
                                                <div class="btn-shine position-absolute top-0 left-0 w-100 h-100" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); transform: skewX(-20deg);"></div>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Store Content / Blog Section -->
                        @if ($store->content || $relatedblogs->isNotEmpty())
                        <div class="content-section mt-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3 p-md-4">
                                    @if ($store->content)
                                    <div class="store-content">
                                        {!! $store->content !!}
                                    </div>
                                    @else
                                    <div class="related-blogs">
                                        <h3 class="section-title mb-3 mb-md-4">Related Articles</h3>
                                        @foreach ($relatedblogs as $blog)
                                        <div class="blog-item mb-3 mb-md-4 pb-3 pb-md-4 border-bottom">
                                            <h4 class="blog-title h5 h6-md mb-2 mb-md-3">{{ $blog->title }}</h4>
                                            @if($blog->image)
                                            <img class="blog-image img-fluid rounded mb-2 mb-md-3"
                                                src="{{ asset('storage/blogs/' . $blog->image) }}"
                                                alt="{{ $blog->title }}"
                                                style="max-height: 150px; object-fit: cover;">
                                            @endif
                                            <div class="blog-content small">
                                                {!! Str::limit(strip_tags($blog->content), 150) !!}
                                            </div>
                                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-link text-golden p-0 mt-2 small">
                                                Read More <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Enhanced Sidebar -->
                    <div class="col-lg-3 col-12 order-2 order-lg-2">
                        <div class="sidebar-sticky">
                            <!-- Store Quick Actions Card -->
                            <div class="sidebar-card card border-0 shadow-sm mb-4">
                                <div class="card-header bg-golden text-dark text-center py-3 rounded-top">
                                    <h5 class="mb-0 fw-bold"><i class="fas fa-store me-2"></i>Store Quick View</h5>
                                </div>
                                <div class="card-body p-0">
                                    <!-- Store Image & Basic Info -->
                                    <div class="store-sidebar-header text-center p-4 bg-gradient-light">
                                        <img src="{{ asset('storage/stores/' . $store->image) }}"
                                            class="store-sidebar-image rounded-circle shadow mb-3 border border-4 border-white"
                                            alt="{{ $store->name }}"
                                            width="90"
                                            height="90">
                                        <h4 class="store-name h5 mb-2 fw-bold text-dark">{{ $store->name }}</h4>
                                        <div class="store-rating text-warning mb-3">
                                            ⭐⭐⭐⭐⭐ <span class="text-muted small">(4.8)</span>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="quick-actions p-3 border-bottom">
                                        <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden w-100 mb-2 fw-semibold">
                                            <i class="fas fa-external-link-alt me-2"></i>Visit Store
                                        </a>
                                        <button class="btn btn-outline-golden w-100 fw-semibold" onclick="scrollToCoupons()">
                                            <i class="fas fa-tags me-2"></i>View All Coupons
                                        </button>
                                    </div>

                                    <!-- Store Stats -->
                                    <div class="store-stats p-3">
                                        <h6 class="stats-title fw-bold text-center mb-3 text-uppercase small">Store Statistics</h6>
                                        <div class="stats-grid">
                                            <div class="stat-circle text-center mb-3">
                                                <div class="stat-number bg-golden text-white rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2"
                                                    style="width: 60px; height: 60px;">
                                                    <strong>{{ $totalCount }}</strong>
                                                </div>
                                                <span class="stat-label small text-muted">Total Offers</span>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <div class="mini-stat">
                                                        <div class="mini-stat-number text-success fw-bold">{{ $codeCount }}</div>
                                                        <div class="mini-stat-label small text-muted">Codes</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mini-stat">
                                                        <div class="mini-stat-number text-info fw-bold">{{ $dealCount }}</div>
                                                        <div class="mini-stat-label small text-muted">Deals</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Options Card -->
                            <div class="sidebar-card card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-filter me-2"></i>Filter Offers</h5>
                                </div>
                                <div class="card-body p-3">
                                    <div class="filter-options">
                                        <div class="filter-group mb-3">
                                            <h6 class="filter-subtitle fw-semibold mb-2">Offer Type</h6>
                                            <div class="d-grid gap-2">
                                                <a href="{{ url()->current() }}" class="btn btn-outline-golden text-start {{ !request()->has('sort') ? 'active' : '' }}">
                                                    <i class="fas fa-layer-group me-2"></i>
                                                    All Offers
                                                    <span class="badge bg-golden float-end">{{ $totalCount }}</span>
                                                </a>
                                                <a href="{{ url()->current() }}?sort=codes" class="btn btn-outline-success text-start {{ request('sort') == 'codes' ? 'active' : '' }}">
                                                    <i class="fas fa-tag me-2"></i>
                                                    Coupon Codes
                                                    <span class="badge bg-success float-end">{{ $codeCount }}</span>
                                                </a>
                                                <a href="{{ url()->current() }}?sort=deals" class="btn btn-outline-info text-start {{ request('sort') == 'deals' ? 'active' : '' }}">
                                                    <i class="fas fa-percent me-2"></i>
                                                    Deals & Sales
                                                    <span class="badge bg-info float-end">{{ $dealCount }}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="filter-group">
                                            <h6 class="filter-subtitle fw-semibold mb-2">Sort By</h6>
                                            <div class="d-grid gap-2">
                                                <a href="{{ url()->current() }}?sort=latest" class="btn btn-outline-secondary text-start">
                                                    <i class="fas fa-clock me-2"></i>Latest
                                                </a>
                                                <a href="{{ url()->current() }}?sort=popular" class="btn btn-outline-secondary text-start">
                                                    <i class="fas fa-fire me-2"></i>Most Popular
                                                </a>
                                                <a href="{{ url()->current() }}?sort=expiring" class="btn btn-outline-secondary text-start">
                                                    <i class="fas fa-hourglass-end me-2"></i>Expiring Soon
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Store About Card -->
                            @if($store->about)
                            <div class="sidebar-card card border-0 shadow-sm mb-4">
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-info-circle me-2"></i>About {{ $store->name }}</h5>
                                </div>
                                <div class="card-body p-3">
                                    <div class="about-content">
                                        <p class="about-text text-muted small mb-0">
                                            {{ Str::limit($store->about, 200) }}
                                        </p>
                                        @if(strlen($store->about) > 200)
                                        <button class="btn btn-link text-golden p-0 mt-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#fullAbout">
                                            Read More <i class="fas fa-chevron-down ms-1"></i>
                                        </button>
                                        <div class="collapse mt-2" id="fullAbout">
                                            <p class="text-muted small">{{ $store->about }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Related Stores Card -->
                            @if($relatedStores->isNotEmpty())
                            <div class="sidebar-card card border-0 shadow-sm">
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-store me-2"></i>Similar Stores</h5>
                                </div>
                                <div class="card-body p-3">
                                    <div class="related-stores-list">
                                        @foreach ($relatedStores as $relatedStore)
                                        <a href="{{ route('store.detail', ['slug' => Str::slug($relatedStore->slug)]) }}"
                                        class="related-store-item d-flex align-items-center text-decoration-none text-dark mb-3 p-3 rounded hover-lift bg-light">
                                            <img src="{{ asset('storage/stores/' . $relatedStore->image) }}"
                                                class="related-store-image rounded-circle shadow-sm me-3 border"
                                                alt="{{ $relatedStore->name }}"
                                                width="45"
                                                height="45">
                                            <div class="related-store-info flex-grow-1">
                                                <h6 class="related-store-name fw-semibold mb-1 small">{{ Str::limit($relatedStore->name, 25) }}</h6>
                                                <div class="related-store-meta d-flex align-items-center">
                                                    <span class="text-warning small me-2">
                                                        <i class="fas fa-star"></i> 4.5
                                                    </span>
                                                    <span class="text-muted small">
                                                        <i class="fas fa-tag ms-2"></i> {{ $relatedStore->coupons_count ?? 0 }} offers
                                                    </span>
                                                </div>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Enhanced Coupon Code Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow border-0 overflow-hidden">
                <!-- Ribbon Banner - Left Side -->
                <div class="ribbon-left">
                    <span class="ribbon-left-content">
                        <i class="fas fa-bolt me-1"></i> EXCLUSIVE
                    </span>
                </div>

                <!-- Modal Header -->
                <div class="modal-header bg-gradient-danger text-white border-0 position-relative" style="padding: 1.5rem;">
                    <h5 class="modal-title fw-bold w-100 text-center mb-0" id="couponModalLabel">EXCLUSIVE DISCOUNT</h5>
                    <button type="button" class="btn-close btn-close-white position-absolute" style="top: 1rem; right: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body text-center py-4 px-5">
                    <!-- Animated Logo -->
                    <div class="mb-4">
                        <div class="logo-container mx-auto">
                            <img src="" alt="Brand Logo" id="storeImage" class="img-fluid rounded-circle shadow border-4 border-white bounce animation" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div>

                    <!-- Title with decorative elements -->
                    <div class="position-relative mb-4">
                        <div class="divider-line"></div>
                        <h5 class="fw-bold text-dark mb-0 px-3 d-inline-block bg-white position-relative" id="couponName"></h5>
                        <div class="divider-line"></div>
                    </div>

                    <!-- Coupon Code Section -->
                    <div class="coupon-container bg-light rounded-3 p-2 mb-4 position-relative">
                        <div class="coupon-cutout top"></div>
                        <div class="coupon-cutout bottom"></div>

                        <p class="small text-muted mb-2">
                            <i class="fas fa-tag me-1"></i> YOUR EXCLUSIVE CODE
                        </p>
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                            <span id="couponCode" class="fw-bold fs-3 text-dark coupon-code-text text-nowrap"></span>
                            <button class="btn btn-sm btn-danger rounded-circle copy-btn" onclick="copyToClipboard()" data-bs-toggle="tooltip" title="Copy Code">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                            <i class="fas fa-check-circle me-1"></i> Copied to clipboard!
                        </p>
                    </div>

                    <!-- Expiry Timer -->
                    <div class="bg-danger-soft rounded-3 p-2 mb-4">
                        <p class="small text-danger mb-1 fw-bold">
                            <i class="fas fa-clock me-1"></i> OFFER EXPIRES IN:
                            <span class="countdown-timer">15:00</span>
                        </p>
                    </div>

                    <!-- Instructions -->
                    <p class="small text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i> Apply this code at checkout on
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark"></a>
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-4 justify-content-center border-0 pt-0">
                    <a href="" id="storeLink" class="btn btn-danger btn-lg rounded-pill px-4 shadow-sm store-link-btn">
                        <i class="fas fa-external-link-alt me-2"></i> REDEEM NOW
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('scripts')
        <script>
            let couponModal = null;

            document.addEventListener('DOMContentLoaded', function() {
                couponModal = new bootstrap.Modal(document.getElementById('couponModal'));

                // Start countdown timer
                startCountdown();

                // Add shine animation to buttons
                const shineElements = document.querySelectorAll('.btn-shine');
                shineElements.forEach(shine => {
                    shine.style.animation = 'shine 2s infinite';
                });
            });

            function handleRevealCode(event, couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
                event.preventDefault();

                // Update modal content
                document.getElementById('couponCode').textContent = couponCode;
                document.getElementById('couponName').textContent = couponName;
                document.getElementById('storeImage').src = storeImage;
                document.getElementById('couponUrl').href = destinationUrl;
                document.getElementById('couponUrl').textContent = storeName;
                document.getElementById('storeLink').href = destinationUrl;

                // Update click count
                updateClickCount(couponId);

                // Show modal
                if (couponModal) {
                    couponModal.show();
                    // Reset countdown when modal is shown
                    startCountdown();
                    // Redirect to destination_url after showing modal
                    setTimeout(function() {
                        window.open(destinationUrl, '_blank');
                    }, 500); // Adjust delay as needed
                } else {
                    window.open(destinationUrl, '_blank');
                }
            }

            function updateClickCount(couponId) {
                fetch('{{ route("update.clicks") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ coupon_id: couponId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const usedCountElement = document.getElementById('usedCount' + couponId);
                        if (usedCountElement) {
                            usedCountElement.innerHTML = `<i class="fas fa-users me-1"></i> ${data.clicks}`;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            function copyToClipboard() {
                const code = document.getElementById('couponCode').textContent;
                navigator.clipboard.writeText(code).then(() => {
                    const copyMessage = document.getElementById('copyMessage');
                    copyMessage.style.display = 'block';
                    setTimeout(() => {
                        copyMessage.style.display = 'none';
                    }, 3000);
                });
            }

            function startCountdown() {
                let timeLeft = 15 * 60; // 15 minutes in seconds
                const countdownElement = document.querySelector('.countdown-timer');

                const timer = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        countdownElement.textContent = "00:00";
                        return;
                    }

                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;

                    countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    timeLeft--;
                }, 1000);
            }

            function scrollToCoupons() {
                document.querySelector('.filter-section').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        </script>
    @endpush
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/store-detail.css') }}">
    @endpush
