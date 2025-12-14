@extends('layouts.master')
@section('title', 'Coupon Codes - Find the latest coupon codes and deals for your favorite stores')
@section('description', 'Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.')
@section('keywords', 'coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping')
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

    .page-header {
        background: var(--gradient-teal);
        padding: 4rem 0;
        margin-bottom: 2rem;
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
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    .page-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        position: relative;
        z-index: 2;
    }

    .page-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .coupon-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        border-left: 4px solid transparent;
    }

    .coupon-card::before {
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

    .coupon-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-left-color: var(--gold-primary);
    }

    .coupon-card:hover::before {
        transform: scaleX(1);
    }

    .store-logo-container {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--light-gradient);
        flex-shrink: 0;
        transition: all 0.3s ease;
        border: 2px solid var(--light-gradient);
        overflow: hidden;
    }

    .coupon-card:hover .store-logo-container {
        background: var(--gradient-gold);
        transform: scale(1.1);
    }

    .store-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .coupon-card:hover .store-logo {
        filter: brightness(0) invert(1);
    }

    .coupon-badge {
        background: var(--gradient-gold);
        color: #2c3e50;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 8px;
        box-shadow: 0 2px 8px rgba(214, 167, 81, 0.3);
    }

    .coupon-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark-teal);
        margin-bottom: 8px;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .coupon-card:hover .coupon-name {
        color: var(--gold-dark);
    }

    .coupon-description {
        font-size: 0.9rem;
        color: var(--dark-teal-light);
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .coupon-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 15px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: var(--dark-teal-light);
    }

    .meta-item i {
        color: var(--gold-primary);
        font-size: 0.9rem;
    }

    .get-code-btn {
        background: var(--gradient-gold);
        color: #2c3e50;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(214, 167, 81, 0.3);
        width: 100%;
        margin-bottom: 8px;
        position: relative;
        overflow: hidden;
    }

    .get-code-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .get-code-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(214, 167, 81, 0.5);
        color: #2c3e50;
    }

    .get-code-btn:hover::before {
        left: 100%;
    }

    .deal-btn {
        background: var(--gradient-teal);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(20, 95, 89, 0.3);
        width: 100%;
        margin-bottom: 8px;
    }

    .deal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(20, 95, 89, 0.5);
        color: white;
    }

    .store-btn {
        background: transparent;
        color: var(--dark-teal);
        border: 2px solid var(--dark-teal);
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .store-btn:hover {
        background: var(--dark-teal);
        color: white;
        transform: translateY(-1px);
    }

    .no-coupons-card {
        background: linear-gradient(135deg, #fff9e6 0%, #fff3d9 100%);
        border: 2px dashed var(--gold-primary);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
    }

    .no-coupons-icon {
        font-size: 3rem;
        color: var(--gold-primary);
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

    /* Modal Styles */
    .coupon-modal .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .coupon-modal .modal-header {
        background: var(--gradient-teal);
        color: white;
        border-bottom: none;
        padding: 1.5rem 2rem;
        position: relative;
    }

    .coupon-modal .modal-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--gradient-gold);
        opacity: 0.1;
    }

    .coupon-modal .modal-body {
        padding: 2.5rem;
        text-align: center;
    }

    .coupon-modal .store-logo-modal {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin: 0 auto 1.5rem;
        border-radius: 12px;
        background: var(--light-gradient);
        padding: 12px;
        border: 2px solid var(--light-gradient);
    }

    .coupon-modal .coupon-code-display {
        background: var(--light-gradient);
        padding: 1.5rem;
        border-radius: 12px;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-teal);
        margin: 1.5rem 0;
        letter-spacing: 2px;
        border: 2px dashed var(--gold-primary);
    }

    .coupon-modal .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .coupon-modal .btn-close:hover {
        opacity: 1;
    }

    .coupon-modal .btn-copy {
        background: var(--gradient-gold);
        color: #2c3e50;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(214, 167, 81, 0.3);
    }

    .coupon-modal .btn-copy:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(214, 167, 81, 0.5);
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .page-header {
            padding: 2.5rem 1rem;
        }

        .store-logo-container {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
        }

        .coupon-name {
            font-size: 1rem;
        }

        .get-code-btn,
        .deal-btn {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .coupon-modal .modal-body {
            padding: 2rem 1.5rem;
        }

        .coupon-modal .coupon-code-display {
            font-size: 1.25rem;
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .coupon-meta {
            flex-direction: column;
            gap: 8px;
        }

        .store-logo-container {
            width: 50px;
            height: 50px;
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .coupon-card,
        .get-code-btn,
        .deal-btn,
        .store-btn {
            transition: none;
        }

        .coupon-card:hover {
            transform: none;
        }

        .page-header::before {
            animation: none;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container">
        <h1 class="page-title">@lang('message.Exclusive Coupon Codes')</h1>
        <p class="page-subtitle">@lang('message.Save money with our verified discount codes for your favorite online stores')</p>
    </div>
</header>

<!-- Main Content -->
<main class="container py-4">
    <!-- Coupon List -->
    <div class="row">
        @forelse ($coupons as $coupon)
        <div class="col-lg-6 mb-4">
            <div class="coupon-card card h-100">
                <div class="card-body p-4">
                    <div class="row align-items-center h-100">
                        <!-- Store Logo -->
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="store-logo-container mx-auto">
                                @if ($coupon->store->image)
                                <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}">
                                    <img src="{{ asset('storage/stores/' . $coupon->store->image) }}"
                                         class="store-logo"
                                         alt="{{ $coupon->store->name }} Logo"
                                         loading="lazy">
                                </a>
                                @else
                                <i class="fas fa-store fa-lg text-muted"></i>
                                @endif
                            </div>
                        </div>

                        <!-- Coupon Details -->
                        <div class="col-md-6">
                            @if ($coupon->authentication && $coupon->authentication !== 'No Auth')
                            <span class="coupon-badge">
                                <i class="fas fa-shield-alt me-1"></i> {{ $coupon->authentication }}
                            </span>
                            @endif

                            <h3 class="coupon-name">{{ $coupon->name }}</h3>
                            <p class="coupon-description">{{ $coupon->description }}</p>

                            <div class="coupon-meta">
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>@lang('message.Expires') {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>@lang('welcome.used') {{ $coupon->clicks }} times</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-md-3">
                            @if ($coupon->code)
                            <button class="get-code-btn"
                                    onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('storage/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">
                                <i class="fas fa-tag me-2"></i>@lang('welcome.Get Code')
                            </button>
                            @else
                            <a href="{{ $coupon->store->destination_url }}"
                               target="_blank"
                               class="deal-btn"
                               onclick="updateClickCount({{ $coupon->id }})">
                                <i class="fas fa-bolt me-2"></i>@lang('welcome.View Deal')
                            </a>
                            @endif
                            <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}"
                               class="store-btn">
                                <i class="fas fa-store me-2"></i>@lang('welcome.More Offers')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="no-coupons-card">
                <div class="no-coupons-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <h4 class="text-dark mb-3">No Coupons Available</h4>
                <p class="text-muted mb-0">
                    @lang('message.No coupons found. Please check back later for new deals.')
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($coupons->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Coupons pagination">
            <ul class="pagination pagination-custom">
                {{ $coupons->links('pagination::bootstrap-5') }}
            </ul>
        </nav>
    </div>
    @endif
</main>

<!-- Coupon Code Modal -->
<div class="modal fade coupon-modal" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header position-relative">
                <div class="position-absolute top-0 start-50 translate-middle mt-n4">
                    <span class="badge bg-warning text-dark px-3 py-2 shadow-sm">
                        <i class="fas fa-bolt me-1"></i> EXCLUSIVE OFFER
                    </span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Store Logo -->
                <div class="mb-4">
                    <img src="" alt="Store Logo" id="storeImage" class="store-logo-modal">
                </div>

                <!-- Coupon Title -->
                <h5 class="fw-bold text-dark mb-3" id="couponName"></h5>

                <!-- Coupon Code Section -->
                <div class="coupon-code-display">
                    <p class="small text-muted mb-2">
                        <i class="fas fa-tag me-1"></i> YOUR COUPON CODE
                    </p>
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                        <span id="couponCode" class="fw-bold"></span>
                        <button class="btn-copy" onclick="copyToClipboard()">
                            <i class="fas fa-copy me-2"></i>Copy
                        </button>
                    </div>
                    <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                        <i class="fas fa-check-circle me-1"></i> Copied to clipboard!
                    </p>
                </div>

                <!-- Instructions -->
                <p class="small text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i> Use this code at checkout on
                    <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark"></a>
                </p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light justify-content-center">
                <a href="" id="storeLink" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="fas fa-external-link-alt me-2"></i> Go to Store
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
            // Redirect to destination_url after showing modal
            setTimeout(function() {
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
</script>
@endpush
