<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Trip;
use App\Models\Booking;
use Auth;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::query()
        ->where('approved',1)
        ->orderBy('created_at','desc')
        ->get();
       // dd($rates);
        return view('pages.rates',compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trips=collect();

        $books = Booking::where('status','حضر')
                ->where('user_id',Auth::id())->get();
        
        
        foreach($books as $book)
        {
            $rate = Rate::Where('trip_id', $book->trip_id)->where('user_id',Auth::id())->first();
            if(!$rate)
            {
                $trip = Trip::where('id',$book->trip_id)->first();
                $trips->push($trip);
               // dd($trips);
            }
        }
        return view('pages.createrate', compact('trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // General Rating
        $request->validate([
            'stars' => 'required',
            'body' => 'required',
            'trip' => 'required'
        ]);

        $rate = new Rate();
        $rate->stars = $request->stars;
        $rate->body = $request->body;
        if($request->trip != "0")
        {
            $trip = Trip::where('id',$request->trip)->first();
            $rate->trip_id = $trip->id;
        }
        $rate->user_id = Auth::id();
        $rate->approved = 0;
        $rate->save();

        return back()->with('message','تم تسجيل التقييم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($trip)
    {
        $rate = Rate::where('trip_id',$trip->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Rate $rate)
    {
        $rate->approved = 1;
        $rate->save();
        return back()->with('message','تم القبول بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        $rate->delete();
        return back()->with('message','تم الحذف بنجاح');
    }

    public function allratesdatatables(Request $request)
    {
        return view('dashboard.rates.all'); 
    }
    public function getratesdatatables(Request $request)
    {

        $rates = Rate::all();
        return Datatables::of($rates)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.rate.approve',$row->id).'" method="POST">
            <button type="submit">قبول التقييم</button>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            </form>';
        })
        ->addColumn('created_at',function($row){
            return Carbon::parse($row->created_at)->format('d/m/Y');
        })
        ->addColumn('updated_at',function($row){
            return Carbon::parse($row->updated_at)->format('d/m/Y');
        })
        ->rawColumns(['id','stars','body','trip_id','user_id','approved','created_at','updated_at','action']) //,'action'
        ->make(true);
    }
}
