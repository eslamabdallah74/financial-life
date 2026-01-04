<?php

use App\Services\CurrencyService;

if (!function_exists('money')) {
    /**
     * Format money using CurrencyService
     */
    function money(float $amount): string
    {
        return app(CurrencyService::class)->format($amount);
    }
}

if (!function_exists('currency_symbol')) {
    /**
     * Get the current currency symbol
     */
    function currency_symbol(): string
    {
        return app(CurrencyService::class)->getSymbol();
    }
}
