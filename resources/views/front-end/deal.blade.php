@extends('layouts.master')

@section('title', __('deal.meta_title', ['app' => config('app.name')]))
@section('description', __('deal.meta_description'))
@section('keywords', __('deal.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/deal.css') }}">
@endpush

@section('content')
<main class="container py-4">
    <!-- Page Header -->
    <div class="deals-header">
        <div class="container">
            <h1>{{ __('deal.header_title') }}</h1>
            <p class="lead">{{ __('deal.header_subtitle') }}</p>
        </div>
    </div>

    <!-- Category Filters -->
    <div class="deal-categories text-center">
        <h5 class="mb-3">{{ __('deal.shop_by_category') }}</h5>
        <div>
            <span class="category-badge active">{{ __('deal.all_deals') }}</span>
            <span class="category-badge">{{ __('deal.fashion') }}</span>
            <span class="category-badge">{{ __('deal.electronics') }}</span>
            <span class="category-badge">{{ __('deal.home_garden') }}</span>
            <span class="category-badge">{{ __('deal.travel') }}</span>
            <span class="category-badge">{{ __('deal.food_drink') }}</span>
        </div>
    </div>

    <!-- Deal List -->
    <div class="row">
        @foreach ($coupons as $coupon)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="deal-card h-100" data-id="{{ $coupon->id }}">
                @if($coupon->authentication == 'feature')
                <div class="deal-badge">{{ __('deal.hot_deal_badge') }}</div>
                @endif

                <div class="deal-image-container">
                    @if ($coupon->stores->image)
                    <img src="{{ $coupon->stores->image_url }}" 
                         class="deal-image" 
                         alt="{{ $coupon->stores->name }}" 
                         loading="lazy"
                         onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <i class="fas fa-store fa-3x text-primary"></i>
                    </div>
                    @endif
                </div>

                <div class="deal-content">
                    <h3 class="deal-title">{{ $coupon->name }}</h3>
                    <p class="deal-description">{{ $coupon->description }}</p>

                    <div class="deal-meta">
                        <div class="deal-expiry">
                            <i class="far fa-clock"></i> 
                            {{ __('deal.expires') }} {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                        </div>
                        <div class="deal-usage">
                            <i class="fas fa-users"></i> {{ $coupon->clicks }}
                        </div>
                    </div>

                    <a href="{{ $coupon->stores->destination_url }}" 
                       target="_blank" 
                       class="view-deal-btn" 
                       onclick="updateClickCount({{ $coupon->id }})">
                       {{ __('deal.view_deal') }}
                    </a>

                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->stores->slug)]) }}" 
                       class="more-offers-btn">
                      {{ __('deal.more_offers') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $coupons->links('pagination::bootstrap-5') }}
    </div>
</main>
@endsection

@push('scripts')
<script>
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
                const usedCountElement = document.querySelector(`.deal-card[data-id="${couponId}"] .deal-usage`);
                if (usedCountElement) {
                    usedCountElement.innerHTML = `<i class="fas fa-users me-1"></i> ${data.clicks}`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Category filter functionality
    document.querySelectorAll('.category-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelector('.category-badge.active').classList.remove('active');
            this.classList.add('active');
            // Here you would typically filter deals by category
            // For now we'll just simulate it
            console.log('Filtering by:', this.textContent);
        });
    });

    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const dealCards = document.querySelectorAll('.deal-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.1
        });

        dealCards.forEach(card => {
            observer.observe(card);
        });
    }
</script>
@endpush