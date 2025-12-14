@extends('layouts.master')

@section('title', 'Latest Coupon & Shopping Tips Blog ' . date("Y") . ' | ' . config('app.name'))
@section('description', 'Explore our amazing blogs and offers. Find the best products and services in one place.')
@section('keywords', 'blogs, offers, products, services')
@section('author', 'John Doe')

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

    /* Page Header Styles */
    .page-header {
        background: var(--gradient-teal);
        padding: 5rem 0 4rem;
        margin-bottom: 3rem;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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

    .page-header-content {
        position: relative;
        z-index: 2;
    }

    .page-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .page-header .lead {
        font-size: 1.3rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto 2rem;
        font-weight: 300;
    }

    .header-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        color: var(--gold-light);
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @keyframes float {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(-100px) translateY(-100px); }
    }

    /* Blog Card Styles */
    .card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .hover-zoom:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .hover-zoom:hover .card-img-top {
        transform: scale(1.05);
    }

    .badge.bg-primary {
        background: var(--gradient-gold) !important;
        color: #000;
        font-weight: 600;
        border: none;
    }

    .card-title {
        color: var(--dark-teal);
        font-weight: 700;
        line-height: 1.4;
    }

    .card-text {
        color: #666;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 3rem 0 2rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
        }

        .page-header .lead {
            font-size: 1.1rem;
        }

        .header-stats {
            gap: 2rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 2.5rem 0 1.5rem;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .header-stats {
            gap: 1.5rem;
        }

        .stat-item {
            flex: 0 0 calc(50% - 1rem);
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="page-header-content">
            <h1>@lang('message.Our Blog')</h1>
            <p class="lead">@lang('message.Discover the latest insights, tips, and news.') on {{ config('app.name') }}</p>

            <!-- Blog Statistics -->
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $blogs->total() }}+</span>
                    <span class="stat-label">Articles Published</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $uniqueAuthors ?? '10+' }}</span>
                    <span class="stat-label">Expert Writers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $currentYear = date('Y') }}</span>
                    <span class="stat-label">Latest Updates</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Content -->
<div class="container py-4">
    <div class="row g-4">
        @foreach ($blogs as $blog)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm overflow-hidden rounded-3 hover-zoom">
                @php
                    $language = $blog->language ? $blog->language->code : 'en';
                    $slug = Str::slug($blog->slug);

                    if ($language === 'en') {
                        $blogurl = route('blog.detail', ['slug' => $slug]);
                    } else {
                        $blogurl = route('blog-details.withLang', ['lang' => $language, 'slug' => $slug]);
                    }
                @endphp

                <a href="{{ $blogurl }}" class="text-decoration-none text-dark">
                    <div class="position-relative">
                        <img
                            src="{{ $blog->image ? asset('storage/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            alt="{{ $blog->name }}"
                            class="card-img-top object-fit-cover"
                            loading="lazy"
                            style="height: 200px; width: 100%;"
                        >
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <span class="badge bg-primary bg-opacity-90 text-dark">
                                {{ $blog->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $blog->name }}</h5>
                        <p class="card-text text-muted mb-4">
                            {{ Str::limit(strip_tags($blog->description), 100, '...') }}
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name ?? 'Unknown') }}&background=random"
                                    alt="Author"
                                    class="rounded-circle"
                                    width="30"
                                >
                            </div>
                            <small class="text-secondary">{{ $blog->user->name ?? 'Unknown' }}</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if ($blogs->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animation to header stats
        const stats = document.querySelectorAll('.stat-number');

        stats.forEach(stat => {
            const target = parseInt(stat.textContent);
            let current = 0;
            const increment = target / 50;

            const updateStat = () => {
                if (current < target) {
                    current += increment;
                    stat.textContent = Math.ceil(current) + '+';
                    setTimeout(updateStat, 30);
                } else {
                    stat.textContent = target + '+';
                }
            };

            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateStat();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(stat);
        });
    });
</script>
@endpush
