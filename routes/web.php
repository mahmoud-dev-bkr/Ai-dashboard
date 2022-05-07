<?php

use App\Http\Controllers\LandpageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
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

        //login routes //
        Route::group(
            ["prefix" => "admin", "middleware" => "user.noauth"],
            function () {
                Route::get("/login", [LoginController::class, "index"])->name(
                    "login"
                );
                Route::post("/login_request", [
                    LoginController::class,
                    "sign_in",
                ]);
            }
        );

        ///////////////////////////////////////////////////

        // dashboard pages
        Route::group(
            ["prefix" => "admin", "middleware" => ["user.auth"]],
            function () {
                // main admin page
                Route::get("/", [PagesController::class, "mainAdminPage"]);

                //start of users routes--------------------------------------------
                Route::group(
                    ["prefix" => "users", "middleware" => ["auth"]],
                    function () {
                        ///////////////////////////////////////// users page
                        Route::get("/", [UsersController::class, "usersPage"]);
                        ///////////////////////////////////////////

                        ////////////////////page for inserting a new user////////////////////////////
                        Route::get("/insert", [
                            UsersController::class,
                            "insertPage",
                        ])->name("insertUserPage");

                        ////////////////////////////////////////////////////////

                        ////////////////////////////////////////////////////////////////////////////
                        Route::post("/insert", [
                            UsersController::class,
                            "createUser",
                        ])->name("addNewUser");
                        ////////////////////////////////////////////////////////////////////////////

                        ////////////get users data for the datatable
                        Route::get("/data", [
                            UsersController::class,
                            "getUsersData",
                        ])->name("getUsersData");
                        ///////////////////////////////////////////////
                    }
                );
                //end of users routes------------------------------------------------
                // logout user
                Route::delete("/logout", [
                    LoginController::class,
                    "sign_out",
                ])->name("logout");
            }
        );
    }
);
