@extends('layouts.master')

@section('title')
  @if ($blog->title)
      {{ $blog->title }}
  @else
        {{ $blog->name }} - {{ config('app.name') }} - {{ date('Y') }}
  @endif
@endsection

@section('description')
  @if ($blog->description)
    {{ $blog->description }}
  @else
    {{ __('blog-detail.meta_description_fallback', [
        'name' => $blog->name,
        'app' => config('app.name'),
        'category' => $blog->category->name ?? __('blog-detail.default_category')
    ]) }}
  @endif
@endsection

@section('keywords')
    @if ($blog->keywords)
        {{ $blog->keywords }}
    @else
        {{ $blog->name }}, {{ $blog->category->name ?? '' }}, blog, articles, insights, tips, trends, {{ config('app.name') }}
    @endif
@endsection

@section('author', $blog->author ?? __('blog-detail.unknown_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/blog-detail.css') }}">
@endpush

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>{{ __('home') }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category', ['slug' => Str::slug($blog->category->slug)]) }}" class="text-decoration-none">
                        <i class="fas fa-folder-open me-1"></i> {{ $blog->category->name }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="text-decoration-none">
                        <i class="fas fa-blog me-1"></i> {{ __('blogs') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $blog->name }}
                </li>
            </ol>
        </nav>

        <!-- Blog Detail -->
        <div class="row">
            <div class="col-12 col-lg-8">
                <article class="blog-main-card">
                    <div class="blog-image-container">
                        <img src="{{ $blog->image_url }}"
                             alt="{{ $blog->name }}"
                             class="blog-image"
                             loading="lazy"
                             onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                        @if($blog->category)
                        <span class="category-badge">
                            {{ $blog->category->name }}
                        </span>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h1 class="blog-title">{{ $blog->name }}</h1>
                        
                        <div class="blog-meta">
                            <span class="meta-badge">
                                <i class="far fa-calendar-alt"></i>
                                {{ $blog->created_at->format('M d, Y') }}
                            </span>
                            <span class="meta-badge author">
                                <i class="fas fa-user"></i>
                                {{ $blog->user->name ?? __('blog-detail.unknown_author') }}
                            </span>
                        </div>

                        <div class="blog-body">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-lg-4">
                <!-- Related Stores (commented out, but kept for future use) -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-store"></i>{{ __('blog-detail.related_stores') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @forelse ($relatedstores as $store)
                            <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" 
                               class="text-decoration-none">
                                <div class="related-item">
                                    <img src="{{ $store->image_url }}"
                                         alt="{{ $store->name }}"
                                         class="item-image"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                    <div class="item-content">
                                        <div class="item-title">{{ Str::limit($store->name, 40) }}</div>
                                        <div class="item-meta">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $store->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="no-items">
                                <i class="fas fa-store-slash"></i>
                                {{ __('blog-detail.no_related_stores') }}
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Related Blogs -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-blog"></i>{{ __('blog-detail.related_blogs') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @forelse ($relatedBlogs as $relatedBlog)
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($relatedBlog->slug)]) }}" 
                               class="text-decoration-none">
                                <div class="related-item">
                                    <img src="{{ $relatedBlog->image_url }}"
                                         alt="{{ $relatedBlog->name }}"x
                                         class="item-image"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                    <div class="item-content">
                                        <div class="item-title">{{ Str::limit($relatedBlog->name, 40) }}</div>
                                        <div class="item-meta">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $relatedBlog->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="no-items">
                                <i class="fas fa-file-alt"></i>
                                {{ __('blog-detail.no_related_blogs') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image error handling
    document.querySelectorAll('.blog-image, .item-image').forEach(img => {
        img.addEventListener('error', function() {
            this.src = '{{ asset("assets/img/no-image-found.png") }}';
        });
    });

    // Add smooth scroll to headings
    document.querySelectorAll('.blog-body h2, .blog-body h3, .blog-body h4').forEach(heading => {
        heading.style.cursor = 'pointer';
        heading.addEventListener('click', function() {
            this.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const blogCard = document.querySelector('.blog-main-card');
        const sidebarCards = document.querySelectorAll('.sidebar-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.1
        });

        if (blogCard) observer.observe(blogCard);
        sidebarCards.forEach(card => observer.observe(card));
    }

    // Add page load animation
    document.body.style.opacity = '0';
    window.requestAnimationFrame(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    });

    // Add reading progress indicator (optional enhancement)
    const readingProgress = document.createElement('div');
    readingProgress.style.position = 'fixed';
    readingProgress.style.top = '0';
    readingProgress.style.left = '0';
    readingProgress.style.height = '3px';
    readingProgress.style.background = 'var(--primary-gradient)';
    readingProgress.style.width = '0%';
    readingProgress.style.zIndex = '9999';
    readingProgress.style.transition = 'width 0.3s ease';
    document.body.appendChild(readingProgress);

    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        readingProgress.style.width = `${scrolled}%`;
    });
});
</script>
@endpush