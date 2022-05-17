<?php

namespace App\Http\Controllers;

use App\Models\Faq;
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

    public function view_faq()
    {
        $faq = Faq::all();
        return view("Dashboard-pages.FAQ.faq", compact("faq"));
    }
    public function deletefaq($id)
    {
        DB::table("faq")->delete($id);
        return redirect()->back();
    }
    public function createFaq()
    {
        return view("Dashboard-pages.FAQ.create");
    }
    public function storeFaQ(Request $req)
    {
        $req->validate([
            "q1" => "required",
            "s1" => "required",
            "q2" => "required",
            "s2" => "required",
        ]);
        $faq = new Faq();
        $faq->title = $req->q1;
        $faq->paragraph = $req->s1;
        $faq->title_ar = $req->q2;
        $faq->paragraph_ar = $req->s2;
        $faq->save();
        return response()->json([
            "msg" => "a Faq Added successfully",
        ]);
    }
    public function update($id)
    {
        $faq = DB::table("faq")
            ->select()
            ->where("id", "=", $id)
            ->first();
        return view("Dashboard-pages.FAQ.update", compact("faq"));
    }
    public function editfaq(Request $req)
    {
        $req->validate([
            "title_en" => "required",
            "title_ar" => "required",
            "body_en" => "required",
            "body_ar" => "required",
        ]);

        Faq::where("id", $req->id)->update([
            "title" => $req->title_en,
            "title_ar" => $req->title_ar,
            "paragraph" => $req->body_en,
            "paragraph_ar" => $req->body_ar,
        ]);
        return response()->json([
            "msg" => "FAQ Updated Succsfully",
        ]);
    }
}
