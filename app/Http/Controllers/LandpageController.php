<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\features_land;
use App\Models\Headers;
use App\Models\Plan;
use App\Models\profile_land;
use App\Models\Reviews;
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
        $faq = Faq::all();
        $plans = Plan::where("activate", 1)->get();
        // get fag data
        $fagCount = Faq::count();
        $according1 = Faq::limit($fagCount / 2)->get();
        $according2 = Faq::offset($fagCount / 2)
            ->limit($fagCount / 2)
            ->get();
        // $reviews = Reviews::all();
        $reviews = DB::table("reviews")
            ->select()
            ->get();
        $profile = DB::table("profile_land")
            ->select()
            ->first();
        $profile_features = features_land::all();
        // dd($reviews);
        return view(
            "landpage.index",
            compact(
                "headers",
                "sentance",
                "faq",
                "according1",
                "according2",
                "reviews",
                "profile_features",
                "profile"
            )
        );
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
        // $image2 = $req->file("img2");

        $req->validate([
            "title_en" => "required",
            "title_ar" => "required",
            "content_en" => "required",
            "content_ar" => "required",
            "body_en" => "required",
            "body_ar" => "required",
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
            "q3" => "required",
            "q4" => "required",
            "s3" => "required",
            "s4" => "required",
        ]);
        $faq = new Faq();
        $faq->title = $req->q1;
        $faq->paragraph = $req->s1;
        $faq->title_ar = $req->q2;
        $faq->paragraph_ar = $req->s2;
        $faq->save();
        $faq2 = new Faq();
        $faq2->title = $req->q3;
        $faq2->paragraph = $req->s3;
        $faq2->title_ar = $req->q4;
        $faq2->paragraph_ar = $req->s4;
        $faq2->save();
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
    //////////////reviews///////////////////////

    public function reviews_pages()
    {
        return view("Dashboard-pages.reviews.reviews");
    }
    public function GetReviewsData()
    {
        $query = Reviews::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->editColumn("paragraph", function (Reviews $review) {
                return view("Dashboard-pages.reviews.action", [
                    "type" => "paragraph",
                    "p" => $review->paragraph,
                ]);
            })
            ->addColumn("action", function (Reviews $review) {
                $id = $review->id;
                return view("Dashboard-pages.reviews.action", [
                    "type" => "action",
                    "id" => $id,
                ]);
            })
            ->toJson();
        return $data;
    }
    public function insertreviews()
    {
        return view("Dashboard-pages.reviews.insert");
    }
    public function storeReviews(Request $req)
    {
        try {
            $req->validate([
                "rate" => "required|numeric",
                "title_en" => "required",
                "body_en" => "required",
                "owner_en" => "required",
                "company_en" => "required",
                "title_ar" => "required",
                "body_ar" => "required",
                "owner_ar" => "required",
                "company_ar" => "required",
            ]);
            $review = new Reviews();
            $review->rate = $req->rate;
            $review->title = $req->title_en;
            $review->paragraph = $req->body_en;
            $review->owner = $req->owner_en;
            $review->supporter = $req->company_en;
            $review->title_ar = $req->title_ar;
            $review->paragraph_ar = $req->body_ar;
            $review->owner_ar = $req->owner_ar;
            $review->supporter_ar = $req->company_ar;

            $review->save();
            return response()->json([
                "msg" => "Reviews Added successfully",
            ]);
        } catch (Exception $err) {
            return $err;
        }
    }
    public function deletereviews($id)
    {
        DB::table("reviews")->delete($id);
        return redirect()->back();
    }

    public function profile_landpage()
    {
        $profile = profile_land::all();
        return view(
            "Dashboard-pages.profile_land.profile_land",
            compact("profile")
        );
    }
    public function update_land_page($id)
    {
        $profile_land = DB::table("profile_land")
            ->select()
            ->where("id", "=", $id)
            ->first();
        return view(
            "Dashboard-pages.profile_land.profile_land_update",
            compact("profile_land")
        );
    }
    public function edit_land_page(Request $req)
    {
        $image = $req->file("img");
        $req->validate([
            "title_en" => "required",
            "title_ar" => "required",
            "span_en" => "required",
            "span_ar" => "required",
        ]);

        profile_land::where("id", $req->id)->update([
            "span" => $req->span_en,
            "title" => $req->title_en,
            "title_ar" => $req->title_ar,
            "span_ar" => $req->span_ar,
            "img" => "banner.png",
            "download" => $req->download,
            "learn_more" => $req->learn_more,
        ]);
        $imageName =
            Str::random(30) . "." . $image->getClientOriginalExtension();

        profile_land::where("id", $req->id)->update([
            "img" => $imageName,
        ]);
        $image->move(public_path("/uploads"), $imageName);
        return response()->json([
            "msg" => "Profile Updated Succsfully",
        ]);
    }
    public function feature_land()
    {
        return view("Dashboard-pages.feature_land.feature_land");
    }

    public function GetProfile_featureData()
    {
        $query = features_land::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->editColumn("content", function (features_land $feature) {
                return view("Dashboard-pages.feature_land.action", [
                    "type" => "content",
                    "p" => $feature->content,
                ]);
            })
            ->editColumn("content_ar", function (features_land $feature) {
                return view("Dashboard-pages.feature_land.action", [
                    "type" => "content_ar",
                    "p" => $feature->content_ar,
                ]);
            })
            ->addColumn("action", function (features_land $feature) {
                $id = $feature->id;
                return view("Dashboard-pages.feature_land.action", [
                    "type" => "action",
                    "id" => $id,
                ]);
            })
            ->toJson();

        return $data;
    }
    public function delete_feature_land($id)
    {
        DB::table("feature_land")->delete($id);
        return redirect()->back();
    }
    public function insert_feature_land()
    {
        return view("Dashboard-pages.feature_land.insert");
    }
    public function store_feature_land(Request $req)
    {
        $req->validate([
            "title_en" => "required",
            "body_en" => "required",
            "title_ar" => "required",
            "body_ar" => "required",
        ]);
        $features = new features_land();
        $features->title = $req->title_en;
        $features->content = $req->body_en;
        $features->title_ar = $req->title_ar;
        $features->content_ar = $req->body_ar;

        $features->save();
        return response()->json([
            "msg" => "Features Added successfully",
        ]);
    }
}
