<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListingImage extends Model
{
    /** @use HasFactory<\Database\Factories\JobListingImageFactory> */
    use HasFactory;

    public function joblisting()
    {
        return $this->belongsTo(JobListing::class);
    }
}
