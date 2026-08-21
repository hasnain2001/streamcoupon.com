@extends('layouts.master')

@section('title', __('privacy.meta_title'))
@section('description', __('privacy.meta_description'))
@section('keywords', __('privacy.meta_keywords'))
@section('author', __('privacy.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/privacy.css') }}">
@endpush

@section('content')
<!-- Privacy Header -->
<div class="privacy-header">
    <div class="container">
        <div class="privacy-header-content">
            <h1>{{ __('privacy.header_title') }}</h1>
            <p class="lead">{{ __('privacy.header_subtitle') }}</p>
            <div class="last-updated">
                <i class="fas fa-history me-2"></i>{{ __('privacy.last_updated', ['date' => now()->format('F d, Y')]) }}
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Main Policy Card -->
            <div class="card policy-card">
                <!-- Card Header -->
                <div class="card-header policy-card-header">
                    <i class="fas fa-user-shield policy-icon"></i>
                    <h2>{{ __('privacy.card_title') }}</h2>
                    <p class="card-subtitle">{{ __('privacy.card_subtitle') }}</p>
                </div>

                <!-- Card Body -->
                <div class="card-body policy-card-body">
                    <!-- Opening Note -->
                    <div class="author-note">
                        <div class="note-header">
                            <i class="fas fa-quote-left"></i>
                            <h4>{{ __('privacy.note_title') }}</h4>
                        </div>
                        <div class="note-content">
                            <p>{{ __('privacy.note_text') }}</p>
                            <div class="author-signature">
                                <strong>{{ __('privacy.note_author_name') }}</strong>
                                <span>{{ __('privacy.note_author_title') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Policy Sections -->
                    <div class="privacy-content">
                        <!-- Information Collection -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.collection_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.collection_intro') }}</p>
                                
                                <div class="info-blocks">
                                    <div class="info-block">
                                        <i class="fas fa-user-circle"></i>
                                        <h5>{{ __('privacy.collection_essentials_title') }}</h5>
                                        <p>{{ __('privacy.collection_essentials_text') }}</p>
                                    </div>
                                    <div class="info-block">
                                        <i class="fas fa-chart-line"></i>
                                        <h5>{{ __('privacy.collection_learning_title') }}</h5>
                                        <p>{{ __('privacy.collection_learning_text') }}</p>
                                    </div>
                                    <div class="info-block">
                                        <i class="fas fa-shield-alt"></i>
                                        <h5>{{ __('privacy.collection_safety_title') }}</h5>
                                        <p>{{ __('privacy.collection_safety_text') }}</p>
                                    </div>
                                </div>

                                <div class="privacy-tip">
                                    <i class="fas fa-lightbulb"></i>
                                    <p><strong>{{ __('privacy.tip_label') }}</strong> {{ __('privacy.tip_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Information Usage -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon success">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.usage_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.usage_intro') }}</p>
                                
                                <div class="usage-examples">
                                    <div class="example-card">
                                        <div class="example-icon">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div class="example-content">
                                            <h6>{{ __('privacy.usage_notifications_title') }}</h6>
                                            <p>{{ __('privacy.usage_notifications_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="example-card">
                                        <div class="example-icon">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <div class="example-content">
                                            <h6>{{ __('privacy.usage_discovery_title') }}</h6>
                                            <p>{{ __('privacy.usage_discovery_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="example-card">
                                        <div class="example-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="example-content">
                                            <h6>{{ __('privacy.usage_community_title') }}</h6>
                                            <p>{{ __('privacy.usage_community_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="policy-promise">
                                    <i class="fas fa-hand-paper"></i>
                                    <div class="promise-content">
                                        <h5>{{ __('privacy.promise_title') }}</h5>
                                        <p><strong>{{ __('privacy.promise_text') }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Security -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon warning">
                                    <i class="fas fa-fortress-alt"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.security_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.security_intro') }}</p>
                                
                                <div class="security-showcase">
                                    <div class="security-layer">
                                        <span class="layer-number">1</span>
                                        <div class="layer-content">
                                            <h6>{{ __('privacy.security_encryption_title') }}</h6>
                                            <p>{{ __('privacy.security_encryption_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="security-layer">
                                        <span class="layer-number">2</span>
                                        <div class="layer-content">
                                            <h6>{{ __('privacy.security_need_title') }}</h6>
                                            <p>{{ __('privacy.security_need_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="security-layer">
                                        <span class="layer-number">3</span>
                                        <div class="layer-content">
                                            <h6>{{ __('privacy.security_vigilance_title') }}</h6>
                                            <p>{{ __('privacy.security_vigilance_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="security-layer">
                                        <span class="layer-number">4</span>
                                        <div class="layer-content">
                                            <h6>{{ __('privacy.security_redundancy_title') }}</h6>
                                            <p>{{ __('privacy.security_redundancy_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="security-tip">
                                    <i class="fas fa-user-lock"></i>
                                    <p><strong>{{ __('privacy.security_tip_label') }}</strong> {{ __('privacy.security_tip_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Cookies -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon info">
                                    <i class="fas fa-cookie"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.cookies_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.cookies_intro') }}</p>
                                
                                <div class="cookie-types">
                                    <div class="cookie-type essential">
                                        <h6><i class="fas fa-cog"></i> {{ __('privacy.cookies_essential_title') }}</h6>
                                        <p>{{ __('privacy.cookies_essential_text') }}</p>
                                    </div>
                                    <div class="cookie-type performance">
                                        <h6><i class="fas fa-tachometer-alt"></i> {{ __('privacy.cookies_performance_title') }}</h6>
                                        <p>{{ __('privacy.cookies_performance_text') }}</p>
                                    </div>
                                    <div class="cookie-type functional">
                                        <h6><i class="fas fa-heart"></i> {{ __('privacy.cookies_functional_title') }}</h6>
                                        <p>{{ __('privacy.cookies_functional_text') }}</p>
                                    </div>
                                </div>

                                <div class="cookie-control">
                                    <div class="control-header">
                                        <i class="fas fa-sliders-h"></i>
                                        <h5>{{ __('privacy.cookies_control_title') }}</h5>
                                    </div>
                                    <p>{{ __('privacy.cookies_control_text') }}</p>
                                    <div class="browser-links">
                                        <a href="#" class="browser-link"><i class="fab fa-chrome"></i> Chrome</a>
                                        <a href="#" class="browser-link"><i class="fab fa-firefox"></i> Firefox</a>
                                        <a href="#" class="browser-link"><i class="fab fa-safari"></i> Safari</a>
                                        <a href="#" class="browser-link"><i class="fab fa-edge"></i> Edge</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Third-Party Relationships -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon secondary">
                                    <i class="fas fa-handshake-alt"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.third_party_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.third_party_intro') }}</p>
                                
                                <div class="partner-guidelines">
                                    <div class="guideline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('privacy.third_party_guideline_1') }}</span>
                                    </div>
                                    <div class="guideline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('privacy.third_party_guideline_2') }}</span>
                                    </div>
                                    <div class="guideline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('privacy.third_party_guideline_3') }}</span>
                                    </div>
                                    <div class="guideline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('privacy.third_party_guideline_4') }}</span>
                                    </div>
                                </div>

                                <div class="transparency-box">
                                    <h6><i class="fas fa-binoculars"></i> {{ __('privacy.transparency_title') }}</h6>
                                    <p>{{ __('privacy.transparency_text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Your Rights -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon danger">
                                    <i class="fas fa-user-cog"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.rights_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.rights_intro') }}</p>
                                
                                <div class="rights-grid">
                                    <div class="right-card view">
                                        <i class="fas fa-eye"></i>
                                        <h6>{{ __('privacy.rights_view_title') }}</h6>
                                        <p>{{ __('privacy.rights_view_text') }}</p>
                                    </div>
                                    <div class="right-card correct">
                                        <i class="fas fa-edit"></i>
                                        <h6>{{ __('privacy.rights_correct_title') }}</h6>
                                        <p>{{ __('privacy.rights_correct_text') }}</p>
                                    </div>
                                    <div class="right-card delete">
                                        <i class="fas fa-trash-alt"></i>
                                        <h6>{{ __('privacy.rights_delete_title') }}</h6>
                                        <p>{{ __('privacy.rights_delete_text') }}</p>
                                    </div>
                                    <div class="right-card port">
                                        <i class="fas fa-download"></i>
                                        <h6>{{ __('privacy.rights_port_title') }}</h6>
                                        <p>{{ __('privacy.rights_port_text') }}</p>
                                    </div>
                                </div>

                                <div class="action-call">
                                    <div class="action-content">
                                        <h5><i class="fas fa-bolt"></i> {{ __('privacy.action_title') }}</h5>
                                        <p>{{ __('privacy.action_text') }}</p>
                                        <a href="mailto:privacy@streamcoupon.com" class="action-btn">
                                            <i class="fas fa-paper-plane"></i> {{ __('privacy.action_button') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The Human Touch -->
                        <div class="policy-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h3 class="section-title">{{ __('privacy.contact_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('privacy.contact_intro') }}</p>
                                
                                <div class="contact-card">
                                    <div class="contact-header">
                                        {{-- <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="{{ __('privacy.contact_avatar_alt') }}" class="contact-avatar"> --}}
                                        <div class="contact-info">
                                            <h5>{{ __('privacy.contact_team_title') }}</h5>
                                            <p>{{ __('privacy.contact_team_subtitle') }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="contact-details">
                                        <div class="contact-method">
                                            <i class="fas fa-envelope-open-text"></i>
                                            <div>
                                                <strong>{{ __('privacy.contact_general') }}</strong>
                                                <a href="mailto:privacy@streamcoupon.com">privacy@streamcoupon.com</a>
                                            </div>
                                        </div>
                                        <div class="contact-method">
                                            <i class="fas fa-user-tie"></i>
                                            <div>
                                                <strong>{{ __('privacy.contact_dpo') }}</strong>
                                                <span>{{ __('privacy.contact_dpo_name') }}</span>
                                            </div>
                                        </div>
                                        <div class="contact-method">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <div>
                                                <strong>{{ __('privacy.contact_location') }}</strong>
                                                <span>3000 Hoffman Dr,Plano, Tx USA 75074 ,United States of America</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="response-promise">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ __('privacy.contact_response') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Closing Thoughts -->
                    <div class="closing-thoughts">
                        <h4><i class="fas fa-heart"></i> {{ __('privacy.closing_title') }}</h4>
                        <p>{{ __('privacy.closing_text_1') }}</p>
                        <p>{{ __('privacy.closing_text_2') }}</p>
                        <p>{{ __('privacy.closing_text_3') }}</p>
                    </div>

                    <!-- Quick Action Footer -->
                    <div class="policy-footer">
                        <div class="footer-actions">
                            <a href="{{ url(app()->getLocale() . '/') }}" class="footer-btn home-btn">
                                <i class="fas fa-home"></i> {{ __('privacy.footer_home') }}
                            </a>
                            <a href="mailto:questions@streamcoupon.com" class="footer-btn question-btn">
                                <i class="fas fa-question-circle"></i> {{ __('privacy.footer_questions') }}
                            </a>
                        </div>
                        <div class="footer-reminder">
                            <i class="fas fa-history"></i>
                            <p>{{ __('privacy.footer_reminder', ['date' => now()->format('F d, Y')]) }}</p>
                        </div>
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
        // Add smooth animations to sections
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all policy sections
        document.querySelectorAll('.policy-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add click animation to back button
        const backBtn = document.querySelector('.back-btn');
        if (backBtn) {
            backBtn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        }
    });
</script>
@endpush