<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Album;
use App\Models\Trip;
use Auth;

class CommentController extends Controller
{
    public function poststore(Request $request,Post $post)
    {
        $request->validate([
            'body' => 'required'
        ]);
        Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'post_id' => $post->id
        ]);
        return redirect('/posts/'.$post->slug);
    }

    public function albumstore(Request $request,Album $album)
    {
        $request->validate([
            'body' => 'required'
        ]);
        Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'album_id' => $album->id
        ]);
        return back();
    }

    public function tripstore(Request $request,Trip $trip)
    {
        $request->validate([
            'body' => 'required'
        ]);
        Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'trip_id' => $trip->id
        ]);
        return back();
    }
}
