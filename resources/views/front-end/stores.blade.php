@extends('layouts.master')

@section('title', __('stores.meta_title', ['year' => date('Y'), 'app' => config('app.name')]))
@section('description', __('stores.meta_description'))
@section('keywords', __('stores.meta_keywords'))
@section('author', __('stores.meta_author'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/stores.css') }}">
@endpush

@section('content')
<main class="container-fluid px-0">
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('stores.page_title') }}</h1>
            <p class="page-subtitle">
                {{ __('stores.page_subtitle') }}
            </p>
        </div>
    </header>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-container">
                <!-- Search Box -->
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        class="search-input" 
                        id="storeSearch"
                        placeholder="{{ __('stores.search_placeholder') }}"
                        autocomplete="off"
                    >
                </div>

                <!-- Alphabet Navigation -->
                <div class="alphabet-nav" id="alphabetNav">
                    <a href="?letter=all" class="alphabet-letter alphabet-all {{ $letter == 'all' ? 'active' : '' }}" data-letter="all">
                        {{ __('stores.all') }}
                    </a>
                    @foreach(range('A', 'Z') as $char)
                        <a href="?letter={{ $char }}" class="alphabet-letter {{ $letter == $char ? 'active' : '' }}" data-letter="{{ $char }}">
                            {{ $char }}
                        </a>
                    @endforeach
                    <a href="?letter=#" class="alphabet-letter {{ $letter == '#' ? 'active' : '' }}" data-letter="#">
                        #
                    </a>
                </div>

                <!-- Active Filters -->
                <div class="active-filters" id="activeFilters">
                    <!-- Active filters will be dynamically added here -->
                </div>

                <!-- Search Results Info -->
                <div class="search-results-info" id="searchResultsInfo">
                    <div class="stats-bar">
                        <div class="stat-item">
                            <i class="fas fa-store"></i>
                            <span id="totalStores">
                                @if(isset($totalStoresCount))
                                    {{ $totalStoresCount }}
                                @else
                                    {{ $stores->total() }}
                                @endif
                            </span> {{ __('stores.stores_found') }}
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-tags"></i>
                            <span id="activeDeals">{{ __('stores.latest_deals', ['year' => date('Y')]) }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <span>{{ __('stores.verified_offers') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>{{ __('home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
                    <span class="mx-2 text-muted">
                        <i class="fas fa-chevron-right small"></i>
                    </span>
                    <i class="fas fa-store me-2 text-primary"></i>
                    {{ __('common.stores') }}
                </li>
            </ol>
        </nav>

        <!-- Stores Content -->
        <div id="storesContent">
            @if(isset($storesByLetter) && !empty($storesByLetter))
                <!-- Display stores grouped by letters -->
                @foreach($storesByLetter as $letterKey => $storesGroup)
                    @if(count($storesGroup) > 0)
                        <section class="letter-section" data-letter="{{ $letterKey }}">
                            <div class="letter-header">
                                <h2 class="letter-title">
                                    <i class="fas fa-bookmark"></i>
                                    {{ $letterKey }}
                                    <span class="letter-count">{{ count($storesGroup) }}</span>
                                </h2>
                            </div>
                            <div class="stores-grid">
                                @foreach($storesGroup as $store)
                                    <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none">
                                        <div class="store-card">
                                            <div class="store-image-container">
                                                <img
                                                    src="{{ $store->image_url  }}"
                                                    onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                                                    class="store-image"
                                                    alt="{{ $store->name }}"
                                                    loading="lazy"
                                                />
                                                @if($store->top_store)
                                                    <div class="store-badge">
                                                        <i class="fas fa-crown me-1"></i>{{ __('stores.top_store') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="store-content">
                                                <h5 class="store-name">{{ $store->name ?: __('stores.default_store_name') }}</h5>
                                                <div class="store-meta">
                                                    <i class="fas fa-tag"></i>
                                                    <span>{{ $store->coupons_count ?? '0' }} {{ __('stores.offers') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                @endforeach
            @else
                <!-- Display stores in grid with pagination -->
                <div class="stores-grid">
                    @forelse ($stores as $store)
                        <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none">
                            <div class="store-card">
                                <div class="store-image-container">
                                    <img
                                        src="{{ $store->image_url }}"
                                        onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                                        class="store-image"
                                        alt="{{ $store->name }}"
                                        loading="lazy"
                                    />
                                    @if($store->top_store)
                                        <div class="store-badge">
                                            <i class="fas fa-crown me-1"></i>{{ __('stores.top_store') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="store-content">
                                    <h5 class="store-name">{{ $store->name ?: __('stores.default_store_name') }}</h5>
                                    <div class="store-meta">
                                        <i class="fas fa-tag"></i>
                                        <span>{{ $store->coupons_count ?? '0' }} {{ __('stores.offers') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="no-results">
                            <div class="no-results-icon">
                                <i class="fas fa-store-slash"></i>
                            </div>
                            <h4 class="text-dark mb-3">{{ __('stores.no_stores_title') }}</h4>
                            <p class="text-muted mb-0">
                                {{ __('stores.no_stores_message') }}
                            </p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if(isset($stores) && $stores->hasPages() && (!isset($storesByLetter) || empty($storesByLetter)))
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="{{ __('stores.pagination_label') }}">
                    {{ $stores->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('storeSearch');
    const alphabetNav = document.getElementById('alphabetNav');
    const storesContent = document.getElementById('storesContent');
    const activeFilters = document.getElementById('activeFilters');
    const totalStoresSpan = document.getElementById('totalStores');
    
    // Get initial stores data from the page
    let allStoresData = [];
    
    // Extract store data from the current page
    function extractStoreData() {
        const storeCards = storesContent.querySelectorAll('.store-card');
        const stores = [];
        
        storeCards.forEach(card => {
            const link = card.closest('a');
            const name = card.querySelector('.store-name').textContent.trim();
            const image = card.querySelector('.store-image').src;
            const offers = card.querySelector('.store-meta span').textContent;
            const isTopStore = card.querySelector('.store-badge') !== null;
            
            // Extract slug from URL
            const url = link.href;
            const slugMatch = url.match(/store\/([^\/]+)/);
            const slug = slugMatch ? slugMatch[1] : '';
            
            stores.push({
                name: name,
                image: image,
                coupons_count: parseInt(offers) || 0,
                top_store: isTopStore,
                detail_url: url,
                slug: slug
            });
        });
        
        return stores;
    }
    
    // Initialize store data
    allStoresData = extractStoreData();
    
    // Function to filter stores
    function filterStores() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const activeLetter = getActiveLetter();
        
        let filteredStores = allStoresData;
        
        // Filter by search term
        if (searchTerm) {
            filteredStores = filteredStores.filter(store => 
                store.name.toLowerCase().includes(searchTerm)
            );
        }
        
        // Filter by letter
        if (activeLetter && activeLetter !== 'all') {
            if (activeLetter === '#') {
                // Filter for stores starting with numbers or symbols
                filteredStores = filteredStores.filter(store => {
                    const firstChar = store.name.charAt(0).toLowerCase();
                    return /[^a-z]/i.test(firstChar);
                });
            } else {
                filteredStores = filteredStores.filter(store => 
                    store.name.toLowerCase().startsWith(activeLetter.toLowerCase())
                );
            }
        }
        
        updateActiveFilters(searchTerm, activeLetter);
        displayFilteredStores(filteredStores);
        updateStats(filteredStores.length);
    }

    // Function to get active letter from URL or navigation
    function getActiveLetter() {
        const urlParams = new URLSearchParams(window.location.search);
        const letter = urlParams.get('letter');
        
        // Also check for active navigation element
        const activeNav = alphabetNav.querySelector('.alphabet-letter.active');
        if (activeNav) {
            return activeNav.dataset.letter;
        }
        
        return letter || 'all';
    }

    // Function to update active filters display
    function updateActiveFilters(searchTerm, activeLetter) {
        activeFilters.innerHTML = '';
        
        if (searchTerm) {
            const searchBadge = createFilterBadge('{{ __("stores.search") }}', searchTerm, 'search');
            activeFilters.appendChild(searchBadge);
        }
        
        if (activeLetter && activeLetter !== 'all') {
            const letterBadge = createFilterBadge('{{ __("stores.letter") }}', activeLetter, 'letter');
            activeFilters.appendChild(letterBadge);
        }
    }

    // Function to create filter badge
    function createFilterBadge(type, value, filterType) {
        const badge = document.createElement('div');
        badge.className = 'filter-badge';
        badge.innerHTML = `
            <span>${type}: ${value}</span>
            <button class="filter-remove" data-filter="${filterType}">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        return badge;
    }

    // Function to display filtered stores
    function displayFilteredStores(stores) {
        if (stores.length === 0) {
            storesContent.innerHTML = `
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="text-dark mb-3">{{ __("stores.no_stores_found") }}</h4>
                    <p class="text-muted mb-0">
                        {{ __("stores.no_stores_message") }}
                    </p>
                </div>
            `;
            return;
        }
        
        // Group stores by first letter
        const groupedStores = {};
        stores.forEach(store => {
            const firstChar = store.name.charAt(0).toUpperCase();
            const letter = /[A-Z]/.test(firstChar) ? firstChar : '#';
            
            if (!groupedStores[letter]) {
                groupedStores[letter] = [];
            }
            groupedStores[letter].push(store);
        });
        
        // Sort letters alphabetically
        const sortedLetters = Object.keys(groupedStores).sort();
        
        // Generate HTML
        let html = '';
        sortedLetters.forEach(letter => {
            html += `
                <section class="letter-section" data-letter="${letter}">
                    <div class="letter-header">
                        <h2 class="letter-title">
                            <i class="fas fa-bookmark"></i>
                            ${letter}
                            <span class="letter-count">${groupedStores[letter].length}</span>
                        </h2>
                    </div>
                    <div class="stores-grid">
            `;
            
            groupedStores[letter].forEach(store => {
                html += `
                    <a href="${store.detail_url}" class="text-decoration-none">
                        <div class="store-card">
                            <div class="store-image-container">
                                <img
                                    src="${store.image}"
                                    onerror="this.src='{{ asset('assets/img/no-image-found.png') }}'"
                                    class="store-image"
                                    alt="${store.name}"
                                    loading="lazy"
                                />
                                ${store.top_store ? `
                                    <div class="store-badge">
                                        <i class="fas fa-crown me-1"></i>{{ __("stores.top_store") }}
                                    </div>
                                ` : ''}
                            </div>
                            <div class="store-content">
                                <h5 class="store-name">${store.name}</h5>
                                <div class="store-meta">
                                    <i class="fas fa-tag"></i>
                                    <span>${store.coupons_count} {{ __("stores.offers") }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
            });
            
            html += `
                    </div>
                </section>
            `;
        });
        
        storesContent.innerHTML = html;
        animateStoreCards();
        
        // Update the store data after re-rendering
        allStoresData = extractStoreData();
    }

    // Function to update stats
    function updateStats(count) {
        if (totalStoresSpan) {
            totalStoresSpan.textContent = count;
        }
    }

    // Function to animate store cards
    function animateStoreCards() {
        const cards = storesContent.querySelectorAll('.store-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.05}s`;
        });
    }

    // Function to scroll to letter section
    function scrollToLetter(letter) {
        const letterSection = storesContent.querySelector(`[data-letter="${letter}"]`);
        if (letterSection) {
            letterSection.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Add highlight animation
            letterSection.style.animation = 'none';
            setTimeout(() => {
                letterSection.style.animation = 'fadeInUp 0.5s ease-out';
            }, 10);
        }
    }

    // Event Listeners

    // Search input with debounce
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(filterStores, 300);
    });

    // Alphabet navigation
    alphabetNav.addEventListener('click', function(e) {
        if (e.target.classList.contains('alphabet-letter')) {
            e.preventDefault();
            const letter = e.target.dataset.letter;
            
            // Update URL
            const url = new URL(window.location);
            url.searchParams.set('letter', letter);
            window.history.pushState({}, '', url);
            
            // Update active state
            alphabetNav.querySelectorAll('.alphabet-letter').forEach(link => {
                link.classList.remove('active');
            });
            e.target.classList.add('active');
            
            // Reload page for server-side filtering
            window.location.href = url.toString();
        }
    });

    // Remove filter
    activeFilters.addEventListener('click', function(e) {
        if (e.target.closest('.filter-remove')) {
            const button = e.target.closest('.filter-remove');
            const filterType = button.dataset.filter;
            
            if (filterType === 'search') {
                searchInput.value = '';
                filterStores();
            } else if (filterType === 'letter') {
                // Navigate to "all" view
                const url = new URL(window.location);
                url.searchParams.set('letter', 'all');
                window.location.href = url.toString();
            }
        }
    });

    // Initialize
    function initialize() {
        filterStores();
        animateStoreCards();
    }

    initialize();

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === '/') {
            e.preventDefault();
            searchInput.focus();
        }
        
        // Jump to letter with keyboard
        if (e.key.length === 1 && /[a-z#]/i.test(e.key) && e.ctrlKey) {
            e.preventDefault();
            const letter = e.key.toUpperCase();
            const letterLink = alphabetNav.querySelector(`[data-letter="${letter}"]`);
            if (letterLink) {
                letterLink.click();
            }
        }
    });

    // Add hover effect for store cards
    document.addEventListener('mouseover', function(e) {
        if (e.target.closest('.store-card')) {
            const card = e.target.closest('.store-card');
            card.style.zIndex = '10';
        }
    });

    document.addEventListener('mouseout', function(e) {
        if (e.target.closest('.store-card')) {
            const card = e.target.closest('.store-card');
            card.style.zIndex = '1';
        }
    });
});
</script>
@endpush
@endsection