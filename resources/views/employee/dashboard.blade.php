@extends('employee.layouts.app')
@section('title', 'Employee Dashboard')
@section('content')

    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card bg-gradient-primary text-white rounded-3 p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2">Welcome back, {{ Auth::user()->name ?? 'Employee' }}! 👋</h2>
                        <p class="mb-0 opacity-75">Here's what's happening with your stores and coupons today.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="date-display">
                            <h4 class="mb-1">{{ now()->format('l') }}</h4>
                            <p class="mb-0 opacity-75">{{ now()->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <!-- Total Stores Managed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="text-primary mb-1">{{ $stores->count() }}</h3>
                            <p class="text-muted mb-2">Stores Managed</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-store me-1"></i>
                                    {{ $stores->where('status', '1')->count() }} Active
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-store text-primary"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        @php
                            $activeStoresCount = $stores->where('status', '1')->count();
                            $storesProgress = $stores->count() > 0 ? ($activeStoresCount / $stores->count()) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $storesProgress }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Coupons Managed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="text-warning mb-1">{{ $coupons->count() }}</h3>
                            <p class="text-muted mb-2">Coupons Managed</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $coupons->where('status', '1')->count() }} Active
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-tag text-warning"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        @php
                            $activeCouponsCount = $coupons->where('status', '1')->count();
                            $couponsProgress = $coupons->count() > 0 ? ($activeCouponsCount / $coupons->count()) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $couponsProgress }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Activity -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="text-success mb-1">{{ $todayCoupons->count() + $todayStores->count() }}</h3>
                            <p class="text-muted mb-2">Today's Activity</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-bolt me-1"></i>
                                    {{ $todayCoupons->count() }} New
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-chart-line text-success"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        @php
                            $totalActivity = $todayCoupons->count() + $todayStores->count();
                            $activityProgress = min(100, ($totalActivity / 10) * 100);
                        @endphp
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $activityProgress }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Score -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="text-info mb-1">
                                @php
                                    $performanceScore = min(100,
                                        ($stores->where('status', '1')->count() * 2) +
                                        ($coupons->where('status', '1')->count() * 1) +
                                        (($todayCoupons->count() + $todayStores->count()) * 5)
                                    );
                                @endphp
                                {{ $performanceScore }}%
                            </h3>
                            <p class="text-muted mb-2">Performance Score</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-trophy me-1"></i>
                                    @if($performanceScore >= 80) Excellent
                                    @elseif($performanceScore >= 60) Good
                                    @else Needs Improvement
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-award text-info"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $performanceScore }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row mt-4">
        <!-- Quick Actions -->
        <div class="col-xl-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-rocket text-primary me-2"></i>Quick Actions
                    </h5>
                    <div class="quick-actions">
                        <a href="{{ route('employee.store.create') }}" class="action-item d-flex align-items-center p-3 border rounded-3 mb-3 text-decoration-none">
                            <div class="action-icon bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-plus text-primary"></i>
                            </div>
                            <div class="action-content">
                                <h6 class="mb-1 text-dark">Add New Store</h6>
                                <small class="text-muted">Create a new store entry</small>
                            </div>
                        </a>

                        <a href="{{ route('employee.coupon.create') }}" class="action-item d-flex align-items-center p-3 border rounded-3 mb-3 text-decoration-none">
                            <div class="action-icon bg-warning bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-tag text-warning"></i>
                            </div>
                            <div class="action-content">
                                <h6 class="mb-1 text-dark">Create Coupon</h6>
                                <small class="text-muted">Add new discount coupon</small>
                            </div>
                        </a>

                        <a href="{{ route('employee.store.index') }}" class="action-item d-flex align-items-center p-3 border rounded-3 text-decoration-none">
                            <div class="action-icon bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-list text-success"></i>
                            </div>
                            <div class="action-content">
                                <h6 class="mb-1 text-dark">Manage Stores</h6>
                                <small class="text-muted">View all stores</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Coupons -->
        <div class="col-xl-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-history text-info me-2"></i>Recent Coupons
                        </h5>
                        <a href="{{ route('employee.coupon.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="recent-coupons">
                        @forelse($recentCoupons as $coupon)
                        <div class="coupon-item d-flex align-items-center p-3 border rounded-3 mb-3">
                            <div class="coupon-icon bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-tag text-primary"></i>
                            </div>
                            <div class="coupon-info flex-grow-1">
                                <h6 class="mb-1">{{ $coupon->name }}</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <small class="text-muted">
                                        <i class="fas fa-store me-1"></i>{{ $coupon->store->name ?? 'No Store' }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>{{ $coupon->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <div class="coupon-status">
                                <span class="badge {{ $coupon->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $coupon->status == '1' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-tag fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No coupons available</h6>
                            <p class="text-muted small">Create your first coupon to get started</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stores & Performance Overview -->
    <div class="row mt-4">
        <!-- Recent Stores -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-store text-warning me-2"></i>Recent Stores
                        </h5>
                        <a href="{{ route('employee.store.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="recent-stores">
                        @forelse($recentStores as $store)
                        <div class="store-item d-flex align-items-center p-3 border rounded-3 mb-3">
                            <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('assets/img/no-image-found.png') }}"
                                 alt="{{ $store->name }}"
                                 class="store-avatar rounded-circle me-3"
                                 width="50"
                                 height="50"
                                 onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'">
                            <div class="store-info flex-grow-1">
                                <a href="{{ route('employee.store.show', $store->id) }}" class="text-decoration-none">
                                    <h6 class="mb-1 text-dark">{{ $store->name }}</h6>
                                </a>
                                <div class="d-flex flex-wrap gap-2">
                                    <small class="text-muted">
                                        <i class="fas fa-folder me-1"></i>{{ $store->category->name ?? 'No Category' }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>{{ $store->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <div class="store-status">
                                <span class="badge {{ $store->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $store->status == '1' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-store fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No stores available</h6>
                            <p class="text-muted small">Add your first store to get started</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Overview -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-chart-pie text-purple me-2"></i>Performance Overview
                    </h5>

                    <!-- Stores by Status -->
                    <div class="performance-item mb-4">
                        <h6 class="mb-3">Stores Status</h6>
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-3">Active Stores</span>
                            <div class="progress flex-grow-1" style="height: 8px;">
                                @php
                                    $activeStoresPercent = $stores->count() > 0 ? ($stores->where('status', '1')->count() / $stores->count()) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" style="width: {{ $activeStoresPercent }}%"></div>
                            </div>
                            <span class="ms-3 fw-bold">{{ $stores->where('status', '1')->count() }}/{{ $stores->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3">Inactive Stores</span>
                            <div class="progress flex-grow-1" style="height: 8px;">
                                @php
                                    $inactiveStoresPercent = $stores->count() > 0 ? ($stores->where('status', '0')->count() / $stores->count()) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-secondary" style="width: {{ $inactiveStoresPercent }}%"></div>
                            </div>
                            <span class="ms-3 fw-bold">{{ $stores->where('status', '0')->count() }}/{{ $stores->count() }}</span>
                        </div>
                    </div>

                    <!-- Coupons by Status -->
                    <div class="performance-item mb-4">
                        <h6 class="mb-3">Coupons Status</h6>
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-3">Active Coupons</span>
                            <div class="progress flex-grow-1" style="height: 8px;">
                                @php
                                    $activeCouponsPercent = $coupons->count() > 0 ? ($coupons->where('status', '1')->count() / $coupons->count()) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-success" style="width: {{ $activeCouponsPercent }}%"></div>
                            </div>
                            <span class="ms-3 fw-bold">{{ $coupons->where('status', '1')->count() }}/{{ $coupons->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3">Inactive Coupons</span>
                            <div class="progress flex-grow-1" style="height: 8px;">
                                @php
                                    $inactiveCouponsPercent = $coupons->count() > 0 ? ($coupons->where('status', '0')->count() / $coupons->count()) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-secondary" style="width: {{ $inactiveCouponsPercent }}%"></div>
                            </div>
                            <span class="ms-3 fw-bold">{{ $coupons->where('status', '0')->count() }}/{{ $coupons->count() }}</span>
                        </div>
                    </div>

                    <!-- Today's Summary -->
                    <div class="performance-item">
                        <h6 class="mb-3">Today's Summary</h6>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="today-stat p-3 rounded-3 bg-light">
                                    <h4 class="text-primary mb-1">{{ $todayStores->count() }}</h4>
                                    <small class="text-muted">New Stores</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="today-stat p-3 rounded-3 bg-light">
                                    <h4 class="text-warning mb-1">{{ $todayCoupons->count() }}</h4>
                                    <small class="text-muted">New Coupons</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Footer -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="quick-stat">
                                <i class="fas fa-layer-group fa-2x text-primary mb-2"></i>
                                <h4 class="mb-1">{{ $categories->count() }}</h4>
                                <small class="text-muted">Categories</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="quick-stat">
                                <i class="fas fa-globe fa-2x text-info mb-2"></i>
                                <h4 class="mb-1">{{ $networks->count() }}</h4>
                                <small class="text-muted">Networks</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="quick-stat">
                                <i class="fas fa-blog fa-2x text-success mb-2"></i>
                                <h4 class="mb-1">{{ $blogs->count() }}</h4>
                                <small class="text-muted">Blog Posts</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-stat">
                                <i class="fas fa-language fa-2x text-warning mb-2"></i>
                                <h4 class="mb-1">{{ $langs->count() }}</h4>
                                <small class="text-muted">Languages</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    .stats-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stats-card h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .action-item {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef !important;
    }

    .action-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-color: #4361ee !important;
    }

    .coupon-item, .store-item {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef !important;
    }

    .coupon-item:hover, .store-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .store-avatar {
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

    .performance-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .today-stat {
        transition: all 0.3s ease;
    }

    .today-stat:hover {
        transform: scale(1.05);
        background: #e9ecef !important;
    }

    .quick-stat {
        padding: 15px;
    }

    .quick-stat:hover {
        transform: translateY(-2px);
    }

    .badge {
        font-weight: 500;
        padding: 6px 10px;
        border-radius: 6px;
    }

    .progress {
        border-radius: 10px;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
    }

    /* Custom colors */
    .text-purple { color: #6f42c1 !important; }
    .bg-purple { background-color: #6f42c1 !important; }
</style>
@endpush
