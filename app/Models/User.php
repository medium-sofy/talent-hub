<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
=======
use App\Models\Candidate;
use App\Models\Notification; // Add this import

>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

<<<<<<< HEAD
    public function employer()
=======
    public function employers()
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    {
        return $this->hasOne(Employer::class);
    }

    public function candidate()
    {
        return $this-> hasOne(Candidate::class);
    }

<<<<<<< HEAD
    public function comment()
=======
    public function comments()
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    {
        return $this-> hasMany(Comment::class);
    }

    public function notifications()
    {
        return $this-> hasMany(Notification::class);
    }
}
