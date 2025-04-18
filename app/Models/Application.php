<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
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

   
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
