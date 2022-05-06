<?php

use App\Http\Controllers\LandpageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        "prefix" => LaravelLocalization::setLocale(),
        "middleware" => [
            "localeSessionRedirect",
            "localizationRedirect",
            "localeViewPath",
        ],
    ],
    function () {
        Route::get("/", [LandpageController::class, "HomePage"]);
        Route::get("/terms", [LandpageController::class, "TermsPage"]);
    }
);
