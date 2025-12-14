@extends('admin.layouts.guest')
@section('title', 'User Management')
@push('styles')
<style>
    /* Modern Gradient Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #06d6a0 0%, #118ab2 100%);
        --warning-gradient: linear-gradient(135deg, #ffd166 0%, #ef476f 100%);
        --info-gradient: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
        --dark-gradient: linear-gradient(135deg, #2b2d42 0%, #1a1a2e 100%);
    }

    /* Page Header Styling */
    .page-header-section {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-header-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.3;
        z-index: 1;
    }

    .page-title-wrapper {
        position: relative;
        z-index: 2;
    }

    .header-actions {
        position: relative;
        z-index: 2;
    }

    /* Stats Cards Modern Design */
    .stats-card-modern {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: white;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 1.5rem;
        height: 100%;
    }

    .stats-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .stats-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }

    .stats-card-modern.primary::before { background: var(--primary-gradient); }
    .stats-card-modern.success::before { background: var(--success-gradient); }
    .stats-card-modern.warning::before { background: var(--warning-gradient); }
    .stats-card-modern.info::before { background: var(--info-gradient); }

    .stats-icon-modern {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .stats-icon-modern.success { background: var(--success-gradient); box-shadow: 0 10px 20px rgba(6, 214, 160, 0.3); }
    .stats-icon-modern.warning { background: var(--warning-gradient); box-shadow: 0 10px 20px rgba(255, 209, 102, 0.3); }
    .stats-icon-modern.info { background: var(--info-gradient); box-shadow: 0 10px 20px rgba(76, 201, 240, 0.3); }

    .stats-number {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    /* User Table Styling */
    .users-table-wrapper {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .table-header-modern {
        background: var(--dark-gradient);
        border: none;
        padding: 1.5rem 1.5rem 0.5rem;
    }

    .table-body-modern {
        background: white;
    }

    .user-row-modern {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .user-row-modern:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.03) 0%, rgba(118, 75, 162, 0.03) 100%);
        transform: translateX(5px);
    }

    .user-avatar {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .avatar-placeholder-modern {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: var(--primary-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    /* Role Badges */
    .role-badge {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 2px solid transparent;
    }

    .role-admin {
        background: linear-gradient(135deg, rgba(239, 71, 111, 0.1) 0%, rgba(255, 209, 102, 0.1) 100%);
        color: #ef476f;
        border-color: rgba(239, 71, 111, 0.2);
    }

    .role-employee {
        background: linear-gradient(135deg, rgba(255, 209, 102, 0.1) 0%, rgba(6, 214, 160, 0.1) 100%);
        color: #ffd166;
        border-color: rgba(255, 209, 102, 0.2);
    }

    .role-user {
        background: linear-gradient(135deg, rgba(6, 214, 160, 0.1) 0%, rgba(67, 97, 238, 0.1) 100%);
        color: #06d6a0;
        border-color: rgba(6, 214, 160, 0.2);
    }

    /* Status Indicators */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 500;
    }

    .status-active {
        background: rgba(6, 214, 160, 0.1);
        color: #06d6a0;
    }

    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .status-dot.active { background: #06d6a0; }
    .status-dot.inactive { background: #6c757d; }

    /* Action Buttons */
    .action-buttons-modern {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-action.edit {
        background: rgba(67, 97, 238, 0.1);
        color: #4361ee;
        border-color: rgba(67, 97, 238, 0.2);
    }

    .btn-action.view {
        background: rgba(6, 214, 160, 0.1);
        color: #06d6a0;
        border-color: rgba(6, 214, 160, 0.2);
    }

    .btn-action.delete {
        background: rgba(239, 71, 111, 0.1);
        color: #ef476f;
        border-color: rgba(239, 71, 111, 0.2);
    }

    /* Search and Filter */
    .search-filter-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .search-input-modern {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }

    .search-input-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
    }

    .filter-dropdown {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 0.75rem;
        background: white;
        transition: all 0.3s ease;
    }

    .filter-dropdown:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
    }

    /* Empty State */
    .empty-state-modern {
        padding: 4rem 1rem;
        text-align: center;
    }

    .empty-state-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 3rem;
        color: #667eea;
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #5a6fd8;
    }

    /* Modal Styling */
    .user-modal .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .user-modal .modal-header {
        background: var(--primary-gradient);
        border-bottom: none;
        padding: 1.5rem 2rem;
    }

    .user-modal .modal-title {
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header-section {
            padding: 1.5rem;
        }

        .stats-card-modern {
            margin-bottom: 1rem;
        }

        .action-buttons-modern {
            justify-content: center;
        }

        .user-avatar, .avatar-placeholder-modern {
            width: 48px;
            height: 48px;
        }
    }

    /* Loading Animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .loading-row {
        animation: pulse 1.5s ease-in-out infinite;
    }
</style>
@endpush
@section('content')
<div class="container-fluid px-3 px-lg-4">
    <!-- Modern Page Header -->
    <div class="page-header-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-title-wrapper">
                    <h1 class="h2 mb-2">
                        <i class="fas fa-users me-3"></i>User Management
                    </h1>
                    <p class="mb-0 opacity-90">Manage and monitor all system users efficiently</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="header-actions text-end">
                    <button class="btn btn-light btn-lg me-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-light btn-lg shadow-sm">
                        <i class="fas fa-user-plus me-2"></i>Add User
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern" role="alert">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle fa-2x me-3"></i>
            </div>
            <div class="flex-grow-1">
                <h5 class="alert-heading mb-1">Success!</h5>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show alert-modern" role="alert">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
            </div>
            <div class="flex-grow-1">
                <h5 class="alert-heading mb-1">Error!</h5>
                <p class="mb-0">{{ session('error') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card-modern primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stats-icon-modern">
                                <i class="fas fa-users"></i>
                            </div>
                            <h2 class="stats-number mb-1">{{ $users->count() }}</h2>
                            <p class="text-muted mb-0">Total Users</p>
                        </div>
                        <div class="text-end">
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                            <small class="text-muted">100% of total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card-modern success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stats-icon-modern success">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h2 class="stats-number mb-1">{{ $users->where('role', 'admin')->count() }}</h2>
                            <p class="text-muted mb-0">Administrators</p>
                        </div>
                        <div class="text-end">
                            @php
                                $adminPercentage = $users->count() > 0 ? ($users->where('role', 'admin')->count() / $users->count()) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-success" style="width: {{ $adminPercentage }}%"></div>
                            </div>
                            <small class="text-muted">{{ round($adminPercentage, 1) }}% of total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card-modern warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stats-icon-modern warning">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h2 class="stats-number mb-1">{{ $users->where('role', 'employee')->count() }}</h2>
                            <p class="text-muted mb-0">Employees</p>
                        </div>
                        <div class="text-end">
                            @php
                                $employeePercentage = $users->count() > 0 ? ($users->where('role', 'employee')->count() / $users->count()) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-warning" style="width: {{ $employeePercentage }}%"></div>
                            </div>
                            <small class="text-muted">{{ round($employeePercentage, 1) }}% of total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card-modern info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stats-icon-modern info">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2 class="stats-number mb-1">{{ $users->where('role', 'user')->count() }}</h2>
                            <p class="text-muted mb-0">Standard Users</p>
                        </div>
                        <div class="text-end">
                            @php
                                $userPercentage = $users->count() > 0 ? ($users->where('role', 'user')->count() / $users->count()) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 6px; width: 100px;">
                                <div class="progress-bar bg-info" style="width: {{ $userPercentage }}%"></div>
                            </div>
                            <small class="text-muted">{{ round($userPercentage, 1) }}% of total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <div class="row g-3 align-items-center">
            {{-- <div class="col-md-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="text"
                           class="form-control search-input-modern border-start-0"
                           placeholder="Search users by name, email, or phone..."
                           id="searchInput">
                    <button class="btn btn-primary" type="button" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div> --}}
            <div class="col-md-3">
                <select class="form-select filter-dropdown" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="admin">Administrator</option>
                    <option value="employee">Employee</option>
                    <option value="user">Standard User</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select filter-dropdown" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card users-table-wrapper">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="basic-datatable">
                    <thead class="table-header-modern">
                        <tr>
                            <th class="text-white border-0">#</th>
                            <th class="text-white border-0">User Information</th>
                            <th class="text-white border-0">Role</th>
                            <th class="text-white border-0">Status</th>
                            <th class="text-white border-0">Last Active</th>
                            <th class="text-white border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-body-modern">
                        @forelse ($users as $user)
                        <tr class="user-row-modern"
                            data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}"
                            data-phone="{{ $user->phone ? strtolower($user->phone) : '' }}"
                            data-role="{{ $user->role }}"
                            data-status="active">
                            <td class="align-middle fw-bold text-primary">#{{ $loop->iteration }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        @if($user->avatar)
                                        <img src="{{ asset('uploads/avatar/' . $user->avatar) }}"
                                             alt="{{ $user->name }}"
                                             class="user-avatar"
                                             onerror="this.onerror=null;this.src='{{ asset('admin/img/user.png') }}'">
                                        @else
                                        <div class="avatar-placeholder-modern">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $user->name }}</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="mailto:{{ $user->email }}"
                                               class="text-muted text-decoration-none small">
                                                <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                            </a>
                                            @if($user->phone)
                                            <span class="text-muted small">
                                                <i class="fas fa-phone me-1"></i>{{ $user->phone }}
                                            </span>
                                            @endif
                                        </div>
                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                @if($user->role == 'admin')
                                <span class="role-badge role-admin">
                                    <i class="fas fa-crown"></i>Admin
                                </span>
                                @elseif($user->role == 'employee')
                                <span class="role-badge role-employee">
                                    <i class="fas fa-user-tie"></i>Employee
                                </span>
                                @else
                                <span class="role-badge role-user">
                                    <i class="fas fa-user"></i>User
                                </span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <span class="status-indicator status-active">
                                    <span class="status-dot active"></span>
                                    Active
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">{{ $user->created_at->diffForHumans() }}</span>
                                    <small class="text-muted">{{ $user->created_at->format('M d, Y') }}</small>
                                </div>
                            </td>
                            <td class="align-middle text-end">
                                <div class="action-buttons-modern">
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                       class="btn-action edit"
                                       data-bs-toggle="tooltip"
                                       title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn-action view"
                                            data-bs-toggle="tooltip"
                                            title="View Details"
                                            onclick="showUserDetails({{ json_encode($user) }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button"
                                            class="btn-action delete delete-user-btn"
                                            data-bs-toggle="tooltip"
                                            title="Delete User"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="empty-state-modern">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h4 class="text-muted mb-3">No Users Found</h4>
                                    <p class="text-muted mb-4">Start by adding your first user to the system</p>
                                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Add First User
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table Footer -->
        @if($users->count() > 0)
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted">
                    Showing <strong>{{ $users->count() }}</strong> users
                </span>
            </div>
            <div>
                <button class="btn btn-outline-primary btn-sm me-2" onclick="exportUsers('csv')">
                    <i class="fas fa-download me-1"></i>Export CSV
                </button>
                <button class="btn btn-outline-success btn-sm" onclick="exportUsers('pdf')">
                    <i class="fas fa-file-pdf me-1"></i>Export PDF
                </button>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade user-modal" id="userDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i>User Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="userDetailsContent">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="mb-4">
                    <i class="fas fa-trash-alt fa-4x text-danger"></i>
                </div>
                <h4 class="mb-3">Are you sure?</h4>
                <p class="text-muted mb-4" id="deleteConfirmText">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-2"></i>Delete User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-filter me-2"></i>Advanced Filters
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="advancedFilterForm">
                    <div class="mb-3">
                        <label class="form-label">Registration Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="dateFrom" placeholder="From">
                            <input type="date" class="form-control" id="dateTo" placeholder="To">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="statusActive" checked>
                            <label class="form-check-label" for="statusActive">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="statusInactive">
                            <label class="form-check-label" for="statusInactive">Inactive</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name_asc">Name (A-Z)</option>
                            <option value="name_desc">Name (Z-A)</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltips.map(tooltip => new bootstrap.Tooltip(tooltip));

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const clearSearchBtn = document.getElementById('clearSearch');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const userRows = document.querySelectorAll('.user-row-modern');

        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedRole = roleFilter.value;
            const selectedStatus = statusFilter.value;

            userRows.forEach(row => {
                const name = row.dataset.name;
                const email = row.dataset.email;
                const phone = row.dataset.phone || '';
                const role = row.dataset.role;
                const status = row.dataset.status;

                const matchesSearch = !searchTerm ||
                    name.includes(searchTerm) ||
                    email.includes(searchTerm) ||
                    phone.includes(searchTerm);

                const matchesRole = !selectedRole || role === selectedRole;
                const matchesStatus = !selectedStatus || status === selectedStatus;

                row.style.display = (matchesSearch && matchesRole && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);
        statusFilter.addEventListener('change', filterUsers);

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            filterUsers();
            searchInput.focus();
        });

        // Delete user functionality
        let userToDelete = null;

        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const userName = this.dataset.userName;

                userToDelete = userId;

                document.getElementById('deleteConfirmText').innerHTML =
                    `You are about to delete user <strong>"${userName}"</strong>. This action cannot be undone.`;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                deleteModal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (userToDelete) {
                const form = document.getElementById('deleteForm');
                form.action = `/admin/user/${userToDelete}`;
                form.submit();
            }
        });

        // Export functionality
        window.exportUsers = function(format) {
            const search = searchInput.value;
            const role = roleFilter.value;
            const status = statusFilter.value;

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (role) params.append('role', role);
            if (status) params.append('status', status);

            const url = `/admin/users/export/${format}?${params.toString()}`;
            window.open(url, '_blank');
        };

        // User details modal
        window.showUserDetails = function(user) {
            const modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
            const content = document.getElementById('userDetailsContent');

            const formattedDate = new Date(user.created_at).toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            content.innerHTML = `
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        ${user.avatar ?
                            `<img src="/uploads/avatar/${user.avatar}"
                                alt="${user.name}"
                                class="rounded-circle shadow-lg mb-3"
                                width="120"
                                height="120"
                                onerror="this.onerror=null;this.src='{{ asset('admin/img/user.png') }}'">` :
                            `<div class="rounded-circle shadow-lg d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="width: 120px; height: 120px; background: var(--primary-gradient);">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>`
                        }
                        <h4 class="mb-2">${user.name}</h4>
                        <span class="badge ${user.role === 'admin' ? 'bg-danger' : user.role === 'employee' ? 'bg-warning' : 'bg-success'} px-3 py-2 rounded-pill">
                            ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-3"><i class="fas fa-id-card me-2"></i>Contact Information</h6>
                                        <div class="mb-2">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <a href="mailto:${user.email}" class="text-decoration-none">${user.email}</a>
                                        </div>
                                        ${user.phone ? `
                                        <div class="mb-2">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            ${user.phone}
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-3"><i class="fas fa-calendar me-2"></i>Registration</h6>
                                        <div class="mb-1">
                                            <small class="text-muted">Date:</small>
                                            <div>${formattedDate}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-3"><i class="fas fa-chart-line me-2"></i>Statistics</h6>
                                        <div class="mb-1">
                                            <small class="text-muted">User ID:</small>
                                            <div class="fw-bold">${user.id}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/admin/user/${user.id}/edit" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Edit User
                            </a>
                        </div>
                    </div>
                </div>
            `;

            modal.show();
        };

        // Apply advanced filters
        window.applyFilters = function() {
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            // Implement advanced filtering logic here
            // This would typically involve an AJAX request to the server

            const filterModal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
            filterModal.hide();

            showToast('info', 'Filters applied successfully');
        };

        // Toast notification
        function showToast(type, message) {
            const toastClass = type === 'success' ? 'bg-success' : 'bg-info';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';

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

            setTimeout(() => toast.remove(), 3000);
        }

        // Auto close alerts
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
