<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\SitemapObserver;
use App\Models\Store;
use App\Models\Blog;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
    {
    if (!file_exists(public_path('uploads'))) {
        @symlink(storage_path('app/uploads'), public_path('uploads'));
    }

            Store::observe(SitemapObserver::class);
            Blog::observe(SitemapObserver::class);
            Category::observe(SitemapObserver::class);

    }
}
