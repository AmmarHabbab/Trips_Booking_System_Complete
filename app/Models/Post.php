<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
   use Translatable;
    protected $fillable = [
        'id', 'slug', 'image', 'user_id', 'category_id', 'created_at', 'updated_at'
    ];
    public $translatedAttributes = ['title', 'content'];
    public function category()
    {
       return $this->belongsTo(Category::class , 'category_id');
    }


    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }

    public function likes()
    {
       return $this->hasMany(Like::class);
    }

    public function comments()
    {
       return $this->hasMany(Comment::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    use HasFactory;
}
