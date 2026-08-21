
@extends('errors::layout')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))

{{-- Override the default content with our custom design --}}
@section('content')
    <div class="error-container">
        {{-- Decorative shapes --}}
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        {{-- Error Code with credit card icon --}}
        <div class="error-code-wrapper">
            <div class="error-code">
                <i class="bi bi-credit-card-fill"></i>
                <span>402</span>
            </div>
            <div class="error-dots">
                <span>●</span> <span>●</span> <span>●</span>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="error-heading">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ __('Payment Required') }}
        </h1>

        {{-- Message --}}
        <p class="error-message">
            {{ __('This page requires a payment to access. Please complete your transaction or contact support if you believe this is an error.') }}
        </p>

        {{-- Action Buttons --}}
        <div class="action-buttons">
            <a href="{{ url('/') }}" class="btn-home">
                <i class="bi bi-house-door-fill"></i> Go Home
            </a>
            <a href="{{ url('/billing') }}" class="btn-outline-help">
                <i class="bi bi-credit-card"></i> Billing
            </a>
        </div>
    </div>

    {{-- Push the custom styles into the minimal layout's stack --}}
    @push('styles')
        <style>
            /* ----- Base for error container (overrides minimal layout) ----- */
            .error-container {
                position: relative;
                max-width: 780px;
                width: 100%;
                margin: 2rem auto;
                background: rgba(255, 255, 255, 0.85);
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
                overflow: hidden;
                transition: transform 0.3s ease;
                z-index: 1;
            }
            .error-container:hover {
                transform: translateY(-4px);
            }

            /* Decorative glows */
            .error-container::before {
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
            .error-container::after {
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

            /* Floating shapes (same as before) */
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
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(10px, -20px) scale(1.1); }
                66% { transform: translate(-10px, 10px) scale(0.9); }
            }

            /* ----- Animated Error Code ----- */
            .error-code-wrapper {
                position: relative;
                z-index: 1;
                margin-bottom: 0.5rem;
            }
            .error-code {
                font-size: 8.5rem;
                font-weight: 900;
                line-height: 1;
                letter-spacing: -0.06em;
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
                animation: float 3.5s ease-in-out infinite, pulseGlow 4s ease-in-out infinite;
                filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.20));
            }
            .error-code i {
                font-size: 0.65em;
                -webkit-text-fill-color: #4f46e5;
                color: #4f46e5;
                background: none;
            }
            .error-code span {
                -webkit-text-fill-color: transparent;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-16px) scale(1.02); }
            }
            @keyframes pulseGlow {
                0%, 100% { filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.20)); }
                50% { filter: drop-shadow(0 12px 40px rgba(79, 70, 229, 0.40)); }
            }

            /* Animated dots */
            .error-dots {
                font-size: 1.5rem;
                font-weight: 600;
                color: #64748b;
                letter-spacing: 0.3em;
                margin-top: -0.5rem;
                position: relative;
                z-index: 1;
            }
            .error-dots span {
                display: inline-block;
                animation: dotPulse 2s ease-in-out infinite;
            }
            .error-dots span:nth-child(2) { animation-delay: 0.3s; }
            .error-dots span:nth-child(3) { animation-delay: 0.6s; }
            @keyframes dotPulse {
                0%, 100% { opacity: 0.3; transform: scale(0.9); }
                50% { opacity: 1; transform: scale(1.2); }
            }

            /* Headings */
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
            .error-message {
                font-size: 1.1rem;
                color: #475569;
                line-height: 1.7;
                max-width: 440px;
                margin: 0.5rem auto 2rem;
                position: relative;
                z-index: 1;
            }

            /* ----- Action Buttons ----- */
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

            /* ----- Responsive ----- */
            @media (max-width: 576px) {
                .error-container {
                    padding: 2.5rem 1.5rem 2rem;
                    border-radius: 2rem;
                    margin: 1rem auto;
                }
                .error-code {
                    font-size: 5.5rem;
                }
                .error-dots {
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
                    font-size: 4.5rem;
                }
                .error-container {
                    padding: 1.5rem 1rem 1.5rem;
                }
            }
        </style>
    @endpush
@endsection