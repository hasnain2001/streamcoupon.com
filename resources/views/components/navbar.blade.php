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
                                <img src="{{ $langs->firstWhere('code', app()->getLocale())->flag_url  }}" width="22" height="16" class="rounded shadow-sm" style="object-fit:cover;">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                @foreach ($langs as $lang)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('/' . $lang->code) }}">
                                        <img src="{{ $lang->flag_url }}" width="22" height="16" class="rounded shadow-sm">
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
                                <input class="search-input" type="search" name="query" value="{{ old('query', request('query')) }}" placeholder="@lang('common.search_here')" aria-label="Search" id="searchInput" >
                                <button class="search-button" type="submit">
                                    <span class="d-none d-sm-inline">@lang('common.search')</span>
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
                            <img src="{{ $langs->firstWhere('code', app()->getLocale())->flag_url }}" width="24" height="17" class="me-2 rounded shadow-sm">
                            <span class="fw-semibold">{{ $langs->firstWhere('code', app()->getLocale())->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            @foreach ($langs as $lang)
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('/' . $lang->code) }}">
                                    <img src="{{ $lang->flag_url }}" width="24" height="17" class="rounded shadow-sm">
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is(app()->getLocale()) || request()->is(app()->getLocale().'/') ? 'active' : '' }}" 
                           href="{{ url(app()->getLocale().'/') }}">
                            <i class="bi bi-house-door"></i> @lang('common.home')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*/stores*') ? 'active' : '' }}" 
                           href="{{ route('stores', ['lang' => app()->getLocale()]) }}">
                            <i class="bi bi-shop"></i> @lang('common.stores')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*/coupons*') ? 'active' : '' }}" 
                           href="{{ route('coupons', ['lang' => app()->getLocale()]) }}">
                            <i class="bi bi-ticket"></i> @lang('common.coupons')
                        </a>
                    </li>                    
                    <!-- Categories Dropdown -->
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('*/category*') ? 'active' : '' }}" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap-fill"></i> @lang('common.categories')
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="{{ route('category', ['lang' => app()->getLocale()]) }}">
                                    <i class="bi bi-collection text-primary"></i>
                                    <span>@lang('common.all_categories')</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($navblogs->take(8) as $blog)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3"
                                       href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                                        @if($blog->image)
                                            <img src="{{ $blog->image_url }}" alt="{{ $blog->name }}" width="18" height="18" class="rounded">
                                        @else
                                            <i class="bi bi-tag-fill text-primary"></i>
                                        @endif
                                        <span class="small fw-medium">{{ $blog->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                            @if($navblogs->count() > 8)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 text-primary fw-semibold" 
                                       href="{{ route('blog', ['lang' => app()->getLocale()]) }}">
                                        <i class="bi bi-arrow-right-circle"></i>
                                        <span>@lang('common.view_all_blogs')</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li> --}}
                    
                    <!-- Resources Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="bi bi-journal-text"></i> @lang('common.resources')
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="{{ route('blog', ['lang' => app()->getLocale()]) }}">
                                    <i class="bi bi-newspaper text-primary"></i>
                                    <span>@lang('common.blogs')</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="#">
                                    <i class="bi bi-question-circle text-primary"></i>
                                    <span>@lang('common.faq_help')</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="#">
                                    <i class="bi bi-book text-primary"></i>
                                    <span>@lang('common.guides_tutorials')</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="#">
                                    <i class="bi bi-tools text-primary"></i>
                                    <span>@lang('common.tools_resources')</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3" 
                                   href="{{ route('about', ['lang' => app()->getLocale()]) }}">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <span>@lang('common.about')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*/blog*') ? 'active' : '' }}" 
                           href="{{ route('blog', ['lang' => app()->getLocale()]) }}">
                            <i class="bi bi-journal-text"></i> @lang('common.blogs')
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*/about*') ? 'active' : '' }}" 
                           href="{{ route('about', ['lang' => app()->getLocale()]) }}">
                            <i class="bi bi-info-circle"></i> @lang('common.about')
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <!-- CATEGORIES DROPDOWN (SCROLLABLE) -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="{{ route('category', ['lang' => app()->getLocale()]) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-grid-3x3-gap"></i> @lang('common.categories')
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
                                <li><span class="dropdown-item text-muted small">@lang('common.no_categories')</span></li>
                            @endforelse
                        </ul>
                    </div>
                    <!-- Auth Links -->
                    @auth
                        <a href="{{
                            auth()->user()->role === 'admin' ? route('admin.dashboard') :
                            (auth()->user()->role === 'employee' ? route('employee.dashboard') : route('dashboard'))
                        }}" class="text-decoration-none text-dark fw-semibold">
                            <i class="bi bi-speedometer2"></i> @lang('common.dashboard')
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-semibold">
                            <i class="bi bi-power"></i> @lang('common.login')
                        </a>
                        <a href="{{ route('register') }}" class="text-decoration-none text-dark fw-semibold">
                            <i class="bi bi-person-plus"></i> @lang('common.register')
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Enhanced Mobile Navigation -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
<div class="mobile-nav-container" id="mobileNavContainer">
    <!-- Mobile Header with Fixed Logo -->
    <div class="mobile-nav-header">
        <div class="mobile-nav-header-content">
            <a href="{{ url(app()->getLocale().'/') }}" class="mobile-logo-wrapper">
                <div class="mobile-logo-container">
                    <x-application-logo class="img-fluid mobile-logo"/>
                </div>
                <div class="mobile-logo-text">
                    <h3 class="site-name">{{ config('app.name') }}</h3>
                    <p class="site-tagline">@lang('common.tagline')</p>
                </div>
            </a>
            <button class="mobile-close-btn" id="mobileNavClose">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="mobile-search-container">
        <form action="{{ route('search') }}" method="GET" class="w-100">
            <div class="input-group mobile-search-group">
                <span class="input-group-text search-icon-wrapper">
                    <i class="bi bi-search"></i>
                </span>
                <input type="search" class="form-control mobile-search-input"
                       name="query" placeholder="@lang('common.search_here')"
                       aria-label="Search">
                <button type="submit" class="mobile-search-btn">
                   <i class="bi bi-search text-primary"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Main Navigation Links -->
    <nav class="mobile-nav-links">
        <a href="{{ url(app()->getLocale().'/') }}" class="mobile-nav-link active">
            <span class="nav-icon"><i class="bi bi-house-door-fill"></i></span>
            <span class="nav-text">@lang('common.home')</span>
            <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </a>
         <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link">
            <span class="nav-icon"><i class="bi bi-shop"></i></span>
            <span class="nav-text">@lang('common.stores')</span>
            <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </a>
        
        <!-- Mobile Categories Dropdown -->
        <div class="mobile-nav-dropdown">
            <a href="javascript:void(0)" class="mobile-nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#mobileCategories">
                <span class="nav-icon"><i class="bi bi-grid-3x3-gap-fill"></i></span>
                <span class="nav-text">@lang('common.categories')</span>
                <span class="nav-arrow"><i class="bi bi-chevron-down"></i></span>
            </a>
            <div class="collapse" id="mobileCategories">
                <div class="mobile-dropdown-content">
                    <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="mobile-dropdown-item">
                        <i class="bi bi-collection text-primary me-2"></i>
                        @lang('common.all_categories')
                    </a>
                    @foreach($allcategories->take(5) as $category)
                    <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}" class="mobile-dropdown-item">
                        @if($category->icon)
                            <img src="{{ asset('uploads/' . $category->icon) }}" alt="{{ $category->name }}" width="16" height="16" class="rounded me-2">
                        @else
                            <i class="bi bi-tag-fill text-primary me-2"></i>
                        @endif
                        {{ $category->name }}
                    </a>
                    @endforeach
                    @if($allcategories->count() > 5)
                    <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="mobile-dropdown-item text-primary fw-semibold">
                        <i class="bi bi-arrow-right-circle me-2"></i>
                        @lang('common.view_all_categories')
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Mobile Resources Dropdown -->
        <div class="mobile-nav-dropdown">
            <a href="javascript:void(0)" class="mobile-nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#mobileResources">
                <span class="nav-icon"><i class="bi bi-journal-text"></i></span>
                <span class="nav-text">@lang('common.resources')</span>
                <span class="nav-arrow"><i class="bi bi-chevron-down"></i></span>
            </a>
            <div class="collapse" id="mobileResources">
                <div class="mobile-dropdown-content">
                    <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="mobile-dropdown-item">
                        <i class="bi bi-newspaper text-primary me-2"></i>
                        @lang('common.blogs')
                    </a>
                    <a href="#" class="mobile-dropdown-item">
                        <i class="bi bi-question-circle text-primary me-2"></i>
                        @lang('common.faq_help')
                    </a>
                    <a href="#" class="mobile-dropdown-item">
                        <i class="bi bi-book text-primary me-2"></i>
                        @lang('common.guides_tutorials')
                    </a>
                    <a href="#" class="mobile-dropdown-item">
                        <i class="bi bi-tools text-primary me-2"></i>
                        @lang('common.tools_resources')
                    </a>
                    <a href="{{ route('about', ['lang' => app()->getLocale()]) }}" class="mobile-dropdown-item">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        @lang('common.about')
                    </a>
                </div>
            </div>
        </div>
        
        <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="mobile-nav-link">
            <span class="nav-icon"><i class="bi bi-newspaper"></i></span>
            <span class="nav-text">@lang('common.blogs')</span>
            <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </a>
    </nav>

    <!-- Language Selection -->
    <div class="mobile-language-section">
        <div class="section-header">
            <i class="bi bi-globe-americas"></i>
            <span class="section-title">@lang('common.select_language')</span>
        </div>
        <div class="language-grid">
            @foreach ($langs as $lang)
            <a href="{{ url('/' . $lang->code) }}"
               class="language-card {{ app()->getLocale() === $lang->code ? 'active' : '' }}">
                <div class="language-flag">
                    <img src="{{ $lang->flag_url }}"
                         width="24" height="18"
                         class="flag-img" alt="{{ $lang->name }}">
                </div>
                <span class="language-name">{{ $lang->name }}</span>
                @if(app()->getLocale() === $lang->code)
                <span class="active-indicator"><i class="bi bi-check-circle-fill"></i></span>
                @endif
            </a>
            @endforeach
        </div>
    </div>

    <!-- Authentication Section -->
    <div class="mobile-auth-section">
        @auth
            <a href="{{
                auth()->user()->role === 'admin' ? route('admin.dashboard') :
                (auth()->user()->role === 'employee' ? route('employee.dashboard') : route('dashboard'))
            }}" class="auth-btn dashboard-btn">
                <span class="auth-icon"><i class="bi bi-speedometer2"></i></span>
                <span class="auth-text">@lang('common.dashboard')</span>
                <span class="auth-badge">Premium</span>
            </a>

            <div class="user-profile-card">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="user-info">
                    <h4 class="user-name">{{ auth()->user()->name }}</h4>
                    <p class="user-email">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <div class="auth-buttons-grid">
                <a href="{{ route('login') }}" class="auth-btn login-btn">
                    <span class="auth-icon"><i class="bi bi-door-open-fill"></i></span>
                    <span class="auth-text">@lang('common.login')</span>
                </a>

                <a href="{{ route('register') }}" class="auth-btn register-btn">
                    <span class="auth-icon"><i class="bi bi-person-plus-fill"></i></span>
                    <span class="auth-text">@lang('common.register')</span>
                    <span class="free-badge">@lang('common.free')</span>
                </a>
            </div>

            <div class="auth-benefits">
                <div class="benefit-item">
                    <i class="bi bi-shield-check text-success"></i>
                    <span> @lang('common.secure-account')</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-lightning-charge text-warning"></i>
                    <span>@lang('common.fast-access')</span>
                </div>
                <div class="benefit-item">
                    <i class="bi bi-gift text-primary"></i>
                    <span>@lang('common.exclusive-offers')</span>
                </div>
            </div>
        @endauth
    </div>

    <!-- App Download CTA -->
    <div class="mobile-app-cta">
        <div class="app-icon">
            <i class="bi bi-phone-fill"></i>
        </div>
        <div class="app-content">
            <h4>@lang('common.get-mobile-app')</h4>
            <p>@lang('common.download-exclusive-deals')</p>
        </div>
        <button class="app-download-btn">
            <i class="bi bi-arrow-down-circle"></i>
        </button>
    </div>
</div>