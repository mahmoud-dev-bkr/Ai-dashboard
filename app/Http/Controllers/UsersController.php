<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function usersPage()
    {
        return view("dashboard-pages.users.users");
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
