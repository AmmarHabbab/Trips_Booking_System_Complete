<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'body','album_id','trip_id', 'post_id', 'user_id', 'created_at', 'updated_at'
     ];

     public function users()
     {
        return $this->belongsTo(User::class,'user_id');
     }

     public function posts()
     {
        return $this->belongsTo(Post::class,'post_id');
     }

     public function albums()
     {
         return $this->belongsTo(Album::class,'album_id');
     }
 
     public function trips()
     {
         return $this->belongsTo(Trip::class,'trip_id');
     }

    use HasFactory;
}
