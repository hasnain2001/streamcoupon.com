@extends('layouts.welcome')
@section('title')
    Welcome to {{ config('app.name') }}
@endsection
@section('description')
    This is the welcome page of {{ config('app.name') }}.
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Welcome to {{ config('app.name') }}</h2>
                <p class="lead">Your gateway to amazing content.</p>
            </div>
        </div>
    </div>
@endsection
