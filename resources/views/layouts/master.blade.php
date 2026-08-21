<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    {{-- ===== CHARACTER SET & VIEWPORT ===== --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- ===== DYNAMIC TITLE & META ===== --}}
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Find verified coupon codes, promo deals, and discounts updated daily on ' . config('app.name'))">
    <meta name="keywords" content="@yield('keywords', 'coupon codes, discount coupons, promo codes, deals, vouchers, ' . config('app.name'))">

    {{-- ===== ROBOTS & INDEXING ===== --}}
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google" content="notranslate">

    {{-- ===== AUTHOR & PUBLISHER ===== --}}
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="publisher" content="{{ config('app.name') }}">

    {{-- ===== CANONICAL URL (critical for SEO) ===== --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- ===== OPEN GRAPH (Facebook / WhatsApp / LinkedIn) ===== --}}
    <meta property="og:title" content="@yield('og_title', $title ?? config('app.name'))">
    <meta property="og:description" content="@yield('og_description', $description ?? 'Find verified coupon codes and exclusive discounts on ' . config('app.name'))">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    {{-- ===== TWITTER CARD ===== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $title ?? config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', $description ?? 'Best online coupon codes and offers from top stores.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/img/twitter-card.jpg'))">

    {{-- ===== THEME COLOR (for mobile browsers) ===== --}}
    <meta name="theme-color" content="#1E8A88">

    {{-- ===== PRELOAD & PRECONNECT (performance) ===== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    {{-- ===== FAVICON ===== --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}">


    {{-- ===== MAIN CSS FILES (load after critical) ===== --}}
    <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">

    {{-- ===== BOOTSTRAP & ICONS ===== --}}
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'">
   <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    {{-- ===== ADDITIONAL STYLES FROM CHILD PAGES ===== --}}
    @stack('styles')
</head>

<body >
    

    {{-- ===== HEADER ===== --}}
    <header role="banner">
        <x-navbar />
    </header>

    {{-- ===== MAIN CONTENT (with ID for skip link) ===== --}}
    <main class="flex-shrink-0" role="main">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="mt-auto" >
        <x-footer />
    </footer>

    {{-- ===== SCRIPTS (deferred for performance) ===== --}}
    {{-- Bootstrap JS (deferred) --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    {{-- Additional vendor scripts (deferred) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    {{-- Custom site scripts --}}
    <script src="{{ asset('assets/js/navbar.js') }}" defer></script>
    <script src="{{ asset('assets/js/footer.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    {{-- ===== PAGE-SPECIFIC SCRIPTS ===== --}}
    @stack('scripts')

    {{-- ===== STRUCTURED DATA (JSON‑LD) – from child views ===== --}}
    @stack('schema')
</body>
</html>