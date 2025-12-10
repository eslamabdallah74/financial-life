<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'name_en',
        'type',
        'color',
        'icon',
        'is_default',
        'workspace_id',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }

    /**
     * Get localized name based on app locale
     */
    public function getLocalizedNameAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'ar' && $this->name_ar) {
            return $this->name_ar;
        }

        if ($locale === 'en' && $this->name_en) {
            return $this->name_en;
        }

        return $this->name;
    }

    /**
     * Scope to get income categories
     */
    public function scopeIncome($query)
    {
        return $query->whereIn('type', ['income', 'both']);
    }

    /**
     * Scope to get expense categories
     */
    public function scopeExpense($query)
    {
        return $query->whereIn('type', ['expense', 'both']);
    }
}
