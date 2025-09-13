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

        $setting = Setting::first();
        $latest_blogs = Blog::orderBy('created_at','desc')->limit(3)->get();

        view()->share([
        'setting' => $setting,
        'latest_blogs' => $latest_blogs
        ]);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap(); // Enable Bootstrap pagination
    }
}
