<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\SitemapObserver;
use App\Models\Store;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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
        // Create storage symlink if it doesn't exist
        if (!file_exists(public_path('storage'))) {
            $this->createStorageLink();
        }

        // Register observers
        Store::observe(SitemapObserver::class);
        Blog::observe(SitemapObserver::class);
        Category::observe(SitemapObserver::class);
    }

    /**
     * Create storage link using Storage facade
     */
    protected function createStorageLink(): void
    {
        try {
            // Use the storage facade to create the symbolic link
            if (Storage::disk('public')->exists('')) {
                // The public disk is already configured
                // Alternative: Use symlink function with proper error handling
                $target = storage_path('app/public');
                $link = public_path('storage');
                
                if (!file_exists($link) && !is_link($link)) {
                    symlink($target, $link);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Failed to create storage symlink: ' . $e->getMessage());
        }
    }
}