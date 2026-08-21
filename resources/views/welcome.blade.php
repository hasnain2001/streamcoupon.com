@extends('layouts.master')

@section('title', __('welcome.meta_title'))
@section('description', __('welcome.meta_description'))

@push('styles')
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- AOS (optional scroll animations) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
@endpush

@section('content')
<!-- ======== HERO SLIDER ======== -->
<section class="py-5" style="background: linear-gradient(135deg, var(--light-gray) 0%, #ffffff 100%);">
    <div class="container">
        <div id="heroSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                @foreach($topblogs as $key => $blog)
                <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $key }}" 
                        class="{{ $key == 0 ? 'active' : '' }}" 
                        style="background-color: var(--primary); width: 14px; height: 14px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                </button>
                @endforeach
            </div>

            <div class="carousel-inner rounded-4 overflow-hidden shadow-lg">
                @foreach($topblogs as $key => $blog)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <!-- Mobile -->
                    <div class="d-block d-lg-none position-relative">
                        <div class="position-relative">
                            <div class="category-badge">{{ __('welcome.featured') }}</div>
                            <img src="{{ $blog->image_url }}" class="img-fluid w-100" alt="{{ $blog->name }}" style="height: 280px; object-fit: cover;">
                        </div>
                        <div class="p-4 bg-white">
                            <span class="trending-badge mb-2 d-inline-block" style="background: var(--accent-gradient); color: white; padding: 4px 16px; border-radius: 30px; font-size:0.75rem; font-weight:600;">@lang('welcome.trending')</span>
                            <h2 class="h4 fw-bold mt-2">{{ Str::limit($blog->name, 60) }}</h2>
                            <p class="text-muted">{{ Str::limit(strip_tags($blog->description), 120) }}</p>
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <span class="read-time"><i class="far fa-clock me-1"></i> {{ rand(3, 8) }} {{ __('welcome.min_read') }}</span>
                                <span class="read-time"><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" 
                               class="btn btn-lg w-100 fw-semibold" 
                               style="background: var(--primary-gradient); color: white; border: none; border-radius: 50px;">
                                {{ __('welcome.read_full_article') }} <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Desktop -->
                    <div class="d-none d-lg-block">
                        <div class="row g-0 align-items-stretch" style="min-height: 400px;">
                            <div class="col-lg-7 d-flex align-items-center hero-slide-content p-5 text-white" style="background: var(--primary-gradient); border-radius: 20px 0 0 20px;">
                                <div>
                                    <span class="badge bg-white text-primary mb-3 px-4 py-2 rounded-pill fw-semibold">{{ __('welcome.trending') }}</span>
                                    <h1 class="display-5 fw-bold mb-4">{{ $blog->name }}</h1>
                                    <p class="lead opacity-90 mb-4">{{ Str::limit(strip_tags($blog->description), 200) }}</p>
                                    <div class="d-flex gap-3 align-items-center mb-4">
                                        <span><i class="far fa-clock me-1"></i> {{ rand(3, 8) }} {{ __('welcome.min_read') }}</span>
                                        <span><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" 
                                       class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill shadow-sm">
                                        {{ __('welcome.read_full_article') }} <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 position-relative">
                                <div class="category-badge">{{ __('welcome.featured') }}</div>
                                <img src="{{ $blog->image_url }}" class="img-fluid w-100 h-100" alt="{{ $blog->name }}" style="object-fit: cover; border-radius: 0 20px 20px 0;">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev d-none d-lg-flex" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon rounded-circle p-3" style="background: rgba(30,138,136,0.2); backdrop-filter: blur(4px);"></span>
            </button>
            <button class="carousel-control-next d-none d-lg-flex" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon rounded-circle p-3" style="background: rgba(30,138,136,0.2); backdrop-filter: blur(4px);"></span>
            </button>

            <!-- Mobile navigation -->
            <div class="d-flex d-lg-none justify-content-center gap-3 mt-3">
                <button class="btn btn-sm rounded-circle" style="background: var(--primary); color: white; width: 44px; height: 44px;" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-sm rounded-circle" style="background: var(--primary); color: white; width: 44px; height: 44px;" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ======== STORES SECTION (3 per row) ======== -->
<section class="stores-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h1 class="display-5 fw-bold text-gradient mb-3">🛍️ {{ __('welcome.store_title') ?? 'Latest Discount Codes & Promo Codes' }}</h1>
            <p class="lead text-muted">{{ __('welcome.store_description') ?? 'Discover our curated stores offering the best products and services' }}</p>
        </div>

        <div class="position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper storesSwiper">
                <div class="swiper-wrapper pb-4">
                    @foreach ($TopStores as $store)
                    <div class="swiper-slide">
                        <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none text-dark">
                            <div class="card store-card h-100 border-0 shadow-sm overflow-hidden">
                                @if($loop->index < 3)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2" style="font-weight:600; letter-spacing:0.5px; box-shadow:0 4px 12px rgba(220,53,69,0.3);">
                                    🔥 @lang('welcome.trending')
                                </span>
                                @endif

                                <div class="store-image-container p-3">
                                    <div class="ratio ratio-1x1 rounded-circle bg-white shadow-sm p-3 d-flex align-items-center justify-content-center store-image-wrapper">
                                        <img src="{{ $store->image_url }}" class="img-fluid rounded-circle" alt="{{ $store->name }}" loading="lazy" style="object-fit: contain; width: 100%; height: 100%;" onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                    </div>
                                </div>

                                <div class="card-body text-center pt-0">
                                    <h5 class="fw-bold mb-2 text-truncate">{{ $store->name }}</h5>
                                    <div class="d-flex justify-content-center align-items-center gap-2 mb-2 flex-wrap">
                                        <span class="badge bg-success bg-opacity-10 text-white rounded-pill px-3 py-2">
                                            <i class="fas fa-tag me-1"></i> {{ rand(5, 30) }} {{ __('common.deals') }}
                                        </span>
                                        <span class="badge bg-secondary bg-opacity-10 text-white rounded-pill px-3 py-2">
                                            <i class="fas fa-star me-1"></i> {{ rand(4, 5) }}.0
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i> {{ __('common.updated') }} {{ $store->updated_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination position-relative mt-4"></div>
            </div>

            <button class="swiper-button-prev text-dark shadow-sm"></button>
            <button class="swiper-button-next text-dark shadow-sm"></button>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="btn btn-lg px-5 py-3 fw-bold rounded-pill text-white" style="background: var(--primary-gradient); border: none; box-shadow: 0 8px 25px rgba(30,138,136,0.3);">
                {{ __('common.view_all_stores') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ======== FEATURED ARTICLES ======== -->
<section class="container py-5">
    <h2 class="section-title fw-bold" style="color: var(--text-primary);" data-aos="fade-right">{{ __('welcome.featured_articles') }}</h2>

    <div class="row g-4">
        @foreach($topblogs as $blog)
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card article-card h-100 shadow-sm border-0">
                <div class="position-relative overflow-hidden">
                    <span class="category-badge">{{ __('welcome.popular') }}</span>
                    <img src="{{ $blog->image_url }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 220px; object-fit: cover;">
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <small class="text-muted"><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(30,138,136,0.1); color: var(--primary); font-weight:600;">{{ __('welcome.featured') }}</span>
                    </div>
                    <h4 class="card-title fw-bold mb-3" style="color: var(--text-primary);">{{ Str::limit($blog->name, 60) }}</h4>
                    <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <a href="{{ route('blog.detail',['slug' => Str::slug($blog->slug)]) }}" class="btn btn-sm px-4 py-2 fw-semibold rounded-pill" style="background: var(--primary-gradient); color: white; border: none;">
                            @lang('common.read_more') <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                        <small class="text-muted"><i class="far fa-clock me-1"></i> {{ rand(3, 8) }} {{ __('welcome.min_read') }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ======== FASHION SECTION ======== -->
<section class="py-5" style="background: linear-gradient(135deg, #ffffff 0%, var(--light-gray) 100%);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-right">
            <h2 class="section-title fw-bold mb-0" style="color: var(--text-primary);">{{ __('welcome.fashion') }}</h2>
            <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="text-decoration-none fw-semibold" style="color: var(--primary);">
                {{ __('common.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @if($fashionBlogs->first())
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card article-card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 position-relative">
                            <span class="category-badge">{{ __('welcome.trending') }}</span>
                            <img src="{{ $fashionBlogs->first()->image_url }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $fashionBlogs->first()->title }}">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <div class="mb-3">
                                    <span class="badge rounded-pill px-3 py-2 mb-2" style="background: var(--accent-gradient); color: white; font-weight:600;">{{ __('welcome.fashion') }}</span>
                                    <small class="text-muted d-block"><i class="far fa-calendar me-1"></i> {{ $fashionBlogs->first()->created_at->format('M d, Y') }}</small>
                                </div>
                                <h3 class="card-title fw-bold mb-3" style="color: var(--text-primary);">{{ $fashionBlogs->first()->title }}</h3>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit(strip_tags($fashionBlogs->first()->description), 180) }}</p>
                                <a href="{{ route('blog.detail', ['slug' => Str::slug($fashionBlogs->first()->slug)]) }}" class="btn mt-3 px-4 py-2 fw-semibold align-self-start rounded-pill" style="background: var(--primary-gradient); color: white; border: none;">
                                    {{ __('welcome.read_article') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color: var(--text-primary);">{{ __('welcome.more_fashion') }}</h5>
                        <div class="list-group list-group-flush">
                            @foreach($fashionBlogs->skip(1)->take(4) as $index => $blog)
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="list-group-item list-group-item-action border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="popular-number me-3">{{ $index + 1 }}</div>
                                    <div>
                                        <h6 class="fw-semibold mb-1" style="color: var(--text-primary);">{{ Str::limit($blog->title, 45) }}</h6>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i> {{ rand(3, 8) }} {{ __('welcome.min_read') }}</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== GIFT SECTION ======== -->
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-right">
        <h2 class="section-title fw-bold mb-0" style="color: var(--text-primary);">{{ __('welcome.gift_ideas_promo') }}</h2>
        <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="text-decoration-none fw-semibold" style="color: var(--primary);">
            {{ __('common.view_all') }} <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($GiftBlogs as $blog)
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card article-card h-100 border-0 shadow-sm">
                <div class="position-relative overflow-hidden">
                    <img src="{{ $blog->image_url }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 220px; object-fit: cover;">
                    <span class="badge rounded-pill position-absolute top-0 end-0 m-3 px-4 py-2" style="background: var(--secondary); color: white; font-weight:600; box-shadow: 0 4px 12px rgba(106,173,59,0.3);">
                        {{ __('welcome.gift') }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <small class="text-muted"><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(106,173,59,0.1); color: var(--secondary); font-weight:600;">{{ __('welcome.promo_available') }}</span>
                    </div>
                    <h4 class="card-title fw-bold mb-3" style="color: var(--text-primary);">{{ Str::limit($blog->name, 50) }}</h4>
                    <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($blog->description), 90) }}</p>
                    <a href="{{ route('blog.detail',['slug' => Str::slug($blog->slug)]) }}" class="btn btn-sm px-3 py-2 fw-semibold w-100 rounded-pill" style="background: var(--secondary-gradient); color: white; border: none;">
                        {{ __('welcome.view_deals') }} <i class="fas fa-gift ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ======== LATEST ARTICLES & SIDEBAR ======== -->
<section class="py-5" style="background: linear-gradient(135deg, var(--light-gray) 0%, #ffffff 100%);">
    <div class="container">
        <div class="row g-5">
            <!-- Latest Articles -->
            <div class="col-lg-8">
                <h2 class="section-title fw-bold mb-4" style="color: var(--text-primary);" data-aos="fade-right">{{ __('welcome.latest_articles') }}</h2>

                @foreach($latestblogs as $blog)
                <div class="card mb-4 border-0 shadow-sm latest-article" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $blog->image_url }}" class="img-fluid rounded-start h-100 w-100" style="object-fit: cover; min-height: 180px;" alt="{{ $blog->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <small class="text-muted"><i class="far fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(30,138,136,0.1); color: var(--primary); font-weight:600;">{{ __('welcome.new') }}</span>
                                </div>
                                <h5 class="card-title fw-bold mb-3" style="color: var(--text-primary);">{{ $blog->title }}</h5>
                                <p class="card-text text-muted mb-3">{{ Str::limit(strip_tags($blog->description), 120) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="text-decoration-none fw-semibold" style="color: var(--primary);">
                                        {{ __('welcome.read_full_story') }} <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i> {{ rand(3, 8) }} {{ __('welcome.min_read') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Popular Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="card border-0 shadow-sm mb-4" data-aos="fade-left">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4" style="color: var(--text-primary);">
                                <i class="fas fa-fire text-danger me-2"></i> {{ __('welcome.popular_now') }}
                            </h5>
                            <div class="list-group list-group-flush popular-list">
                                @foreach($latestblogs->take(6) as $index => $blog)
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="list-group-item list-group-item-action border-0 px-0 py-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="popular-number">{{ $index + 1 }}</div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-semibold mb-1" style="color: var(--text-primary);">{{ Str::limit($blog->title, 50) }}</h6>
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">{{ $blog->created_at->diffForHumans() }}</small>
                                                <small class="text-primary fw-semibold">{{ rand(100, 999) }} {{ __('welcome.views') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter card -->
                    <div class="card border-0 shadow-sm" style="background: var(--accent-gradient);" data-aos="fade-left" data-aos-delay="100">
                        <div class="card-body p-4 text-center text-white">
                            <div class="display-6 mb-3"><i class="fas fa-envelope-open-text"></i></div>
                            <h5 class="fw-bold mb-3">{{ __('welcome.never_miss_deal') }}</h5>
                            <p class="mb-4 opacity-75">{{ __('welcome.newsletter_text') }}</p>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control border-0 py-3 rounded-start-pill" placeholder="{{ __('enter_email') }}">
                                <button class="btn px-4 py-3 fw-semibold rounded-end-pill" style="background: var(--primary-gradient); color: white; border: none;">
                                    {{ __('subscribe') }}
                                </button>
                            </div>
                            <small class="opacity-75">{{ __('welcome.no_spam') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== NEWSLETTER CTA ======== -->
<section class="container py-5" data-aos="fade-up">
    <div class="cta-card text-center text-white">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold display-6 mb-3">{{ __('welcome.ready_to_save') }}</h2>
                <p class="lead opacity-90 mb-4">{{ __('welcome.newsletter_cta_text') }}</p>
                <a href="#" class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill shadow-lg">
                    {{ __('welcome.explore_all_deals') }} <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/js/welcome.js') }}"></script>
@endpush