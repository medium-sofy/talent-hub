<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
<<<<<<< HEAD
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

=======
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'job_listing_id',
        'candidate_id',
        'status',
        'contact_email',
        'contact_phone',
        'resume_url',
    ];

   
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

<<<<<<< HEAD
=======
   
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
