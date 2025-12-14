    document.addEventListener('DOMContentLoaded', function ()
    
    {
        const mobileNav = {
            init() {
                this.bindEvents();
                this.initScrollHeader();
                this.initSearchSuggestions();
            },
            bindEvents() {
                const toggler = document.getElementById('mobileNavToggle');
                const closeBtn = document.getElementById('mobileNavClose');
                const overlay = document.getElementById('mobileNavOverlay');
                const container = document.getElementById('mobileNavContainer');

                toggler?.addEventListener('click', () => this.toggle(true));
                closeBtn?.addEventListener('click', () => this.toggle(false));
                overlay?.addEventListener('click', () => this.toggle(false));
                document.addEventListener('keydown', e => e.key === 'Escape' && this.toggle(false));

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
                } else {
                    overlay.classList.remove('active');
                    container.classList.remove('active');
                    toggler.classList.remove('active');
                    document.body.style.overflow = '';
                }
            },
            initScrollHeader() {
                const header = document.getElementById('header');
                let last = 0;
                window.addEventListener('scroll', () => {
                    const cur = window.scrollY;
                    if (cur > last && cur > 120) header.classList.add('hide-header');
                    else header.classList.remove('hide-header');
                    last = cur;
                });
            },
            initSearchSuggestions() {
                const searchInput = document.getElementById('searchInput');
                const suggestionsContainer = document.getElementById('searchSuggestions');

                if (!searchInput || !suggestionsContainer) return;

                // Hide suggestions when clicking outside
                document.addEventListener('click', (e) => {
                    if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                        suggestionsContainer.classList.remove('active');
                    }
                });

                searchInput.addEventListener('focus', () => {
                    this.showPlaceholderSuggestions(suggestionsContainer);
                });


                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.trim();

                    if (query.length > 1) {
                        this.fetchSuggestions(query, suggestionsContainer);
                    } else if (query.length === 0) {
                        this.showPlaceholderSuggestions(suggestionsContainer);
                    } else {
                        suggestionsContainer.classList.remove('active');
                    }
                });
            },
            showPlaceholderSuggestions(container) {
                const placeholderSuggestions = [
                    { text: 'Popular Coupons', icon: 'bi-ticket-perforated' },
                    { text: 'Latest Deals', icon: 'bi-tags' },
                    { text: 'Featured Stores', icon: 'bi-shop' },
                    { text: 'Top Categories', icon: 'bi-grid-3x3-gap' }
                ];

                container.innerHTML = placeholderSuggestions.map(item => `
                    <div class="suggestion-item">
                        <i class="bi ${item.icon} text-primary"></i>
                        <span>${item.text}</span>
                    </div>
                `).join('');

                container.classList.add('active');
            },
            fetchSuggestions(query, container) {
                setTimeout(() => {
                    const mockSuggestions = [
                        { text: `${query} coupons`, icon: 'bi-ticket-perforated',},
                        { text: `${query} deals`, icon: 'bi-tags' },
                        { text: `${query} stores`, icon: 'bi-shop' },
                        { text: `Category: ${query}`, icon: 'bi-grid-3x3-gap' }
                    ];

                    container.innerHTML = mockSuggestions.map(item => `
                        <div class="suggestion-item">
                            <i class="bi ${item.icon} text-primary"></i>
                            <span>${item.text}</span>
                        </div>
                    `).join('');

                    container.classList.add('active');
                }, 300);
            }
        };
        mobileNav.init();
    });
