<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Album;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Booking;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function charts()
    {
        //album likes
        $mostLikedAlbums = Album::selectRaw("albums.id,albums.name as album_name, COUNT(*) as likes_count")
            ->join('likes', 'albums.id', '=', 'likes.album_id')
            ->where('likes.like_status', 1)
            ->groupBy('albums.id', 'album_name')
            ->orderBy('likes_count', 'desc')
            ->take(10)
            ->get();

        //album Dislikes
        $mostDislikedAlbums = Album::selectRaw("albums.id,albums.name as album_name, COUNT(*) as dislikes_count")
            ->join('likes', 'albums.id', '=', 'likes.album_id')
            ->where('likes.like_status', 0)
            ->groupBy('albums.id', 'album_name')
            ->orderBy('dislikes_count', 'desc')
            ->take(10)
            ->get();
        //trip Likes
        $mostLikedTrips = Trip::selectRaw("trips.id, COUNT(*) as likes_count")
            ->join('likes', 'trips.id', '=', 'likes.trip_id')
            ->where('likes.like_status', 1)
            ->groupBy('trips.id')
            ->orderBy('likes_count', 'desc')
            ->take(10)
            ->get();
        //trip DisLikes
        $mostDislikedTrips = Trip::selectRaw("trips.id, COUNT(*) as dislikes_count")
            ->join('likes', 'trips.id', '=', 'likes.trip_id')
            ->where('likes.like_status', 0)
            ->groupBy('trips.id')
            ->orderBy('dislikes_count', 'desc')
            ->take(10)
            ->get();
        //trip Likes
        $mostLikedPosts = Post::selectRaw("posts.id, COUNT(*) as likes_count")
            ->join('likes', 'posts.id', '=', 'likes.post_id')
            ->where('likes.like_status', 1)
            ->groupBy('posts.id')
            ->orderBy('likes_count', 'desc')
            ->take(10)
            ->get();
        //trip DisLikes
        $mostDislikedPosts = Post::selectRaw("posts.id, COUNT(*) as dislikes_count")
            ->join('likes', 'posts.id', '=', 'likes.post_id')
            ->where('likes.like_status', 0)
            ->groupBy('posts.id')
            ->orderBy('dislikes_count', 'desc')
            ->take(10)
            ->get();
        //trip Comments
        $mostCommentedTrips = Trip::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();

        //album Comments
        $mostCommentedAlbums = Album::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();
        //post comments
        $mostCommentedPosts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();
        //users per month
        $usersPerMonth = User::whereYear('created_at', now()->startOfYear())
            ->selectRaw('month(created_at) as month, count(*) as user_count')
            ->groupBy('month')
            ->get();
        //bookings per month for last 12 months 
        $bookingsPerMonth = Booking::whereBetween('created_at', [now()->subMonths(12), now()])
            ->selectRaw('month(created_at) as month, count(*) as booking_count')
            ->groupBy('month')
            ->get();
        //bookings per week for last 12 weeks
        $bookingsPerWeek = Booking::whereBetween('created_at', [now()->subWeeks(12)->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('WEEK(created_at) as week, count(*) as booking_count')
            ->groupBy('week')
            ->get();
        //bookings per day for last 10 days
        $bookingsPerDay = Booking::whereDate('created_at', '>=', now()->subDays(10))
            ->selectRaw('date(created_at) as date, count(*) as booking_count')
            ->groupBy('date')
            ->get();
            $mostBookedTrips = Trip::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(10)
            ->get();
//dd($mostBookedTrips);
        return view(
            'dashboard.statistics.charts',
            compact(
                'mostLikedAlbums',
                'mostDislikedAlbums',
                'mostLikedTrips',
                'mostDislikedTrips',
                'mostLikedPosts',
                'mostDislikedPosts',
                'mostCommentedTrips',
                'mostCommentedAlbums',
                'mostCommentedPosts',
                'usersPerMonth',
                'bookingsPerMonth',
                'bookingsPerWeek',
                'bookingsPerDay',
                'mostBookedTrips'
            )
        );
    }


}
