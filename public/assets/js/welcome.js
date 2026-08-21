        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS (scroll animations)
            AOS.init({
                duration: 600,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });

            // Store Swiper – 3 per row on desktop
            new Swiper('.storesSwiper', {
                slidesPerView: 1,
                spaceBetween: 16,
                loop: false,
                navigation: {
                    nextEl: '.stores-section .swiper-button-next',
                    prevEl: '.stores-section .swiper-button-prev',
                },
                pagination: {
                    el: '.stores-section .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    576: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 2, spaceBetween: 24 },
                    992: { slidesPerView: 3, spaceBetween: 24 },
                    1200: { slidesPerView: 3, spaceBetween: 30 }
                }
            });

            // Auto-play hero carousel (already set via data-bs-interval)
        });