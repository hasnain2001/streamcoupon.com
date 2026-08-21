@extends('errors::layout')

@section('title', __('404 - Page Not Found'))
@section('code', '404')
@section('message', __('Oops! The page you are looking for could not be found.'))

{{-- Push custom styles into the minimal layout's stack --}}
@push('styles')
    {{-- Bootstrap 5 & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Google Fonts for a polished look --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ── Reset / Base ── */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #f8faff 0%, #eef2f9 100%);
            padding: 2rem 1.5rem;
            margin: 0;
        }

        /* ── Main Card ── */
        .error-card {
            max-width: 780px;
            width: 100%;
            background: rgba(255, 255, 255, 0.80);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 3.5rem;
            padding: 3.5rem 3rem 3rem;
            box-shadow:
                0 30px 60px -20px rgba(0, 20, 40, 0.25),
                0 10px 30px -10px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.5);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .error-card:hover {
            transform: translateY(-4px);
        }

        /* ── Decorative Glow ── */
        .error-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .error-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* ── 404 Text with Animation ── */
        .error-code-wrapper {
            position: relative;
            z-index: 1;
            margin-bottom: 0.5rem;
        }

        .error-code {
            font-size: 10rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.06em;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
            animation: float 3.5s ease-in-out infinite, pulseGlow 4s ease-in-out infinite;
            position: relative;
            filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.20));
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-16px) scale(1.02);
            }
        }

        @keyframes pulseGlow {
            0%,
            100% {
                filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.20));
            }
            50% {
                filter: drop-shadow(0 12px 40px rgba(79, 70, 229, 0.40));
            }
        }

        /* ── 404 sub-text (0's with dots) ── */
        .error-code-sub {
            font-size: 1.5rem;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.3em;
            margin-top: -0.5rem;
            position: relative;
            z-index: 1;
        }

        .error-code-sub span {
            display: inline-block;
            animation: dotPulse 2s ease-in-out infinite;
        }
        .error-code-sub span:nth-child(2) {
            animation-delay: 0.3s;
        }
        .error-code-sub span:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes dotPulse {
            0%,
            100% {
                opacity: 0.3;
                transform: scale(0.9);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* ── Heading ── */
        .error-heading {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 0.75rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
        }

        .error-heading i {
            color: #f59e0b;
            margin-right: 0.4rem;
        }

        /* ── Message ── */
        .error-message {
            font-size: 1.1rem;
            color: #475569;
            line-height: 1.7;
            max-width: 440px;
            margin: 0.5rem auto 2rem;
            position: relative;
            z-index: 1;
        }

        /* ── Search Box ── */
        .search-box {
            position: relative;
            z-index: 1;
            max-width: 400px;
            margin: 0 auto 1.75rem;
        }

        .search-box .input-group {
            background: white;
            border-radius: 60px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(203, 213, 225, 0.5);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .search-box .input-group:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.15);
        }

        .search-box .form-control {
            border: none;
            padding: 0.85rem 1.5rem;
            font-size: 0.95rem;
            background: transparent;
            color: #0f172a;
            font-weight: 500;
            box-shadow: none;
        }

        .search-box .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .search-box .form-control:focus {
            box-shadow: none;
        }

        .search-box .btn-search {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border: none;
            color: white;
            padding: 0 1.75rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .search-box .btn-search:hover {
            transform: scale(1.04);
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.30);
            background: linear-gradient(135deg, #4338ca, #6d28d9);
        }

        /* ── Action Buttons ── */
        .action-buttons {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 0.75rem 1rem;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: white;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.15);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.25);
            color: white;
            background: linear-gradient(135deg, #1e293b, #0f172a);
        }

        .btn-home i {
            font-size: 1.1rem;
        }

        .btn-outline-help {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 1.8rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: transparent;
            color: #475569;
            border: 1.5px solid #cbd5e1;
            text-decoration: none;
        }

        .btn-outline-help:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            transform: translateY(-3px);
            color: #0f172a;
        }

        /* ── Decorative floating shapes ── */
        .shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #a78bfa, transparent 70%);
            top: -30px;
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
            left: -15px;
            animation: floatShape 7s ease-in-out infinite 1s;
        }

        @keyframes floatShape {
            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(10px, -20px) scale(1.1);
            }
            66% {
                transform: translate(-10px, 10px) scale(0.9);
            }
        }

        /* ── Responsive ── */
        @media (max-width: 576px) {
            .error-card {
                padding: 2.5rem 1.5rem 2rem;
                border-radius: 2rem;
            }

            .error-code {
                font-size: 6.5rem;
            }

            .error-code-sub {
                font-size: 1.1rem;
                letter-spacing: 0.2em;
            }

            .error-heading {
                font-size: 1.5rem;
            }

            .error-message {
                font-size: 1rem;
                padding: 0 0.5rem;
            }

            .search-box .form-control {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
            }

            .search-box .btn-search {
                padding: 0 1.2rem;
                font-size: 0.85rem;
            }

            .btn-home,
            .btn-outline-help {
                padding: 0.6rem 1.4rem;
                font-size: 0.85rem;
                width: 100%;
                justify-content: center;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.6rem;
            }
        }

        @media (max-width: 400px) {
            .error-code {
                font-size: 5rem;
            }
            .error-card {
                padding: 2rem 1rem 1.5rem;
            }
        }
    </style>
@endpush

{{-- Override the default content of the minimal layout --}}
@section('content')
    {{-- The minimal layout typically outputs code & message inside a container.
         We override the whole content area with our custom design. --}}
    <div class="error-card">

        {{-- Decorative shapes --}}
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        {{-- 404 Number with animation --}}
        <div class="error-code-wrapper">
            <div class="error-code">404</div>
            <div class="error-code-sub">
                <span>●</span> <span>●</span> <span>●</span>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="error-heading">
            <i class="bi bi-emoji-frown"></i> Page Not Found
        </h1>

        {{-- Message --}}
        <p class="error-message">
            {{ __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.') }}
        </p>

        {{-- Search Box --}}
        <div class="search-box">
            <form action="{{ route('home') }}" method="GET" class="input-group">
                <input
                type="text"
                class="form-control"
                placeholder="Search for coupons, stores…"
                aria-label="Search"
                name="q"
                >
                <button class="btn-search" type="submit">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </form>
        </div>

        {{-- Action Buttons --}}
        <div class="action-buttons">
            <a href="{{ url('/') }}" class="btn-home">
                <i class="bi bi-house-door-fill"></i> Go Home
            </a>
            <a href="{{ url()->previous() }}" class="btn-outline-help">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>

        {{-- Small footer note --}}
        <p class="mt-4 mb-0 text-center text-muted" style="font-size:0.8rem;position:relative;z-index:1;">
            <i class="bi bi-shield-check me-1"></i>
            {{ config('app.name') }} &middot; Verified coupons &amp; deals
        </p>
    </div>
@endsection

{{-- Push scripts if needed --}}
@push('scripts')
    {{-- Bootstrap 5 JS (optional, for any interactive elements) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
@endpush