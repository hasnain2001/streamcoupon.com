<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\NetworkController;
use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\StoreController;
use App\Http\Controllers\Employee\CouponController;
use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\Employee\SearchController;
use App\Http\Controllers\Employee\LanguageController;


Route::middleware(['auth','role:employee'])->prefix('employee')->group(function(){
    Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');

    Route::resource('/network', NetworkController::class)->names('employee.network');
    Route::resource('/category', CategoryController::class)->names('employee.category');
    Route::resource('/store', StoreController::class)->names('employee.store');
    Route::delete('/store/deleteSelected', [StoreController::class, 'deleteSelected'])->name('employee.store.deleteSelected');
    Route::resource('/coupon', CouponController::class)->names('employee.coupon');
    Route::post('coupon/update-order',[CouponController::class,'updateOrder'])->name('employee.coupon.update-order');
    Route::resource('/blog', BlogController::class)->names('employee.blog');
    Route::delete('/blog/deleteSelected', [BlogController::class, 'deleteSelected'])->name('employee.blog.deleteSelected');

    Route::resource('/language', LanguageController::class)->names('employee.language');
     Route::controller(SearchController::class)->name('employee.')->group(function () {
    Route::get('/search/store', 'searchStores')->name('search.store');
    Route::get('/search/store/coupons', 'searchStoresCoupons')->name('search.store.coupons');
    Route::get('/search',  'search')->name('search');
    Route::get('/search_results',  'searchResults')->name('search_results');
    });

});


