<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    /** @use HasFactory<\Database\Factories\AnalyticFactory> */
    use HasFactory;

    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
