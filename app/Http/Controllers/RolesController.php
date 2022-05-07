<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function viewRoles()
    {
        return view("dashboard-pages.roles.index");
    }

    public function getRulesData()
    {
        $query = Role::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("usersNo", function (Role $role) {
                $users = $role->users;
                return view("dashboard-layouts.actions", [
                    "users" => $users,
                    "type" => "roles_users",
                ]);
            })
            ->toJson();
        return $data;
    }
    public function insertPage()
    {
        $permissions = Permission::all();
        return view("dashboard-pages.roles.create", compact("permissions"));
    }
}
