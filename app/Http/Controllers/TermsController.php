<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    //

    public function termspage()
    {
        $terms = Term::all();
        return view("dashboard-pages.terms.index", compact("terms"));
    }

    public function insertTermPage()
    {
        return view("dashboard-pages.terms.create");
    }
    public function insert(Request $req)
    {
        $valdiator = $req->validate([
            "title" => "required",
            "title_ar" => "required",
            "body" => "required",
            "body_ar" => "required",
        ]);

        $term = new Term();
        $term->title = $valdiator["title"];
        $term->title_ar = $valdiator["title_ar"];
        $term->body = $valdiator["body"];
        $term->body_ar = $valdiator["body_ar"];
        $term->save();
        return response()->json([
            "msg" => "a new term is added successfully",
        ]);
    }
}
