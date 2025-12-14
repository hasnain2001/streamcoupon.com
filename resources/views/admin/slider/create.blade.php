@extends('admin.layouts.app')
@section('title', 'Create Slider')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title text-white mb-0">Create New Slider</h4>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Sliders
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i> Validation Error</h5>
                        <hr>
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="createSliderForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-2 shadow-sm" name="title" id="title"
                                       value="{{ old('title') }}" placeholder="Enter slider title" required>
                                <div class="invalid-feedback">Please provide a title.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="subtitle" class="form-label fw-bold">Subtitle <span class="text-danger">*</span></label>
                                <textarea class="form-control border-2 shadow-sm" name="subtitle" id="subtitle"
                                          rows="3" placeholder="Enter slider subtitle" >{{ old('subtitle') }}</textarea>
                                <div class="invalid-feedback">Please provide a subtitle.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="store_id" class="form-label fw-bold">Store <span class="text-danger">*</span></label>
                                <select name="store_id" id="store_id" class="form-select border-2 shadow-sm" required>
                                    <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>-- Select Store --</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}"
                                                data-url="{{ $store->destination_url }}"
                                                data-language-id="{{ $store->language_id }}"
                                                {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                            {{ $store->slug }} ({{ $store->name }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a store.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="language_id" class="form-label fw-bold">Language <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select border-2 shadow-sm" required>
                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }} ({{ $language->code }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a language.</div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold d-block">Status <span class="text-danger">*</span></label>
                                <div class="btn-group btn-group-toggle w-100 shadow-sm" data-toggle="buttons">
                                    <label class="btn btn-outline-success {{ old('status') === '1' || old('status') === null ? 'active' : '' }}">
                                        <input type="radio" name="status" id="status_true" value="1" {{ old('status') === '1' || old('status') === null ? 'checked' : '' }} required> Active
                                    </label>
                                    <label class="btn btn-outline-danger {{ old('status') === '0' ? 'active' : '' }}">
                                        <input type="radio" name="status" id="status_false" value="0" {{ old('status') === '0' ? 'checked' : '' }}> Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="sort_order" class="form-label fw-bold">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-2 shadow-sm" name="sort_order" id="sort_order"
                                       value="{{ old('sort_order', 0) }}" placeholder="Enter sort order" min="0" required>
                                <div class="invalid-feedback">Please provide a valid sort order.</div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="link" class="form-label fw-bold">Link <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-2"><i class="fas fa-link"></i></span>
                                    <input type="url" class="form-control border-2 shadow-sm" name="link" id="link"
                                           value="{{ old('link') }}" placeholder="Enter slider link" required>
                                    <div class="invalid-feedback">Please provide a valid URL.</div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="form-label fw-bold">Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input border-2 shadow-sm" name="image" id="image" accept="image/*" required>
                                    <label class="custom-file-label" for="image">Choose image file</label>
                                    <div class="invalid-feedback">Please select an image file.</div>
                                </div>
                                <small class="form-text text-muted mt-1">Recommended size: 1920x1080 pixels (JPG, PNG, or WebP)</small>
                                <div class="mt-2" id="image-preview-container" style="display: none;">
                                    <img id="image-preview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="reset" class="btn btn-outline-secondary px-4 py-2 me-2">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow">
                                <i class="fas fa-plus-circle mr-1"></i> Create Slider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show selected file name in file input and preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileName = file.name;
            const label = e.target.nextElementSibling;
            label.innerText = fileName;

            // Show image preview
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('image-preview');
                preview.src = event.target.result;
                document.getElementById('image-preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Update URL and language when store is selected
    document.getElementById('store_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const destinationUrl = selectedOption.getAttribute('data-url');
        const languageId = selectedOption.getAttribute('data-language-id');

        // Update URL field
        if (destinationUrl) {
            document.getElementById('link').value = destinationUrl;
        }

        // Update language selection
        if (languageId) {
            const languageSelect = document.getElementById('language_id');
            for (let i = 0; i < languageSelect.options.length; i++) {
                if (languageSelect.options[i].value === languageId) {
                    languageSelect.selectedIndex = i;
                    break;
                }
            }
        }
    });

    // Bootstrap validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            const form = document.getElementById('createSliderForm');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>
@endpush
