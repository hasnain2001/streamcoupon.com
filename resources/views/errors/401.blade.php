@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('description', 'You are not authorized to access this page.')

@section('content')
    <div class="error-centered">
        {{-- Error Code with lock icon --}}
        <div class="error-code-wrapper mb-3">
            <div class="error-code">
                <i class="bi bi-lock-fill" style="font-size:0.6em; background: none; -webkit-text-fill-color: #4f46e5; color: #4f46e5;"></i>
                401
            </div>
            <div class="error-dots">
                <span>●</span> <span>●</span> <span>●</span>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="error-heading">
            <i class="bi bi-shield-exclamation"></i>
            {{ __('Unauthorized') }}
        </h1>

        {{-- Message --}}
        <p class="error-message">
            {{ __('You do not have permission to view this page. Please log in or contact support if you believe this is a mistake.') }}
        </p>

        {{-- Action Buttons --}}
        <div class="action-buttons">
            <a href="{{ url('/') }}" class="btn-home">
                <i class="bi bi-house-door-fill"></i> Go Home
            </a>
            <a href="{{ route('login') }}" class="btn-outline-help">
                <i class="bi bi-box-arrow-in-right"></i> Log In
            </a>
        </div>
    </div>
@endsection

{{-- Optional extra styles for the error-centered layout --}}
@push('styles')
    <style>
        /* Reuse the same error styles from the main layout, but ensure they are applied */
        .error-code-wrapper {
            position: relative;
            z-index: 1;
            margin-bottom: 0.5rem;
        }
        .error-code {
            font-size: 8rem; /* Slightly smaller because of the lock icon */
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
            font-size: 0.7em;
            -webkit-text-fill-color: #4f46e5;
            color: #4f46e5;
            background: none;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-16px) scale(1.02); }
        }
        @keyframes pulseGlow {
            0%, 100% { filter: drop-shadow(0 8px 24px rgba(79, 70, 229, 0.20)); }
            50% { filter: drop-shadow(0 12px 40px rgba(79, 70, 229, 0.40)); }
        }

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

        .error-centered {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            text-align: center;
        }

        @media (max-width: 576px) {
            .error-code {
                font-size: 5.5rem;
            }
            .error-dots {
                font-size: 1.1rem;
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
                width: 100%;
                justify-content: center;
            }
            .action-buttons {
                flex-direction: column;
                gap: 0.6rem;
            }
        }
    </style>
@endpush