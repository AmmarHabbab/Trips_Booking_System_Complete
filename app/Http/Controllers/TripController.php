<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Models\Trip;
use App\Models\Payment;
use App\Models\Translater;
use App\Models\Coupon;
use App\Models\Booking;
use App\Models\Comment;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Jorenvh\Share\Share;
use Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::query()
        ->where('status','حجز_مفتوح')
        ->orderBy('start_date','ASC')
        ->get();
        return view('pages.trips',compact('trips'));
    }

    public function showtype(Trip $trip)
    {
       // dd($type);
       $trips = Trip::where('type', $trip->type)
       ->orderBy('start_date', 'ASC')
       ->get();
        return view('pages.trips',compact('trips'));
    }

    public function showstatus(Trip $trip)
    {
       // dd($type);
       $trips = Trip::where('status', $trip->status)
       ->orderBy('start_date', 'ASC')
       ->get();
        return view('pages.trips',compact('trips'));
    }

    public function search(Request $request)
{
    
    $search = $request->search;

    $trips = Trip::query()
        ->whereTranslation('name', 'LIKE', "%{$search}%")
        ->orWhere('price', 'LIKE', "%{$search}%")
        ->orWhereTranslation('area', 'LIKE', "%{$search}%")
        ->orWhere('start_date', 'LIKE', "%{$search}%")
        ->get();
       // dd($trips);
        return view('pages.trips', compact('trips'));
}
    
    public function show(Trip $trip)
    {
       
        $artrip = $trip->translate('ar')->title;
        $entrip = $trip->translate('en')->title;

       // $trip = Trip::whereTranslation('name',$trip)->firstOrFail();
        $available_seats = $trip->seats - $trip->seats_taken;

        $share = new Share;
        $shareComponent = $share->page(
            'http://127.0.0.1:8000/trips/'.$trip->id,
        )
        ->facebook()
        ->twitter()
      //  ->linkedin()
        ->telegram()
        ->whatsapp();        
       // ->reddit();

       //dd($shareComponent);
       $like_count = 0;
        $dislike_count = 0;
        foreach($trip->likes as $like){
            if($like->like_status == 1)
                $like_count++;
            if($like->like_status == 0)
                $dislike_count++;
        }

        $comments = Comment::where('trip_id',$trip->id)->get();

        return view('pages.trip',compact('trip','available_seats','shareComponent','like_count','dislike_count','comments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      //  $translaters = Translater::where('status','available')->get();
        return view('dashboard.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'en.name' => 'required',
            'en.info' => 'required',
            'en.area' => 'required',
            'ar.name' => 'required',
            'ar.info' => 'required',
            'ar.area' => 'required',
            'image' => 'required|mimes:jpeg,jpg,gif,svg,png|max:4096',
            'seats' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;

        $trip = new Trip();
        $trip->image = $path;
        $trip->type = $request->type;
        $trip->seats = $request->seats;
        $trip->price = $request->price;
        // if($request->translatername != "Select A translater if Need one!")
        // {
            
        // }
        $trip->start_date = $request->start_date;
        $trip->expiry_date = $request->expiry_date;
        

        foreach (config('app.languages') as $key => $lang) {
            //dd($request->input($key.'.title'));
            $trip->translateOrNew($key)->locale = $key;
            $trip->translateOrNew($key)->name = $request->input($key.'.name');
            $trip->translateOrNew($key)->area = $request->input($key.'.area');
            $trip->translateOrNew($key)->info = $request->input($key.'.info');
        }

        $trip->save();
        return redirect('dashboard/trips/all')->with('message','تم انشاء الرحلة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function createagain(Trip $trip)
    {
        return view('dashboard.trips.createagain',compact('trip'));
    }

    public function storeagain(Request $request,Trip $trip)
    {
       
        $request->validate([
            'en.name' => 'required',
            'en.info' => 'required',
            'en.area' => 'required',
            'ar.name' => 'required',
            'ar.info' => 'required',
            'ar.area' => 'required',
            'image' => 'image|mimes:jpeg,jpg,gif,svg,png|max:4096',
            'seats' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $newtrip = new Trip();
        
        $newtrip->image = $trip->image;
        if($request->file('image'))
        {
        $img = $request->file('image');
        $imgname = Str::uuid() . $img->getClientOriginalName();
        $img->move(public_path('images'),$imgname);
        $path = '/images/' .$imgname;
        $newtrip->image = $path;
        }
        else
        {
           $newtrip->image = $trip->image;
        }

        $newtrip->type = $request->type;

        $newtrip->seats = $request->seats;
        $newtrip->price = $request->price;
        // if($request->translatername != "Select A translater if Need one!")
        // {
            
        // }
        $newtrip->start_date = $request->start_date;
        $newtrip->expiry_date = $request->expiry_date;
        

        foreach (config('app.languages') as $key => $lang) {
            //dd($request->input($key.'.title'));
            $newtrip->translateOrNew($key)->locale = $key;
            $newtrip->translateOrNew($key)->name = $request->input($key.'.name');
            $newtrip->translateOrNew($key)->area = $request->input($key.'.area');
            $newtrip->translateOrNew($key)->info = $request->input($key.'.info');
        }

        $newtrip->save();
        return redirect('dashboard/trips/all')->with('message','تم انشاء الرحلة بنجاح');
    }

    public function cancel(Trip $trip)
    {
        $trip->status = 'ملغية';
        $trip->save();
        $bookings = Booking::where('trip_id',$trip->id)->get();
        $payment = Payment::where('trip_id',$trip->id)->get();
        foreach($payment as $pay)
        {
            if($pay->coupon_id != null)
            {
                $coupon = Coupon::where('id',$pay->coupon_id)->first();
                $coupon->status = 'غير_مستخدم';
                $coupon->save();
            }
            if($pay->status == 'مؤكدة')
            {
            $pay->status = 'اعادة';
            $pay->save();
            }
            
        }
        foreach($bookings as $booking)
        {
            if($booking->translater_id)
            {
                $translater = Translater::where('id',$booking->translater_id)->first();
                $translater->status = 'متوفر';
                $translater->save();
            }
            
            $booking->status = 'ملغي';
            $booking->save();
        }
        return redirect('dashboard/trips/all')->with('message','تم الغاء الرحلة بنجاح');
    }

    public function alltripsdatatables(Request $request)
    {
        return view('dashboard.trips.all'); 
    }
    public function gettripsdatatables(Request $request)
    {
        $trips = Trip::all();
        return Datatables::of($trips)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            if(Auth::user()->role == 'admin'){
            return $btn = '
            <button><a href="'.route('dashboard.books.trippage',$row->id).'">اظهار الحجوزات</a></button><br>
            <button><a href="'.Route('dashboard.trips.createagain',$row->id).'">انشاء رحلة بتوصيف هذه الرحلة</a></button>
            <form action="'.Route('dashboard.trips.cancel',$row->id).'" method="POST">
            <button type="submit">الغاء الرحلة</button>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            </form>';
            }
            else
            {
                return $btn = '
                <button><a href="'.route('dashboard.books.trippage',$row->id).'">اظهار الحجوزات</a></button>';
            }
        })
        ->addColumn('start_date',function($row){
            return Carbon::parse($row->start_date)->format('d/m/Y');
        })
        ->addColumn('expiry_date',function($row){
            return Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->addColumn('info',function($row){
            return Str::words($row->translate('ar')->info,4);
        })
        ->addColumn('name',function($row){
            return $row->translate('ar')->name;
        })
        ->addColumn('area',function($row){
            return $row->translate('ar')->area;
        })
        ->rawColumns(['name','info','area','type','seats','seats_taken','status','price','start_date','expiry_date','action']) //,'action'
        ->make(true);
    }

  

    
}
