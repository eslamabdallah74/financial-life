<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'title_ar',
        'message',
        'message_ar',
        'data',
        'read',
        'scheduled_for',
        'sent_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read' => 'boolean',
        'scheduled_for' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    /**
     * Scope to get scheduled notifications
     */
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_for')
            ->whereNull('sent_at');
    }

    /**
     * Scope to get pending notifications (ready to be sent)
     */
    public function scopePending($query)
    {
        return $query->whereNotNull('scheduled_for')
            ->whereNull('sent_at')
            ->where('scheduled_for', '<=', now());
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(): void
    {
        $this->update(['read' => true]);
    }

    /**
     * Mark notification as sent
     */
    public function markAsSent(): void
    {
        $this->update(['sent_at' => now()]);
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'ar' && $this->title_ar) {
            return $this->title_ar;
        }

        return $this->title;
    }

    /**
     * Get localized message
     */
    public function getLocalizedMessageAttribute(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'ar' && $this->message_ar) {
            return $this->message_ar;
        }

        return $this->message;
    }
}
