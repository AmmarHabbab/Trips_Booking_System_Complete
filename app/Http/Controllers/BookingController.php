<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';
use DB;
//use ConsoleTVs\Charts\Facades\Charts;
use ConsoleTVs\Charts\ChartsServiceProvider;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Translater;
use App\Models\Coupon;
use App\Models\User;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use Slim\Http\Request;
// use Slim\Http\Response;
use Stripe;
use Session;
use Str;
use Charts;
class BookingController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Trip $trip)
    {
        $translaters = Translater::where('status','متوفر')->get();
        $available_seats = $trip->seats - $trip->seats_taken;
        return view('pages.book',compact('translaters','trip','available_seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function payment(Request $request,Trip $trip)
    {
      //  dd($request->all());
        $request->validate([
             'payment' => 'required'
         ]);

        $bookings = Booking::where('trip_id',$trip->id)->get();
        foreach($bookings as $booking)
        {
            if($booking->user_id == Auth::id())
            {
                return redirect('/trips/'.$trip->id)->with('message','لقد قمت بالحجز مسبقا لهذه الرحلة');
            }
        }

        $user_bookings = Booking::where('user_id',Auth::id())->get();
      
       
        foreach($user_bookings as $user_booking)
        {
            $user_trip = Trip::where('id',$user_booking->trip_id)->first();
            if($user_trip->status != 'منتهية' && $user_trip->status != 'ملغية')
            {
                // if($user_trip->expiry_date >= $trip->start_date || $trip->expiry_date >= $user_trip->start_date)
                // {
                    if (($user_trip->expiry_date >= $trip->start_date && $user_trip->start_date <= $trip->start_date) || 
                       ($trip->expiry_date >= $user_trip->start_date && $trip->start_date <= $user_trip->start_date)) 
                {
                    return redirect('/trips/'.$trip->id)->with('message',$user_trip->translate()->name.'لا يمكنك الحجز لهذه الرحلة لأنها تتعارض مع رحلة حجزتها مسبقا');
                }
                
            }
        }


        $available_seats = $trip->seats - $trip->seats_taken;

        if($available_seats < 1)
        {
            return redirect('/trips/'.$trip->id)->with('message','لا يمكنك الحجز لهذه الرحلة لأنه لا يوجد مقاعد متاحة');
        }
       // if($request->seats > $available_seats)
       // {
       //     return response()->json(['message','Sorry no available seats for booking the only available seats number is:'.$available_seats]);
       // }
        $coupon=null;
        if($request->coupon)
        {
            $coupon = Coupon::where('coupon_code',$request->coupon)->first();
            if(!$coupon || $coupon->user_id != Auth::id() || $coupon->status != 'غير_مستخدم')
            {
                return redirect('/trips/'.$trip->id)->with('message','عذرا لا يمكنك استعمال كود الحسم لانه لا يوجد او مستعمل او انتهت صلاحيته');
            }
        }
       

        if($request->translater != '0')
        {
            $translater = Translater::where('id',$request->translater)->first();
        }
        
            if($request->translater != '0')
            {
              $totalpayment = $trip->price + $translater->price;
              if($coupon)
              {
                $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
                $totalpayment = $totalpayment - $discount_amount;
              }
            }
            else
            {
            if($coupon)
              {
                $totalpayment =  $trip->price;
                $discount_amount = ($totalpayment * $coupon->discount_percentage) / 100;
                $totalpayment = $totalpayment - $discount_amount;
              }
              else
              {
                $totalpayment =  $trip->price;
              }
            }
        // if($request->translater != "Choose a Translater if You Want!")
        // {
        //     $translater = Translater->
        // }

        if($request->payment == "1")
        {
            $payment = new Payment();
            $payment->payment_type = "كاش";
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != '0')
            {
               // $translater = Translater::where('name',$request->translater)->first();
                $book->translater_id = $translater->id;
                $translater->status = 'محجوز';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'حجز_مغلق';
            }
            $trip->save();
            if($coupon)
            {
            $coupon->status = 'مستخدم';
            $coupon->save();
            }
            return redirect('/trips/')->with('message',$totalpayment.'تم الحجز بنجاح الرجاء الدفع في مكتبنا المبلغ المطلوب');
            
        }
        if($request->payment == "2")
        {
            $payment = new Payment();
            $payment->payment_type = "سيرياتيل_كاش";
           // $payment->phone = $request->syrnumb;
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != '0')
            {
                $book->translater_id = $translater->id;
                $translater->status = 'محجوز';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'حجز_مغلق';
            }
            $trip->save();

            if($coupon)
            {
            $coupon->status = 'مستخدم';
            $coupon->save();
            }

           return view('pages.syriatelcash',compact('payment'));
        }
        if($request->payment == "3")
        {
            $payment = new Payment();
            $payment->payment_type = "ام_تي_ان_كاش";
          //  $payment->phone = $request->mtnnumb;
            $payment->amount = $totalpayment;
            $payment->user_id = Auth::id();
            $payment->trip_id = $trip->id;
            if($coupon)
            {
                $payment->coupon_id = $coupon->id;
            }
            $payment->save();

            $book = new Booking();
            $book->payment_id = $payment->id;
            $book->user_id = Auth::id();
            $book->trip_id = $trip->id;
          //  $book->seats = $request->seats;
            if($request->translater != '0')
            {
                $book->translater_id = $translater->id;
                $translater->status = 'محجوز';
            }
            $book->save();

            $trip->seats_taken += $request->seats;
            if($trip->seats == $trip->seats_taken)
            {
                $trip->status = 'حجز_مغلق';
            }
            $trip->save();

            if($coupon)
            {
            $coupon->status = 'مستخدم';
            $coupon->save();
            }
            
            //return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
            return view('pages.mtncash',compact('payment'));
        }

        // if($request->payment == "Credit Card")
        // {
        //     $payment = new Payment();
        //     $payment->payment_type = "credit_card";
        //   //  $payment->phone = $request->mtnnumb;
        //     $payment->amount = $totalpayment;
        //     $payment->user_id = Auth::id();
        //     $payment->trip_id = $trip->id;
        //     $payment->save();

        //     $book = new Booking();
        //     $book->payment_id = $payment->id;
        //     $book->user_id = Auth::id();
        //     $book->trip_id = $trip->id;
        //    // $book->seats = $request->seats;
        //     if($request->translater != 'Choose a Translater if You Want!')
        //     {
        //         $book->translater_id = $translater->id;
        //         $translater->status = 'taken';
        //     }
        //     $book->save();

        //     $trip->seats_taken += $request->seats;
        //     if($trip->seats == $trip->seats_taken)
        //     {
        //         $trip->status = 'res_over';
        //     }
        //     $trip->save();

        //     // //return response()->json(['message','trip booked successfully the booking will be confirmed as soon as we confirm the payment']);
        //     // return view('pages.mtncash',compact('payment'));
        //    // $stripe = new \Stripe\StripeClient('sk_test_51O59JML9GmdzDG8x6tzGMrablEXq4TNnIIKJQAIY2GeJT0PRVyzOxve2MUbEQfnjfS7RgYiVoDiUp54VbntX6icb00K3c9eI8E');
          
        // //    Stripe::setApiKey(env('STRIPE_SECRET'));
        // //   $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // // $checkout_session = $stripe->checkout->sessions->create([
        // //   'line_items' => [[
        // //     'price_data' => [
        // //       'currency' => 'usd',
        // //       'product_data' => [
        // //         'name' => 'T-shirt',
        // //       ],
        // //       'unit_amount' => 2000,
        // //     ],
        // //     'quantity' => 1,
        // //   ]],
        // //   'mode' => 'payment',
        // //   'success_url' => 'http://127.0.0.1:8000/book/creditcard/success',
        // //   'cancel_url' => 'http://127.0.0.1:8000/book/creditcard/cancel',
        // // ]);
        
        // // header("HTTP/1.1 303 See Other");
        // // header("Location: " . $checkout_session->url);

        // // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // // Stripe\Charge::create ([
        // //         "amount" => 100 * 150,
        // //         "currency" => "inr",
        // //         // "source" => $request->stripeToken,
        // //         "description" => "Making test payment." 
        // // ]);
  
        // // Session::flash('success', 'Payment has been successfully processed.');
          

        // }

       // return view('pages.pay',compact('totalpayment'));
    }
    
    public function mtncash(Request $request,Payment $payment)
    {
        $request->validate([
            'mtnnumb' => 'required|numeric'
        ]);

        $payment->phone = $request->mtnnumb;
        $payment->save();
        return redirect('/trips/')->with('message','تم الحجز بنجاح وسيتم تأكيد الحجز عند تأكيد التحويل المالي');
    }

    public function syriatelcash(Request $request,Payment $payment)
    {
        $request->validate([
            'syrnumb' => 'required'
        ]);

        $payment->phone = $request->syrnumb;
        $payment->save();
        return redirect('/trips/')->with('message','تم الحجز بنجاح وسيتم تأكيد الحجز عند تأكيد التحويل المالي');
    }

    // public function creditcard(Request $request,Payment $payment)
    // {
    //     // $stripe = new \Stripe\StripeClient('sk_test_51O59JML9GmdzDG8x6tzGMrablEXq4TNnIIKJQAIY2GeJT0PRVyzOxve2MUbEQfnjfS7RgYiVoDiUp54VbntX6icb00K3c9eI8E');


    //     // $checkout_session = $stripe->checkout->sessions->create([
    //     //   'line_items' => [[
    //     //     'price_data' => [
    //     //       'currency' => 'usd',
    //     //       'product_data' => [
    //     //         'name' => 'T-shirt',
    //     //       ],
    //     //       'unit_amount' => 2000,
    //     //     ],
    //     //     'quantity' => 1,
    //     //   ]],
    //     //   'mode' => 'payment',
    //     //   'success_url' => 'http://127.0.0.1:8000/book/creditcard/success',
    //     //   'cancel_url' => 'http://127.0.0.1:8000/book/creditcard/cancel',
    //     // ]);
        
    //     // header("HTTP/1.1 303 See Other");
    //     // header("Location: " . $checkout_session->url);
        
    //     // Stripe::setApiKey(env('STRIPE_SECRET'));
    //     // Stripe::create ([
    //     //         "amount" => 100 * 150,
    //     //         "currency" => "inr",
    //     //         "source" => $request->stripeToken,
    //     //         "description" => "Making test payment." 
    //     // ]);
  
    //     // Session::flash('success', 'Payment has been successfully processed.');
    // }

    // public function success()
    // {
    //     return response()->json(['message','success']);
    // }

    // public function cancel()
    // {
    //     return response()->json(['message','cancel']);
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }

    public function confirm(Payment $payment)
    {
        $payment->status = 'مؤكدة';
        // $payment->updated_at = Carbon::now();
        $payment->save();
        return redirect()->back()->with(['message','تمت التأكيد بنجاح']);
    }

    public function refund(Payment $payment)
    {
        $payment->status = 'تم_الاعادة';
        $payment->save();
        return redirect()->back()->with(['message','تمت الاعادة بنجاح']);
    }
    private function createcoupon()
    {
        $code = Str::random(8); 
        $coupon = Coupon::where('coupon_code', $code)->first();
    
        if ($coupon) {
            $this->createcoupon();
        }
    
        return $code;
    }
    public function attend(Booking $booking)
    {
       
        $booking->status = 'حضر';
        $booking->save();

        $user = User::where('id',$booking->user_id)->first();
        $user->trips_attended+=1;
        $user->save();

        if($user->trips_attended % 5 == 0)
        {
            $coupon = new Coupon();
            $coupon->user_id = $user->id;
            $coupon->coupon_code = $this->createcoupon();
            $coupon->discount_percentage =  10.0;
            $coupon->expiry_date = Carbon::now()->addWeeks(3);
            $coupon->save();
        }

        return redirect()->back()->with(['message','تمت تأكيد الحضور بنجاح']);
    }
    public function allbooksdatatables(Request $request)
    {
        return view('dashboard.books.all'); 
    }
    public function getbooksdatatables(Request $request)
    {
        $books = Booking::all();
        return Datatables::of($books)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.payment.confirm',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد الدفع</button>
            </form>
            <form action="'.Route('dashboard.payment.refund',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد اعادة المال</button>
            </form>
            <form action="'.Route('dashboard.booking.attend',$row->id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد الحضور</button>
            </form>';
        })
        ->addColumn('name',function($row){
            return $row->users->name;  
        })
        ->addColumn('trip_id',function($row){
            return $row->trips->id;  
        })
        ->addColumn('trip_name',function($row){
            return $row->trips->translate('ar')->name;  
        })
        ->addColumn('trip_status',function($row){
            return $row->trips->status;  
        })
        ->addColumn('translater',function($row){
            return optional($row->translaters)->name;
        })
        ->addColumn('payment_amount',function($row){
            return $row->payments->amount;
        })
        ->addColumn('payment_status',function($row){
            return $row->payments->status;
        })
        ->addColumn('start_date',function($row){
            return  Carbon::parse($row->start_date)->format('d/m/Y');
        })
        ->addColumn('expiry_date',function($row){
            return  Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->rawColumns(['name','trip_id','trip_name','trip_status','payment_id','payment_amount','payment_status','start_date','expiry_date','status','translater','action'])//,'action'
        ->make(true);
    }
    public function tripbooksdatatables(Trip $trip)
    {
        return view('dashboard.books.trip',compact('trip')); 
    }
    public function tripgetbooksdatatables(Trip $trip)
    {
        $books = Booking::where('trip_id',$trip->id)->get();
        return Datatables::of($books)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.payment.confirm',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد الدفع</button>
            </form>
            <form action="'.Route('dashboard.payment.refund',$row->payment_id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد اعادة المال</button>
            </form>
            <form action="'.Route('dashboard.booking.attend',$row->id).'" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">تأكيد الحضور</button>
            </form>';
        })
        ->addColumn('name',function($row){
            return $row->users->name;  
        })
        ->addColumn('trip_id',function($row){
            return $row->trips->id;  
        })
        ->addColumn('trip_name',function($row){
            return $row->trips->translate('ar')->name;  
        })
        ->addColumn('trip_status',function($row){
            return $row->trips->status;  
        })
        ->addColumn('translater',function($row){
            return optional($row->translaters)->name;
        })
        ->addColumn('payment_amount',function($row){
            return $row->payments->amount;
        })
        ->addColumn('payment_status',function($row){
            return $row->payments->status;
        })
        ->addColumn('start_date',function($row){
            return  Carbon::parse($row->start_date)->format('d/m/Y');
        })
        ->addColumn('expiry_date',function($row){
            return  Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->rawColumns(['name','trip_id','trip_name','trip_status','payment_id','payment_amount','payment_status','start_date','expiry_date','status','translater','action'])//,'action'
        ->make(true);
    }

    public function userbooksdatatables()
    {
        return view('dashboard.normaluser.books'); 
    }
    public function usergetbooksdatatables()
    {
        $user = Auth::user();
        $books = Booking::where('user_id',$user->id)->get();
        return Datatables::of($books)
        ->addIndexColumn()
        ->addColumn('name',function($row){
            return $row->users->name;  
        })
        ->addColumn('trip_id',function($row){
            return $row->trips->id;  
        })
        ->addColumn('trip_name',function($row){
            return $row->trips->name;  
        })
        ->addColumn('trip_status',function($row){
            return $row->trips->status;  
        })
        ->addColumn('translater',function($row){
            return optional($row->translaters)->name;
        })
        ->addColumn('payment_amount',function($row){
            return $row->payments->amount;
        })
        ->addColumn('payment_status',function($row){
            return $row->payments->status;
        })
        ->addColumn('start_date',function($row){
            return  Carbon::parse($row->start_date)->format('d/m/Y');
        })
        ->addColumn('expiry_date',function($row){
            return  Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->rawColumns(['name','trip_id','trip_name','trip_status','payment_amount','payment_status','start_date','expiry_date','status','translater'])//,'action'
        ->make(true);
    }
    public function mostbookedtrips()
    {
        $mostBookedTrips = Trip::withCount('books')
            ->orderBy('books_count', 'desc')
            ->take(10)
            ->get();
        return view('dashboard.statistics.trips',compact('mostBookedTrips'));
    }
    


  
}
