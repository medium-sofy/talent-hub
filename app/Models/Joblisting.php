<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joblisting extends Model
{
    /** @use HasFactory<\Database\Factories\JoblistingFactory> */
    use HasFactory;

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_listings_skills');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'job_listings_technologies');
    }

    public function images()
    {
        return $this->hasMany(JoblistingImage::class);
    }

    public function analytics()
    {
        return $this->hasOne(Analytic::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
