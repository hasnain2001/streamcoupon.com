    @extends('admin.layouts.app')
    @section('title', 'Admin Dashboard')
    @section('content')
    @include('components.admin.page-header', ['title' => 'Admin Dashboard','breadcrumbs' => ['Ubold' => route('admin.dashboard'), 'Dashboard' => '#']])

        <!-- Stats Cards -->
        <div class="row">
            <!-- Total Stores -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-primary mb-1">{{ $stores->count() }}</h3>
                                <p class="text-muted mb-2">Total Stores</p>
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

            <!-- Total Coupons -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-warning mb-1">{{ $coupons->count() }}</h3>
                                <p class="text-muted mb-2">Total Coupons</p>
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

            <!-- Total Customers -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-success mb-1">{{ $users->count() }}</h3>
                                <p class="text-muted mb-2">Total Users</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-user-check me-1"></i> Registered
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-success bg-opacity-10">
                                <i class="fas fa-users text-success"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(($users->count()/50)*100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Blogs -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-info mb-1">{{ $blogs->count() }}</h3>
                                <p class="text-muted mb-2">Total Blogs</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-file-alt me-1"></i> Published
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-info bg-opacity-10">
                                <i class="fas fa-blog text-info"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ min(($blogs->count()/20)*100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-purple mb-1">{{ $categories->count() }}</h3>
                                <p class="text-muted mb-2">Total Categories</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-purple bg-opacity-10 text-white">
                                        <i class="fas fa-folder me-1"></i> Active
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-purple bg-opacity-10">
                                <i class="fas fa-layer-group text-white"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: {{ min(($categories->count()/15)*100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Networks -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-danger mb-1">{{ $networks->count() }}</h3>
                                <p class="text-muted mb-2">Total Networks</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        <i class="fas fa-network-wired me-1"></i> Connected
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-danger bg-opacity-10">
                                <i class="fas fa-globe text-danger"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ min(($networks->count()/10)*100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Coupons -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-teal mb-1">{{ $todayCoupons->count() }}</h3>
                                <p class="text-muted mb-2">Today's Coupons</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-teal bg-opacity-10 text-white">
                                        <i class="fas fa-bolt me-1"></i> New Today
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-teal bg-opacity-10 text-white">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            @php
                                $todayCouponsProgress = $coupons->count() > 0 ? ($todayCoupons->count() / $coupons->count()) * 100 : 0;
                            @endphp
                            <div class="progress-bar bg-teal" role="progressbar" style="width: {{ min($todayCouponsProgress, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Stores -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="text-orange mb-1">{{ $todayStores->count() }}</h3>
                                <p class="text-muted mb-2">Today's Stores</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-orange bg-opacity-10 text-white">
                                        <i class="fas fa-plus-circle me-1"></i> New Today
                                    </span>
                                </div>
                            </div>
                            <div class="stats-icon bg-orange bg-opacity-10">
                                <i class="fas fa-store-alt"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4px;">
                            @php
                                $todayStoresProgress = $stores->count() > 0 ? ($todayStores->count() / $stores->count()) * 100 : 0;
                            @endphp
                            <div class="progress-bar bg-orange" role="progressbar" style="width: {{ min($todayStoresProgress, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics Row -->
        <div class="row mt-4">
            <!-- Platform Overview Chart -->
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie text-primary me-2"></i>Platform Overview
                            </h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    This Month
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="platform-overview">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="overview-item p-3 rounded">
                                        <i class="fas fa-store fa-2x text-primary mb-2"></i>
                                        <h4 class="mb-1">{{ $stores->count() }}</h4>
                                        <small class="text-muted">Stores</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="overview-item p-3 rounded">
                                        <i class="fas fa-tag fa-2x text-warning mb-2"></i>
                                        <h4 class="mb-1">{{ $coupons->count() }}</h4>
                                        <small class="text-muted">Coupons</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="overview-item p-3 rounded">
                                        <i class="fas fa-users fa-2x text-success mb-2"></i>
                                        <h4 class="mb-1">{{ $users->count() }}</h4>
                                        <small class="text-muted">Users</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="overview-item p-3 rounded">
                                        <i class="fas fa-blog fa-2x text-info mb-2"></i>
                                        <h4 class="mb-1">{{ $blogs->count() }}</h4>
                                        <small class="text-muted">Blogs</small>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-container mt-3">
                                <div class="chart-placeholder">
                                    <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">Platform Analytics</h6>
                                    <p class="text-muted small">Detailed analytics visualization will be displayed here</p>
                                    <h4>Visitors (Last 30 Days)</h4>
                                    {{-- <ul>
                                    @foreach ($visitors as $day)
                                        <li>{{ $day['date']->format('d M') }} — {{ $day['visitors'] }} visitors</li>
                                    @endforeach
                                    </ul>

                                    <h4>Most Visited Pages</h4>
                                    <ul>
                                    @foreach ($topPages as $page)
                                        <li>{{ $page['pageTitle'] }} — {{ $page['pageViews'] }} views</li>
                                    @endforeach
                                    </ul> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats & Top Stores -->
            <div class="col-xl-4">
                <!-- Quick Stats -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-tachometer-alt text-warning me-2"></i>Quick Stats
                        </h5>
                        <div class="quick-stats">
                            <div class="stat-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-store text-primary me-3"></i>
                                    <span>Active Stores</span>
                                </div>
                                <span class="badge bg-primary">{{ $stores->where('status', 'enable')->count() }}</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tag text-warning me-3"></i>
                                    <span>Active Coupons</span>
                                </div>
                                <span class="badge bg-warning">{{ $coupons->where('status', 'enable')->count() }}</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-eye text-info me-3"></i>
                                    <span>Today's Activity</span>
                                </div>
                                <span class="badge bg-info">{{ $todayCoupons->count() + $todayStores->count() }}</span>
                            </div>
                            <div class="stat-item d-flex justify-content-between align-items-center py-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chart-line text-success me-3"></i>
                                    <span>Growth Rate</span>
                                </div>
                                <span class="badge bg-success">
                                    @php
                                        $totalGrowth = $todayCoupons->count() + $todayStores->count();
                                        echo $totalGrowth > 0 ? '+' . $totalGrowth : '0';
                                    @endphp
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Performing Stores -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-trophy text-success me-2"></i>Recent Stores
                        </h5>
                        <div class="top-stores">
                            @foreach($recentStores as $store)
                            <div class="store-item d-flex align-items-center py-3 border-bottom">
                                <img src="{{ $store->image ? asset('storage/stores/' . $store->image) : asset('assets/img/no-image-found.png') }}"
                                    alt="{{ $store->name }}"
                                    class="store-avatar rounded-circle me-3"
                                    width="40"
                                    height="40"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-found.png') }}'">
                                <div class="store-info flex-grow-1">
                                    <a href="{{ route('admin.store.show', $store->id) }}" class="text-decoration-none">
                                        <h6 class="mb-1 store-name text-dark">{{ $store->name }}</h6>
                                    </a>
                                    <small class="text-muted">{{ $store->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="store-stats text-end">
                                    <span class="badge {{ $store->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $store->status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            @endforeach
                            @if ($recentStores->isEmpty())
                            <div class="text-center py-4">
                                <i class="fas fa-store fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No stores available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Performance -->
        <div class="row mt-4">
            <!-- Recent Coupons -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-history text-info me-2"></i>Recent Coupons
                            </h5>
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="recent-coupons">
                            @foreach($recentCoupons as $coupon)
                            <div class="coupon-item d-flex align-items-center py-3 border-bottom">
                                <div class="coupon-icon bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-tag text-primary"></i>
                                </div>
                                <div class="coupon-info flex-grow-1">
                                    <h6 class="mb-1">{{ $coupon->name }}</h6>
                                    <small class="text-muted">
                                        {{ $coupon->store->name ?? 'No Store' }} •
                                        {{ $coupon->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="coupon-status">
                                    <span class="badge {{ $coupon->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $coupon->status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            @if ($recentCoupons->isEmpty())
                            <div class="text-center py-4">
                                <i class="fas fa-tag fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No coupons available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Stores -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-store text-warning me-2"></i>Recent Stores
                            </h5>
                            <a href="{{ route('admin.store.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="recent-stores">
                            @php
                                $recentStores = $stores->sortByDesc('created_at')->take(5);
                            @endphp

                            @forelse($recentStores as $store)
                            <div class="store-item d-flex align-items-center py-3 border-bottom">
                                <div class="store-icon bg-warning bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-store text-warning"></i>
                                </div>
                                <div class="store-info flex-grow-1">
                                    <a href="{{ route('admin.store.show', $store->id) }}" class="text-decoration-none">
                                        <h6 class="mb-1 text-dark">{{ $store->name }}</h6>
                                    </a>
                                    <small class="text-muted">
                                        {{ $store->category->name ?? 'No Category' }} •
                                        {{ $store->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="store-status">
                                    <span class="badge {{ $store->status == '1' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $store->status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-store fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No stores available</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Performance -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-server text-purple me-2"></i>System Performance & Languages
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="performance-stats">
                                    <div class="performance-item mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Platform Health</span>
                                            <span class="text-success">Excellent</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 95%"></div>
                                        </div>
                                    </div>

                                    <div class="performance-item mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>Data Accuracy</span>
                                            <span class="text-info">98.7%</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-info" style="width: 98.7%"></div>
                                        </div>
                                    </div>

                                    <div class="performance-item mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>User Engagement</span>
                                            <span class="text-warning">84.3%</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-warning" style="width: 84.3%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Supported Languages</h6>
                                <div class="languages-list">
                                    @foreach($langs->take(6) as $language)
                                    <div class="language-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="d-flex align-items-center">
                                            <i class="fas fa-language text-primary me-2"></i>
                                            {{ $language->name }}
                                        </span>
                                        <span class="badge bg-light text-dark">
                                            {{ $language->code }}
                                        </span>
                                    </div>
                                    @endforeach
                                    @if($langs->count() > 6)
                                    <div class="text-center mt-2">
                                        <small class="text-muted">+{{ $langs->count() - 6 }} more languages</small>
                                    </div>
                                    @endif
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

        .chart-container {
            height: 200px;
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overview-item {
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .overview-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .store-avatar {
            object-fit: cover;
            border: 2px solid #e9ecef;
        }

        .quick-stats .stat-item,
        .top-stores .store-item,
        .recent-coupons .coupon-item,
        .recent-stores .store-item,
        .language-item {
            transition: background-color 0.2s ease;
        }

        .quick-stats .stat-item:hover,
        .top-stores .store-item:hover,
        .recent-coupons .coupon-item:hover,
        .recent-stores .store-item:hover,
        .language-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding-left: 10px;
            padding-right: 10px;
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
        .text-teal { color: #20c997 !important; }
        .bg-teal { background-color: #20c997 !important; }
        .text-orange { color: #fd7e14 !important; }
        .bg-orange { background-color: #fd7e14 !important; }
    </style>
    @endpush
