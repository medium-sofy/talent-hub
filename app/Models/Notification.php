<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message',
        'is_read',
        'notifiable_type',
        'notifiable_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Mark the notification as read.
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update(['is_read' => true]);
        }
    }

    /**
     * Mark the notification as unread.
     */
    public function markAsUnread()
    {
        if ($this->is_read) {
            $this->update(['is_read' => false]);
        }
    }

    /**
     * Check if the notification is read.
     *
     * @return bool
     */
    public function read()
    {
        return $this->is_read;
    }

    /**
     * Check if the notification is unread.
     *
     * @return bool
     */
    public function unread()
    {
        return !$this->is_read;
    }

    /**
     * Notification belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Notification belongs to a notifiable.
     */
    public function notifiable()
    {
        return $this->morphTo();
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    }
}
