@extends('layouts.master')

@section('title', __('community.meta_title', ['year' => date('Y'), 'app' => config('app.name')]))
@section('description', __('community.meta_description'))
@section('keywords', __('community.meta_keywords'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center mb-4">{{ __('community.heading') }}</h1>
                    <p class="text-center">{{ __('community.paragraph_1') }}</p>
                    <p class="text-center">{{ __('community.paragraph_2') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection