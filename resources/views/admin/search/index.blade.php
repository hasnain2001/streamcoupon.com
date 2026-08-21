@extends('admin.layouts.guest')
@section('title', 'Search Results')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="header-title">Search Results</h4>
                        <p class="text-muted mb-0">
                            @if(isset($total_results))
                                Found {{ $total_results }} results for "{{ $query }}"
                            @endif
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('admin.store.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Back to Stores
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="row mb-4">
                    <div class="col-md-8 mx-auto">
                        <div class="search-box position-relative">
                            <form id="searchForm" action="{{ route('admin.search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="searchInput" 
                                           name="query" 
                                           placeholder="Search stores, coupons, blogs, categories, networks..."
                                           autocomplete="off"
                                           value="{{ $query ?? '' }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i> Search
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <!-- Autocomplete Dropdown -->
                            <div id="autocompleteResults" class="autocomplete-dropdown" style="display: none;">
                                <div class="list-group" id="autocompleteList">
                                    <!-- Results will be loaded here -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Live Search Results (AJAX) -->
                        <div id="liveSearchResults" class="mt-3" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="mb-3">Live Results <span id="resultCount" class="badge bg-primary"></span></h6>
                                    <div id="searchResultsContainer">
                                        <!-- Results will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Results Tabs -->
                @if(isset($total_results) && $total_results > 0)
                <ul class="nav nav-tabs nav-bordered mb-3" id="searchTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#stores-tab" role="tab">
                            <i class="mdi mdi-store"></i> Stores <span class="badge bg-primary">{{ $stores->total() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#coupons-tab" role="tab">
                            <i class="mdi mdi-tag"></i> Coupons <span class="badge bg-primary">{{ $coupons->total() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#blogs-tab" role="tab">
                            <i class="mdi mdi-post"></i> Blogs <span class="badge bg-primary">{{ $blogs->total() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#categories-tab" role="tab">
                            <i class="mdi mdi-folder"></i> Categories <span class="badge bg-primary">{{ $categories->total() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#networks-tab" role="tab">
                            <i class="mdi mdi-sitemap"></i> Networks <span class="badge bg-primary">{{ $networks->total() }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Stores Tab -->
                    <div class="tab-pane show active" id="stores-tab" role="tabpanel">
                        @include('admin.search.partials.stores', ['stores' => $stores])
                    </div>

                    <!-- Coupons Tab -->
                    <div class="tab-pane" id="coupons-tab" role="tabpanel">
                        @include('admin.search.partials.coupons', ['coupons' => $coupons])
                    </div>

                    <!-- Blogs Tab -->
                    <div class="tab-pane" id="blogs-tab" role="tabpanel">
                        @include('admin.search.partials.blogs', ['blogs' => $blogs])
                    </div>

                    <!-- Categories Tab -->
                    <div class="tab-pane" id="categories-tab" role="tabpanel">
                        @include('admin.search.partials.categories', ['categories' => $categories])
                    </div>

                    <!-- Networks Tab -->
                    <div class="tab-pane" id="networks-tab" role="tabpanel">
                        @include('admin.search.partials.networks', ['networks' => $networks])
                    </div>
                </div>
                @elseif(isset($query))
                <div class="text-center py-5">
                    <i class="mdi mdi-search-off display-1 text-muted"></i>
                    <h4 class="mt-3">No results found for "{{ $query }}"</h4>
                    <p class="text-muted">Try adjusting your search terms or browse our stores.</p>
                    <a href="{{ route('admin.store.index') }}" class="btn btn-primary mt-2">
                        <i class="mdi mdi-store"></i> Browse Stores
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // ============ SEARCH FUNCTIONALITY ============
    
    let searchTimeout;
    const searchInput = $('#searchInput');
    const autocompleteResults = $('#autocompleteResults');
    const autocompleteList = $('#autocompleteList');
    const liveSearchResults = $('#liveSearchResults');
    const searchResultsContainer = $('#searchResultsContainer');
    const resultCount = $('#resultCount');
    const clearSearchBtn = $('#clearSearch');
    const searchForm = $('#searchForm');

    // Live search on input
    searchInput.on('input', function() {
        const query = $(this).val().trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            autocompleteResults.hide();
            liveSearchResults.hide();
            return;
        }

        // Show loading state
        autocompleteList.html('<div class="list-group-item text-center text-muted"><i class="mdi mdi-loading mdi-spin"></i> Searching...</div>');
        autocompleteResults.show();

        // Debounce search
        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    // Perform search
    function performSearch(query) {
        $.ajax({
            url: '{{ route("admin.search") }}',
            type: 'GET',
            data: { query: query, ajax: true },
            success: function(response) {
                if (response.status === 'success') {
                    displayAutocompleteResults(response);
                    displayLiveResults(response);
                } else if (response.status === 'redirect') {
                    window.location.href = response.url;
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const error = xhr.responseJSON;
                    autocompleteList.html('<div class="list-group-item text-danger">' + error.message + '</div>');
                } else {
                    autocompleteList.html('<div class="list-group-item text-danger">An error occurred. Please try again.</div>');
                }
            }
        });
    }

    // Display autocomplete results
    function displayAutocompleteResults(response) {
        let html = '';
        let totalResults = response.total_results || 0;

        if (totalResults === 0) {
            html = '<div class="list-group-item text-muted">No results found</div>';
        } else {
            html += `<div class="list-group-item list-group-item-light">Found ${totalResults} results</div>`;
            
            // We'll just show a preview in autocomplete
            html += '<div class="list-group-item text-muted small">Type to see more results or press Enter to view all</div>';
        }

        autocompleteList.html(html);
        autocompleteResults.show();
    }

    // Display live results using partials
    function displayLiveResults(response) {
        let totalResults = response.total_results || 0;

        if (totalResults === 0) {
            liveSearchResults.hide();
            return;
        }

        resultCount.text(totalResults + ' results found');
        searchResultsContainer.html(response.html);
        liveSearchResults.show();
    }

    // Handle form submission
    searchForm.on('submit', function(e) {
        e.preventDefault();
        const query = searchInput.val().trim();
        
        if (query.length < 2) {
            Swal.fire({
                title: 'Search Term Too Short',
                text: 'Please enter at least 2 characters to search.',
                icon: 'warning',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // Redirect to search results page
        window.location.href = '{{ route("admin.search.index") }}?query=' + encodeURIComponent(query);
    });

    // Clear search
    clearSearchBtn.on('click', function() {
        searchInput.val('');
        autocompleteResults.hide();
        liveSearchResults.hide();
        searchInput.focus();
    });

    // Close autocomplete on outside click
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-box').length) {
            autocompleteResults.hide();
        }
    });

    // Keyboard navigation for autocomplete
    searchInput.on('keydown', function(e) {
        const items = autocompleteList.find('.list-group-item-action');
        const currentIndex = items.index(items.filter('.active'));
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            items.removeClass('active');
            const nextIndex = Math.min(currentIndex + 1, items.length - 1);
            items.eq(nextIndex).addClass('active');
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            items.removeClass('active');
            const prevIndex = Math.max(currentIndex - 1, 0);
            items.eq(prevIndex).addClass('active');
        } else if (e.key === 'Enter') {
            const activeItem = autocompleteList.find('.list-group-item-action.active');
            if (activeItem.length) {
                e.preventDefault();
                window.location.href = activeItem.attr('href');
            }
        }
    });
});
</script>
@endsection

@section('styles')
<style>
    .header-title {
        position: relative;
        padding-bottom: 10px;
    }
    .header-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #727cf5;
    }
    
    /* Search Styles */
    .search-box {
        position: relative;
    }
    
    .autocomplete-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 0 0 4px 4px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
    }
    
    .autocomplete-dropdown .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 10px 15px;
        cursor: pointer;
    }
    
    .autocomplete-dropdown .list-group-item:hover,
    .autocomplete-dropdown .list-group-item.active {
        background-color: #f8f9fa;
    }
    
    .autocomplete-dropdown .list-group-item-light {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }
    
    #liveSearchResults .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    /* Tabs */
    .nav-tabs.nav-bordered .nav-item .nav-link.active {
        border-bottom: 2px solid #727cf5;
        color: #727cf5;
    }
    
    .nav-tabs.nav-bordered .nav-item .nav-link {
        border: none;
        color: #6c757d;
        padding: 10px 20px;
        font-weight: 500;
    }
    
    .nav-tabs.nav-bordered .nav-item .nav-link:hover {
        color: #727cf5;
    }
    
    .nav-tabs .nav-item .nav-link .badge {
        margin-left: 5px;
        font-size: 10px;
    }
</style>
@endsection