@extends('layouts.master')

@section('title', __('terms.meta_title', ['app' => config('app.name')]))
@section('description', __('terms.meta_description'))
@section('keywords', __('terms.meta_keywords'))
@section('author', __('terms.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/terms.css') }}">

@endpush

@section('content')
<!-- Terms Header -->
<div class="terms-header">
    <div class="container">
        <div class="terms-header-content">
            <h1>{{ __('terms.header_title') }}</h1>
            <p class="lead">{{ __('terms.header_subtitle') }}</p>
            <div class="last-updated">
                <i class="fas fa-history me-2"></i>{{ __('terms.last_updated', ['date' => date('F j, Y')]) }}
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Main Terms Card -->
            <div class="card terms-card">
                <!-- Card Header -->
                <div class="card-header terms-card-header">
                    <i class="fas fa-users terms-icon"></i>
                    <h2>{{ __('terms.card_title') }}</h2>
                    <p class="card-subtitle">{{ __('terms.card_subtitle') }}</p>
                </div>

                <!-- Card Body -->
                <div class="card-body terms-card-body">
                    <!-- Opening Message -->
                    <div class="community-message">
                        <div class="message-avatar">
                            {{-- <img src="https://images.unsplash.com/photo-1560250056-07ba64664864?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="{{ __('terms.message_avatar_alt') }}"> --}}
                        </div>
                        <div class="message-content">
                            <h4><i class="fas fa-comment-dots"></i> {{ __('terms.message_title') }}</h4>
                            <p>{{ __('terms.message_text') }}</p>
                            <div class="message-author">
                                <strong>{{ __('terms.message_author_name') }}</strong>
                                <span>{{ __('terms.message_author_title') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Sections -->
                    <div class="terms-content">
                        <!-- The Handshake -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.handshake_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.handshake_intro') }}</p>
                                
                                <div class="agreement-cards">
                                    <div class="agreement-card">
                                        <div class="agreement-icon">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                        <div class="agreement-text">
                                            <h5>{{ __('terms.handshake_yes_title') }}</h5>
                                            <p>{{ __('terms.handshake_yes_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="agreement-card">
                                        <div class="agreement-icon">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div class="agreement-text">
                                            <h5>{{ __('terms.handshake_respect_title') }}</h5>
                                            <p>{{ __('terms.handshake_respect_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="agreement-card">
                                        <div class="agreement-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="agreement-text">
                                            <h5>{{ __('terms.handshake_responsibility_title') }}</h5>
                                            <p>{{ __('terms.handshake_responsibility_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="choice-notice">
                                    <i class="fas fa-road"></i>
                                    <div>
                                        <h6>{{ __('terms.choice_title') }}</h6>
                                        <p>{{ __('terms.choice_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Community Rules -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon success">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.rules_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.rules_intro') }}</p>
                                
                                <div class="rules-container">
                                    <div class="rule-card good">
                                        <div class="rule-header">
                                            <i class="fas fa-thumbs-up"></i>
                                            <h5>{{ __('terms.rules_do_title') }}</h5>
                                        </div>
                                        <ul class="rule-list">
                                            <li><i class="fas fa-check-circle"></i> {!! __('terms.rules_do_1') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('terms.rules_do_2') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('terms.rules_do_3') !!}</li>
                                            <li><i class="fas fa-check-circle"></i> {!! __('terms.rules_do_4') !!}</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="rule-card bad">
                                        <div class="rule-header">
                                            <i class="fas fa-thumbs-down"></i>
                                            <h5>{{ __('terms.rules_dont_title') }}</h5>
                                        </div>
                                        <ul class="rule-list">
                                            <li><i class="fas fa-times-circle"></i> {!! __('terms.rules_dont_1') !!}</li>
                                            <li><i class="fas fa-times-circle"></i> {!! __('terms.rules_dont_2') !!}</li>
                                            <li><i class="fas fa-times-circle"></i> {!! __('terms.rules_dont_3') !!}</li>
                                            <li><i class="fas fa-times-circle"></i> {!! __('terms.rules_dont_4') !!}</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="community-story">
                                    <h6><i class="fas fa-book-open"></i> {{ __('terms.story_title') }}</h6>
                                    <p>{!! __('terms.story_text') !!}</p>
                                </div>
                            </div>
                        </section>

                        <!-- The Creative Commons -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon warning">
                                    <i class="fas fa-paint-brush"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.creative_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.creative_intro') }}</p>
                                
                                <div class="ownership-guidelines">
                                    <div class="ownership-item">
                                        <div class="ownership-icon">
                                            <i class="fas fa-seedling"></i>
                                        </div>
                                        <div class="ownership-content">
                                            <h6>{{ __('terms.creative_ours_title') }}</h6>
                                            <p>{{ __('terms.creative_ours_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="ownership-item">
                                        <div class="ownership-icon">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                        <div class="ownership-content">
                                            <h6>{{ __('terms.creative_yours_title') }}</h6>
                                            <p>{{ __('terms.creative_yours_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="ownership-item">
                                        <div class="ownership-icon">
                                            <i class="fas fa-share-alt"></i>
                                        </div>
                                        <div class="ownership-content">
                                            <h6>{{ __('terms.creative_share_title') }}</h6>
                                            <p>{{ __('terms.creative_share_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="creative-license">
                                    <h6><i class="fas fa-balance-scale"></i> {{ __('terms.creative_license_title') }}</h6>
                                    <p>{{ __('terms.creative_license_text') }}</p>
                                </div>
                            </div>
                        </section>

                        <!-- Real Talk About Limits -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon danger">
                                    <i class="fas fa-umbrella"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.limits_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.limits_intro') }}</p>
                                
                                <div class="limitations-grid">
                                    <div class="limitation-card">
                                        <i class="fas fa-wifi"></i>
                                        <h6>{{ __('terms.limits_uptime_title') }}</h6>
                                        <p>{{ __('terms.limits_uptime_text') }}</p>
                                    </div>
                                    <div class="limitation-card">
                                        <i class="fas fa-tag"></i>
                                        <h6>{{ __('terms.limits_expire_title') }}</h6>
                                        <p>{{ __('terms.limits_expire_text') }}</p>
                                    </div>
                                    <div class="limitation-card">
                                        <i class="fas fa-shield-virus"></i>
                                        <h6>{{ __('terms.limits_security_title') }}</h6>
                                        <p>{{ __('terms.limits_security_text') }}</p>
                                    </div>
                                </div>

                                <div class="reality-check">
                                    <div class="reality-header">
                                        <i class="fas fa-microphone-alt"></i>
                                        <h5>{{ __('terms.reality_title') }}</h5>
                                    </div>
                                    <p>{{ __('terms.reality_text') }}</p>
                                    <div class="reality-author">
                                        <strong>{{ __('terms.reality_author') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- The Safety Net -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon info">
                                    <i class="fas fa-shield-halved"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.safety_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.safety_intro') }}</p>
                                
                                <div class="safety-layers">
                                    <div class="safety-layer">
                                        <span class="layer-number">1</span>
                                        <div class="layer-content">
                                            <h6>{{ __('terms.safety_protection_title') }}</h6>
                                            <p>{{ __('terms.safety_protection_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="safety-layer">
                                        <span class="layer-number">2</span>
                                        <div class="layer-content">
                                            <h6>{{ __('terms.safety_responsibility_title') }}</h6>
                                            <p>{{ __('terms.safety_responsibility_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="safety-layer">
                                        <span class="layer-number">3</span>
                                        <div class="layer-content">
                                            <h6>{{ __('terms.safety_shield_title') }}</h6>
                                            <p>{{ __('terms.safety_shield_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="safety-commitment">
                                    <i class="fas fa-hand-holding-heart"></i>
                                    <div class="commitment-content">
                                        <h5>{{ __('terms.safety_commitment_title') }}</h5>
                                        <p>{{ __('terms.safety_commitment_text') }}</p>
                                        <p class="small">{{ __('terms.safety_commitment_legal') }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- When Things Change -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon secondary">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.change_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.change_intro') }}</p>
                                
                                <div class="change-process">
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>{{ __('terms.change_ideas_title') }}</h6>
                                            <p>{{ __('terms.change_ideas_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>{{ __('terms.change_talk_title') }}</h6>
                                            <p>{{ __('terms.change_talk_text') }}</p>
                                        </div>
                                    </div>
                                    <div class="process-step">
                                        <div class="step-icon">
                                            <i class="fas fa-sync-alt"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>{{ __('terms.change_update_title') }}</h6>
                                            <p>{{ __('terms.change_update_text') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="change-philosophy">
                                    <h6><i class="fas fa-compass"></i> {{ __('terms.change_north_star') }}</h6>
                                    <p>{{ __('terms.change_philosophy_text') }}</p>
                                </div>
                            </div>
                        </section>

                        <!-- The Conversation -->
                        <section class="terms-section">
                            <div class="section-header">
                                <div class="section-icon primary">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h3 class="section-title">{{ __('terms.conversation_title') }}</h3>
                            </div>
                            <div class="section-content">
                                <p>{{ __('terms.conversation_intro') }}</p>
                                
                                <div class="conversation-channels">
                                    <div class="channel-card">
                                        <div class="channel-icon">
                                            <i class="fas fa-envelope-open-text"></i>
                                        </div>
                                        <div class="channel-content">
                                            <h6>{{ __('terms.conversation_legal_title') }}</h6>
                                            <p>{!! __('terms.conversation_legal_text') !!} 
                                                <a href="mailto:contact@streamcoupon.com">legal@streamcoupon.com</a>
                                            </p>
                                            <small>{{ __('terms.conversation_legal_note') }}</small>
                                        </div>
                                    </div>
                                    <div class="channel-card">
                                        <div class="channel-icon">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                        <div class="channel-content">
                                            <h6>{{ __('terms.conversation_community_title') }}</h6>
                                            <p>{!! __('terms.conversation_community_text') !!}</p>
                                            <small>{{ __('terms.conversation_community_note') }}</small>
                                        </div>
                                    </div>
                                    <div class="channel-card">
                                        <div class="channel-icon">
                                            <i class="fas fa-coffee"></i>
                                        </div>
                                        <div class="channel-content">
                                            <h6>{{ __('terms.conversation_serious_title') }}</h6>
                                            <p>{{ __('terms.conversation_serious_text') }}</p>
                                            <small>{{ __('terms.conversation_serious_note') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="final-thought">
                                    <h6><i class="fas fa-heart"></i> {{ __('terms.final_title') }}</h6>
                                    <p>{{ __('terms.final_text_1') }}</p>
                                    <p class="mt-2"><strong>{{ __('terms.final_text_2') }}</strong></p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Community Actions -->
                    <div class="community-actions">
                        <div class="actions-grid">
                            <a href="{{ url(app()->getLocale() . '/') }}" class="action-btn primary-btn">
                                <i class="fas fa-home"></i> {{ __('terms.action_home') }}
                            </a>
                            <a href="{{ route('community', ['lang' => app()->getLocale()]) }}" class="action-btn secondary-btn">
                                <i class="fas fa-users"></i> {{ __('terms.action_community') }}
                            </a>
                            <button onclick="window.print()" class="action-btn tertiary-btn">
                                <i class="fas fa-file-contract"></i> {{ __('terms.action_print') }}
                            </button>
                        </div>
                        <div class="actions-footer">
                            <p><i class="fas fa-history"></i> {{ __('terms.footer_reminder', ['date' => date('F j, Y')]) }}</p>
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

        // Observe all terms sections
        document.querySelectorAll('.terms-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Smooth scroll when clicking section headers
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('click', function() {
                const section = this.parentElement;
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Print functionality
        const printBtn = document.querySelector('.print-btn');
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                window.print();
            });
        }

        // Add hover effects to activity cards
        document.querySelectorAll('.activity-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush