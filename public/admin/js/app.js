// Enhanced Admin Layout JavaScript
document.addEventListener("DOMContentLoaded", function() {
    // Sidebar functionality
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const overlay = document.querySelector('.overlay');

    // Mobile navigation functionality
    const mobileToggle = document.getElementById("mobileMenuToggle");
    const mobileNav = document.getElementById("mobileNav");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const mobileSearchToggle = document.getElementById("mobileSearchToggle");
    const mobileSearchBar = document.getElementById("mobileSearchBar");
    const mobileSearchClose = document.getElementById("mobileSearchClose");

    // Sidebar toggle functionality
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            if (overlay) {
                overlay.classList.toggle('show');
            }
            document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
        });
    }

    // Close sidebar when clicking on overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            this.classList.remove('show');
            document.body.style.overflow = '';
        });
    }

    // Auto-hide sidebar on small screens when navigating
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                sidebar.classList.remove('show');
                if (overlay) {
                    overlay.classList.remove('show');
                }
                document.body.style.overflow = '';
            }
        });
    });

    // Mobile menu toggle
    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener("click", function() {
            mobileNav.classList.toggle("show");
            if (mobileOverlay) {
                mobileOverlay.classList.toggle("show");
            }
            document.body.style.overflow = mobileNav.classList.contains("show") ? "hidden" : "";
        });
    }

    // Mobile search toggle
    if (mobileSearchToggle && mobileSearchBar) {
        mobileSearchToggle.addEventListener("click", function() {
            mobileSearchBar.classList.toggle("show");
            if (mobileSearchBar.classList.contains("show")) {
                const searchInput = mobileSearchBar.querySelector('input');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });
    }

    // Mobile search close
    if (mobileSearchClose && mobileSearchBar) {
        mobileSearchClose.addEventListener("click", function() {
            mobileSearchBar.classList.remove("show");
        });
    }

    // Close mobile menu when clicking overlay
    if (mobileOverlay) {
        mobileOverlay.addEventListener("click", function() {
            if (mobileNav) mobileNav.classList.remove("show");
            this.classList.remove("show");
            document.body.style.overflow = "";
        });
    }

    // Close mobile menu when clicking links
    document.querySelectorAll('.mobile-nav-links .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (mobileNav) mobileNav.classList.remove("show");
            if (mobileOverlay) mobileOverlay.classList.remove("show");
            document.body.style.overflow = "";
        });
    });

    // Enhanced dropdown animations
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        dropdown.addEventListener('show.bs.dropdown', function () {
            const dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.style.opacity = '0';
                dropdownMenu.style.transform = 'translateY(-10px) scale(0.95)';
            }
        });

        dropdown.addEventListener('shown.bs.dropdown', function () {
            const dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.style.opacity = '1';
                dropdownMenu.style.transform = 'translateY(0) scale(1)';
                dropdownMenu.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            }
        });
    });

    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced card hover effects
    document.querySelectorAll('.stats-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-5px) scale(1)';
        });
    });

    // Active link highlighting
    function setActiveLink() {
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    setActiveLink();

    // Responsive adjustments
    function handleResize() {
        if (window.innerWidth >= 992) {
            if (sidebar) sidebar.classList.remove('show');
            if (overlay) overlay.classList.remove('show');
            if (mobileNav) mobileNav.classList.remove('show');
            if (mobileOverlay) mobileOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    window.addEventListener('resize', handleResize);

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add loading states to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('btn-loading')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                this.disabled = true;

                // Reset after 2 seconds for demo purposes
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            }
        });
    });
});

// Utility function for showing notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show`;
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 5000);
}
