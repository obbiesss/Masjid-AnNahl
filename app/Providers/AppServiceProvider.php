<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MasjidProfile; // Ganti ini

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
        // Share $profile to all views
        View::composer('*', function ($view) {
            $profile = MasjidProfile::first();
            $view->with('profile', $profile);
        });
    }
}