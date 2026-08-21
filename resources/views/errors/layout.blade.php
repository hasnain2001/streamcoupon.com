{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Dynamic Meta -->
    <title>@yield('title', config('app.name', 'CouponHub'))</title>
    <meta name="description" content="@yield('description', 'Find the best coupons and deals.')">
    <meta name="keywords" content="@yield('keywords', 'coupon codes, discount, promo, deals')">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google" content="notranslate">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="publisher" content="{{ config('app.name') }}">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'Verified coupons and exclusive offers.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', 'Best online deals.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/img/twitter-image.jpg'))">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- ===== BOOTSTRAP 5 & ICONS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        /* ----- Base Reset & Body ----- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: linear-gradient(145deg, #f8faff 0%, #eef2f9 100%);
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        /* ----- Main Container (Glass Card) ----- */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 3.5rem;
            padding: 2rem 2.5rem;
            box-shadow:
                0 30px 60px -20px rgba(0, 20, 40, 0.20),
                0 10px 30px -10px rgba(0, 0, 0, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .main-wrapper:hover {
            transform: translateY(-3px);
        }

        /* Decorative glows (same as error page) */
        .main-wrapper::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .main-wrapper::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.3;
        }
        .shape-1 {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #a78bfa, transparent 70%);
            top: -20px;
            right: -20px;
            animation: floatShape 8s ease-in-out infinite;
        }
        .shape-2 {
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, #f472b6, transparent 70%);
            bottom: 10px;
            left: 10px;
            animation: floatShape 6s ease-in-out infinite reverse;
        }
        .shape-3 {
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, #60a5fa, transparent 70%);
            top: 50%;
            left: -10px;
            animation: floatShape 7s ease-in-out infinite 1s;
        }
        @keyframes floatShape {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(10px, -20px) scale(1.1); }
            66% { transform: translate(-10px, 10px) scale(0.9); }
        }

        /* ----- Navigation ----- */
        .navbar-custom {
            position: relative;
            z-index: 1;
            padding: 0.5rem 0 1rem 0;
            border-bottom: 1px solid rgba(203, 213, 225, 0.3);
            margin-bottom: 1.5rem;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #1e293b;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            transition: background 0.2s, color 0.2s;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(79, 70, 229, 0.08);
            color: #4f46e5;
        }

        /* ----- Main Content Area ----- */
        .page-content {
            position: relative;
            z-index: 1;
            flex: 1;
            padding: 0.5rem 0;
        }

        /* ----- Footer ----- */
        .footer-custom {
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(203, 213, 225, 0.3);
            padding-top: 1.5rem;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #64748b;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .footer-custom a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }
        .footer-custom a:hover {
            text-decoration: underline;
        }

        /* ----- Responsive ----- */
        @media (max-width: 768px) {
            .main-wrapper {
                padding: 1.5rem;
                border-radius: 2.5rem;
            }
            .navbar-brand {
                font-size: 1.3rem;
            }
            .footer-custom {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
        }
        @media (max-width: 576px) {
            body {
                padding: 0.75rem;
            }
            .main-wrapper {
                padding: 1rem;
                border-radius: 1.5rem;
            }
            .navbar-custom {
                padding: 0.25rem 0 0.75rem;
            }
            .navbar-nav .nav-link {
                padding: 0.3rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        /* Additional utility for error pages (centered content) */
        .error-centered {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            text-align: center;
        }
    </style>

    {{-- Stack for extra styles --}}
    @stack('styles')
</head>
<body>

    <div class="main-wrapper">

        {{-- Decorative shapes --}}
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        {{-- ===== NAVIGATION ===== --}}
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid px-0">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'CouponHub') }}
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- ===== PAGE CONTENT ===== --}}
        <div class="page-content">
            @yield('content')
        </div>

        {{-- ===== FOOTER ===== --}}
        <footer class="footer-custom">
            <span>
                &copy; {{ date('Y') }} {{ config('app.name') }} &middot; All rights reserved.
            </span>
            <span>
                <i class="bi bi-shield-check me-1"></i>
                Verified coupons &amp; deals
            </span>
        </footer>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    {{-- Stack for scripts --}}
    @stack('scripts')
</body>
</html>