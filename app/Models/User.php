<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Billable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'name', 'email', 'email_verified_at', 'password', 'trips_attended', 'remember_token', 'created_at', 'updated_at', 'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
       return $this->hasMany(Post::class);
    }

    public function categories()
    {
       return $this->hasMany(Category::class);
    }

    public function suggestions()
    {
       return $this->hasMany(Suggestion::class);
    }

    public function comments()
    {
       return $this->hasMany(Comment::class);
    }

    public function like()
    {
       return $this->hasMany(Like::class);
    }

    public function album()
    {
       return $this->hasMany(Album::class);
    }

    public function photo()
    {
       return $this->hasMany(Photo::class);
    }

    public function rates()
    {
       return $this->hasMany(Rate::class);
    }

    public function books()
    {
       return $this->hasMany(Booking::class);
    }

    public function surveydata()
    {
        return $this->hasMany(SurveyData::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
