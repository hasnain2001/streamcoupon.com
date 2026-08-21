@extends('layouts.master')

@section('title', __('faq.meta_title', ['app' => config('app.name')]))
@section('description', __('faq.meta_description'))
@section('keywords', __('faq.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/faq.css') }}">
@endpush

@section('content')
<div class="faq-container">
    <h1 class="faq-title">{{ __('faq.page_title') }}</h1>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q1', ['app' => config('app.name')]) }}</h2>
        <p class="faq-answer">{{ __('faq.a1', ['app' => config('app.name')]) }}</p>
    </div>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q2') }}</h2>
        <p class="faq-answer">{{ __('faq.a2') }}</p>
    </div>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q3', ['app' => config('app.name')]) }}</h2>
        <p class="faq-answer">{{ __('faq.a3', ['app' => config('app.name')]) }}</p>
    </div>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q4') }}</h2>
        <p class="faq-answer">{{ __('faq.a4') }}</p>
    </div>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q5') }}</h2>
        <p class="faq-answer">{{ __('faq.a5') }}</p>
    </div>
    
    <div class="faq-item">
        <h2 class="faq-question">{{ __('faq.q6') }}</h2>
        <p class="faq-answer">{{ __('faq.a6') }}</p>
    </div>
</div>
@endsection