@extends('admin.layouts.app')
@section('title', 'Edit Slider')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title">Edit Slider</h4>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Back to Sliders
                    </a>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Error!</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="title" name="title"
                                    value="{{ old('title', $slider->title) }}" required>
                                <div class="invalid-feedback">Please provide a title.</div>
                            </div>

                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <textarea class="form-control shadow-sm" id="subtitle" name="subtitle"
                                    rows="3">{{ old('subtitle', $slider->subtitle) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="store_id" class="form-label">Store <span class="text-danger">*</span></label>
                                <select name="store_id" id="store_id" class="form-select shadow-sm" required>
                                    <option value="" disabled {{ old('store_id') ? '' : 'selected' }}>-- Select Store --</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}"
                                                data-url="{{ $store->destination_url }}"
                                                data-language-id="{{ $store->language_id }}"
                                                {{ old('store_id', $slider->store_id) == $store->id ? 'selected' : '' }}>
                                            {{ $store->slug }} ({{ $store->name }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a store.</div>
                            </div>

                            <div class="mb-3">
                                <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select shadow-sm" required>
                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ old('language_id', $slider->language_id) == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }} ({{ $language->code }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a language.</div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_true"
                                            value="1" {{ old('status', $slider->status) == 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label text-success fw-medium" for="status_true">
                                            <i class="mdi mdi-check-circle-outline me-1"></i> Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_false"
                                            value="0" {{ old('status', $slider->status) == 0 ? 'checked' : '' }} required>
                                        <label class="form-check-label text-danger fw-medium" for="status_false">
                                            <i class="mdi mdi-close-circle-outline me-1"></i> Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control shadow-sm" name="sort_order" id="sort_order"
                                    value="{{ old('sort_order', $slider->sort_order) }}" placeholder="Enter sort order" required>
                                <div class="invalid-feedback">Please provide a valid sort order.</div>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Link URL</label>
                                <input type="url" class="form-control shadow-sm" name="link" id="link"
                                    value="{{ old('link', $slider->link) }}" placeholder="https://example.com">
                                <div class="invalid-feedback">Please provide a valid URL.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase text-muted mb-3">Slider Image</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Upload New Image</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control shadow-sm" name="image" id="image" accept="image/*">
                                                    <button class="btn btn-outline-secondary" type="button" id="clearImage">Clear</button>
                                                </div>
                                                <small class="form-text text-muted">Recommended size: 1920×1080 pixels (Max 2MB)</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center h-100">
                                                @if($slider->image)
                                                <div class="border p-2 rounded me-3">
                                                    <img src="{{ asset('uploads/slider/' . $slider->image) }}"
                                                        class="img-thumbnail"
                                                        alt="Current slider image"
                                                        width="120">
                                                </div>
                                                <div>
                                                    <small class="d-block text-muted">Current Image</small>
                                                    <small class="d-block">{{ $slider->image }}</small>
                                                </div>
                                                @else
                                                <div class="text-muted">
                                                    <i class="mdi mdi-image-off-outline me-1"></i> No image uploaded
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                                        <h6 class="text-muted">New Image Preview</h6>
                                        <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light px-4">
                                    <i class="mdi mdi-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="mdi mdi-content-save me-1"></i> Update Slider
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Image preview functionality
        $('#image').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#imagePreview').attr('src', event.target.result);
                    $('#imagePreviewContainer').show();
                }
                reader.readAsDataURL(file);
            }
        });

        // Clear image selection
        $('#clearImage').click(function() {
            $('#image').val('');
            $('#imagePreviewContainer').hide();
        });

        // Update URL and language when store is selected
        $('#store_id').change(function() {
            const selectedOption = $(this).find('option:selected');
            const destinationUrl = selectedOption.data('url');
            const languageId = selectedOption.data('language-id');

            // Update URL field if empty or matches the store's URL
            if (destinationUrl && (!$('#link').val() || $('#link').val() === $('#store_id').data('current-url'))) {
                $('#link').val(destinationUrl);
            }

            // Update language selection if not manually changed
            if (languageId && !$('#language_id').data('user-selected')) {
                $('#language_id').val(languageId);
            }
        });

        // Track if user manually changes language
        $('#language_id').change(function() {
            $(this).data('user-selected', true);
        });

        // Initialize store data for comparison
        $('#store_id').data('current-url', '{{ $slider->link }}');

        // Form validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    });
</script>
@endpush
