<header class="sticky-top" id="header">
    <!-- Top Bar -->
    <nav class="navbar navbar-top">
        <div class="container">
            <div class="row w-100 align-items-center g-3">

                <!-- Logo -->
                <div class="col-4 col-md-2 text-start">
                    <a href="{{ url(app()->getLocale().'/') }}" class="d-block">
                        <div class="logo-container mx-auto">
                            <x-application-logo class="img-fluid"/>
                        </div>
                    </a>
                </div>

                <!-- Mobile Controls -->
                <div class="col-8 d-md-none text-end">
                    <div class="mobile-header-controls">
                        <div class="dropdown language-selector-mobile">
                            <button class="btn dropdown-toggle d-flex align-items-center p-2" type="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" width="22" height="16" class="rounded shadow-sm" style="object-fit:cover;">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                @foreach ($langs as $lang)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('/' . $lang->code) }}">
                                        <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="22" height="16" class="rounded shadow-sm">
                                        <span>{{ $lang->name }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <button class="enhanced-toggler" id="mobileNavToggle">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-12 col-md-8 order-1 order-md-0 mt-3 mt-md-0">
                    <div class="search-container">
                        <div class="search-box">
                            <i class="bi bi-search search-icon"></i>
                            <form action="{{ route('search') }}" method="GET" class="w-100">
                                <input class="search-input" type="search" name="query" value="{{ old('query', request('query')) }}" placeholder="@lang('nav.Search here')" aria-label="Search" id="searchInput" >
                                <button class="search-button" type="submit">
                                    <span class="d-none d-sm-inline">Search</span>
                                    <i class="bi bi-arrow-right-short d-sm-none"></i>
                                </button>
                            </form>
                            <!-- Search suggestions container -->
                            <div class="search-suggestions" id="searchSuggestions">
                                <!-- Suggestions will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desktop Language -->
                <div class="col-12 col-md-2 order-0 order-md-1 d-none d-md-flex justify-content-end">
                    <div class="dropdown language-selector">
                        <button class="btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" width="24" height="17" class="me-2 rounded shadow-sm">
                            <span class="fw-semibold">{{ $langs->firstWhere('code', app()->getLocale())->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            @foreach ($langs as $lang)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('/' . $lang->code) }}">
                                    <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="24" height="17" class="rounded shadow-sm">
                                    <span>{{ $lang->name }} <small class="text-muted">({{ strtoupper($lang->code) }})</small></span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Desktop Main Nav -->
    <nav class="navbar navbar-expand-lg navbar-main shadow text-uppercase d-none d-md-block">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link {{ request()->is(app()->getLocale()) || request()->is(app()->getLocale().'/') ? 'active' : '' }}" href="{{ url(app()->getLocale().'/') }}"><i class="bi bi-house-door"></i> @lang('nav.home')</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('*/stores*') ? 'active' : '' }}" href="{{ route('stores', ['lang' => app()->getLocale()]) }}"><i class="bi bi-shop"></i> @lang('nav.stores')</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('*/category*') ? 'active' : '' }}" href="{{ route('category', ['lang' => app()->getLocale()]) }}"><i class="bi bi-grid-3x3-gap-fill"></i> @lang('nav.cateories')</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('*/coupons*') ? 'active' : '' }}" href="{{ route('coupons', ['lang' => app()->getLocale()]) }}"><i class="bi bi-ticket-perforated"></i> @lang('nav.Coupons')</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('*/deals*') ? 'active' : '' }}" href="{{ route('deals', ['lang' => app()->getLocale()]) }}"><i class="bi bi-tags"></i> @lang('nav.deal')</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('*/blog*') ? 'active' : '' }}" href="{{ route('blog', ['lang' => app()->getLocale()]) }}"><i class="bi bi-journal-text"></i> @lang('nav.blogs')</a></li>
                </ul>

                <div class="d-flex align-items-center gap-3">

                    <!-- CATEGORIES DROPDOWN (SCROLLABLE) -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap"></i> @lang('nav.cateories')
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg p-2 dropdown-menu-scrollable" style="min-width:240px; border-radius:12px;">
                            @forelse ($allcategories as $category)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded"
                                       href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                        @if($category->icon)
                                            <img src="{{ asset('uploads/' . $category->icon) }}" alt="{{ $category->name }}" width="18" height="18" class="rounded">
                                        @else
                                            <i class="bi bi-tag-fill text-primary"></i>
                                        @endif
                                        <span class="small fw-medium">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted small">@lang('nav.no_categories')</span></li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Auth Links -->
                    @auth
                        <a href="{{
                            auth()->user()->role === 'admin' ? route('admin.dashboard') :
                            (auth()->user()->role === 'employee' ? route('employee.dashboard') : route('dashboard'))
                        }}" class="text-decoration-none text-dark fw-semibold">
                            <i class="bi bi-speedometer2"></i> @lang('nav.Dashboard')
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-semibold"><i class="bi bi-power"></i> @lang('nav.Login')</a>
                        <a href="{{ route('register') }}" class="text-decoration-none text-dark fw-semibold"><i class="bi bi-person-plus"></i> @lang('nav.register')</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Navigation -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
<div class="mobile-nav-container" id="mobileNavContainer">
    <div class="mobile-nav-header position-relative ">
        <a href="{{ url(app()->getLocale().'/') }}" class="d-block">
            <div class="mobile-logo-container ">
                <x-application-logo class="img-fluid"/>
            </div>
        </a>
        <button class="mobile-close-btn" id="mobileNavClose">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- Mobile Search -->
    <div class="mobile-search-container ">
        <form action="{{ route('search') }}" method="GET" class="w-100">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0" id="basic-addon1">
                    <i class="bi bi-search text-primary"></i>
                </span>
                <input type="search" class="form-control border-start-0" name="query" placeholder="@lang('nav.Search here')" aria-label="Search">
            </div>
        </form>
    </div>

    <div class="flex-grow-1">
        <a href="{{ url(app()->getLocale().'/') }}" class="mobile-nav-link active"><i class="bi bi-house-door"></i> <span>@lang('nav.home')</span></a>
        <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link"><i class="bi bi-shop"></i> <span>@lang('nav.stores')</span></a>
        <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link"><i class="bi bi-grid-3x3-gap-fill"></i> <span>@lang('nav.cateories')</span></a>
        <a href="{{ route('coupons', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link"><i class="bi bi-ticket-perforated"></i> <span>@lang('nav.Coupons')</span></a>
        <a href="{{ route('deals', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link"><i class="bi bi-tags"></i> <span>@lang('nav.deal')</span></a>
        <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link"><i class="bi bi-journal-text"></i> <span>@lang('nav.blogs')</span></a>
    </div>

    <div class="p-4 bg-light border-top">
        <div class="small text-uppercase fw-bold text-muted mb-3">@lang('select language')</div>
        <div class="d-grid gap-2" style="grid-template-columns: repeat(2, 1fr);">
            @foreach ($langs as $lang)
            <a href="{{ url('/' . $lang->code) }}" class="btn btn-sm rounded d-flex align-items-center gap-2 p-3 text-start {{ app()->getLocale() === $lang->code ? 'btn-warning text-dark' : 'btn-outline-secondary' }}">
                <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="20" height="14" class="rounded">
                <span class="small">{{ $lang->name }}</span>
            </a>
            @endforeach
        </div>
    </div>

    <div class="p-4 bg-light border-top">
        @auth
            <a href="{{
                auth()->user()->role === 'admin' ? route('admin.dashboard') :
                (auth()->user()->role === 'employee' ? route('employee.dashboard') : route('dashboard'))
            }}" class="mobile-auth-btn btn-dashboard">
                <i class="bi bi-speedometer2"></i> <span>@lang('nav.Dashboard')</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="mobile-auth-btn btn-login">
                <i class="bi bi-power"></i> <span>@lang('nav.Login')</span>
            </a>
            <a href="{{ route('register') }}" class="mobile-auth-btn btn-register">
                <i class="bi bi-person-plus"></i> <span>@lang('nav.register')</span>
            </a>
        @endauth
    </div>
</div>

