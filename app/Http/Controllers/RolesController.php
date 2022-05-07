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
    public function createRole(Request $req)
    {
        $validator = $req->validate(
            [
                "name" => "required|alpha_dash|unique:roles",
                "display_name" => "required",
                "permissions" => "required",
                "note" => "",
            ],
            [
                "permissions.required" =>
                    "you should select at least on permission",
            ]
        );
        $permissions = $req->permissions;
        $name = $validator["name"];
        $display_name = $validator["display_name"];
        $note = $validator["note"];

        $role = Role::create([
            "name" => $name,
            "display_name" => $display_name,
            "description" => $note,
        ]);

        foreach ($permissions as $p) {
            $role->attachPermission($p);
        }
        return response()->json(["msg" => "role is created successfully"]);
    }
}
