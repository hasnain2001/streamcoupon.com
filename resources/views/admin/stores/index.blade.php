@extends('admin.layouts.guest')
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
                        <a href="{{ route('admin.store.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New Store
                        </a>
                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-warning">
                            <i class="mdi mdi-tag-plus-outline"></i> Add New Coupon
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
                <form id="deleteForm" action="{{ route('admin.store.deleteSelected') }}" method="POST">
                    @csrf
                    @method('DELETE')
 </form>
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-hover align-middle mb-0 dt-responsive nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th width="40"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                    <th width="50">#</th>
                                    <th width="80">ID</th>
                                    <th>Store Info</th>
                                    <th width="120">Category</th>
                                    <th width="120">Network</th>
                                    <th width="120">Language</th>
                                    <th width="100">Status</th>
                                    <th width="180">Timeline</th>
                                    <th width="150" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="storeList">
                                @include('admin.stores.partials.store-list')
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Delete -->
                    <div class="mt-3" id="bulkActions" style="display: none;">
                        <button id="deleteSelected" class="btn btn-danger">
                            <i class="mdi mdi-delete"></i> Delete Selected Stores
                        </button>
                        <span class="ms-2 text-muted" id="selectedCount">0 stores selected</span>
                    </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function () {
        // Filter by language
        $('#languageSelect').on('change', function () {
            const languageId = $(this).val();
            const url = languageId ?
                `{{ route('admin.store.index') }}?language_id=${languageId}` :
                `{{ route('admin.store.index') }}`;

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.html) {
                    $('#storeList').html(data.html);
                    table.destroy();
                    $('#basic-datatable').DataTable({
                        responsive: true,
                        paging: true,
                        lengthChange: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        pageLength: 10,
                        language: {
                            search: "<i class='mdi mdi-magnify'></i>",
                            searchPlaceholder: "Search stores...",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ stores",
                            paginate: {
                                previous: "<i class='mdi mdi-chevron-left'></i>",
                                next: "<i class='mdi mdi-chevron-right'></i>"
                            }
                        },
                        columnDefs: [
                            { orderable: false, targets: [0, 9] },
                            { searchable: false, targets: [0, 1, 2, 4, 5, 6, 7, 8, 9] },
                            { className: "text-center", targets: [0, 1, 2, 7, 9] }
                        ],
                        order: [[2, 'desc']]
                    });
                    resetSelection(); // Reset selection after filter
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Failed to load stores. Please try again.', 'error');
            });
        });

        // Select all checkboxes
        $('#selectAll').on('click', function () {
            const isChecked = this.checked;
            $('.select-checkbox').prop('checked', isChecked);
            updateBulkActions();
        });

        // Update bulk actions when individual checkboxes change
        $(document).on('change', '.select-checkbox', function() {
            updateBulkActions();
        });

        // Update bulk actions visibility and selected count
        function updateBulkActions() {
            const selectedCount = $('.select-checkbox:checked').length;
            const bulkActions = $('#bulkActions');
            const selectedCountText = $('#selectedCount');

            if (selectedCount > 0) {
                bulkActions.fadeIn(300);
                selectedCountText.text(`${selectedCount} store${selectedCount > 1 ? 's' : ''} selected`);
            } else {
                bulkActions.fadeOut(300);
            }

            // Update select all checkbox state
            const totalCheckboxes = $('.select-checkbox').length;
            $('#selectAll').prop('checked', selectedCount === totalCheckboxes && totalCheckboxes > 0);
        }

        // Reset selection
        function resetSelection() {
            $('.select-checkbox').prop('checked', false);
            $('#selectAll').prop('checked', false);
            updateBulkActions();
        }

        // Bulk delete
        $('#deleteSelected').click(function (e) {
            e.preventDefault();
            const selected = $('.select-checkbox:checked').length;

            if (selected > 0) {
                Swal.fire({
                    title: 'Delete Stores?',
                    text: `You are about to delete ${selected} store${selected > 1 ? 's' : ''}. This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then(result => {
                    if (result.isConfirmed) {
                        // Show loading state
                        $(this).html('<i class="mdi mdi-loading mdi-spin"></i> Deleting...').prop('disabled', true);
                        $('#deleteForm').submit();
                    }
                });
            } else {
                Swal.fire({
                    title: 'No Selection',
                    text: 'Please select at least one store to delete.',
                    icon: 'info',
                    confirmButtonColor: '#3085d6'
                });
            }
        });

        // Single delete via anchor tag
        $(document).on('click', '.delete-store-btn', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            const storeName = $(this).closest('tr').find('.store-name').text() || 'this store';

            Swal.fire({
                title: 'Delete Store?',
                text: `You are about to delete "${storeName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading on the button
                    const deleteBtn = $(this);
                    const originalHtml = deleteBtn.html();
                    deleteBtn.html('<i class="mdi mdi-loading mdi-spin"></i>').prop('disabled', true);

                    $.ajax({
                        url: `/admin/store/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                $(`#store-row-${id}`).fadeOut(300, function() {
                                    $(this).remove();
                                    // Reload the table data
                                    table.ajax.reload();
                                });
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Store has been deleted successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6'
                                });
                            }
                        },
                        error: function (xhr) {
                            deleteBtn.html(originalHtml).prop('disabled', false);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong while deleting the store.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                }
            });
        });

        // Initialize bulk actions on page load
        updateBulkActions();
    });
</script>
@endpush

@push('styles')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: none;
    }

    .table th {
        white-space: nowrap;
        vertical-align: middle;
        font-weight: 600;
        font-size: 0.875rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }

    .badge {
        font-size: 0.75em;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
        border-radius: 6px;
    }

    .store-image {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: transform 0.2s ease;
    }

    .store-image:hover {
        transform: scale(1.05);
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        padding: 4px 8px;
    }

    /* Hover effects for table rows */
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.04);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Custom scrollbar for table */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endpush
