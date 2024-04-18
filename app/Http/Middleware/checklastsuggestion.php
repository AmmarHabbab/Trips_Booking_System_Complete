<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\Suggestion;
use Carbon\Carbon;
class checklastsuggestion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $suggestions = Suggestion::where('user_id', $user->id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        if ($suggestions->count() >= 1)
        {
            return response()->json(['message','u already posted a suggestion this week']);
           // return redirect()->back()->withErrors(['You have already submitted a suggestion this week.']);
        }

        return $next($request);
    }
}
