<footer class="py-5 text-capitalize">
    <div class="container">
        <div class="row g-4">
            <!-- Logo & About Column -->
            <div class="col-lg-4 col-md-6">
                <div class="mb-4">
                    <a href="{{ url('/') }}" class="footer-logo d-inline-block">
                        <x-application-logo class="img-fluid" />
                    </a>
                </div>
                <p class="text-light mb-4">
                    Your trusted source for the best deals, coupons, and savings.
                    Join thousands of happy customers saving every day.
                </p>
                <div class="social-links">
                    <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" title="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ url(app()->getLocale()) }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('stores', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> Stores</a></li>
                    <li><a href="{{ route('category', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> Categories</a></li>
                    <li><a href="{{ route('coupons', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> Coupons</a></li>
                    <li><a href="{{ route('blog', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> Blog</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Contact Info</h5>
                <ul class="contact-info">
                    <li>
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <strong>Address:</strong><br>
                           <span> 3000 Hoffman Dr,Plano, Tx USA 75074 ,United States of America</span>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        <div>
                            <strong>Phone:</strong>
                            <a href="tel:++17473651163" class="text-light text-decoration-none">+17473651163</a>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-envelope"></i>
                        <div>
                            <strong>Email:</strong>
                           <a href="mailto: contact@streamcoupon.com" class="text-light text-decoration-none"> contact@streamcoupon.com</a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Newsletter</h5>
                <p class="text-light mb-3">
                    Subscribe to get special offers, free giveaways, and amazing deals!
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email address" required>
                    <button type="submit" class="newsletter-btn">
                        <i class="bi bi-send"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom mt-5">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <p class="copyright mb-0">
                        &copy; {{ date('Y') }} <a href="http://streamcoupon.com" target="_blank" class="text-light">streamcoupon</a>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="{{ route('privacy',['lang' => app()->getLocale()]) }}">Privacy Policy</a>
                        <a href="{{ route('terms',['lang' => app()->getLocale()]) }}">Terms of Service</a>
                        <a href="{{ route('contact',['lang' => app()->getLocale()]) }}">Contact Us</a>
                        <a href="{{ route('imprint',['lang' => app()->getLocale()]) }}">Imprint </a>
                          <a href="{{ route('about',['lang' => app()->getLocale()]) }}">About </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop">
    <i class="bi bi-chevron-up"></i>
</button>

