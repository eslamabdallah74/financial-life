<?php

namespace App\Providers;

use App\Services\CurrencyService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyService::class, function ($app) {
            return new CurrencyService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share balance with all authenticated layouts
        View::composer('layouts.app', \App\View\Composers\BalanceComposer::class);

        // Register User observer for auto-seeding categories
        \App\Models\User::observe(\App\Observers\UserObserver::class);

        // Blade Directive: @money($amount)
        Blade::directive('money', function ($expression) {
            return "<?php echo money($expression); ?>";
        });

        // Blade Directive: @currencySymbol
        Blade::directive('currencySymbol', function () {
            return "<?php echo currency_symbol(); ?>";
        });
    }
}
