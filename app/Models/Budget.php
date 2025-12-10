<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'amount',
        'alert_threshold',
        'period',
        'month',
        'year',
        'workspace_id',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'alert_threshold' => 'decimal:2',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get spent amount for this budget period
     */
    public function getSpentAmountAttribute(): float
    {
        $query = Transaction::where('workspace_id', $this->workspace_id)
            ->where('type', 'expense')
            ->whereYear('transaction_date', $this->year);

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->period === 'monthly' && $this->month) {
            $query->whereMonth('transaction_date', $this->month);
        }

        return $query->sum('amount');
    }

    /**
     * Get remaining budget amount
     */
    public function getRemainingAmountAttribute(): float
    {
        return max(0, $this->amount - $this->spent_amount);
    }

    /**
     * Get percentage spent
     */
    public function getSpentPercentageAttribute(): float
    {
        if ($this->amount == 0) {
            return 0;
        }

        return min(100, ($this->spent_amount / $this->amount) * 100);
    }

    /**
     * Check if budget has exceeded alert threshold
     */
    public function isAlertThresholdExceeded(): bool
    {
        return $this->spent_percentage >= $this->alert_threshold;
    }

    /**
     * Check if budget is exceeded
     */
    public function isExceeded(): bool
    {
        return $this->spent_amount > $this->amount;
    }

    /**
     * Get localized name
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
