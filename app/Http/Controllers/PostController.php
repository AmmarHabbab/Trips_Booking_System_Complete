<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App;
use Str;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use ConsoleTVs\Charts\Facades\Charts;
use Astrotomic\Translatable\Translatable;
use Jorenvh\Share\Share;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $posts = Post::query()
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('pages.posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'categoryname' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'en.title' => 'required',
        'en.content' => 'required',
        'ar.title' => 'required',
        'ar.content' => 'required',
    ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

    $post = new Post();
    //$post->category_id = Category::where('name', $request->categoryname)->first()->id;
    $category = Category::whereHas('translations', function ($query) use ($request) {
        $query->where('name', $request->categoryname);
    })->first();
   // $category->translate('ar')->name;
    $post->category_id = $category->id;
    $post->image = $path;
    $slug = Str::slug($request->input('en'.'.title'));
    $post->slug = $slug;
    $post->user_id = Auth::id();
    foreach (config('app.languages') as $key => $lang) {
        //dd($request->input($key.'.title'));
        $post->translateOrNew($key)->locale = $key;
        $post->translateOrNew($key)->title = $request->input($key.'.title');
        $post->translateOrNew($key)->content = $request->input($key.'.content');
    }

    $post->save();

     return redirect('/dashboard/posts/all')->with('message', 'تم الانشاء بنجاح');

        

       
    }
    public function search(Request $request)
    {
        
        $search = $request->search;
    
        $posts = Post::whereTranslation('title', $search)
            ->get();
           // dd($trips);
            return view('pages.posts', compact('posts'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $arpost = $post->translate('ar')->title;
        $enpost = $post->translate('en')->title;

       // App::setLocale('ar');
        $like_count = 0;
        $dislike_count = 0;
        foreach($post->likes as $like){
            if($like->like_status == 1)
                $like_count++;
            if($like->like_status == 0)
                $dislike_count++;
        }
        
        $comments = Comment::where('post_id',$post->id)->get();

        $share = new Share;
        $shareComponent = $share->page(
            'http://127.0.0.1:8000/posts/'.$post->slug,
            ''.$arpost.'-'.$enpost,
        )
        ->facebook()
        ->twitter()
      //  ->linkedin()
        ->telegram()
        ->whatsapp();        
       // ->reddit();

        return view('pages.post',compact('post','comments','like_count','dislike_count','shareComponent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        
       
        $request->validate([
            'categoryname' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'en.title' => 'required',
            'en.content' => 'required',
            'ar.title' => 'required',
            'ar.content' => 'required',
        ]);
            if($request->file('image')){
            $img = $request->file('image');
            $imgname = Str::uuid() . $img->getClientOriginalName();
            $img->move(public_path('images'),$imgname);
            $path = '/images/' .$imgname;
            }
            
        //$post->category_id = Category::where('name', $request->categoryname)->first()->id;
        $category = Category::whereTranslation('name',$request->categoryname)->firstOrFail();
       // $category->translate('ar')->name;
        $post->category_id = $category->id;

        $slug = Str::slug($request->input('en'.'.title'));
        $post->slug = $slug;
        $post->user_id = Auth::id();
        foreach (config('app.languages') as $key => $lang) {
            //dd($request->input($key.'.title'));
            $post->translateOrNew($key)->locale = $key;
            $post->translateOrNew($key)->title = $request->input($key.'.title');
            $post->translateOrNew($key)->content = $request->input($key.'.content');
        }
    
        $post->save();

        return redirect('/dashboard/posts/all')->with('message', 'تم التحديث بنجاح');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->deleteTranslations();
        $post->delete();
        return redirect('/dashboard/posts/all')->with('message', 'تم الحذف بنجاح');
    }
    
    public function allpostdatatables(Request $request)
    {
        return view('dashboard.posts.all'); 
    }
    public function getpostsdatatables(Request $request)
    {
        $posts = Post::all();
        return Datatables::of($posts)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <button><a href="'.Route('dashboard.posts.edit',$row->slug).'">Edit</a></.button>
            <form action="'.Route('dashboard.posts.delete',$row->slug).'" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Delete</button>
            </form>';
        })
        ->addColumn('title',function($row){
            return $row->translate('ar')->title;
            //return $row->category->translate('en')->name;
        })
        ->addColumn('content',function($row){
            return Str::words($row->translate('ar')->content,4);
        })
        ->addColumn('category',function($row){
            if($row->category)
            {
            return $row->category->translate('ar')->name;
            }
            else
            {
                return  "غير مصنفة";
            }
        })
        ->addColumn('created_at',function($row){
            return  Carbon::parse($row->created_at)->format('d/m/Y');
        })
        ->addColumn('updated_at',function($row){
            return  Carbon::parse($row->updated_at)->format('d/m/Y');
        })
        ->rawColumns(['title','content','category','created_at','updated_at','action'])
        ->make(true);
    }

   
}
