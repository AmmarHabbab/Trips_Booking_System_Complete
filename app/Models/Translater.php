<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translater extends Model
{
    protected $fillable = [
        'id', 'name','image', 'info', 'gender', 'languages_spoken', 'status','price', 'created_at', 'updated_at'
    ];

    public function books()
    {
        return $this->hasOne(Booking::class);
    }
    use HasFactory;
}
