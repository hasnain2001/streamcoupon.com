<?php
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
    Route::get('/', function () {return view('welcome');});

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::middleware(['auth','role:user'])->group(function () {
        Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
    });
  Route::middleware([Localization::class])->group(function () {
    Route::group(['prefix' => '{lang}',], function () {
    Route::get('/imprint', function () {return view('front-end.imprint');})->name('imprint');
    Route::get('/privacy', function () { return view('front-end.privacy'); })->name('privacy');
    Route::get('/terms', function () { return view('front-end.terms'); })->name('terms');
    Route::get('/about', function () { return view('front-end.about'); })->name('about');
    Route::get('/contact',[ContactController::class, 'index'])->name('contact');
        });
      });

       Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');
    Route::middleware([Localization::class])->group(function () {
        Route::controller(HomeController::class)->group(function () {
                Route::get('/{lang?}', 'index')->name('home');
                Route::get('/{lang?}/stores', 'stores')->name('stores');
                Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store.detail');
                Route::get('/{lang}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');
                Route::get('{lang?}/category', 'category')->name('category');
                Route::get('/category/{slug}',function($slug) {return app(HomeController::class)->category_detail('en', $slug, request());})->name('category.detail');
            Route::get('{lang?}/category/{slug}', 'category_detail')->name('category.detail.withlang');
                Route::get('{lang?}/coupon', 'coupons')->name('coupons');
                Route::get('{lang?}/deal', 'deal')->name('deals');
                Route::get('{lang?}/coupon/{slug}', 'coupon_detail')->name('coupon.detail');
                Route::get('{lang?}/blog', 'blog')->name('blog');
                Route::get('/blog/{slug}',function($slug) {return app(HomeController::class)->blog_detail('en', $slug, request());})->name('blog.detail');
                Route::get('/{lang}/blog/{slug}', 'blog_detail')->name('blog-details.withLang');
            });
    });

    Route::controller(CouponController::class)->group(function () {
        Route::post('/update-clicks', 'updateClicks')->name('update.clicks');
        Route::get('/clicks/{couponId}',  'openCoupon')->name('open.coupon');
     });
   Route::controller(SearchController::class)->group(function () {
            Route::get('/Search/Store', 'search')->name('search');
            Route::get('/Search/Stores', 'searchResults')->name('search_results');
     });
        Route::controller(SitemapController::class)->group(function () {
            Route::get('/sitemap.xml', 'index')->name('sitemap.xml');
            Route::get('/generate-sitemap', 'generate')->name('generate-sitemap');
        });