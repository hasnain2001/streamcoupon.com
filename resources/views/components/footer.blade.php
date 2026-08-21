<footer class="py-5 text-capitalize">
    <div class="container">
        <div class="row g-4">
            <!-- Logo & About Column -->
            <div class="col-lg-4 col-md-6">
                <div class="mb-4">
                    <a href="{{ url(app()->getLocale()) }}" class="footer-logo d-inline-block">
                        <x-application-logo class="img-fluid" />
                    </a>
                </div>
                <p class="text-light mb-4">
                    @lang('common.about_footer')
                </p>
                <div class="social-links">
                    <a href="https://www.facebook.com/profile.php?id=61592843130515" title="Facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/streamcoupon/" title="Instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.tiktok.com/@streamcoupon" title="Tiktok" target="_blank"><i class="bi bi-tiktok"></i></a>
                    <a href="https://www.threads.com/@streamcoupon" title="Threads" target="_blank"><i class="bi bi-threads"></i></a>
                    <a href="https://www.pinterest.com/streamcoupon/" title="Pinterest" target="_blank"><i class="bi bi-pinterest"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-lg-2 col-md-6"> 
                <h5 class="footer-heading">@lang('common.quick_links')</h5>
                <ul class="footer-links">
                    <li><a href="{{ url(app()->getLocale()) }}"><i class="bi bi-chevron-right"></i> @lang('common.home')</a></li>
                    <li><a href="{{ route('category', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> @lang('common.categories')</a></li>
                    <li><a href="{{ route('blog', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> @lang('common.blogs')</a></li>
                    <li><a href="{{ route('about', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> @lang('common.about')</a></li>
                    <li><a href="{{ route('faq', ['lang' => app()->getLocale()]) }}"><i class="bi bi-chevron-right"></i> @lang('common.faq')</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">@lang('common.contact_info')</h5>
                <ul class="contact-info">
                    <li>
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <strong>@lang('common.address'):</strong><br>
                           <span> 3000 Hoffman Dr,Plano, Tx USA 75074 ,United States of America</span>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        <div>
                            <strong>@lang('common.phone'):</strong>
                            <a href="tel:++17473651163" class="text-light text-decoration-none">+17473651163</a>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-envelope"></i>
                        <div>
                            <strong>@lang('common.email'):</strong>
                           <a href="mailto:contact@streamcoupon.com" class="text-light text-decoration-none">contact@streamcoupon.com</a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">@lang('common.newsletter')</h5>
                <p class="text-light mb-3">
                    @lang('common.subscribe_newsletter')
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="@lang('common.enter_email')" required>
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
                        @lang('common.copyright', ['year' => date('Y'), 'name' => config('app.name')])
                    </p>
                </div>
                <div class="col-md-8">
                    <div class="footer-bottom-links">
                        <a href="{{ route('privacy', ['lang' => app()->getLocale()]) }}">@lang('common.privacy_policy')</a>
                        <a href="{{ route('terms', ['lang' => app()->getLocale()]) }}">@lang('common.terms_of_service')</a>
                        <a href="{{ route('contact', ['lang' => app()->getLocale()]) }}">@lang('common.contact')</a>
                        <a href="{{ route('imprint', ['lang' => app()->getLocale()]) }}">@lang('common.imprint')</a>
                        <a href="{{ route('about', ['lang' => app()->getLocale()]) }}">@lang('common.about')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- <!-- Back to Top Button -->
<button class="back-to-top" id="backToTop">
    <i class="bi bi-chevron-up"></i>
</button> --}}