<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
        'is_replied',
        'replied_at',
        'reply_message',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime'
    ];

    /**
     * Scope a query to only unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('is_replied', true);
    }

    /**
     * Mark as read
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update(['is_read' => true]);
        }
    }

    /**
     * Mark as replied
     */
    public function markAsReplied(string $reply = null): void
    {
        $this->update([
            'is_replied' => true,
            'replied_at' => now(),
            'reply_message' => $reply
        ]);
    }
}