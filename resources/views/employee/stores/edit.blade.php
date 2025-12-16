@extends('employee.layouts.app')
@section('title', 'Edit Store')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="header-title mb-0"><i class="mdi mdi-pencil-outline me-2"></i>Edit Store</h4>
            </div>
            <div class="card-body">
                 @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
              @if ($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Validation Errors:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                     <form action="{{ route('employee.store.update', $store->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title text-dark fw-bold mb-0"><i class="mdi mdi-information-outline me-1"></i> Basic Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label text-dark fw-bold">Store Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $store->name) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="slug" class="form-label text-dark fw-bold">URL Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('/') }}/</span>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $store->slug) }}" required>
                                        </div>
                                        <div id="slug-message" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label text-dark fw-bold">Short Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="2" required>{{ $store->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="url" class="form-label text-dark fw-bold">Store Website URL <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="url" id="url" value="{{ old('url', $store->url) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="destination_url" class="form-label text-dark fw-bold">Affiliate Link <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ old('destination_url', $store->destination_url) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title text-dark fw-bold mb-0"><i class="mdi mdi-tag-outline me-1"></i> SEO Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label text-dark fw-bold">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $store->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_keyword" class="form-label text-dark fw-bold">Meta Keywords <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="{{ old('meta_keyword', $store->meta_keyword) }}">
                                        <div class="form-text">Separate keywords with commas</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label text-dark fw-bold">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $store->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="card mb-3 border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="card-title text-dark fw-bold mb-0"><i class="mdi mdi-cog-outline me-1"></i> Store Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label text-dark fw-bold">Status <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="enable" value="1" {{ old('status', $store->status) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="enable">
                                                    <i class="mdi mdi-check-circle-outline"></i> Enable
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="disable" value="0" {{ old('status', $store->status) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="disable">
                                                    <i class="mdi mdi-close-circle-outline"></i> Disable
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label text-dark fw-bold">Featured Store <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_store" id="not_top_store" value="0" {{ old('top_store', $store->top_store) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="not_top_store">
                                                    Regular
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="top_store" id="top_store" value="1" {{ old('top_store', $store->top_store) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-warning" for="top_store">
                                                    <i class="mdi mdi-star-outline"></i> Featured
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="network" class="form-label text-dark fw-bold">Affiliate Network <span class="text-danger">*</span></label>
                                        <select name="network_id" id="network" class="form-select" required>
                                            <option value="" disabled {{ !$store->network_id ? 'selected' : '' }}>-- Select Network --</option>
                                            @foreach ($networks as $network)
                                                <option value="{{ $network->id }}" {{ $store->network_id == $network->id ? 'selected' : '' }}>
                                                    {{ $network->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label text-dark fw-bold">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="" disabled>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $store->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language_id" class="form-label text-dark fw-bold">Language <span class="text-danger">*</span></label>
                                        <select name="language_id" id="language_id" class="form-select" required>
                                            <option value="" disabled>-- Select Language --</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}" {{ old('language_id', $store->language_id) == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                     <div class="mb-3">
                                        <label for="about" class="form-label text-dark fw-bold">About Store</label>
                                        <textarea name="about" id="about" class="form-control" rows="3" placeholder="Detailed information about the store">{{ $store->about }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label text-dark fw-bold">Store Logo</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                        <div class="form-text">Recommended size: 300x300 pixels</div>
                                        @if($store->image)
                                            <div class="mt-2">
                                                <input type="hidden" name="previous_image" value="{{ $store->image }}">
                                                <img src="{{ asset('uploads/' . $store->image) }}" alt="Current Store Image" class="img-thumbnail" style="max-width: 200px;">

                                            </div>
                                        @else
                                            <p class="text-muted mt-2">No image uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     <!-- Full Width Content Editor -->
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h5 class="card-title text-dark fw-bold mb-0">Store Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea id="editor" name="content" >{!! $store->content !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="mdi mdi-content-save"></i> Update Store
                        </button>
                        <a href="{{ route('employee.store.index') }}" class="btn btn-danger px-4 ms-2">
                            <i class="mdi mdi-close-circle"></i> Cancel
                        </a>
                        <button type="reset" class="btn btn-light px-4 ms-2">
                            <i class="mdi mdi-autorenew"></i> Reset
                        </button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection

@push('styles')
<style>
    .card-header.bg-primary {
        color: white;
        border-bottom: none;
    }
    .card-header.bg-light {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .card.border-primary {
        border: 1px solid #727cf5 !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .form-check-label.text-success {
        color: #0acf97 !important;
    }
    .form-check-label.text-danger {
        color: #fa5c7c !important;
    }
    .form-check-label.text-warning {
        color: #ffbc00 !important;
    }
    .input-group-text {
        background-color: #eef2f7;
    }
    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }
</style>
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const languageSelect = document.getElementById('language_id');

        categorySelect.addEventListener('change', function() {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const languageId = selectedOption.getAttribute('data-language');
            if (languageId) {
                for (let i = 0; i < languageSelect.options.length; i++) {
                    if (languageSelect.options[i].value == languageId) {
                        languageSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    });

    // Slug generation from name
    document.getElementById('name').addEventListener('blur', function() {
        const name = this.value;
        const slugField = document.getElementById('slug');

        if (name && !slugField.value) {
            slugField.value = name.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special chars
                .replace(/\s+/g, '-')     // Replace spaces with -
                .replace(/--+/g, '-');    // Replace multiple - with single -
        }
    });

    // Image removal toggle
    document.getElementById('image').addEventListener('change', function() {
        const removeCheckbox = document.getElementById('remove_image');
        if (removeCheckbox && this.files.length > 0) {
            removeCheckbox.checked = false;
        }
    });
</script>
@endpush
