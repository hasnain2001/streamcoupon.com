@extends('layouts.master')
@section('title')
    Hot Deals - Limited-time offers & exclusive discounts | {{ config('app.name') }}
@endsection
@section('description')
    Discover today's hottest deals and limited-time offers from your favorite stores. Save big with our exclusive discounts!
@endsection
@section('keywords')
    hot deals, limited-time offers, flash sales, exclusive discounts, online shopping deals
@endsection

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

    /* Header Styles */
     .deals-header {
        background: var(--gradient-teal);
        padding: 4rem 0;
        margin-bottom: 2rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .deals-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }



    /* Category Filters */
    .deal-categories {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .category-badge {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        margin: 0.3rem;
        background: var(--light-gradient);
        border: 2px solid #e9ecef;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--dark-teal);
    }

    .category-badge:hover,
    .category-badge.active {
        background: var(--gradient-gold);
        border-color: var(--gold-primary);
        color: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(214, 167, 81, 0.3);
    }

    /* Deal Cards */
    .deal-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid #f0f0f0;
    }

    .deal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .deal-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--gradient-gold);
        color: #000;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .deal-image-container {
        height: 180px;
        overflow: hidden;
        position: relative;
        background: var(--light-gradient);
    }

    .deal-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .deal-card:hover .deal-image {
        transform: scale(1.05);
    }

    .deal-content {
        padding: 1.5rem;
    }

    .deal-title {
        font-weight: 700;
        color: var(--dark-teal);
        margin-bottom: 0.8rem;
        font-size: 1.2rem;
        line-height: 1.3;
    }

    .deal-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
        line-height: 1.5;
    }

    .deal-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: #777;
    }

    .deal-expiry, .deal-usage {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .deal-expiry i {
        color: #e74c3c;
    }

    .deal-usage i {
        color: var(--gold-primary);
    }

    .view-deal-btn {
        display: block;
        width: 100%;
        background: var(--gradient-teal);
        color: white;
        text-align: center;
        padding: 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 0.8rem;
    }

    .view-deal-btn:hover {
        background: var(--dark-teal-light);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(20, 95, 89, 0.3);
    }

    .more-offers-btn {
        display: block;
        width: 100%;
        background: transparent;
        color: var(--dark-teal);
        text-align: center;
        padding: 0.7rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        border: 2px solid var(--dark-teal);
        transition: all 0.3s ease;
    }

    .more-offers-btn:hover {
        background: var(--dark-teal);
        color: white;
    }

    /* Pagination */
    .pagination {
        margin-top: 3rem;
    }

    .page-link {
        color: var(--dark-teal);
        border: 1px solid #dee2e6;
        padding: 0.5rem 1rem;
    }

    .page-link:hover {
        color: var(--dark-teal-dark);
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        background-color: var(--dark-teal);
        border-color: var(--dark-teal);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .deals-header h1 {
            font-size: 2rem;
        }

        .deals-header .lead {
            font-size: 1rem;
        }

        .category-badge {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }

        .deal-image-container {
            height: 160px;
        }
    }

    @media (max-width: 576px) {
        .deals-header {
            padding: 2rem 0;
        }

        .deals-header h1 {
            font-size: 1.8rem;
        }

        .deal-categories {
            padding: 1rem;
        }

        .deal-content {
            padding: 1.2rem;
        }
    }
</style>
@endpush

@section('content')
<main class="container">
    <!-- Page Header -->
    <div class="deals-header">
        <div class="container">
            <h1>🔥 FLASH DEALS ALERT!</h1>
            <p class="lead">Limited-time offers you won't want to miss - act fast before they're gone!</p>
        </div>
    </div>

    <!-- Category Filters -->
    <div class="deal-categories text-center">
        <h5 class="mb-3">Shop by Category:</h5>
        <div>
            <span class="category-badge active">All Deals</span>
            <span class="category-badge">Fashion</span>
            <span class="category-badge">Electronics</span>
            <span class="category-badge">Home & Garden</span>
            <span class="category-badge">Travel</span>
            <span class="category-badge">Food & Drink</span>
        </div>
    </div>

    <!-- Deal List -->
    <div class="row">
        @foreach ($coupons as $coupon)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="deal-card h-100">
                @if($coupon->authentication == 'feature')
                <div class="deal-badge">@lang('message.HOT DEAL')</div>
                @endif

                <div class="deal-image-container">
                    @if ($coupon->store->image)
                    <img src="{{ asset('storage/stores/' . $coupon->store->image) }}" class="deal-image" alt="{{ $coupon->store->name }}" loading="lazy">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                        <i class="fas fa-store fa-3x text-muted"></i>
                    </div>
                    @endif
                </div>

                <div class="deal-content">
                    <h3 class="deal-title">{{ $coupon->name }}</h3>
                    <p class="deal-description">{{ $coupon->description }}</p>

                    <div class="deal-meta">
                        <div class="deal-expiry">
                            <i class="far fa-clock"></i> @lang('message.Expires') {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d') }}
                        </div>
                        <div class="deal-usage">
                            <i class="fas fa-users"></i> {{ $coupon->clicks }}
                        </div>
                    </div>

                    <a href="{{ $coupon->store->destination_url }}" target="_blank" class="view-deal-btn" onclick="updateClickCount({{ $coupon->id }})">
                       @lang('welcome.View Deal')
                    </a>

                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}" class="more-offers-btn">
                      @lang('welcome.More Offers')
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
</script>
@endpush
