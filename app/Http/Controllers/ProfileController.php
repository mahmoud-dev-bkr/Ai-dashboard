<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //profile view
    public function profilepage()
    {
        $id = Auth::id();
        $users = DB::table("users")->where('id', $id)->first();
        $user_role = DB::table("role_user")->select("users.name")->join("users", 'users.id', '=', 'role_user.user_id')->where('role_user.user_id', '=', $id)->first();
        // dd($user_role);
        return view('Dashboard-pages.Profile.profile', compact('users', 'user_role'));
    }
    public function changepassword()
    {
        return view("Dashboard-pages.Profile.changepassword");
    }
    public function updatepassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            // return back()->with("error", "Old Password Doesn't match!");
            return response()->json([
                'error' => "Old Password Doesn't match!"
            ]);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        // return back()->with("status", "Password changed successfully!");
        return response()->json([
            'success' => "Password changed successfully!"
        ]);
    }
}
