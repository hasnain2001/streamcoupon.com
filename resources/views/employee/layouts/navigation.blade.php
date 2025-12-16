<!-- Desktop Navigation -->
<nav class="navbar top-navbar navbar-expand-lg d-none d-lg-flex">
    <div class="container-fluid">
        <!-- Logo and Brand -->
        <a class="navbar-brand" href="{{ route('employee.dashboard') }}">
            <div class="d-flex align-items-center">

                <span class="brand-text"> Employee Panel</span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <div class="navbar-nav mx-auto">
            <div class="d-flex align-items-center">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('employee.dashboard') }}">
                    <i class="fas fa-home me-1"></i> Dashboard
                </a>

                <a class="nav-link {{ request()->routeIs('employee.store.*') ? 'active' : '' }}" href="{{ route('employee.store.index') }}">
                   <i class="fas fa-store"></i> store
                </a>
                <a class="nav-link {{ request()->routeIs('coupon.*') ? 'active' : '' }}" href="{{ route('employee.coupon.index') }}">
                   <i class="fas fa-list-ul"></i> coupon
                </a>
            </div>
        </div>

        <!-- Right Side Items -->
        <div class="d-flex align-items-center">
            <!-- Search Box -->
            <div class="search-box me-3">
                     <form role="search" class="position-relative d-flex align-items-center" action="{{ route('employee.search') }}" method="GET">
                    <i class="fas fa-search search-icon"></i>
                <input type="text" class="form-control" name="query" id="searchInput" placeholder="Search store here..." aria-label="Search">
                </form>
            </div>

            <!-- Notifications -->
            <div class="dropdown me-3">
                <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="notification-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Notifications</h6>
                            <span class="badge bg-primary rounded-pill">4</span>
                        </div>
                    </div>
                    <div class="p-2" style="width: 320px;">
                        <a href="#" class="dropdown-item p-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="notification-icon bg-primary">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">New Order Received</h6>
                                    <p class="mb-0 text-muted">Order #ORD-1234 has been placed</p>
                                    <small class="text-muted">5 minutes ago</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item p-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="notification-icon bg-success">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">New User Registered</h6>
                                    <p class="mb-0 text-muted">John Doe joined the platform</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <a href="#" class="btn btn-outline-primary btn-sm w-100">View All Notifications</a>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="user-avatar me-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=5b73e8&color=ffffff"
                             alt="{{ Auth::user()->name }}" class="rounded-circle">
                    </div>
                    <div class="user-info d-none d-md-block">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role text-muted">{{ Auth::user()->email }}</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-lock me-2"></i> Lock Screen
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Header -->
<nav class="navbar top-navbar-mobile d-lg-none">
    <div class="container-fluid">
        <!-- Mobile Menu Toggle -->
        <button class="btn sidebar-toggle" type="button" id="mobileMenuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Mobile Logo -->
        <a class="navbar-brand mx-auto" href="{{ route('employee.dashboard') }}">
            <x-application-logo class="h-7 w-auto" />
        </a>

        <!-- Mobile Right Icons -->
        <div class="d-flex align-items-center">
            <!-- Mobile Search Toggle -->
            <button class="btn nav-icon me-2" id="mobileSearchToggle">
                <i class="fas fa-search"></i>
            </button>

            <!-- Mobile Notifications -->
            <div class="dropdown me-2">
                <a class="btn nav-icon position-relative" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <!-- Same notifications content as desktop -->
                    <div class="p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Notifications</h6>
                            <span class="badge bg-primary rounded-pill">4</span>
                        </div>
                    </div>
                    <div class="p-2" style="width: 280px;">
                        <a href="#" class="dropdown-item p-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="notification-icon bg-primary">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">New Order</h6>
                                    <small class="text-muted">5 min ago</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item p-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="notification-icon bg-success">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">New User</h6>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile User Menu -->
            <div class="dropdown">
                <a class="btn nav-icon" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=5b73e8&color=ffffff"
                         alt="{{ Auth::user()->name }}" class="rounded-circle" width="32" height="32">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile Search Bar -->
    <div class="mobile-search-bar" id="mobileSearchBar">
        <div class="container-fluid">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn search-close" id="mobileSearchClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Menu -->
<div class="mobile-nav d-lg-none" id="mobileNav">
    <div class="mobile-menu">
        <!-- User Profile Section -->
        <div class="mobile-user-profile text-center p-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=5b73e8&color=ffffff"
                 alt="{{ Auth::user()->name }}" class="rounded-circle mb-3" width="80" height="80">
            <h6 class="text-dark mb-1">{{ Auth::user()->name }}</h6>
            <p class="text-muted small mb-3">{{Auth::user()->email}}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-edit me-1"></i> Edit Profile
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="mobile-nav-links">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-home me-3"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-users me-3"></i>
                <span>Users</span>
                <span class="badge bg-primary ms-auto">5</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-box me-3"></i>
                <span>Products</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart me-3"></i>
                <span>Orders</span>
                <span class="badge bg-success ms-auto">12</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-chart-bar me-3"></i>
                <span>Analytics</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-cog me-3"></i>
                <span>Settings</span>
            </a>
        </div>

        <!-- Quick Actions -->
        <div class="mobile-quick-actions p-3 border-top">
            <h6 class="text-muted mb-3">Quick Actions</h6>
            <div class="row g-2">
                <div class="col-6">
                    <a href="#" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-plus me-1"></i> Add User
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-outline-success btn-sm w-100">
                        <i class="fas fa-file-export me-1"></i> Export
                    </a>
                </div>
            </div>
        </div>

        <!-- Logout Section -->
        <div class="mobile-logout p-3 border-top">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobileOverlay"></div>
