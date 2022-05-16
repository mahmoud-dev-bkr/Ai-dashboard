<?php

namespace App\Http\Controllers;

use App\Models\Headers;
use App\Models\Plan;
use App\Models\Term;
use Exception;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandpageController extends Controller
{
    function HomePage()
    {
        // $plans = Plan::where("activate", 1)->get();
        return view("landpage.index");
    }

    function TermsPage()
    {
        // $terms = Term::where("isActive", 1)->get();
        return view("landpage.terms");
    }
    public function headerpage()
    {
        return view("Dashboard-pages.Headers.header");
    }
    public function view_header($id)
    {
        $headers = DB::table("header")
            ->select()
            ->where("id", "=", $id)
            ->get();
        // $headers = Headers::find($id);
        // dd($headers);
        return view("Dashboard-pages.Headers.view", compact("headers"));
    }
    public function update_header($id)
    {
        $headers = DB::table("header")
            ->select()
            ->where("id", "=", $id)
            ->first();
        //dd($headers);
        return view("Dashboard-pages.Headers.update", compact("headers"));
    }
    public function edit_header(Request $req)
    {
        $image = $req->file("img");
        $req->validate([
            "title_en" => "required",
            "title_ar" => "required",
            "content_en" => "required",
            "content_ar" => "required",
            "body_en" => "required",
            "body_ar" => "required",
            "img" => "required",
        ]);

        Headers::where("id", $req->id)->update([
            "title" => $req->title_en,
            "title_ar" => $req->title_ar,
            "content" => $req->content_en,
            "content_ar" => $req->content_ar,
            "paragraph" => $req->body_en,
            "paragraph_ar" => $req->body_ar,
            "img" => "banner.png",
        ]);
        $imageName =
            Str::random(30) . "." . $image->getClientOriginalExtension();
        $image->move(public_path("/uploads"), $imageName);
        Headers::where("id", $req->id)->update([
            "img" => $imageName,
        ]);
        return response()->json([
            "msg" => "Header Updated Succsfully",
        ]);
    }
    public function GetHeaderData()
    {
        $query = Headers::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("content_img", function (Headers $head) {
                $img = $head->img;
                // $id = $head->id;

                return view("Dashboard-pages.Headers.action", [
                    "type" => "header_img",
                    "img" => $img,
                    // "id" => $id,
                ]);
            })
            ->addColumn("action", function (Headers $head) {
                $id = $head->id;
                return view("Dashboard-pages.Headers.action", [
                    "type" => "action",
                    "id" => $id,
                ]);
            })
            ->toJson();

        return $data;
    }
}
