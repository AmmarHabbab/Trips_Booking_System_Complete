<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Trip extends Model implements TranslatableContract
{
    use Translatable;
    protected $fillable = [
        'id', 'image','seats', 'price',
        'status','start_date','expiry_date','seats_taken',
        'type'
    ];
    public $translatedAttributes = ['name', 'area','info'];
    public function books()
    {
        return $this->hasMany(Booking::class);
    }
//     protected $dates = [
//     'start_date',
//     'expiry_date',
// ];

protected $casts = [
    'start_date' => 'datetime',
    'expiry_date' => 'datetime',
];

public function albums()
{
    return $this->hasOne(Album::class);
}

public function likes()
{
   return $this->hasMany(Like::class);
}

public function comments()
{
   return $this->hasMany(Comment::class);
}

public function rates()
{
    return $this->hasMany(Rate::class);
}
    public $timestamps = false;
    use HasFactory;
}
