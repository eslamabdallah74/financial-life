<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingsGoal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'target_amount',
        'current_amount',
        'deadline',
        'status',
        'icon',
        'color',
        'workspace_id',
        'user_id',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'deadline' => 'date',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate progress percentage
     */
    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_amount == 0) {
            return 0;
        }

        return min(100, ($this->current_amount / $this->target_amount) * 100);
    }

    /**
     * Get remaining amount to reach goal
     */
    public function getRemainingAmountAttribute(): float
    {
        return max(0, $this->target_amount - $this->current_amount);
    }

    /**
     * Check if goal is completed
     */
    public function isCompleted(): bool
    {
        return $this->current_amount >= $this->target_amount;
    }

    /**
     * Check if goal is overdue
     */
    public function isOverdue(): bool
    {
        return $this->deadline && $this->deadline < now() && !$this->isCompleted();
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

        return $this->name;
    }
}
