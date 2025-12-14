@extends('admin.layouts.app')
@section('title', 'Edit Language')
@section('content')
@include('components.admin.page-header', [
    'title' => 'Edit Language',
    'breadcrumbs' => [
        'Ubold' => route('admin.dashboard'),
        'Languages' => route('admin.language.index'),
        'Edit' => 'active'
    ]
])

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h4 class="header-title mb-0"><i class="fas fa-edit mr-2"></i> Edit Language</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.language.update', $language->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Language Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $language->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Language Code *</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                       id="code" name="code" value="{{ old('code', $language->code) }}" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="1" {{ old('status', $language->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $language->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="flag">Flag Image</label>
                        @if($language->flag)
                            <div class="mb-2">
                                <img src="{{ Storage::disk('public')->url($language->flag) }}"
                                     alt="{{ $language->name }}"
                                     width="60"
                                     class="rounded border">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_flag" name="remove_flag">
                                    <label class="form-check-label text-danger" for="remove_flag">
                                        Remove current flag
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('flag') is-invalid @enderror"
                                   id="flag" name="flag" accept="image/*">
                            <label class="custom-file-label" for="flag">Choose new flag image...</label>
                            @error('flag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted">
                            Supported formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB
                        </small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Language
                        </button>
                        <a href="{{ route('admin.language.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show file name when selected
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("flag").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
