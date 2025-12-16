@extends('layouts.master')

@section('title', 'Latest Coupon & Shopping Tips Blog ' . date("Y") . ' | ' . config('app.name'))
@section('description', 'Explore our amazing blogs and offers. Find the best products and services in one place.')
@section('keywords', 'blogs, offers, products, services')
@section('author', 'John Doe')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
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
            <div class="blog-card h-100">
                <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="text-decoration-none">
                    <div class="position-relative overflow-hidden">
                        <img
                            src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                            alt="{{ $blog->name }}"
                            class="card-img-top"
                            loading="lazy"
                            onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                        >
                        <span class="date-badge">
                            {{ $blog->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->name }}</h5>
                        <p class="card-text">
                            {{ Str::limit(strip_tags($blog->description), 100, '...') }}
                        </p>
                        <div class="author-info mt-auto">
                            <div class="author-avatar">
                                {{ substr($blog->user->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="author-name">{{ $blog->user->name ?? 'Admin' }}</span>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animation to header stats
        const stats = document.querySelectorAll('.stat-number');

        stats.forEach(stat => {
            const currentText = stat.textContent;
            const target = parseInt(currentText.replace('+', ''));
            
            if (isNaN(target)) return;

            let current = 0;
            const increment = target / 30;
            const duration = 1500;
            const steps = 30;
            const stepDuration = duration / steps;

            const updateStat = () => {
                if (current < target) {
                    current += increment;
                    stat.textContent = Math.ceil(current) + '+';
                    setTimeout(updateStat, stepDuration);
                } else {
                    stat.textContent = currentText;
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
            }, {
                threshold: 0.5
            });

            observer.observe(stat);
        });

        // Intersection Observer for blog cards
        if ('IntersectionObserver' in window) {
            const blogCards = document.querySelectorAll('.blog-card');
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, {
                threshold: 0.1
            });

            blogCards.forEach(card => {
                cardObserver.observe(card);
            });
        }

        // Add hover effect to blog cards
        const blogCards = document.querySelectorAll('.blog-card');
        blogCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });

        // Image error handling
        const blogImages = document.querySelectorAll('.card-img-top');
        blogImages.forEach(img => {
            img.addEventListener('error', function() {
                this.src = '{{ asset("assets/img/no-image-found.png") }}';
            });
        });
    });
</script>
@endpush