@extends('employee.layouts.guest')
@section('title', 'Store List')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="header-title">Store Management</h4>
                        <p class="text-muted mb-0">Manage all stores in the system. View, edit, or delete stores below.</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('employee.store.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New Store
                        </a>
                        <a href="{{ route('employee.coupon.create') }}" class="btn btn-warning">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New Coupon
                        </a>
                    </div>
                </div>

                <!-- Filter -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-2">Filter Stores by Language</h5>
                        <p class="text-muted">Select a language to filter the list of stores below.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-inline-block" style="min-width: 250px;">
                            <label for="languageSelect" class="form-label fw-semibold">Select Language</label>
                            <select class="form-select" id="languageSelect" name="language_id">
                                <option value="">All Languages</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}" {{ $selectedLanguage == $language->id ? 'selected' : '' }}>
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle-outline me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle-outline me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Store Table -->
                <form id="deleteForm" action="{{ route('employee.store.deleteSelected') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-hover table-centered mb-0 dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Network</th>
                                    <th>Language</th>
                                    <th>Status</th>
                                    <th>Created / Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="storeList">
                              @include('employee.stores.partials.store-list')
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Delete -->
                    <div class="mt-3">
                        <button id="deleteSelected" class="btn btn-danger">
                            <i class="mdi mdi-delete"></i> Delete Selected
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Filter by language
    $('#languageSelect').on('change', function () {
        const languageId = $(this).val();
        fetch(`{{ route('employee.store.index') }}?language_id=${languageId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => $('#storeList').html(data.html));
    });

    // Select all checkboxes
    $('#selectAll').on('click', function () {
        $('.select-checkbox').prop('checked', this.checked);
    });

    // Bulk delete
    $('#deleteSelected').click(function (e) {
        e.preventDefault();
        const selected = $('.select-checkbox:checked').length;
        if (selected > 0) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${selected} store(s).`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then(result => {
                if (result.isConfirmed) $('#deleteForm').submit();
            });
        } else {
            Swal.fire('No Selection', 'Please select at least one store to delete.', 'info');
        }
    });

    // Single delete via anchor tag
    $(document).on('click', '.delete-store-btn', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete Store?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/employee/store/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        $(`#store-row-${id}`).remove();
                        Swal.fire('Deleted!', 'Store has been deleted.', 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong while deleting.', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    .table th { white-space: nowrap; vertical-align: middle; }
    .table td { vertical-align: middle; }
    .badge { font-size: 0.75em; font-weight: 500; padding: 4px 8px; }
    .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
    .card { border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
</style>
@endpush
