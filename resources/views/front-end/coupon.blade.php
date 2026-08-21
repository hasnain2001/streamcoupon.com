@extends('layouts.master')

@section('title', __('coupon.meta_title'))
@section('description', __('coupon.meta_description'))
@section('keywords', __('coupon.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/coupon.css') }}">
@endpush

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container">
        <h1 class="page-title">{{ __('coupon.page_title') }}</h1>
        <p class="page-subtitle">{{ __('coupon.page_subtitle') }}</p>
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
                                    @if ($coupon->stores->image_url)
                                        <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->stores->slug)]) }}"
                                           target="_blank">
                                            <img src="{{ $coupon->stores->image_url }}"
                                                class="store-logo"
                                                alt="{{ $coupon->stores->name }} Logo"
                                                loading="lazy">
                                        </a>
                                    @else
                                        <i class="fas fa-store fa-lg text-primary"></i>
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
                                        <i class="far fa-clock text-primary"></i>
                                        <span>{{ __('coupon.expires') }} {{ \Carbon\Carbon::parse($coupon->ending_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-users text-primary"></i>
                                        <span>{{ __('coupon.used') }} {{ $coupon->clicks }} {{ __('coupon.times') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-3">
                                @if ($coupon->code)
                                    <button class="get-code-btn"
                                            onclick="handleRevealCode(
                                                event,
                                                {{ $coupon->id }},
                                                '{{ $coupon->code }}',
                                                '{{ $coupon->name }}',
                                                '{{ $coupon->stores->image_url }}',
                                                '{{ route('store.detail', ['slug' => Str::slug($coupon->stores->slug)]) }}',
                                                '{{ $coupon->stores->name }}'
                                            )">
                                        <i class="fas fa-tag me-2"></i>{{ __('coupon.get_code') }}
                                    </button>
                                @else
                                    <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->stores->slug)]) }}"
                                       target="_blank"
                                       class="deal-btn"
                                       onclick="updateClickCount({{ $coupon->id }})">
                                        <i class="fas fa-bolt me-2"></i>{{ __('coupon.view_deal') }}
                                    </a>
                                @endif

                                <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->stores->slug)]) }}"
                                   class="store-btn"
                                   target="_blank">
                                    <i class="fas fa-store me-2"></i>{{ __('coupon.more_offers') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                    <h4>{{ __('coupon.no_coupons_found') }}</h4>
                    <p class="text-muted">{{ __('coupon.no_coupons_message') }}</p>
                    <a href="{{ route('stores') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-store me-2"></i>{{ __('stores') }}
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($coupons->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="{{ __('coupon.pagination_label') }}">
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
                    <span class="badge bg-success text-white px-3 py-2 shadow-sm">
                        <i class="fas fa-bolt me-1"></i> {{ __('coupon.modal_badge') }}
                    </span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('coupon.close') }}"></button>
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
                        <i class="fas fa-tag me-1 text-primary"></i> {{ __('coupon.your_coupon_code') }}
                    </p>
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                        <span id="couponCode" class="fw-bold"></span>
                        <button class="btn-copy" onclick="copyToClipboard()">
                            <i class="fas fa-copy me-2"></i>{{ __('coupon.copy_button') }}
                        </button>
                    </div>
                    <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                        <i class="fas fa-check-circle me-1"></i> {{ __('coupon.copied_message') }}
                    </p>
                </div>

                <!-- Instructions -->
                <p class="small text-muted mb-0">
                    <i class="fas fa-info-circle me-1 text-primary"></i> {{ __('coupon.use_code_at_checkout') }}
                    <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-primary"></a>
                </p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light justify-content-center">
                <a href="" id="storeLink" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill">
                    <i class="fas fa-external-link-alt me-2"></i> {{ __('coupon.go_to_store') }}
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

        // If no store image, show a default icon or hide the img
        document.getElementById('storeImage').src = storeImage || '{{ asset('assets/img/no-image-found.png') }}';
        document.getElementById('couponCode').textContent = couponCode || 'N/A';
        document.getElementById('couponName').textContent = couponName || '{{ __('coupon.default_coupon_name') }}';
        document.getElementById('couponUrl').href = destinationUrl || '#';
        document.getElementById('couponUrl').textContent = storeName || '{{ __('coupon.default_store_name') }}';
        document.getElementById('storeLink').href = destinationUrl || '#';

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