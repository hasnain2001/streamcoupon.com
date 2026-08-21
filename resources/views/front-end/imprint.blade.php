@extends('layouts.master')

@section('title', __('imprint.meta_title', ['app' => config('app.name')]))
@section('description', __('imprint.meta_description', ['app' => config('app.name')]))
@section('keywords', __('imprint.meta_keywords', ['app' => config('app.name')]))
@section('author', config('app.name'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/imprint.css') }}">
@endpush

@section('content')
<main>
    {{-- HERO --}}
    <section class="imprint-hero">
        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="mb-3">{{ __('imprint.hero_title') }}</h1>
                    <p class="lead mb-3">{{ __('imprint.hero_subtitle') }}</p>
                    <div class="hero-badge">
                        <i class="fas fa-file-contract"></i> {{ __('imprint.hero_badge') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CARD --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="imprint-card">

                    {{-- HEADER --}}
                    <div class="imprint-header">
                        <h2><i class="fas fa-home-alt me-2"></i>{{ __('imprint.card_header') }}</h2>
                        <p class="subtitle">{{ __('imprint.card_subheader') }}</p>
                    </div>

                    {{-- OPENING NOTE --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div>
                            <h4 class="info-title">{{ __('imprint.welcome_title') }}</h4>
                            <p class="info-content">{{ __('imprint.welcome_text') }}</p>
                        </div>
                    </div>

                    {{-- OUR STORY / TEXAS ROOTS --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-map-pin"></i>
                        </div>
                        <div>
                            <h4 class="info-title">{{ __('imprint.texas_title') }}</h4>
                            <div class="info-content">
                                <div class="d-flex flex-wrap align-items-center gap-3 bg-soft-primary p-3 rounded-4 border border-soft">
                                    <div class="display-6 text-primary-dark" style="font-size: 2.8rem;">
                                        <i class="fas fa-texas"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold text-accent">{{ __('imprint.texas_location') }}</h5>
                                        <p class="mb-1">{{ __('imprint.texas_text') }}</p>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary-emphasis px-3 py-2">
                                            <i class="fas fa-lightbulb me-1"></i> {{ __('imprint.texas_fun_fact') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TEAM --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-users-gear"></i>
                        </div>
                        <div class="w-100">
                            <h4 class="info-title">{{ __('imprint.team_title') }}</h4>
                            <div class="row g-3 mt-1">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-3 p-3 border rounded-4 bg-white hover-lift">
                                        <i class="fas fa-user-tie fs-2 text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.team_legal') }}</h6>
                                            <small class="text-muted">{{ __('imprint.team_legal_sub') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-3 p-3 border rounded-4 bg-white hover-lift">
                                        <i class="fas fa-shield-alt fs-2 text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.team_compliance') }}</h6>
                                            <small class="text-muted">{{ __('imprint.team_compliance_sub') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-3 p-3 border rounded-4 bg-white hover-lift">
                                        <i class="fas fa-handshake fs-2 text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.team_partners') }}</h6>
                                            <small class="text-muted">{{ __('imprint.team_partners_sub') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CONTACT HUB --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="w-100">
                            <h4 class="info-title">{{ __('imprint.contact_title') }}</h4>
                            <p class="text-muted">{{ __('imprint.contact_subtitle') }}</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 h-100 bg-white hover-lift">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-envelope-open-text fs-4 text-primary"></i>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.contact_email') }}</h6>
                                        </div>
                                        <p class="small text-muted">{{ __('imprint.contact_email_text') }}</p>
                                        <a href="mailto:contact@streamcoupon.com" class="fw-bold text-decoration-none text-primary-dark">
                                            <i class="fas fa-paper-plane me-1"></i> contact@streamcoupon.com
                                        </a>
                                        <div class="mt-2"><span class="badge bg-light text-dark"><i class="far fa-clock me-1"></i> {{ __('imprint.contact_response') }}</span></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 h-100 bg-white hover-lift">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-phone-volume fs-4 text-primary"></i>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.contact_phone') }}</h6>
                                        </div>
                                        <p class="small text-muted">{{ __('imprint.contact_phone_text') }}</p>
                                        <a href="tel:+17473651163" class="fw-bold text-decoration-none text-primary-dark">
                                            <i class="fas fa-phone-alt me-1"></i> +1 (747) 365-1163
                                        </a>
                                        <div class="mt-2"><span class="badge bg-light text-dark"><i class="far fa-calendar-alt me-1"></i> {{ __('imprint.contact_hours') }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LEGAL BACKBONE --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="w-100">
                            <h4 class="info-title">{{ __('imprint.legal_title') }}</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 bg-soft-primary rounded-4 border border-soft h-100">
                                        <i class="fas fa-building-columns fs-3 text-primary-dark mb-2"></i>
                                        <h6 class="fw-bold">{{ __('imprint.legal_registered') }}</h6>
                                        <p class="small mb-0">{{ __('imprint.legal_registered_text') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-soft-primary rounded-4 border border-soft h-100">
                                        <i class="fas fa-file-invoice-dollar fs-3 text-primary-dark mb-2"></i>
                                        <h6 class="fw-bold">{{ __('imprint.legal_tax') }}</h6>
                                        <p class="small mb-0">{{ __('imprint.legal_tax_text') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-soft-primary rounded-4 border border-soft h-100">
                                        <i class="fas fa-umbrella fs-3 text-primary-dark mb-2"></i>
                                        <h6 class="fw-bold">{{ __('imprint.legal_insurance') }}</h6>
                                        <p class="small mb-0">{{ __('imprint.legal_insurance_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- DISCLAIMER / REAL TALK --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-microphone-alt"></i>
                        </div>
                        <div class="w-100">
                            <h4 class="info-title">{{ __('imprint.disclaimer_title') }}</h4>
                            <p>{{ __('imprint.disclaimer_intro') }}</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 bg-white h-100">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-check-circle text-success fs-4"></i>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.disclaimer_do') }}</h6>
                                        </div>
                                        <p class="small mb-0">{{ __('imprint.disclaimer_do_text') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 bg-white h-100">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-exclamation-circle text-warning fs-4"></i>
                                            <h6 class="fw-bold mb-0">{{ __('imprint.disclaimer_cant') }}</h6>
                                        </div>
                                        <p class="small mb-0">{{ __('imprint.disclaimer_cant_text') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 p-3 bg-light rounded-4 d-flex align-items-start gap-3">
                                <i class="fas fa-hand-holding-heart fs-3 text-primary-dark"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ __('imprint.disclaimer_responsibility') }}</h6>
                                    <p class="small mb-0">{{ __('imprint.disclaimer_responsibility_text') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- COPYRIGHT --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div>
                            <h4 class="info-title">{{ __('imprint.copyright_title') }}</h4>
                            <p class="info-content">{{ __('imprint.copyright_text') }}</p>
                            <div class="d-flex flex-wrap align-items-center gap-3 p-3 bg-soft-primary rounded-4 border border-soft">
                                <i class="fas fa-copyright fs-2 text-primary-dark"></i>
                                <div>
                                    <h6 class="fw-bold mb-0">© {{ date('Y') }} streamcoupon</h6>
                                    <p class="small mb-0">{{ __('imprint.copyright_tagline') }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6><i class="fas fa-share-alt me-1"></i> {{ __('imprint.copyright_sharing') }}</h6>
                                <p class="small text-muted">{{ __('imprint.copyright_sharing_text') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- LIVING DOCUMENT --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <div>
                            <h4 class="info-title">{{ __('imprint.living_title') }}</h4>
                            <p>{{ __('imprint.living_text') }}</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="p-3 bg-white border rounded-4 flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-calendar-check text-primary"></i>
                                        <span class="fw-bold">{{ date('F j, Y') }}</span>
                                    </div>
                                    <h6 class="fw-bold mt-1">{{ __('imprint.living_review') }}</h6>
                                    <p class="small mb-0">{{ __('imprint.living_review_text') }}</p>
                                </div>
                                <div class="p-3 bg-white border rounded-4 flex-grow-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-rocket text-primary"></i>
                                        <span class="fw-bold">January 1, 2023</span>
                                    </div>
                                    <h6 class="fw-bold mt-1">{{ __('imprint.living_beginning') }}</h6>
                                    <p class="small mb-0">{{ __('imprint.living_beginning_text') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CLOSING --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div>
                            <h4 class="info-title">{{ __('imprint.closing_title') }}</h4>
                            <p>{{ __('imprint.closing_text_1') }}</p>
                            <p>{{ __('imprint.closing_text_2') }}</p>
                            <p class="mt-3 fst-italic">{{ __('imprint.closing_signoff') }}<br><strong>{{ __('imprint.closing_team') }}</strong></p>
                        </div>
                    </div>

                    {{-- JOURNEY CONTINUES --}}
                    <div class="info-section d-flex flex-wrap align-items-start gap-3 border-bottom-0">
                        <div class="info-icon flex-shrink-0">
                            <i class="fas fa-road"></i>
                        </div>
                        <div class="w-100">
                            <h4 class="info-title">{{ __('imprint.journey_title') }}</h4>
                            <p class="mb-3">{{ __('imprint.journey_text') }}</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('home', ['lang' => app()->getLocale()]) }}" class="btn btn-primary-custom">
                                    <i class="fas fa-home"></i> {{ __('imprint.journey_btn_deals') }}
                                </a>
                                <a href="{{ route('about', ['lang' => app()->getLocale()]) }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                                    <i class="fas fa-users me-1"></i> {{ __('imprint.journey_btn_team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- BACK HOME FOOTER --}}
                    <div class="back-home-section">
                        <p class="text-muted mb-3">{{ __('imprint.back_home_text') }}</p>
                        <a href="{{ route('home', ['lang' => app()->getLocale()]) }}" class="btn btn-primary-custom">
                            <i class="fas fa-arrow-left"></i> {{ __('imprint.back_home_btn') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            // subtle fade-in for sections (optional)
            const sections = document.querySelectorAll('.info-section');
            sections.forEach((el, i) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(12px)';
                setTimeout(() => {
                    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 + i * 60);
            });
        });
    </script>
@endpush