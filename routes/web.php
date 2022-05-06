<?php

use App\Http\Controllers\LandpageController;
use App\Http\Controllers\UsersController;
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
        // landpage
        Route::get("/", [LandpageController::class, "HomePage"]);
        Route::get("/terms", [LandpageController::class, "TermsPage"]);
        // dashboard routes
        Route::group(["prefix" => "admin", "middleware" => []], function () {
            //start of users routes--------------------------------------------
            Route::group(
                ["prefix" => "users", "middleware" => []],
                function () {
                    ///////////////////////////////////////// users page
                    Route::get("/", [UsersController::class, "usersPage"]);
                    ///////////////////////////////////////////

                    ////////////get users data for the datatable
                    Route::get("/data", [
                        UsersController::class,
                        "getUsersData",
                    ])->name("getUsersData");
                    ///////////////////////////////////////////////
                }
            );
            //end of users routes------------------------------------------------
        });
    }
);
