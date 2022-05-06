<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandpageController extends Controller
{
    function HomePage()
    {
        return view("landpage.index");
    }

    function TermsPage()
    {
        return view("landpage.terms");
    }
}
