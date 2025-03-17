<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /** @use HasFactory<\Database\Factories\CandidateFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'phone_number',
        'linkedin_profile',
        'resume_url'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->hasMany(application::class);
    }
}
