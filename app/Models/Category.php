<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $fillable = [
        'id', 'category_id','name','desc','user_id'
    ];

    public $translatedAttributes = ['name', 'desc'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    use HasFactory;
}
