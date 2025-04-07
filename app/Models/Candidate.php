<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
<<<<<<< HEAD
    /** @use HasFactory<\Database\Factories\CandidateFactory> */
    use HasFactory;

    protected $guarded = [];
=======
    protected $fillable = [
        'user_id',
        'resume_url',
        'linkedin_profile',
        'phone_number',
        'slug'
    ];
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD

    public function application()
    {
        return $this->hasMany(application::class);
    }
=======
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
}
