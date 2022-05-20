<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\alerts_to_companies;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class AlertWithComapanyController extends Controller
{
    //
    public function AlertCompany()
    {
        return view("Dashboard-pages.AlertCompany.Alert");
    }
    public function getAlertCompanyData()
    {
        $query = alerts_to_companies::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("message_en", function (alerts_to_companies $alert) {
                if ($alert->alert_id) {
                    return Alert::find($alert->alert_id)->message_en;
                }
            })
            ->addColumn("message_ar", function (alerts_to_companies $alert) {
                if ($alert->alert_id) {
                    return Alert::find($alert->alert_id)->message_ar;
                }
            })
            ->addColumn("start_date", function (alerts_to_companies $alert) {
                if ($alert->alert_id) {
                    return Alert::find($alert->alert_id)->start_date;
                }
            })
            ->addColumn("end_date", function (alerts_to_companies $alert) {
                if ($alert->alert_id) {
                    return Alert::find($alert->alert_id)->end_date;
                }
            })
            ->addColumn("username", function (alerts_to_companies $alert) {
                if ($alert->user_id) {
                    return User::find($alert->user_id)->name;
                }
            })
            ->addColumn("", function (alerts_to_companies $alert) {
                if ($alert->user_id) {
                    return User::find($alert->user_id)->name;
                }
            })
            ->addColumn("type", function (alerts_to_companies $alert) {
                if ($alert->alert_id) {
                    return Alert::find($alert->alert_id)->type;
                }
            })
            ->addColumn("company_name", function (alerts_to_companies $alert) {
                if ($alert->company_id) {
                    return Company::find($alert->company_id)->name_en;
                }
            })
            ->addColumn("isActive", function (alerts_to_companies $alert) {
                // $active = null;
                if ($alert->alert_id) {
                    $active = Alert::find($alert->alert_id)->is_activate;
                }
                $id = $alert->alert_id;
                return view("Dashboard-pages.AlertCompany.action", [
                    "type" => "togglealertActive",
                    "active_state" => $active,
                    "id" => $id,
                ]);
            })

            ->addColumn("delete", function (alerts_to_companies $alert) {
                $active = null;
                if ($alert->alert_id) {
                    $active = Alert::find($alert->alert_id)->is_activate;
                }
                $id = $alert->id;
                return view("Dashboard-pages.AlertCompany.action", [
                    "type" => "action",
                    "active_state" => $active,
                    "id" => $id,
                ]);
            })
            ->toJson();
        return $data;
    }

    public function togglealertactivate(Request $req)
    {
        $id = $req->id;
        $state = $req->active_state;

        $isavtive = Alert::find($id);

        $isavtive->is_activate = $state ? false : true;
        $isavtive->save();
        $state_text = $state ? "not active any more" : "active now";
        return response()->json([
            "msg" => "Alert is " . $state_text,
        ]);
    }

    public function deletealertcompany($id)
    {
        DB::table("alerts_to_companies")->delete($id);
        return redirect()->back();
    }

    public function InsertAlertPage()
    {
        $company = Company::all();
        $message = Alert::all();
        return view(
            "Dashboard-pages.AlertCompany.insert",
            compact("company", "message")
        );
    }
    public function storealertcompany(Request $req)
    {
        $req->validate([
            "company" => "required",
            "alert" => "required",
        ]);
        $getcompanydata = $req->company;
        $getalertdata = $req->alert;

        // return $getcompanydata;
        // $companyreq = implode(",", $getcompanydata);
        // $alertreq = implode(",", $getalertdata);

        $alerts_companies = [];
        foreach ($getcompanydata as $c_id) {
            array_push($alerts_companies, [
                "user_id" => Auth::id(),
                "alert_id" => $getalertdata,
                "company_id" => $c_id,
            ]);
        }

        // $company = new alerts_to_companies();
        // $company->alert_id = $getalertdata;
        // $company->company_id = $getcompanydata;
        // $company->user_id = Auth::id();
        // $company->save();

        alerts_to_companies::insert($alerts_companies);
        return response()->json([
            "msg" => "Message Send Succsfully",
        ]);
    }
}
