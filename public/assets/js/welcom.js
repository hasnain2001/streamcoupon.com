   // Optional: Add autoplay functionality
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000, // Change slide every 5 seconds
            pause: 'hover' // Pause on hover
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Store Swiper
        new Swiper('.storesSwiper', {
            slidesPerView: 6,
            spaceBetween: 24,
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
                0: { slidesPerView: 1 },
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 },
                1200: { slidesPerView: 6 }
            }
        });

        // Category Swiper
        new Swiper('.categorySwiper', {
            slidesPerView: 6,
            spaceBetween: 24,
            loop: false,
            navigation: {
                nextEl: '.category-section .swiper-button-next',
                prevEl: '.category-section .swiper-button-prev',
            },
            pagination: {
                el: '.category-section .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 },
                1200: { slidesPerView: 6 }
            }
        });
    });
