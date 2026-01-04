<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'currency',
        'language',
        'theme',
        'notifications_enabled',
        'email_notifications',
        'push_notifications',
        'budget_alerts',
        'savings_reminders',
        'cloud_sync_enabled',
        'timezone',
    ];

    protected $casts = [
        'notifications_enabled' => 'boolean',
        'email_notifications' => 'boolean',
        'push_notifications' => 'boolean',
        'budget_alerts' => 'boolean',
        'savings_reminders' => 'boolean',
        'cloud_sync_enabled' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get or create settings for a user
     */
    public static function getOrCreateForUser(int $userId): self
    {
        return self::firstOrCreate(
            ['user_id' => $userId],
            [
                'currency' => 'EGP',
                'language' => 'ar',
                'theme' => 'auto',
                'notifications_enabled' => true,
                'email_notifications' => true,
                'push_notifications' => true,
                'budget_alerts' => true,
                'savings_reminders' => true,
                'cloud_sync_enabled' => true,
                'timezone' => 'Africa/Cairo',
            ]
        );
    }

    /**
     * Available currencies
     */
    public static function availableCurrencies(): array
    {
        return [
            'EGP' => 'Egyptian Pound',
            'SAR' => 'Saudi Riyal',
            'AED' => 'UAE Dirham',
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'GBP' => 'British Pound',
            'KWD' => 'Kuwaiti Dinar',
            'QAR' => 'Qatari Riyal',
            'OMR' => 'Omani Rial',
            'BHD' => 'Bahraini Dinar',
            'JOD' => 'Jordanian Dinar',
            'LBP' => 'Lebanese Pound',
        ];
    }
}
