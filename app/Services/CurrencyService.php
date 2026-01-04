<?php

namespace App\Services;

use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;

class CurrencyService
{
    /**
     * Map of currency codes to symbols
     */
    protected static array $symbols = [
        'EGP' => 'EGP',
        'SAR' => 'SR',
        'AED' => 'DH',
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'KWD' => 'KD',
        'QAR' => 'QR',
        'OMR' => 'OR',
        'BHD' => 'BD',
        'JOD' => 'JD',
        'LBP' => 'LL',
    ];

    /**
     * Get the current user's currency code
     */
    public function getCurrencyCode(): string
    {
        if (!Auth::check()) {
            return 'USD';
        }

        return Auth::user()->settings?->currency ?? 'USD';
    }

    /**
     * Get the symbol for a given currency code
     */
    public function getSymbol(string $code = null): string
    {
        $code = $code ?: $this->getCurrencyCode();
        return self::$symbols[$code] ?? $code;
    }

    /**
     * Format an amount with the user's currency
     */
    public function format(float $amount): string
    {
        $symbol = $this->getSymbol();
        $formatted = number_format($amount, 2);

        // Decide placement based on currency (simple rule: symbols like $ prefix, codes suffix)
        if (in_array($symbol, ['$', '€', '£'])) {
            return $symbol . $formatted;
        }

        return $formatted . ' ' . $symbol;
    }
}
