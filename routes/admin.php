<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NetworkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SliderController;

  Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('/user', AdminController::class)->names('admin.user');

    Route::resource('/language', LanguageController::class)->names('admin.language');

    Route::resource('/network', NetworkController::class)->names('admin.network');

    Route::resource('/category', CategoryController::class)->names('admin.category');

    Route::resource('/store', StoreController::class)->names('admin.store');
    Route::delete('/store/deleteSelected', [StoreController::class, 'deleteSelected'])->name('admin.store.deleteSelected');

    Route::resource('/coupon', CouponController::class)->names('admin.coupon');
    Route::post('coupon/update-order',[CouponController::class,'updateOrder'])->name('admin.coupon.update-order');

    Route::resource('/blog', BlogController::class)->names('admin.blog');
    Route::delete('/blog/deleteSelected', [BlogController::class, 'deleteSelected'])->name('admin.blog.deleteSelected');

    Route::controller(SearchController::class)->name('admin.')->group(function () {
    Route::get('/search/store', 'searchStores')->name('search.store');
    Route::get('/search/store/coupons', 'searchStoresCoupons')->name('search.store.coupons');
    Route::get('/search',  'search')->name('search');
    Route::get('/search_results',  'searchResults')->name('search_results');
    });
    Route::resource('/slider', SliderController::class)->names('admin.slider');
    Route::patch('/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('admin.slider.toggle-status');
    Route::get('/export', [SliderController::class, 'export'])->name('admin.slider.export');

});
