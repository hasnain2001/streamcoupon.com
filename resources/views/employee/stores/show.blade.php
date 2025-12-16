@extends('employee.layouts.guest')
@section('title', 'Store Details - ' . $store->name)
@section('content')
<main class="container-fluid px-0">
    <div class="content-wrapper">
        <!-- Enhanced Breadcrumb -->
        <div class="page-title-box mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="page-title mb-1">
                        <i class="fas fa-store me-2 text-primary"></i>{{ $store->name }}
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Ubold</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employee.store.index') }}">Stores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Store Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="btn-group">
                        <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Edit Store
                        </a>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('employee.store.destroy', $store->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure to delete this store?')">
                                        <i class="fas fa-trash-alt me-2"></i> Delete Store
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store Overview Cards -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon primary">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3>{{ $coupons->count() }}</h3>
                        <p class="text-muted">Total Coupons</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>{{ $coupons->where('status', 1)->count() }}</h3>
                        <p class="text-muted">Active Coupons</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $coupons->count() > 0 ? ($coupons->where('status', 1)->count() / $coupons->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon warning">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3>{{ $coupons->where('code', '!=', null)->count() }}</h3>
                        <p class="text-muted">Code Coupons</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $coupons->count() > 0 ? ($coupons->where('code', '!=', null)->count() / $coupons->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card stats-card border-0">
                    <div class="card-body">
                        <div class="stats-icon info">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h3>{{ $coupons->where('code', null)->count() }}</h3>
                        <p class="text-muted">Deal Coupons</p>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-info" role="progressbar"
                                 style="width: {{ $coupons->count() > 0 ? ($coupons->where('code', null)->count() / $coupons->count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Store Information Column -->
            <div class="col-lg-4">
                <!-- Store Profile Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-info-circle me-2"></i>Store Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img class="img-thumbnail rounded-circle border-4 border-primary shadow-sm"
                                 src="{{ asset('uploads/stores/' . $store->image) }}"
                                 style="width: 120px; height: 120px; object-fit: contain;"
                                 loading="lazy"
                                 alt="{{ $store->name }}"
                                 onerror="this.src='{{ asset('employee/img/default-store.png') }}'">
                            <h4 class="mt-3 mb-1">{{ $store->name }}</h4>
                            <p class="text-muted">{{ $store->slug }}</p>
                        </div>

                        <div class="store-details">
                            <div class="detail-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-network-wired me-2 text-primary"></i>Network
                                    </span>
                                    <span class="fw-semibold">{{ $store->network->title ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="detail-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-list me-2 text-primary"></i>Category
                                    </span>
                                    <span class="fw-semibold">{{ $store->category->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="detail-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-language me-2 text-primary"></i>Language
                                    </span>
                                    <span class="fw-semibold">{{ $store->language->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detail-item mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-plus me-2 text-primary"></i>Created
                                    </span>
                                    <small class="text-muted">{{ $store->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-check me-2 text-primary"></i>Updated
                                    </span>
                                    <small class="text-muted">{{ $store->updated_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCouponModal" onclick="setCurrentStore()">
                                <i class="fas fa-plus-circle me-2"></i>Add New Coupon
                            </button>
                            <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Edit Store Details
                            </a>
                            <a href="{{ route('employee.store.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Stores
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coupons Column -->
            <div class="col-lg-8">
                <!-- Coupons Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-tags me-2"></i>Store Coupons
                            <span class="badge bg-primary ms-2">{{ $coupons->count() }}</span>
                        </h5>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm me-2" style="width: 200px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search coupons..." id="searchCoupons">
                            </div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCouponModal" onclick="setCurrentStore()">
                                <i class="fas fa-plus-circle me-1"></i> Add Coupon
                            </button>
                        </div>
                    </div>

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

                    <div class="card-body p-0">
                        @if($coupons->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="40px" class="ps-3">#</th>
                                        <th width="40px">Sort</th>
                                        <th>Coupon Details</th>
                                        <th width="100px">Type</th>
                                        <th width="100px">Status</th>
                                        <th width="200px">Audit Info</th>
                                        <th width="120px" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tablecontents">
                                    @foreach($coupons as $coupon)
                                    <tr class="row1" data-id="{{ $coupon->id }}">
                                        <td class="ps-3">
                                            <div class="fw-semibold text-muted">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="handle">
                                            <i class="fas fa-arrows-alt text-muted" data-bs-toggle="tooltip" title="Drag to reorder"></i>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1 fw-semibold">{{ $coupon->name ?: 'N/A' }}</h6>
                                                    @if($coupon->code)
                                                    <div class="d-flex align-items-center mt-1">
                                                        <span class="badge bg-light text-dark me-2">Code:</span>
                                                        <code class="text-primary fw-bold">{{ $coupon->code }}</code>
                                                    </div>
                                                    @endif
                                                    @if($coupon->description)
                                                    <small class="text-muted d-block mt-1">{{ Str::limit($coupon->description, 50) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($coupon->code)
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-code me-1"></i> Code
                                                </span>
                                            @else
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-percentage me-1"></i> Deal
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($coupon->status == 1)
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Active
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $created = $coupon->created_at ? $coupon->created_at->setTimezone('Asia/Karachi') : null;
                                                $updated = $coupon->updated_at ? $coupon->updated_at->setTimezone('Asia/Karachi') : null;
                                            @endphp
                                            <div class="audit-info">
                                                <div class="d-flex align-items-center mb-1">
                                                    <div>
                                                        @if($created)
                                                            <small class="text-muted">
                                                                Created: {{ $created->format('M d, Y, h:i A') }}
                                                                ({{ $created->format('T') }}) · {{ $created->diffForHumans() }}
                                                            </small>
                                                        @else
                                                            <small class="text-muted">Created: N/A</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        @if($updated)
                                                            <small class="text-muted">
                                                                Updated: {{ $updated->format('M d, Y, h:i A') }}
                                                                ({{ $updated->format('T') }}) · {{ $updated->diffForHumans() }}
                                                            </small>
                                                        @else
                                                            <small class="text-muted">Updated: N/A</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('employee.coupon.edit', $coupon->id) }}"
                                                   class="btn btn-outline-primary rounded-start"
                                                   data-bs-toggle="tooltip"
                                                   title="Edit Coupon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('employee.coupon.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-outline-danger rounded-end"
                                                            onclick="return confirm('Are you sure you want to delete this coupon?')"
                                                            data-bs-toggle="tooltip"
                                                            title="Delete Coupon">
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
                        @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Coupons Found</h4>
                                <p class="text-muted mb-4">This store doesn't have any coupons yet.</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCouponModal" onclick="setCurrentStore()">
                                    <i class="fas fa-plus-circle me-1"></i> Create First Coupon
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($coupons->count() > 0)
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                <i class="fas fa-info-circle me-1"></i> Drag and drop to reorder coupons
                            </span>
                            <span class="text-muted small">
                                Showing {{ $coupons->count() }} coupon(s)
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Create Coupon Modal (Non-scrolling) -->
    <div class="modal fade" id="createCouponModal" tabindex="-1" aria-labelledby="createCouponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-primary text-white py-3">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-ticket-alt fa-lg text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="modal-title mb-1" id="createCouponModalLabel">Create New Coupon</h5>
                            <p class="mb-0 opacity-75">Add a new coupon for <strong id="currentStoreName">{{ $store->name }}</strong></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form name="CreateStore" id="CreateStore" method="POST" enctype="multipart/form-data"
                      action="{{ route('employee.coupon.store') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="modal-body p-4" style="max-height: 60vh; overflow-y: auto;">
                        <div class="row g-3">
                            <!-- Basic Information -->
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 text-primary">
                                            <i class="fas fa-info-circle me-2"></i>Basic Information
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label fw-semibold">Coupon Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-sm" name="name" id="name"
                                                        value="{{ old('name') }}" required placeholder="e.g. Summer Sale 2024">
                                                    <div class="invalid-feedback">Please provide a coupon name.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="ending_date" class="form-label fw-semibold">Expiry Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control shadow-sm" name="ending_date" id="ending_date"
                                                        value="{{ old('ending_date') }}" required min="{{ date('Y-m-d') }}">
                                                    <div class="invalid-feedback">Please select a valid future date.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-semibold">Description</label>
                                            <textarea name="description" id="description" class="form-control shadow-sm" rows="2"
                                                      placeholder="Brief description about the coupon offer">{{ old('description') }}</textarea>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="toggleCodeCheckbox"
                                                            onchange="toggleCodeInput(this)" {{ old('code') ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-semibold" for="toggleCodeCheckbox">
                                                            <i class="fas fa-code me-1"></i>Enable Custom Code
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3" id="codeInputGroup">
                                                    <label for="code" class="form-label fw-semibold">Coupon Code</label>
                                                    <input type="text" class="form-control shadow-sm" name="code" id="code"
                                                           value="{{ old('code') }}" placeholder="e.g. SUMMER20">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Store & Settings -->
                            <div class="col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 text-primary">
                                            <i class="fas fa-store me-2"></i>Store & Settings
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="store_id" class="form-label fw-semibold">Store <span class="text-danger">*</span></label>
                                                    <select name="store_id" id="store_id" class="form-select shadow-sm" onchange="updateLanguage()" required>
                                                        <option value="" disabled>-- Select Store --</option>
                                                        @foreach($stores as $storeOption)
                                                            <option value="{{ $storeOption->id }}"
                                                                    data-language-id="{{ $storeOption->language_id }}"
                                                                    {{ $storeOption->id == $store->id ? 'selected' : (old('store_id') == $storeOption->id ? 'selected' : '') }}>
                                                                {{ $storeOption->name }} ({{ $storeOption->slug }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-text text-success small">
                                                        <i class="fas fa-check-circle me-1"></i>
                                                        <span id="storeSelectionInfo">Automatically selected: {{ $store->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="language_id" class="form-label fw-semibold">Language <span class="text-danger">*</span></label>
                                                    <select name="language_id" id="language_id" class="form-select shadow-sm" required>
                                                        <option value="" disabled>-- Select Language --</option>
                                                        @foreach($languages as $language)
                                                            <option value="{{ $language->id }}"
                                                                    {{ $language->id == $store->language_id ? 'selected' : (old('language_id') == $language->id ? 'selected' : '') }}>
                                                                {{ $language->name }} ({{ strtoupper($language->code) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Priority Rating <span class="text-danger">*</span></label>
                                                    <select name="top_coupons" class="form-select shadow-sm" required>
                                                        @for ($i = 0; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ old('top_coupons', 0) == $i ? 'selected' : '' }}>
                                                                Priority {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <div class="form-text small">
                                                        Higher numbers appear first in listings
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                                    <div class="btn-group w-100" role="group">
                                                        <input type="radio" class="btn-check" name="status" id="enable" value="1" checked>
                                                        <label class="btn btn-outline-success" for="enable">
                                                            <i class="fas fa-check-circle me-1"></i> Active
                                                        </label>
                                                        <input type="radio" class="btn-check" name="status" id="disable" value="0">
                                                        <label class="btn btn-outline-danger" for="disable">
                                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer (Always Visible) -->
                    <div class="modal-footer bg-light border-top">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="reset" class="btn btn-outline-warning">
                            <i class="fas fa-redo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-1"></i> Create Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
<script>
    // Set current store when modal opens
    function setCurrentStore() {
        const currentStoreId = {{ $store->id }};
        const storeSelect = document.getElementById('store_id');
        const currentStoreName = document.getElementById('currentStoreName');
        const storeSelectionInfo = document.getElementById('storeSelectionInfo');

        if (storeSelect && currentStoreName && storeSelectionInfo) {
            storeSelect.value = currentStoreId;
            currentStoreName.textContent = '{{ $store->name }}';
            storeSelectionInfo.textContent = `Automatically selected: {{ $store->name }}`;
            updateLanguage();
        }
    }

    // Update language based on store selection
    function updateLanguage() {
        const storeSelect = document.getElementById('store_id');
        const languageSelect = document.getElementById('language_id');

        if (storeSelect && languageSelect) {
            const selectedOption = storeSelect.options[storeSelect.selectedIndex];
            const languageId = selectedOption.getAttribute('data-language-id');

            if (languageId) {
                languageSelect.value = languageId;
            }
        }
    }

    // Toggle code input visibility
    function toggleCodeInput(checkbox) {
        const group = document.getElementById('codeInputGroup');
        if (checkbox.checked) {
            group.style.display = 'block';
        } else {
            group.style.display = 'none';
            document.getElementById('code').value = '';
        }
    }

    // Search functionality
    document.getElementById('searchCoupons').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#tablecontents tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize code input toggle
        const checkbox = document.getElementById('toggleCodeCheckbox');
        if (checkbox) {
            toggleCodeInput(checkbox);
        }

        // Date validation
        const dateInput = document.getElementById('ending_date');
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    this.setCustomValidity('Please select a future date.');
                    this.classList.add('is-invalid');
                } else {
                    this.setCustomValidity('');
                    this.classList.remove('is-invalid');
                }
            });
        }

        // Form submission loading state
        const form = document.getElementById('CreateStore');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('submitBtn');
                if (submitBtn && this.checkValidity()) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Creating...';
                    submitBtn.disabled = true;
                }
            });
        }

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Make table rows sortable
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            handle: '.handle',
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('employee.coupon.update-order') }}",
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == "success") {
                        // Show success toast
                        const toast = new bootstrap.Toast(document.getElementById('orderToast'));
                        toast.show();
                    }
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
.stats-card {
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

.store-details .detail-item {
    padding: 0.5rem 0;
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

.handle {
    cursor: move;
    transition: color 0.3s ease;
}

.handle:hover {
    color: var(--primary-color) !important;
}

.empty-state {
    padding: 3rem 1rem;
}

.card {
    border-radius: 1rem;
}

.btn {
    border-radius: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
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

.modal-content {
    border-radius: 1rem;
    overflow: hidden;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
}

.avatar-sm {
    width: 40px;
    height: 40px;
}

/* Ensure modal footer is always visible */
.modal-footer {
    position: sticky;
    bottom: 0;
    background: white;
    z-index: 10;
}
</style>
@endpush


<!-- Success Toast for Order Update -->
<div class="toast position-fixed top-0 end-0 m-3" id="orderToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-success text-white">
        <i class="fas fa-check-circle me-2"></i>
        <strong class="me-auto">Success</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">
        Coupon order updated successfully!
    </div>
</div>
