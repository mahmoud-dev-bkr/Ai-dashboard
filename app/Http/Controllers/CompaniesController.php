<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function getCompaniesData()
    {
        $query = Company::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("location", function (Company $c) {
                return $c->long . " , " . $c->lat;
            })
            ->editColumn("commercial_record", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "link" => $c->commercial_record,
                    "type" => "file",
                ]);
            })
            ->editColumn("tax_card", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "link" => $c->tax_card,
                    "type" => "file",
                ]);
            })
            ->editColumn("email", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "email" => $c->email,
                    "type" => "mailto",
                ]);
            })
            ->addColumn("user", function (Company $c) {
                if ($c->user_id) {
                    return User::find($c->user_id)->name_en;
                }
                return "not found";
            })
            ->addColumn("active", function (Company $c) {
                return $c->isActive ? "active" : "not active";
            })
            ->toJson();
        return $data;
    }

    public function companyPage()
    {
        return view("dashboard-pages.companies.index");
    }

    public function inserPage()
    {
        $plans = Plan::all();
        $methods = PaymentMethod::all();
        return view("dashboard-pages.companies.insert", [
            "plans" => $plans,
            "methods" => $methods,
        ]);
    }

    public function addCompany(Request $req)
    {
        $validator = $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "email" => "required|email|unique:companies",
            "tel1" => "required",
            "tel2" => "",
            "tel3" => "",
            "website" => "",
            "address" => "required",
            "long" => "required",
            "lat" => "required",
            "commercial_record" => "required|url",
            "tax_card" => "required|url",
            "timezone" => "required",
            "note" => "",
            "plan_id" => "required",
            "pay_method" => "required",
            "pay_date" => "required",
            "start_date" => "required",
        ]);
        $company = new Company();
        $company->name_en = $validator["name_en"];
        $company->name_ar = $validator["name_ar"];
        $company->Tel_1 = $validator["tel1"];
        $company->Tel_2 = $validator["tel2"];
        $company->Tel_3 = $validator["tel3"];
        $company->email = $validator["email"];
        $company->website = $validator["website"];
        $company->main_address = $validator["address"];
        $company->long = $validator["long"];
        $company->lat = $validator["lat"];
        $company->commercial_record = $validator["commercial_record"];
        $company->commercial_record = $validator["commercial_record"];
        $company->tax_card = $validator["tax_card"];
        $company->note = $validator["note"];
        $company->timezone = $validator["timezone"];
        $company->current_plan_id = $validator["plan_id"];
        $company->registration_num = $this->generateRandomString(12);
        $company->user_id = Auth::id();
        $company->isActive = true;
        $company->save();

        // create a payment details for the company
        $pay = new PaymentDetail();
        $pay->plan_id = $validator["plan_id"];
        $pay->company_id = $company->id;
        $pay->paymethod_id = $validator["pay_method"];

        $pay->pay_date = $req->pay_date;
        $pay->start_date = $req->start_date;

        $date = Carbon::createFromFormat("Y-m-d", $req->start_date);
        $daysToAdd = Plan::find($validator["plan_id"])->duration_days;
        $pay->end_date = $date->addDays($daysToAdd);

        // $pay->user_id = Auth::id();
        $pay->save();

        return response()->json([
            "msg" => "company and payment are added successfully",
        ]);
    }

    function generateRandomString($length)
    {
        $characters = "0123456789";
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
