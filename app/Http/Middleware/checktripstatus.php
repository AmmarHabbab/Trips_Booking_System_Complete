<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Trip;
use App\Models\User;
use Auth;

class checktripstatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $trip = Trip::where('id', $request->trip->id)->firstOrFail();
        if ($trip->status == 'حجز_مغلق') {
            return redirect('/trips/')->with('message','عذرا لكن وقت الحجز انتهى لهذه الرحلة');
        }
        if ($trip->status == 'الأن') {
            return redirect('/trips/')->with('message','عفوا هذه الرحلة نشطة الأن');
        }
        if ($trip->status == 'منتهية') {
            return redirect('/trips/')->with('message',$trip->expiry_date.'عفوا هذه الرحلة منتهية من تاريخ : ');
        }
        if ($trip->status == 'ملغية') {
            return redirect('/trips/')->with('message','عذرا هذه الرحلة ملغية');
        }
        if ($trip->status == 'حجز_مفتوح') {
            $user_bookings = Booking::where('user_id', Auth::id())->get();
            foreach ($user_bookings as $user_booking) {
                $user_trip = Trip::where('id', $user_booking->trip_id)->first();
                if ($user_trip->status != 'منتهية' && $user_trip->status != 'ملغية') {
                    if($user_booking->trip_id == $trip->id)
                    {
                        return redirect('/trips/')->with('message','عذرا لقد حجزت مسبقا لهذه الرحلة');
                    }
                    if (
                        ($user_trip->expiry_date >= $trip->start_date && $user_trip->start_date <= $trip->start_date) ||
                        ($trip->expiry_date >= $user_trip->start_date && $trip->start_date <= $user_trip->start_date)
                    ) {
                        return redirect('/trips/')->with('message','عذرا لا يمكنك حجز رحلة مع نفس وقت رحلة حجزتها :'.$user_trip->translate()->name);
                    }
                }
            }
        }
        return $next($request);
    }
}
