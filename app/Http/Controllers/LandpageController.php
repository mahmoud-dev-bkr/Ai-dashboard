<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Headers;
use App\Models\Plan;
use App\Models\Sentence;
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
        // $headers = Headers::all();
        $headers = DB::table("header")
            ->select()
            ->first();
        $sentance = Sentence::all();
        // $plans = Plan::where("activate", 1)->get();
        return view("landpage.index", compact("headers", "sentance"));
    }

    function TermsPage()
    {
        // $terms = Term::where("isActive", 1)->get();
        return view("landpage.terms");
    }
    public function headerpage()
    {
        $header = Headers::all();
        // dd($header);
        return view("Dashboard-pages.Headers.header", compact("header"));
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
        $image2 = $req->file("img2");

        $req->validate([
            "title_en" => "required",
            "title_ar" => "required",
            "content_en" => "required",
            "content_ar" => "required",
            "body_en" => "required",
            "body_ar" => "required",
            // "img" => "required",
            // 'img2' => 'required',
            "learn_more" => "required",
            "download" => "required",
        ]);

        Headers::where("id", $req->id)->update([
            "title" => $req->title_en,
            "title_ar" => $req->title_ar,
            "content" => $req->content_en,
            "content_ar" => $req->content_ar,
            "paragraph" => $req->body_en,
            "paragraph_ar" => $req->body_ar,
            "img" => "banner.png",
            "image_2" => "banner.png",
            "download" => $req->download,
            "learn_more" => $req->learn_more,
        ]);

        if ($req->file("img")) {
            $imageName = "banner" . "." . $image->getClientOriginalExtension();

            // $imageName2 =
            //     Str::random(30) . "." . $image->getClientOriginalExtension();

            Headers::where("id", $req->id)->update([
                "img" => $imageName,
                // "image_2" => $imageName2,
            ]);

            $image->move(public_path("/uploads"), $imageName);
            // $image2->move(public_path("/uploads"), $imageName2);
        }

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
    public function Sentancepage()
    {
        return view("Dashboard-pages.sentance.sentance");
    }

    public function GetSentaceData()
    {
        $query = Sentence::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("action", function (Sentence $sent) {
                $id = $sent->id;
                return view("Dashboard-pages.sentance.action", [
                    "type" => "sentance",
                    "id" => $id,
                ]);
            })
            ->toJson();

        return $data;
    }
    public function createSentance()
    {
        return view("Dashboard-pages.sentance.create");
    }
    public function storeSentance(Request $req)
    {
        $req->validate([
            "sen_en" => "required",
            "sen_ar" => "required",
        ]);
        $sentance = new Sentence();
        $sentance->sentence_en = $req->sen_en;
        $sentance->sentence_ar = $req->sen_ar;
        $sentance->save();
        return response()->json([
            "msg" => "a Sentance Added successfully",
        ]);
    }
    public function deletesentace($id)
    {
        DB::table("sentence")->delete($id);
        return redirect()->back();
    }
}
