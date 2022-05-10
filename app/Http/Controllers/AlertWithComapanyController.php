<?php

namespace App\Http\Controllers;

use App\Models\alerts_to_companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

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
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $name_en = DB::table("alerts_to_companies")
                    ->select("alerts.message_en")
                    ->join("alerts", 'alerts.id', '=', 'alerts_to_companies.alert_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $name_en[0]->message_en;
            })
            ->addColumn("message_ar", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $name_ar = DB::table("alerts_to_companies")
                    ->select("alerts.message_ar")
                    ->join("alerts", 'alerts.id', '=', 'alerts_to_companies.alert_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $name_ar[0]->message_ar;
            })
            ->addColumn("start_date", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $start_date = DB::table("alerts_to_companies")
                    ->select("alerts.start_date")
                    ->join("alerts", 'alerts.id', '=', 'alerts_to_companies.alert_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $start_date[0]->start_date;
            })
            ->addColumn("end_date", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $start_date = DB::table("alerts_to_companies")
                    ->select("alerts.end_date")
                    ->join("alerts", 'alerts.id', '=', 'alerts_to_companies.alert_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $start_date[0]->end_date;
            })
            ->addColumn("created_by", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $username = DB::table("alerts_to_companies")
                    ->select("users.name")
                    ->join("users", 'users.id', '=', 'alerts_to_companies.user_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $username[0]->name;
            })
            ->addColumn("type", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $type = DB::table("alerts_to_companies")
                    ->select("alerts.type")
                    ->join("alerts", 'alerts.id', '=', 'alerts_to_companies.alert_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $type[0]->type;
            })
            ->addColumn("compname", function (alerts_to_companies $alert) {
                // return optional($alert->alert_id)->message_en;
                $id = $alert->id;
                $companyname = DB::table("alerts_to_companies")
                    ->select("companies.name_en")
                    ->join("companies", 'companies.id', '=', 'alerts_to_companies.company_id')
                    ->where('alerts_to_companies.id', '=', $id)
                    ->get();
                return $companyname[0]->name_en;
            })

            ->addColumn("isActive", function (alerts_to_companies $alert) {
                $active = DB::table("alerts_to_companies")
                    ->select("alerts.is_activate")
                    ->join("alerts", "alerts.id", "=", "alerts_to_companies.alert_id")->get();
                $id = $alert->id;
                return view("Dashboard-pages.AlertCompany.action", [
                    "type" => "togglealertActive",
                    "active_state" => $active[0]->is_activate,
                    "id" => $id,
                ]);
            })
            ->toJson();
        return $data;
    }
}
