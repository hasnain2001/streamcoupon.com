@extends('layouts.master')

@section('title')
    @if ($store->title)
        {{ $store->title }} - {{ config('app.name') }}
    @else
        {{ __('store-detail.meta_title_fallback', ['store' => $store->name, 'year' => date('Y'), 'app' => config('app.name')]) }}
    @endif
@endsection

@section('description')
    @if ($store->meta_description)
        {{ $store->meta_description }}
    @else
        {{ __('store-detail.meta_description_fallback', ['store' => $store->name, 'app' => config('app.name')]) }}
    @endif
@endsection

@section('keywords')
    @if ($store->meta_keyword)
        {{ $store->meta_keyword }}, {{ $store->name }} discounts, {{ $store->name }} promo codes
    @else
        {{ __('store-detail.meta_keywords_fallback', ['store' => $store->name]) }}
    @endif
@endsection



@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/store-detail.css') }}">
@endpush

@section('content')
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



    <main class="main">

        <!-- ===== BREADCRUMB ===== -->
        <section class="breadcrumb-section" aria-label="Breadcrumb">
            <div class="container-fluid">
                <div class="breadcrumb-wrapper">
                    <nav class="breadcrumb-nav">
                        <div class="breadcrumb-container">
                            <a href="{{ url(app()->getLocale() . '/') }}" class="breadcrumb-item">
                                <span class="breadcrumb-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                        <polyline points="9 22 9 12 15 12 15 22"/>
                                    </svg>
                                </span>
                                <span class="breadcrumb-text">{{ __('home') }}</span>
                            </a>
                            <span class="breadcrumb-separator">›</span>

                            @if(!empty($store->category))
                                <a href="{{ route('category.detail', ['slug' => Str::slug($store->category->slug)]) }}" class="breadcrumb-item">
                                    <span class="breadcrumb-icon">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </span>
                                    <span class="breadcrumb-text">{{ $store->category->name }}</span>
                                </a>
                                <span class="breadcrumb-separator">›</span>
                            @endif

                            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="breadcrumb-item">
                                <span class="breadcrumb-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"/>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                                    </svg>
                                </span>
                                <span class="breadcrumb-text">{{ __('common.stores') }}</span>
                            </a>
                            <span class="breadcrumb-separator">›</span>

                            <div class="breadcrumb-item current" aria-current="page">
                                <span class="breadcrumb-text">{{ $store->name }}</span>
                            </div>
                        </div>
                    </nav>

                    @if(!empty($store->logo))
                        <div class="breadcrumb-store-logo">
                            <img src="{{ $store->logo }}" alt="{{ $store->name }}" class="store-logo" loading="lazy">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- ===== STORE HEADER ===== -->
        <header class="store-header-section">
            <div class="container-fluid">
                <div class="row align-items-center g-2">
                    <div class="col-3 col-sm-2 text-center">
                        <img src="{{ $store->image_url }}" class="store-logo-img" alt="{{ $store->name }}" loading="lazy">
                    </div>
                    <div class="col-9 col-sm-10">
                        <div class="store-info">
                            <h1>{{ __('store-detail.header_title', ['store' => $store->name, 'year' => date('Y')]) }}</h1>
                            <div class="store-rating d-flex align-items-center gap-1">
                                <span class="stars text-warning">⭐⭐⭐⭐⭐</span>
                                <span class="text-muted small">(4.8/5)</span>
                            </div>
                            <p class="store-tagline">{{ $store->description ?? __('store-detail.default_description', ['store' => $store->name, 'year' => date('Y'), 'app' => config('app.name')]) }}</p>
                            <div class="store-stats-badges">
                                <span class="badge bg-light text-dark border"><i class="fas fa-tag me-1"></i>{{ $totalCount }} {{ __('store-detail.total_offers') }}</span>
                                <span class="badge bg-success text-white"><i class="fas fa-code me-1"></i>{{ $codeCount }} {{ __('store-detail.codes') }}</span>
                                <span class="badge bg-info text-white"><i class="fas fa-percent me-1"></i>{{ $dealCount }} {{ __('store-detail.deals') }}</span>
                            </div>
                            <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden btn-sm mt-2" rel="nofollow noopener">
                                <i class="fas fa-external-link-alt me-1"></i>{{ __('store-detail.visit_store') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ===== FILTER BAR (sticky) ===== -->
        <div class="filter-bar" role="tablist">
            <div class="container-fluid">
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}" class="btn {{ !request()->has('sort') ? 'active' : '' }}" role="tab">
                        {{ __('store-detail.all') }} <span class="badge bg-secondary bg-opacity-25 text-dark">{{ $totalCount }}</span>
                    </a>
                    <a href="{{ url()->current() }}?sort=codes" class="btn {{ request('sort') == 'codes' ? 'active' : '' }}" role="tab">
                        {{ __('store-detail.codes') }} <span class="badge bg-secondary bg-opacity-25 text-dark">{{ $codeCount }}</span>
                    </a>
                    <a href="{{ url()->current() }}?sort=deals" class="btn {{ request('sort') == 'deals' ? 'active' : '' }}" role="tab">
                        {{ __('store-detail.deals') }} <span class="badge bg-secondary bg-opacity-25 text-dark">{{ $dealCount }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <section class="store-content-section">
            <div class="container-fluid">
                <div class="row">
                    <!-- Coupons Grid -->
                    <div class="col-lg-9">
                        <div class="coupons-grid-container">
                            @if($coupons->isEmpty())
                                <div class="empty-state text-center py-5">
                                    <div class="empty-icon mb-3">
                                        <i class="fas fa-tag fa-3x text-muted"></i>
                                    </div>
                                    <h2 class="h5 mb-2">{{ __('store-detail.no_coupons_title') }}</h2>
                                    <p class="text-muted small">{{ __('store-detail.no_coupons_text') }}</p>
                                    <a href="{{ route('stores') }}" class="btn btn-golden btn-sm mt-3">{{ __('store-detail.explore_brands') }}</a>
                                </div>
                            @else
                                <div class="row g-2 g-sm-3">
                                    @foreach ($coupons as $coupon)
                                        <div class="col-6 col-md-4 col-xl-3">
                                            <article class="coupon-card" itemscope itemtype="https://schema.org/Offer">
                                                <meta itemprop="availability" content="https://schema.org/InStock" />
                                                <meta itemprop="price" content="0" />
                                                <meta itemprop="priceCurrency" content="USD" />

                                                <div class="coupon-type-badge {{ $coupon->code ? 'badge-code' : '' }}">
                                                    <i class="fas {{ $coupon->code ? 'fa-tag' : 'fa-percent' }} me-1"></i>
                                                    {{ $coupon->code ? __('store-detail.code') : __('store-detail.deal') }}
                                                </div>

                                                @if($coupon->clicks > 50)
                                                    <div class="hot-offer-ribbon"><i class="fas fa-fire me-1"></i>{{ __('store-detail.hot') }}</div>
                                                @endif

                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img src="{{ $store->image_url }}" class="coupon-store-image" alt="{{ $store->name }}" loading="lazy" itemprop="image">
                                                    </div>

                                                    <h3 class="coupon-title" itemprop="name">{{ Str::limit($coupon->name, 50) }}</h3>

                                                    @if($coupon->description)
                                                        <p class="coupon-description" itemprop="description">{{ Str::limit($coupon->description, 60) }}</p>
                                                    @endif

                                                    <div class="coupon-meta">
                                                        <span class="ending-date {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : '' }}">
                                                            <i class="fas fa-clock me-1"></i>{{ __('store-detail.ends') }} {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                                                        </span>
                                                        <span class="used-count"><i class="fas fa-users me-1"></i><span id="usedCount{{ $coupon->id }}">{{ $coupon->clicks }}</span></span>
                                                    </div>

                                                    @if ($coupon->code)
                                                        <button class="btn btn-get-code" onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ $store->image_url }}', '{{ $store->destination_url }}', '{{ $store->name }}')">
                                                            <i class="fas fa-gift me-1"></i>{{ __('store-detail.get_code') }}
                                                        </button>
                                                    @else
                                                        <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-deal" rel="nofollow noopener" onclick="updateClickCount('{{ $coupon->id }}')">
                                                            <i class="fas fa-bolt me-1"></i>{{ __('store-detail.view_deal') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Content / Related Blogs -->
                        @if ($store->content || $relatedblogs->isNotEmpty())
                            <div class="content-section mt-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        @if ($store->content)
                                            <div class="content" itemprop="description">
                                                {!! $store->content !!}
                                            </div>
                                        @elseif ($relatedblogs->isNotEmpty())
                                            <h2 class="h5 fw-bold mb-3">{{ __('store-detail.related_articles') }}</h2>
                                            @foreach ($relatedblogs as $blog)
                                                <article class="blog-item mb-3 pb-3 border-bottom">
                                                    <h3 class="blog-title h5 fw-semibold">{{ $blog->title }}</h3>
                                                    @if($blog->image)
                                                        <img src="{{ $blog->image_url }}" class="blog-img" alt="{{ $blog->title }}" loading="lazy" itemprop="image">
                                                    @endif
                                                    <div class="content">
                                                        {!! $blog->content !!}
                                                    </div>
                                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-link text-primary p-0 mt-1 small">
                                                        {{ __('common.read_more') }} <i class="fas fa-arrow-right ms-1"></i>
                                                    </a>
                                                </article>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar (accordion on mobile, static on desktop) -->
                    <div class="col-lg-3 mt-4 mt-lg-0">
                        <div class="sidebar-accordion accordion" id="sidebarAccordion">
                            <!-- About Store -->
                            <div class="accordion-item border-0 mb-2">
                                <h2 class="accordion-header" id="headingAbout">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">
                                        <i class="fas fa-store me-2"></i> {{ __('store-detail.about_store', ['store' => $store->name]) }}
                                    </button>
                                </h2>
                                <div id="collapseAbout" class="accordion-collapse collapse" aria-labelledby="headingAbout" data-bs-parent="#sidebarAccordion">
                                    <div class="accordion-body">
                                        <div class="text-center mb-3">
                                            <img src="{{ $store->image_url }}" class="rounded-circle" style="width:80px;height:80px;object-fit:contain;border:2px solid var(--medium-gray);" alt="{{ $store->name }}" loading="lazy">
                                        </div>
                                        <p class="small text-muted">{{ $store->about ?? __('store-detail.no_description') }}</p>
                                        <div class="d-grid gap-2">
                                            <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden btn-sm" rel="nofollow noopener"><i class="fas fa-external-link-alt me-1"></i>{{ __('store-detail.visit_store') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Similar Stores -->
                            @if($relatedStores->isNotEmpty())
                                <div class="accordion-item border-0 mb-2">
                                    <h2 class="accordion-header" id="headingSimilar">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSimilar" aria-expanded="false" aria-controls="collapseSimilar">
                                            <i class="fas fa-store-alt me-2"></i> {{ __('store-detail.similar_stores') }}
                                        </button>
                                    </h2>
                                    <div id="collapseSimilar" class="accordion-collapse collapse" aria-labelledby="headingSimilar" data-bs-parent="#sidebarAccordion">
                                        <div class="accordion-body">
                                            @foreach ($relatedStores as $relatedStore)
                                                <a href="{{ route('store.detail', ['slug' => Str::slug($relatedStore->slug)]) }}" class="related-store-item">
                                                    <img src="{{ $relatedStore->image_url }}" class="related-store-image" alt="{{ $relatedStore->name }}" loading="lazy">
                                                    <div>
                                                        <h3 class="fw-semibold mb-0 small">{{ Str::limit($relatedStore->name, 25) }}</h3>
                                                        <small class="text-muted"><i class="fas fa-tag me-1"></i>{{ $relatedStore->coupons()->count() ?? 0 }} {{ __('store-detail.offers') }}</small>
                                                    </div>
                                                    <i class="fas fa-chevron-right ms-auto text-muted"></i>
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

    <!-- ===== STICKY "VISIT STORE" BUTTON (mobile only) ===== -->
    <div class="sticky-visit-store">
        <a href="{{ $store->destination_url }}" target="_blank" class="btn btn-golden" rel="nofollow noopener">
            <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.visit_store') }}
        </a>
    </div>

    <!-- ===== COUPON MODAL ===== -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold w-100 text-center" id="couponModalLabel">{{ __('store-detail.exclusive_discount') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <img src="" alt="Brand Logo" id="storeImage" class="rounded-circle" style="width:80px;height:80px;object-fit:contain;border:2px solid var(--medium-gray);" loading="lazy">
                    </div>
                    <h6 class="fw-bold mb-3" id="couponName"></h6>
                    <div class="bg-light rounded-3 p-3 mb-3">
                        <p class="small text-muted mb-2"><i class="fas fa-tag me-1"></i>{{ __('store-detail.your_exclusive_code') }}</p>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <span id="couponCode" class="fw-bold coupon-code-text"></span>
                            <button class="copy-btn" onclick="copyToClipboard()" aria-label="Copy code"><i class="fas fa-copy"></i></button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mt-2" style="display:none;"><i class="fas fa-check-circle me-1"></i>{{ __('store-detail.copied') }}</p>
                    </div>
                    <p class="small text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i>{{ __('store-detail.apply_code') }}
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark" target="_blank" rel="nofollow noopener"></a>
                    </p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <a href="" id="storeLink" class="btn btn-golden btn-lg w-100 rounded-pill" target="_blank" rel="nofollow noopener">
                        <i class="fas fa-external-link-alt me-2"></i>{{ __('store-detail.redeem_now') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll breadcrumb to current item on mobile
        if (window.innerWidth <= 576) {
            const current = document.querySelector('.breadcrumb-item.current');
            if (current) {
                setTimeout(() => {
                    current.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                }, 300);
            }
        }
    });

    // Coupon modal logic
    let couponModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        couponModal = new bootstrap.Modal(document.getElementById('couponModal'));
    });

    function handleRevealCode(event, couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
        event.preventDefault();

        document.getElementById('couponCode').textContent = couponCode;
        document.getElementById('couponName').textContent = couponName;
        document.getElementById('storeImage').src = storeImage;
        document.getElementById('couponUrl').href = destinationUrl;
        document.getElementById('couponUrl').textContent = storeName;
        document.getElementById('storeLink').href = destinationUrl;

        updateClickCount(couponId);

        if (couponModal) {
            couponModal.show();
            setTimeout(() => {
                window.open(destinationUrl, '_blank');
            }, 500);
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
                const el = document.getElementById('usedCount' + couponId);
                if (el) el.textContent = data.clicks;
            }
        })
        .catch(console.error);
    }

    function copyToClipboard() {
        const code = document.getElementById('couponCode').textContent;
        navigator.clipboard.writeText(code).then(() => {
            const msg = document.getElementById('copyMessage');
            msg.style.display = 'block';
            setTimeout(() => { msg.style.display = 'none'; }, 3000);
        });
    }
</script>
@endpush