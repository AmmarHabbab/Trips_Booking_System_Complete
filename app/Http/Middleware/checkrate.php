<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Auth;
use App\Models\Rate;

class checkrate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rates = Rate::where('user_id', Auth::id())
            ->where('trip_id', null)
            ->get();

        $now = Carbon::now();

        foreach ($rates as $rate) {
            $dif = $now->diffInDays($rate->created_at);
            if ($dif < 90)
            {
                return response()->json(['message' => 'u can only enter general rating each 3 months']);
            }
        }

        return $next($request);
    }
}
