<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    /** @use HasFactory<\Database\Factories\TechnologyFactory> */
    use HasFactory;

    public function jobListings()
    {
        return $this->belongsToMany(JobListing::class,'job_listings_technologies','technology_id','job_listing_id' );
    }
}
