<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Str;
use App\Models\CategoryTranslation;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App;
use Carbon\Carbon;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $categories = Category::all();
    //    return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate = [
        //     'name' => 'required',
        //     'desc' => 'requiree',
        //     'image' => 'required|mimes:jpg,jpeg,png|max:4096'
        // ];

        // $img = $request->file('image');
        // $imgname = Str::uuid() . $img->getClientOriginalName();
        // $img->move(public_path('images'),$imgname);
        // $path = '/images/' .$imgname;

        // $category=new Category();
        // $category->image = $path;
        // $category->name = $request->name;
        // $category->desc = $request->desc;
        // $category->user_id = Auth::id();
        // $category->save();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'en.name' => 'required',
            'en.desc' => 'required',
            'ar.name' => 'required',
            'ar.desc' => 'required',
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;
    
        $category = new Category();
        $category->image = $path;
        $category->user_id = Auth::id();
        foreach (config('app.languages') as $key => $lang) {
            //dd($request->input($key.'.title'));
            $category->translateOrNew($key)->locale = $key;
            $category->translateOrNew($key)->name = $request->input($key.'.name');
            $category->translateOrNew($key)->desc = $request->input($key.'.desc');
        }
    
        $category->save();
    
        // return redirect()->route('dashboard.posts.index')->with('success', 'Post created successfully.');
    
            
    
        return redirect('/dashboard/categories/all')->with(['message','تمت الانشاء بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$category)
    {
        $categoryy = Category::whereTranslation('name',$category)->firstOrFail();
       // dd($categoryy);
        $posts = Post::where('category_id',$categoryy->id)->get();
       // App::setLocale('ar');
        return view('pages.postscategories',compact('posts','categoryy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {
        $category = Category::whereTranslation('name',$category)->firstOrFail();
        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        // $request->validate = [
        //     'name' => 'required',
        //     'desc' => 'requiree',
        //     'image' => 'mimes:jpg,jpeg,png|max:4096'
        // ];

        

        // if($request->file('image'))
        // {
        //     $img = $request->file('image');
        //    $imgname = Str::uuid() . $img->getClientOriginalName();
        //     $img->move(public_path('images'),$imgname);
        //    $path = '/images/' .$imgname;

        // Category::where('name',$name)
        // ->update([
        //     'name' => $request->name,
        //     'desc' => $request->desc,
        //     'image' => $path
        // ]);
        // return redirect('/dashboard');

        // }
        // else
        // {
        //     Category::where('name',$name)
        //     ->update([
        //     'name' => $request->name,
        //     'desc' => $request->desc,
        // ]);
        // return redirect('/dashboard');
        // }

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'en.name' => 'required',
            'en.desc' => 'required',
            'ar.name' => 'required',
            'ar.desc' => 'required',
        ]);

        //$category = new Category();
        $category = Category::whereTranslation('name',$category)->firstOrFail();
        
        if($request->file('image'))
        {
        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;
        $category->image = $path;
        }
        
        $category->user_id = Auth::id();
        foreach (config('app.languages') as $key => $lang) {
            //dd($request->input($key.'.title'));
            $category->translateOrNew($key)->locale = $key;
            $category->translateOrNew($key)->name = $request->input($key.'.name');
            $category->translateOrNew($key)->desc = $request->input($key.'.desc');

        }
        $category->save();
    
        // return redirect()->route('dashboard.posts.index')->with('success', 'Post created successfully.');
    
            
    
        return redirect('/dashboard/categories/all')->with(['message','تمت التعديل بنجاح']);
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $category = Category::whereTranslation('name',$category)->firstOrFail();
        $category->deleteTranslations();
        $category->delete();

        return redirect('/dashboard/categories/all')->with(['message','تمت الحذف بنجاح']);
    }

    public function allcategoriesdatatables(Request $request)
    {
        return view('dashboard.categories.all'); 
    }
    public function getcategoriesdatatables(Request $request)
    {
       // return Datatables::of(Category::query())->make(true);
       $categories = Category::all();
        return Datatables::of($categories)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <button class="btn btn-primary"><a style="color:white;" href="'.Route('dashboard.categories.edit',$row->name).'">Edit</a></.button>
            <form action="'.Route('dashboard.categories.delete',$row->name).'" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>';
        })
        ->addColumn('name',function($row){
            return $row->translate('ar')->name;
        })
        ->addColumn('desc',function($row){
            return  $row->translate('ar')->desc;
        })
        ->addColumn('user_name',function($row){
            return $row->users->name;
        })
        ->addColumn('created_at',function($row){
            return  Carbon::parse($row->start_date)->format('d/m/Y');
        })
        ->addColumn('updated_at',function($row){
            return  Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->rawColumns(['name','desc','user_name','created_at','updated_at','action'])
        ->make(true);
    }
}
