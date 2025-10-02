<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Blog;

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

        $setting = null;
        $latest_blogs = collect();

        try {
            // Check if the tables exist before querying
            if (Schema::hasTable('settings')) {
                $setting = Setting::first() ?? new Setting();
            }
            
            if (Schema::hasTable('blogs')) {
                $latest_blogs = Blog::orderBy('created_at', 'desc')->limit(3)->get();
            }
        } catch (\Exception $e) {
            // If DB not connected or anything else fails, just keep defaults
        }

        // Share safely with views
        view()->share([
            'setting' => $setting,
            'latest_blogs' => $latest_blogs
        ]);
    
        Schema::defaultStringLength(191);
        Paginator::useBootstrap(); // Enable Bootstrap pagination
    }
}
