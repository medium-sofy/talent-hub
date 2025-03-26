<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'resume_url',
        'linkedin_profile',
        'phone_number',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
