@extends('admin.layouts.guest')
@section('title', 'Language Management')

@push('styles')
<style>
    .language-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .language-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .flag-container {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .flag-container:hover {
        transform: scale(1.05);
        border-color: #4361ee;
    }

    .flag-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge.active {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
        border: 1px solid rgba(25, 135, 84, 0.2);
    }

    .status-badge.inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .page-header-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }

    .add-language-btn {
        background: linear-gradient(135deg, #06d6a0 0%, #118ab2 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .add-language-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
    }

    /* Modal Styling */
    .language-modal .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .language-modal .modal-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
        border-bottom: none;
        padding: 1.5rem 2rem;
    }

    .language-modal .modal-title {
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .language-modal .modal-body {
        padding: 2rem;
    }

    .form-label-with-icon {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .required-field:after {
        content: '*';
        color: #dc3545;
        margin-left: 4px;
    }

    .preview-flag {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid #e9ecef;
        margin-top: 10px;
        display: none;
    }

    .preview-flag.show {
        display: block;
    }

    /* Table Styling */
    .language-table {
        border: none;
    }

    .language-table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        padding: 1rem;
    }

    .language-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }

    .language-table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    /* Alert Styling */
    .alert-custom {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background: rgba(25, 135, 84, 0.1);
        border-left: 4px solid #198754;
        color: #0a3622;
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
        color: #842029;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header with Gradient -->
    <div class="page-header-gradient">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-2">
                    <i class="fas fa-language me-2"></i>Language Management
                </h1>
                <p class="mb-0 opacity-75">Manage all languages supported by your application</p>
            </div>
            <button class="btn add-language-btn text-white" data-bs-toggle="modal" data-bs-target="#languageModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Language
            </button>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-custom alert-dismissible fade show">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-lg me-3"></i>
            <div>
                <h6 class="mb-1">Success!</h6>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-custom alert-dismissible fade show">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
            <div>
                <h6 class="mb-1">Error!</h6>
                <p class="mb-0">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Languages Table -->
    <div class="card shadow-sm language-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table language-table" id="basic-datatable">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Language</th>
                            <th>Code</th>
                            <th width="120">Flag</th>
                            <th width="120">Status</th>
                            <th width="160" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $index => $language)
                        <tr>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-3 py-2">#{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-globe text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $language->name }}</h6>
                                        <small class="text-muted">Created {{ $language->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2">
                                    <code class="fw-bold">{{ strtoupper($language->code) }}</code>
                                </span>
                            </td>
                            <td>
                                <div class="flag-container">
                                    <img src="{{ asset('uploads/flags/' . $language->flag) }}"
                                         alt="{{ $language->name }}"
                                         class="flag-img"
                                         title="{{ $language->name }}">
                                </div>
                            </td>
                            <td>
                                <span class="status-badge {{ $language->status ? 'active' : 'inactive' }}">
                                    <i class="fas {{ $language->status ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                    {{ $language->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.language.edit', $language->id) }}"
                                       class="btn btn-icon btn-primary"
                                       data-bs-toggle="tooltip"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-icon btn-danger delete-language-btn"
                                            data-id="{{ $language->id }}"
                                            data-name="{{ $language->name }}"
                                            data-bs-toggle="tooltip"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if($languages->isEmpty())
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-language fa-4x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted mb-2">No languages found</h5>
                <p class="text-muted mb-4">Add your first language to get started!</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#languageModal">
                    <i class="fas fa-plus-circle me-2"></i>Add First Language
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add/Edit Language Modal -->
<div class="modal fade language-modal" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">
                    <i class="fas fa-language me-2"></i>Add New Language
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="Createlanguage" id="Createlanguage" method="POST" action="{{ route('admin.language.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Language Name -->
                        <div class="col-md-6">
                            <label class="form-label-with-icon required-field">
                                <i class="fas fa-font"></i>Language Name
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-language"></i>
                                </span>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="e.g., English, Spanish, French"
                                       required
                                       value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Language Code -->
                        <div class="col-md-6">
                            <label class="form-label-with-icon required-field">
                                <i class="fas fa-code"></i>Language Code
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-hashtag"></i>
                                </span>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       placeholder="e.g., en, es, fr"
                                       required
                                       value="{{ old('code') }}">
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Use ISO 639-1 language codes
                            </small>
                            @error('code')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label-with-icon required-field">
                                <i class="fas fa-toggle-on"></i>Status
                            </label>
                            <select class="form-select" name="status" required>
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Flag Upload -->
                        <div class="col-md-6">
                            <label class="form-label-with-icon required-field">
                                <i class="fas fa-flag"></i>Flag Image
                            </label>
                            <div class="input-group">
                                <input type="file"
                                       class="form-control"
                                       name="flag"
                                       id="flagInput"
                                       accept="image/*"
                                       required
                                       onchange="previewFlag(event)">
                                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('flagInput').click()">
                                    <i class="fas fa-upload"></i>
                                </button>
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Recommended size: 64x64px (PNG format)
                            </small>

                            <!-- Flag Preview -->
                            <img id="flagPreview" class="preview-flag" src="" alt="Flag preview">

                            @error('flag')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Language
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h5 class="fw-bold">Are you sure?</h5>
                    <p>You are about to delete the language: <strong id="deleteLanguageName"></strong></p>
                    <p class="text-danger">This action cannot be undone!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-2"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Flag preview function
    window.previewFlag = function(event) {
        const input = event.target;
        const preview = document.getElementById('flagPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('show');
            }

            reader.readAsDataURL(input.files[0]);
        }
    };

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Delete language functionality
    let deleteLanguageId = null;
    let deleteLanguageName = null;

    document.querySelectorAll(".delete-language-btn").forEach(button => {
        button.addEventListener("click", function () {
            deleteLanguageId = this.getAttribute("data-id");
            deleteLanguageName = this.getAttribute("data-name");

            document.getElementById("deleteLanguageName").textContent = deleteLanguageName;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });
    });

    // Confirm delete
    document.getElementById("confirmDeleteBtn").addEventListener("click", function () {
        if (deleteLanguageId) {
            const form = document.getElementById("deleteForm");
            form.action = `/admin/language/${deleteLanguageId}`;
            form.submit();
        }
    });

    // Auto focus on modal input when modal opens
    $('#languageModal').on('shown.bs.modal', function () {
        $('#languageModal input[name="name"]').focus();
    });

    // Form validation
    const languageForm = document.getElementById('Createlanguage');
    if (languageForm) {
        languageForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showToast('error', 'Please fill in all required fields.');
            }
        });
    }

    // Toast notification function
    function showToast(type, message) {
        const toastClass = type === 'success' ? 'bg-success' : 'bg-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

        const toast = $(`
            <div class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
                <div class="toast align-items-center text-white ${toastClass} border-0 show" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas ${icon} me-2"></i>${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        `).appendTo('body');

        setTimeout(function() {
            toast.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

    // Auto close alerts after 5 seconds
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
});
</script>
@endpush
