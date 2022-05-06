<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function usersPage()
    {
        return view("dashboard-pages.users");
    }

    public function getUsersData()
    {
        $query = User::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->toJson();
        return $data;
    }
}
