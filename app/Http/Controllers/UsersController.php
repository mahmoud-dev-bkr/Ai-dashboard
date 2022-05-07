<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
        $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "email" => "email|required",
            "password" => "required",
            "tel1" => "required",
            "role" => "required",
        ]);
        return "success";
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
