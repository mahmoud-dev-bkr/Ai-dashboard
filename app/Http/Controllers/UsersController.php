<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // by mohammed ahmed
    // return main view for users
    public function usersPage()
    {
        return view("dashboard-pages.users.users");
    }
    // by mohammed ahmed
    // return a page for adding a new user
    public function insertPage()
    {
        $roles = Role::all();
        return view("dashboard-pages.users.insert", compact("roles"));
    }

    public function createUser(Request $req)
    {
        $validator = $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "email" => "email|required|unique:users",
            "password" => "required",
            "tel1" => "required",
            "role" => "required",
            "tel2" => "",
            "tel3" => "",
            "address" => "",
        ]);
        $user = new User();
        $user->name_en = $validator["name_en"];
        $user->name_ar = $validator["name_ar"];
        $user->email = $validator["email"];
        $user->password = Hash::make($validator["password"]);
        $user->Tel_1 = $validator["tel1"];
        $user->Tel_2 = $validator["tel2"];
        $user->Tel_3 = $validator["tel3"];
        $user->address = $validator["address"];
        $user->save();
        $user->attachRole($validator["role"]);
        return response()->json([
            "msg" => "user created successfully",
        ]);
    }

    public function getUsersData()
    {
        $query = User::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("roles", function (User $user) {
                $roles = $user->roles;
                return view("dashboard-layouts.actions", [
                    "type" => "roles",
                    "roles" => $roles,
                ]);
            })
            ->toJson();
        return $data;
    }
}
