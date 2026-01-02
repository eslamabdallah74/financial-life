<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share balance with all authenticated layouts
        \Illuminate\Support\Facades\View::composer('layouts.app', \App\View\Composers\BalanceComposer::class);

        // Register User observer for auto-seeding categories
        \App\Models\User::observe(\App\Observers\UserObserver::class);
    }
}
