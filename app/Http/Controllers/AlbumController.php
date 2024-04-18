<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Trip;
use App\Models\Photo;
use App\Models\Comment;
use Auth;
use Str;
use Illuminate\Support\Facades\File;
use Jorenvh\Share\Share;
use Yajra\DataTables\DataTables;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::query()
        ->orderBy('created_at','DESC')
        ->get();
        return view('pages.albums', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $trips = Trip::orderBy('id','DESC')->take(10);
        //  dd($trips);
        // $trips = Trip::all()->take(10);
        $trip = Trip::whereTranslation('locale', 'ar')
            ->orderBy('expiry_date', 'desc')
            ->get();

        $trips = collect();

        foreach ($trip as $tr) {
            $album = Album::where('trip_id', $tr->id)->first();
            if (!$album) {
                $trips->push($tr);
            }
        }
        // dd($trips);
        return view('dashboard.albums.create', compact('trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:4096',
        ]);

        $album = new Album();
        $album->name = $request->name;
        $album->desc = $request->desc;
        $album->user_id = Auth::id();


        $trip = Trip::whereTranslation('name', $request->tripname)->first();
        $album->trip_id = $trip->id;

        if (!public_path('albums/' . $request->name)) {
            File::makeDirectory(public_path('albums/' . $request->name));
        }

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('/albums/' . $request->name), $imgname);
        $path = '/albums/'. $request->name. '/' . $imgname;

        $album->image = $path;
        $album->save();


        return redirect('/dashboard/albums/all')->with(['message', 'تمت الإصافة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $like_count = 0;
        $dislike_count = 0;
        foreach ($album->likes as $like) {
            if ($like->like_status == 1)
                $like_count++;
            if ($like->like_status == 0)
                $dislike_count++;
        }


        $share = new Share;
        $shareComponent = $share->page(
            'http://127.0.0.1:8000/album/' . $album->name,
            '' . $album->name,
        )
            ->facebook()
            ->twitter()
            //  ->linkedin()
            ->telegram()
            ->whatsapp();
        // ->reddit();

        $comments = Comment::where('album_id', $album->id)->get();

        $photos = Photo::where('album_id', $album->id)->get();
        return view('pages.album', compact('photos', 'album', 'like_count', 'dislike_count', 'shareComponent', 'comments'));
    }

    public function search(Request $request)
    {
        
        $search = $request->search;
    
        $albums = Album::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('desc', 'LIKE', "%{$search}%")
            ->get();
           // dd($trips);
            return view('pages.albums', compact('albums'));
    }
    public function albumsdatatables()
    {
        return view('dashboard.albums.all');
    }
    public function albumsgetbooksdatatables()
    {
        $albums = Album::all();
        return Datatables::of($albums)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '<button><a href="' . route('show.album', $row->name) . '">شاهد الألبوم</a></button>';
            })
            ->addColumn('trip_name', function ($row) {
                return $row->trips->translate('ar')->name;
            })
            ->addColumn('user_name', function ($row) {
                return $row->user->name;
            })
            ->rawColumns(['name', 'desc', 'trip_id', 'trip_name', 'user_id', 'user_name', 'action'])//,'action'
            ->make(true);
    }
}
