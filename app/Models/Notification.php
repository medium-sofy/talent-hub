<?php

namespace App\Models;

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

  
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update(['is_read' => true]);
        }
    }

    
    public function markAsUnread()
    {
        if ($this->is_read) {
            $this->update(['is_read' => false]);
        }
    }

  
    
    public function read()
    {
        return $this->is_read;
    }

  
    
    public function unread()
    {
        return !$this->is_read;
    }

   
    
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
    }
}