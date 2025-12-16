@extends('employee.layouts.app')
@section('title', 'Blog Management')
@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="page-title mb-1">
                        <i class="fas fa-blog me-2 text-primary"></i>Blog Management
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Ubold</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <a href="{{ route('employee.blog.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i> Add New Blog
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-3">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3>{{ $blogs->count() }}</h3>
                        <p class="text-muted">Total Blogs</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-3">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>{{ $blogs->where('status', 1)->count() }}</h3>
                        <p class="text-muted">Active Blogs</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $blogs->count() > 0 ? ($blogs->where('status', 1)->count() / $blogs->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-3">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon warning">
                            <i class="fas fa-pause-circle"></i>
                        </div>
                        <h3>{{ $blogs->where('status', 0)->count() }}</h3>
                        <p class="text-muted">Inactive Blogs</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $blogs->count() > 0 ? ($blogs->where('status', 0)->count() / $blogs->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-3">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon info">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3>{{ $blogs->groupBy('category_id')->count() }}</h3>
                        <p class="text-muted">Categories Used</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blogs Table Card -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-list me-2"></i>Blogs List
                        </h5>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" placeholder="Search blogs..." id="searchBlogs">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Success Message -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Success!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-0" id="blogsTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Blog Info</th>
                                <th class="border-0">Category</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Language</th>
                                <th class="border-0">Audit Info</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                            <tr class="blog-row">
                                <td class="align-middle">
                                    <div class="fw-semibold text-muted">{{ $loop->iteration }}</div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded shadow-sm border"
                                                 src="{{ asset('uploads/' . $blog->image) }}"
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 alt="{{ $blog->name }}"
                                                 onerror="this.src='{{ asset('employee/img/default-blog.png') }}'">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-semibold">{{ Str::limit($blog->name, 50) }}</h6>
                                            <small class="text-muted">ID: {{ $blog->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if ($blog->category)
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                            <i class="fas fa-tag me-1"></i>{{ $blog->category->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="fas fa-tag me-1"></i>N/A
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($blog->status == 1)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if(isset($blog->language) && !empty($blog->language->name))
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                            <i class="fas fa-language me-1"></i>{{ $blog->language->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="fas fa-language me-1"></i>N/A
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="audit-info">
                                        <div class="d-flex align-items-center mb-2">

                                            <div>
                                                <div class="fw-semibold small">{{ $blog->user->name }}</div>
                                                <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                        @if($blog->updatedby)
                                        <div class="d-flex align-items-center">

                                            <div>
                                                <div class="fw-semibold small">{{ $blog->updatedby->name }}</div>
                                                <small class="text-muted">{{ $blog->updated_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('employee.blog.show', $blog->id) }}"
                                           class="btn btn-outline-info btn-sm rounded-start-3 px-3"
                                           data-bs-toggle="tooltip"
                                           title="View Blog">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('employee.blog.edit', $blog->id) }}"
                                           class="btn btn-outline-primary btn-sm px-3"
                                           data-bs-toggle="tooltip"
                                           title="Edit Blog">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employee.blog.destroy', $blog->id) }}"
                                              method="POST"
                                              class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm rounded-end-3 px-3 delete-btn"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete Blog"
                                                    data-blog-name="{{ $blog->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-blog fa-4x text-muted mb-3"></i>
                                        <h4 class="text-muted">No Blogs Found</h4>
                                        <p class="text-muted mb-4">Get started by creating your first blog post.</p>
                                        <a href="{{ route('employee.blog.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus-circle me-2"></i>Create First Blog
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete blog "<strong id="deleteBlogName"></strong>"?</p>
                <p class="text-muted small">This action cannot be undone and all associated data will be lost.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Blog</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchBlogs').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('.blog-row');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Delete confirmation with modal
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteForm = document.getElementById('deleteForm');
    const deleteBlogName = document.getElementById('deleteBlogName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const blogName = this.getAttribute('data-blog-name');
            const form = this.closest('.delete-form');

            deleteBlogName.textContent = blogName;
            deleteForm.action = form.action;
            deleteModal.show();
        });
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Export functionality (optional)
function exportBlogs(format) {
    // Implement export functionality here
    alert(`Exporting blogs as ${format.toUpperCase()} - This would be implemented with a backend endpoint.`);
}
</script>
@endpush

@push('styles')
<style>
.stats-card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1rem;
}

.stats-icon.primary { background: linear-gradient(135deg, #5b73e8, #4b60d2); }
.stats-icon.success { background: linear-gradient(135deg, #34c38f, #27a876); }
.stats-icon.warning { background: linear-gradient(135deg, #f1b44c, #e6a841); }
.stats-icon.info { background: linear-gradient(135deg, #50a5f1, #3d8fd6); }

.page-title-box {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.avatar-xs {
    width: 24px;
    height: 24px;
    font-size: 0.75rem;
}

.audit-info .avatar-title {
    font-size: 0.7rem;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.blog-row:hover {
    background-color: rgba(91, 115, 232, 0.02);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.empty-state {
    padding: 3rem 1rem;
}

.card {
    border-radius: 1rem;
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
    font-weight: 500;
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

.input-group-text {
    background-color: #f8f9fa;
    border-color: #e9ecef;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}
</style>
@endpush
