<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'transcript',
        'audio_file_path',
        'ai_confidence_score',
        'manually_edited',
        'transaction_date',
        'workspace_id',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
        'manually_edited' => 'boolean',
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
     * Scope to filter income transactions
     */
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope to filter expense transactions
     */
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }

    /**
     * Scope to filter by today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('transaction_date', today());
    }

    /**
     * Scope to filter by this week
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('transaction_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope to filter by this month
     */
    public function scopeThisMonth($query)
    {
        return $query->whereYear('transaction_date', now()->year)
            ->whereMonth('transaction_date', now()->month);
    }

    /**
     * Scope to filter by this year
     */
    public function scopeThisYear($query)
    {
        return $query->whereYear('transaction_date', now()->year);
    }

    /**
     * Get formatted date in Arabic locale
     */
    public function getArabicDateAttribute(): string
    {
        return Carbon::parse($this->transaction_date)->locale('ar')->translatedFormat('j F Y');
    }
}
