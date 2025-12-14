@extends('admin.layouts.guest')
@section('title', 'Network List')
@push('styles')
<style>
    .create-form-section .card {
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .form-floating > label {
        padding-left: 2.5rem;
        font-size: 0.875rem;
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(91, 115, 232, 0.1);
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--primary-color);
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .create-form-section .row {
            flex-direction: column;
        }

        .create-form-section .col-md-3 {
            margin-top: 1rem;
        }

        .create-form-section .btn {
            height: auto !important;
            padding: 0.75rem 1rem;
        }
    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0 text-white">
                        <i class="fas fa-network-wired me-2"></i> Network Management
                    </h4>
                    <a href="{{ route('admin.network.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-1"></i> Add Network
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Single Line Create Form -->
                <div class="create-form-section mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3">
                            <form name="CreateStore" id="CreateStore" method="POST" action="{{ route('admin.network.store') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <input type="text"
                                                   class="form-control shadow-sm @error('name') is-invalid @enderror"
                                                   name="name"
                                                   id="name"
                                                   placeholder="Enter network name"
                                                   value="{{ old('name') }}"
                                                   required>
                                            <label for="name" class="form-label">
                                                <i class="fas fa-heading me-2 text-primary"></i>Network name
                                                <span class="text-danger">*</span>
                                            </label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select shadow-sm" name="status" id="status" required>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on me-2 text-primary"></i>Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100 h-100">
                                            <i class="fas fa-plus-circle me-1"></i> Create Network
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-3">
                        <i class="fas fa-info-circle me-1"></i> The network data table displays all networks in the system. You can manage networks through this interface.
                    </p>
                </div>

                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-hover table-striped dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Network Title</th>
                                <th>Status</th>
                                <th>Audit Info</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($networks as $network)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $network->name }}</span>
                                </td>
                                <td>
                                    @if($network->status == 1)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column small">
                                        <span class="text-muted">
                                            <i class="fas fa-user-plus me-1"></i>
                                            {{ $network->user->name ?? 'N/A'}}
                                        </span>
                                        <span class="text-muted">
                                            <i class="fas fa-user-edit me-1"></i>
                                            {{ $network->updatedby->name ?? 'N/A'}}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.network.edit', $network->id) }}"
                                           class="btn btn-outline-primary rounded-start"
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.network.destroy', $network->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this network?')"
                                                    class="btn btn-outline-danger rounded-end"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end card body-->
            <div class="card-footer bg-light">
                <div class="text-muted small">
                    <i class="fas fa-database me-1"></i> Total Networks: {{ $networks->count() }}
                </div>
            </div>
        </div>
        <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection

@push('scripts')
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

// Form validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

// Add loading state to form submission
document.getElementById('CreateStore').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    if (this.checkValidity()) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Creating...';
        submitBtn.disabled = true;
    }
});
</script>
@endpush
