document.addEventListener('DOMContentLoaded', function() {
    // Header Scroll Hide/Show Functionality
    const header = document.getElementById('header');
    let lastScrollTop = 0;
    let scrollTimeout;
    
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
        
        // Calculate scroll distance and speed
        const scrollDiff = scrollTop - lastScrollTop;
        
        if (scrollTop > 100) { // Only hide/show after 100px scroll
            if (scrollDiff > 5) {
                // Scrolling down - hide header
                header.classList.add('header-hidden');
            } else if (scrollDiff < -5) {
                // Scrolling up - show header
                header.classList.remove('header-hidden');
            }
        }
        
        lastScrollTop = scrollTop;
        
        // Set timeout to show header if user stops scrolling
        scrollTimeout = setTimeout(() => {
            if (scrollTop > 0) {
                header.classList.remove('header-hidden');
            }
        }, 1500); // Show after 1.5 seconds of inactivity
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
    let mouseMoveTimeout;
    document.addEventListener('mousemove', function(e) {
        if (e.clientY < 100) { // If mouse is near top of screen
            header.classList.remove('header-hidden');
            clearTimeout(mouseMoveTimeout);
            mouseMoveTimeout = setTimeout(() => {
                if (window.pageYOffset > 100) {
                    header.classList.add('header-hidden');
                }
            }, 2000); // Hide again after 2 seconds
        }
    });
    
    // Mobile Navigation
    const mobileNav = {
        init() {
            this.bindEvents();
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
            document.addEventListener('keydown', e => e.key === 'Escape' && this.toggle(false));
            
            // Active link handling
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    document.querySelectorAll('.mobile-nav-link').forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                    setTimeout(() => this.toggle(false), 300);
                });
            });
        },
        
        toggle(show) {
            const overlay = document.getElementById('mobileNavOverlay');
            const container = document.getElementById('mobileNavContainer');
            const toggler = document.getElementById('mobileNavToggle');
            
            if (show) {
                overlay.classList.add('active');
                container.classList.add('active');
                toggler.classList.add('active');
                document.body.style.overflow = 'hidden';
                header.classList.remove('header-hidden'); // Show header when mobile nav opens
            } else {
                overlay.classList.remove('active');
                container.classList.remove('active');
                toggler.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
    };
    
    mobileNav.init();
    
    // Search Suggestions
    const searchInput = document.getElementById('searchInput');
    const suggestionsContainer = document.getElementById('searchSuggestions');
    
    if (searchInput && suggestionsContainer) {
        searchInput.addEventListener('focus', () => {
            showPlaceholderSuggestions();
        });
        
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            
            if (query.length > 1) {
                fetchSuggestions(query);
            } else if (query.length === 0) {
                showPlaceholderSuggestions();
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
        
        function showPlaceholderSuggestions() {
            const suggestions = [
                { text: 'Popular Coupons', icon: 'bi-ticket-perforated' },
                { text: 'Latest Deals', icon: 'bi-tags' },
                { text: 'Featured Stores', icon: 'bi-shop' },
                { text: 'Top Categories', icon: 'bi-grid-3x3-gap' }
            ];
            
            suggestionsContainer.innerHTML = suggestions.map(item => `
                <div class="suggestion-item">
                    <i class="bi ${item.icon} text-primary"></i>
                    <span>${item.text}</span>
                </div>
            `).join('');
            
            suggestionsContainer.style.display = 'block';
        }
        
        function fetchSuggestions(query) {
            // In a real application, you would fetch from API
            const mockSuggestions = [
                { text: `${query} coupons`, icon: 'bi-ticket-perforated' },
                { text: `${query} deals`, icon: 'bi-tags' },
                { text: `${query} stores`, icon: 'bi-shop' },
                { text: `Category: ${query}`, icon: 'bi-grid-3x3-gap' }
            ];
            
            suggestionsContainer.innerHTML = mockSuggestions.map(item => `
                <div class="suggestion-item">
                    <i class="bi ${item.icon} text-primary"></i>
                    <span>${item.text}</span>
                </div>
            `).join('');
            
            suggestionsContainer.style.display = 'block';
        }
    }
});