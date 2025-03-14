<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
