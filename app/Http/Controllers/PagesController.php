<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Trip;
use App\Models\Post;
use App;
use Illuminate\Support\Facades\Session;
use Auth;
use Jorenvh\Share\Share;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\BotMan;
//use Illuminate\Support\Facades\Lang;
class PagesController extends Controller
{
    public function dashboard()
    {
        $user = User::where('id',Auth::id())->first();
        $coupons = Coupon::where('user_id',Auth::id())->get();
        return view('dashboard.dashboard3',compact('user','coupons'));
    }

    public function index()
    {
        return redirect('/trips');
    }

    public function about()
    {
       // dd(trans('messages.Register'));
        return view('pages.about');
    }

    public function search(Request $request)
    {
        $search = $request->searchval;

        $results = [];

        $trips = Trip::whereTranslationLike('name', '%'.$search.'%')
        ->orWhereTranslationLike('info','%'.$search.'%')
        ->orWhereTranslationLike('area','%'.$search.'%')
        // ->orWhere('info', 'LIKE', "%{$search}%")
        // ->orWhere('status', 'LIKE', "%{$search}%")
        ->get();

        $posts = Post::whereTranslationLike('title','%'.$search.'%')
        ->orWhereTranslationLike('content','%'.$search.'%')
        ->get();
       // dd($posts);

        //$results+= ['trips'=>$trips,'posts'=>$posts];
        //dd($results);

        return view('pages.search',compact('trips','posts'));
    }
    
// app()->setLocale('ar');
     //   dd(app()->getLocale());
        // if(app()->getLocale() == 'en')
        // {
        //     app()->setLocale('ar');
        //     session()->put('locale','ar');
        // }
        // else
        // {
        //     app()->setLocale('en');
        //     session()->put('locale','en');
        // }

        // App::setLocale('ar');

        // if(App::getLocale() == 'en')
        // {
        //     App::setLocale('ar');
        // }
        // else
        // {
        //     App::setLocale('en');
        // }

        // App::setLocale('ar');
        // App::setLocale(session()->put('locale', 'ar'));
       
    public function lang(Request $request)
    {
    
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
  
        return redirect()->back();
    
    }

    // public function ShareWidget()
    // {
    //     $share = new Share;
    //     $shareComponent = $share->page(
    //         'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
    //         'Your share text comes here',
    //     )
    //     ->facebook()
    //     ->twitter()
    //     ->linkedin()
    //     ->telegram()
    //     ->whatsapp()        
    //     ->reddit();
        
    //     return view('post', compact('shareComponent'));
    // }

    public function invoke()
    {
        $botman = app('botman');
        $botman->hears('{message}', function($botman, $message) {
            if ($message == 'hello') {
                $this->askName($botman);
            }else{
                $botman->reply("Type 'hello' for demo ...");
            }
        });
        $botman->listen();
    }
   
    public function askInfo($botman)
    {
        $botman->ask('Hey There! How are you?', function(Answer $answer) {
            $ans = $answer->getText();
            $this->say('Whats up '.$ans);
        });
    }

}
