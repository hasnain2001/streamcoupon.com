document.addEventListener('DOMContentLoaded', function() {
    // Header Scroll Hide/Show Functionality
    const header = document.getElementById('header');
    let lastScrollTop = 0;
    let scrollTimeout;
    let mouseMoveTimeout;

    // Configuration
    const SCROLL_THRESHOLD = 100; // Minimum scroll to start hiding header
    const SCROLL_DIFF_THRESHOLD = 5; // Scroll speed threshold
    const SHOW_DELAY = 1500; // Delay to show header after scroll stops
    const MOUSE_HIDE_DELAY = 2000; // Delay to hide header after mouse leaves top
    const HEADER_HEIGHT = header?.offsetHeight || 80; // Dynamic header height

    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Clear any existing timeout
        clearTimeout(scrollTimeout);

        // Add scrolled class for shadow effect
        if (scrollTop > 20) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }

        // Don't hide/show if mobile nav is open
        const isMobileNavOpen = document.getElementById('mobileNavContainer')?.classList.contains('active');
        if (isMobileNavOpen) {
            return;
        }

        // Calculate scroll distance and speed
        const scrollDiff = scrollTop - lastScrollTop;

        if (scrollTop > SCROLL_THRESHOLD) {
            if (scrollDiff > SCROLL_DIFF_THRESHOLD && scrollTop > HEADER_HEIGHT) {
                // Scrolling down - hide header
                header.classList.add('header-hidden');
            } else if (scrollDiff < -SCROLL_DIFF_THRESHOLD) {
                // Scrolling up - show header
                header.classList.remove('header-hidden');
            }
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Prevent negative scroll

        // Set timeout to show header if user stops scrolling
        scrollTimeout = setTimeout(() => {
            if (scrollTop > 0 && !isMobileNavOpen) {
                header.classList.remove('header-hidden');
            }
        }, SHOW_DELAY);
    }

    // Throttle scroll events for better performance
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });

    // Show header on mouse move near top
    document.addEventListener('mousemove', function(e) {
        const isMobileNavOpen = document.getElementById('mobileNavContainer')?.classList.contains('active');

        if (isMobileNavOpen) return; // Don't hide when mobile nav is open

        if (e.clientY < 100) { // If mouse is near top of screen
            header.classList.remove('header-hidden');
            clearTimeout(mouseMoveTimeout);
            mouseMoveTimeout = setTimeout(() => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > SCROLL_THRESHOLD && !isMobileNavOpen) {
                    header.classList.add('header-hidden');
                }
            }, MOUSE_HIDE_DELAY);
        }
    });

    // Mobile Navigation
    const mobileNav = {
        init() {
            this.bindEvents();
            this.setActiveLink(); // Set active link on page load
        },

        bindEvents() {
            const toggler = document.getElementById('mobileNavToggle');
            const closeBtn = document.getElementById('mobileNavClose');
            const overlay = document.getElementById('mobileNavOverlay');
            const container = document.getElementById('mobileNavContainer');

            toggler?.addEventListener('click', () => this.toggle(true));
            closeBtn?.addEventListener('click', () => this.toggle(false));
            overlay?.addEventListener('click', () => this.toggle(false));

            // Close on escape key
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    this.toggle(false);
                }
            });

            // Handle link clicks
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    // Only handle if it's not a dropdown toggle
                    if (!link.hasAttribute('data-toggle')) {
                        this.handleLinkClick(e, link);
                    }
                });
            });
        },

        toggle(show) {
            const overlay = document.getElementById('mobileNavOverlay');
            const container = document.getElementById('mobileNavContainer');
            const toggler = document.getElementById('mobileNavToggle');

            if (show) {
                overlay?.classList.add('active');
                container?.classList.add('active');
                toggler?.classList.add('active');
                document.body.style.overflow = 'hidden';
                header?.classList.remove('header-hidden'); // Show header when mobile nav opens
            } else {
                overlay?.classList.remove('active');
                container?.classList.remove('active');
                toggler?.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Dispatch custom event
            const event = new CustomEvent('mobileNavToggle', {
                detail: { isOpen: show }
            });
            document.dispatchEvent(event);
        },

        handleLinkClick(e, link) {
            e.preventDefault();
            const url = link.getAttribute('href');

            // Remove active class from all links
            document.querySelectorAll('.mobile-nav-link').forEach(l => l.classList.remove('active'));

            // Add active class to clicked link
            link.classList.add('active');

            // Smooth navigation with delay
            setTimeout(() => {
                this.toggle(false);
                setTimeout(() => {
                    window.location.href = url;
                }, 300);
            }, 300);
        },

        setActiveLink() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                const href = link.getAttribute('href');
                if (href && href === currentPath) {
                    link.classList.add('active');
                }
            });
        }
    };

    mobileNav.init();

    // Search Suggestions - IMPROVED VERSION
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.querySelector('.search-box form');
    const suggestionsContainer = document.getElementById('searchSuggestions');

    if (searchInput && suggestionsContainer) {
        let debounceTimeout;
        let isFetching = false;

        // Show suggestions on focus
        searchInput.addEventListener('focus', () => {
            if (!searchInput.value.trim()) {
                showPlaceholderSuggestions();
            } else if (searchInput.value.length > 1) {
                fetchSuggestions(searchInput.value);
            }
        });

        // Handle input with debouncing
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();

            clearTimeout(debounceTimeout);

            if (query.length === 0) {
                showPlaceholderSuggestions();
                return;
            }

            if (query.length < 2) {
                suggestionsContainer.style.display = 'none';
                return;
            }

            // Debounce API calls
            debounceTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        // Handle form submission
        searchForm?.addEventListener('submit', (e) => {
            if (!searchInput.value.trim()) {
                e.preventDefault();
                searchInput.focus();
                return;
            }
            suggestionsContainer.style.display = 'none';
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (suggestionsContainer &&
                !searchInput.contains(e.target) &&
                !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', (e) => {
            const items = suggestionsContainer.querySelectorAll('.suggestion-item');

            if (!items.length || suggestionsContainer.style.display === 'none') return;

            let currentIndex = -1;
            items.forEach((item, index) => {
                if (item.classList.contains('selected')) {
                    currentIndex = index;
                }
            });

            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    if (currentIndex < items.length - 1) {
                        items.forEach(item => item.classList.remove('selected'));
                        items[currentIndex + 1].classList.add('selected');
                    }
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    if (currentIndex > 0) {
                        items.forEach(item => item.classList.remove('selected'));
                        items[currentIndex - 1].classList.add('selected');
                    }
                    break;
                case 'Enter':
                    e.preventDefault();
                    const selected = suggestionsContainer.querySelector('.suggestion-item.selected');
                    if (selected) {
                        const url = selected.getAttribute('data-url') ||
                                   `/search?query=${encodeURIComponent(searchInput.value)}`;
                        window.location.href = url;
                    }
                    break;
                case 'Escape':
                    suggestionsContainer.style.display = 'none';
                    break;
            }
        });

        function showPlaceholderSuggestions() {
            if (isFetching) return;

            const suggestions = [
                {
                    text: 'Popular Coupons',
                    icon: 'bi-ticket-perforated',
                    url: '/coupons?sort=popular'
                },
                {
                    text: 'Latest Deals',
                    icon: 'bi-tags',
                    url: '/deals?sort=latest'
                },
                {
                    text: 'Featured Stores',
                    icon: 'bi-shop',
                    url: '/stores?featured=true'
                },
                {
                    text: 'Top Categories',
                    icon: 'bi-grid-3x3-gap',
                    url: '/categories'
                }
            ];

            suggestionsContainer.innerHTML = suggestions.map(item => `
                <div class="suggestion-item" data-url="${item.url}">
                    <i class="bi ${item.icon} text-primary me-2"></i>
                    <span class="flex-grow-1">${item.text}</span>
                    <i class="bi bi-arrow-right-short text-muted"></i>
                </div>
            `).join('');

            suggestionsContainer.style.display = 'block';
        }

        async function fetchSuggestions(query) {
            if (isFetching) return;

            isFetching = true;
            suggestionsContainer.innerHTML = `
                <div class="suggestion-loading">
                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="text-muted">Searching...</span>
                </div>
            `;
            suggestionsContainer.style.display = 'block';

            try {
                // Simulate API call - Replace with actual API endpoint
                await new Promise(resolve => setTimeout(resolve, 300));

                const mockSuggestions = [
                    {
                        text: `${query} coupons`,
                        icon: 'bi-ticket-perforated',
                        url: `/search/coupons?query=${encodeURIComponent(query)}`
                    },
                    {
                        text: `${query} deals`,
                        icon: 'bi-tags',
                        url: `/search/deals?query=${encodeURIComponent(query)}`
                    },
                    {
                        text: `${query} stores`,
                        icon: 'bi-shop',
                        url: `/search/stores?query=${encodeURIComponent(query)}`
                    },
                    {
                        text: `Category: ${query}`,
                        icon: 'bi-grid-3x3-gap',
                        url: `/search/categories?query=${encodeURIComponent(query)}`
                    }
                ];

                suggestionsContainer.innerHTML = mockSuggestions.map(item => `
                    <div class="suggestion-item" data-url="${item.url}">
                        <i class="bi ${item.icon} text-primary me-2"></i>
                        <span class="flex-grow-1">${item.text}</span>
                        <i class="bi bi-arrow-right-short text-muted"></i>
                    </div>
                `).join('');

            } catch (error) {
                console.error('Failed to fetch suggestions:', error);
                suggestionsContainer.innerHTML = `
                    <div class="suggestion-error text-danger p-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Failed to load suggestions
                    </div>
                `;
            } finally {
                isFetching = false;
            }
        }

        // Add CSS for loading and selected states
        const style = document.createElement('style');
        style.textContent = `
            .suggestion-item.selected {
                background: rgba(30, 138, 136, 0.1);
                border-left: 3px solid var(--primary);
            }
            .suggestion-loading {
                padding: 12px 20px;
                display: flex;
                align-items: center;
                color: var(--text-secondary);
            }
            .suggestion-error {
                text-align: center;
                font-size: 0.9rem;
            }
        `;
        document.head.appendChild(style);
    }

    // Touch device support
    if ('ontouchstart' in window) {
        // Add touch-specific optimizations
        document.documentElement.classList.add('touch-device');

        // Prevent header hide on mobile when scrolling
        window.addEventListener('touchstart', () => {
            if (window.pageYOffset > 100) {
                header?.classList.remove('header-hidden');
            }
        });
    }

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Close mobile nav on desktop
            if (window.innerWidth >= 768) {
                mobileNav.toggle(false);
            }
        }, 250);
    });

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
