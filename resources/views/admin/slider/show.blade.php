@extends('admin.layouts.app')
@section('title', 'Show Slider')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider Details</h1>
 <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Back to Sliders
                    </a>
                    <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-outline-primary">
                        <i class="mdi mdi-pencil me-1"></i> Edit Slider
                    </a>

            </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Slider Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td>{{ $slider->title }}</td>
                </tr>
                <tr>
                    <th>Subtitle</th>
                    <td>{{ $slider->subtitle }}</td>
                </tr>
                <tr>
                    <th>Link</th>
                    <td>
                        <a href="{{ $slider->link }}" target="_blank">{{ $slider->link }}</a>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $slider->status ? 'Active' : 'Inactive' }}</td>
                </tr>
                <tr>
                    <th>Sort Order</th>
                    <td>{{ $slider->sort_order }}</td>
                </tr>
                <tr>
                    <th>Button Text</th>
                    <td>{{ $slider->button_text }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" width="200"></td>
                </tr>
            </table>
        </div>
    </div>
@endsection