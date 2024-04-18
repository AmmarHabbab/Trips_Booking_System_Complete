<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripTranslation extends Model
{
    protected $fillable = [
        'id', 'trip_id','locale','name ', 'area',
        'info', 'created_at','updated_at'
    ];
    public $timestamps = false;
    use HasFactory;
}
