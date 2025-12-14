@extends('layouts.master')
{{-- 🏷️ Page Title --}}
@section('title')
@if (!empty($category->meta_title))
    {{ ucwords($category->meta_title) }} | {{ date('Y') }} Coupons, Deals & Offers
@elseif (!empty($category->title))
    {{ ucwords($category->title) }} | {{ date('Y') }} Coupons & Discount Codes
@else
    {{ ucwords($category->name) }} | {{ date('Y') }} Deals, Offers & Promo Codes
@endif
@endsection

{{-- 📝 Meta Description --}}
@section('description')
@if (!empty($category->meta_description))
    {{ ucfirst($category->meta_description) }}
@else
    Find the best {{ ucwords($category->name) }} deals and verified discount codes for {{ date('Y') }}.
    Save money with exclusive {{ strtolower($category->name) }} coupons, vouchers, and promo offers updated daily.
@endif
@endsection

{{-- 🔑 Meta Keywords --}}
@section('keywords')
@if (!empty($category->meta_keywords))
    {{ strtolower($category->meta_keywords) }}
@else
    {{ strtolower($category->name) }}, {{ strtolower($category->name) }} coupons,
    {{ strtolower($category->name) }} promo codes, {{ strtolower($category->name) }} vouchers,
    discount offers, {{ strtolower($category->name) }} deals, save money online
@endif
@endsection

@push('styles')
<style>
    /* Category Header Styling */
    .category-header {
        background-size: contain;
        background-position: center;
        height: 250px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-image: url('{{ asset('storage/categories/' . $category->image) }}');
        border-radius: 10px;
        overflow: hidden;
    }

    .category-header .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .category-header h1 {
        font-size: 2.5rem;
        color: #fff;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }

    /* Store Cards Styling */
    .card-list .card {
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
    }

    .card-list .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
        width: 100%;
        height: 120px;
        object-fit: contain;
        padding: 10px;
        background: #fff;
        border-radius: 10px;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-top: 10px;
    }
</style>
@endpush
@section('content')

    <div class="container mt-4">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-light p-2 rounded">
                    <li class="breadcrumb-item">
                        <a href="{{ url(app()->getlocale().'/') }}" class="text-decoration-none text-primary fw-semibold">@lang('nav.home')</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>

            <div class="category-header text-center">
                @if ($category->image)
                    <div class="overlay">
                        <h1 class="text-uppercase">{{ $category->name }}</h1>
                    </div>
                @else
                    <div class="fallback-image d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <p class="text-muted">@lang('message.No logo available')</p>
                    </div>
                @endif
            </div>

            <p class="h5 mt-4">@lang('message.total store') <span class="fw-bold">{{ $stores->count() }}</span></p>

        <section>
            <div class="row card-list g-4 mt-3">
                @forelse ($stores as $store)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                        {{-- @php
                            $language = $store->language ? $store->language->code : 'en';
                            $storeSlug = Str::slug($store->slug);
                            $storeurl = $store->slug
                                ? ($language === 'en'
                                    ? route('store_details', ['slug' => $storeSlug])
                                    : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))
                                : '#';
                        @endphp --}}
                        @php
                        $storeurl = $store->slug
                        ? route('store.detail', ['slug' => Str::slug($store->slug)])
                        : '#';
                        @endphp
                        <a href="{{ $storeurl }}" class="text-decoration-none">
                            <div class="card shadow-sm text-center p-2">
                                <img src="{{ $store->image ? asset('storage/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                    loading="lazy"
                                    alt="{{ $store->name }}">
                                <h5 class="card-title">{{ $store->name ?: "Title not found" }}</h5>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                        @lang('message.No stores found in this category!Explore new')
                            <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class=" get text-decoration-none fw-bold"> @lang('nav.stores')</a>
                        </div>
                    </div>
                @endforelse
            </div>

        </section>
        <section>
            <div class="row card-list g-4 mt-3">
                <div class="col-md-8">
                    <section class="blog">
                    <h2>@lang('message.Shopping Hacks & Savings Tips & Tricks')</h2>
                    <div class="row">
                        @foreach ($relatedblogs as $blog)
                        <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100 d-flex flex-column">
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                            <img src="{{ asset('storage/blogs/' . $blog->image) }}" class="card-img-top" alt="Blog Post Image">
                        </a>
                            <div class="card-body d-flex flex-column">
                            <div class="blog-text mb-3">
                                <h5 class="blog-title">{{ $blog->title }}</h5>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-danger rounded-pill w-100">@lang('welcome.Read More')</a>
                            </div>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
