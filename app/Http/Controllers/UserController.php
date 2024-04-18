<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coupon;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Carbon\Carbon;
class UserController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function coupons()
    {
        return view('dashboard.normaluser.coupons'); 
    }

    /**
     * Display the specified resource.
     */
    public function couponsget()
    {
        $coupons = Coupon::where('user_id',Auth::id())->get();
        return Datatables::of($coupons)
        ->addColumn('created_at',function($row){
            return  Carbon::parse($row->created_at)->format('d/m/Y');
        })
        ->addColumn('expiry_date',function($row){
            return  Carbon::parse($row->expiry_date)->format('d/m/Y');
        })
        ->rawColumns(['coupon_code','discount_percentage','expiry_date','status','created_at'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect('/dashboard/users/all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function allusersdatatables(Request $request)
    {
        return view('dashboard.users.all'); 
    }
    public function getusersdatatables(Request $request)
    {
        $users = User::all();
        return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <button><a href="'.Route('dashboard.users.edit',$row->id).'">Change User Role</a></button>';
        })
        ->rawColumns(['name','email','role','trips_attended','action']) //,'action'
        ->make(true);
    }
}

// <form action="'.Route('dashboard.users.destroy',$row->id).'" method="POST">
            
// <button type="submit">Delete User</button>
// <input type="hidden" name="_method" value="DELETE">
// <input type="hidden" name="_token" value="' . csrf_token() . '">
// </form>