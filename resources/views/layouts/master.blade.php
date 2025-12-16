<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Dynamic Title & Meta -->
    <title>@yield('title', config('app.name'))</title>
    <!-- Primary Meta Description -->
    <meta name="description" content="@yield('description', 'Find verified coupon codes, promo deals, and discounts updated daily only on ' . config('app.name'))">
    <!-- Meta Keywords (optional, not used by Google) -->
    <meta name="keywords" content="@yield('keywords', 'coupon codes, discount coupons, promo codes, deals, vouchers, ' . config('app.name'))">
    <!-- Crawling & Indexing -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Prevent Google from auto-translating -->
    <meta name="google" content="notranslate">

    <!-- Author / Publisher -->
    <meta name="author" content="streamcoupon">
    <meta name="publisher" content="streamcoupon">

    <!-- Canonical URL (Correct Placement) -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph (Facebook / WhatsApp / LinkedIn) -->
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'Find verified coupon codes and exclusive discounts on ' . config('app.name'))">
    <meta property="og:image" content="@yield('og-image')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('description', 'Best online coupon codes and offers from top stores.')">
    <meta name="twitter:image" content="@yield('twitter-image')">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- CSS Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

    @stack('styles')
</head>

<body>
       <header>
        <x-navbar />
    </header>

  <main class="container py-4">
        @yield('content')
    </main>

    <footer>
        <x-footer />
    </footer>
    @stack('scripts')
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('assets/js/footer.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
