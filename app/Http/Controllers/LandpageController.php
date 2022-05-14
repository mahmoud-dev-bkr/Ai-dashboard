<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Term;
use Illuminate\Http\Request;

class LandpageController extends Controller
{
    function HomePage()
    {
        // $plans = Plan::where("activate", 1)->get();
        return view("landpage.index", compact("plans"));
    }

    function TermsPage()
    {
        // $terms = Term::where("isActive", 1)->get();
        return view("landpage.terms", compact("terms"));
    }
}
