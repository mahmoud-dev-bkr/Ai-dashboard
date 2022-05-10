<?php

use App\Http\Controllers\AlertsController;
use App\Http\Controllers\AlertWithComapanyController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LandpageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentDetailsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermsController;
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
                ])->name("loginRequest");
            }
        );
        ///////////////////////////////////////////////////
        // dashboard pages
        Route::group(
            ["prefix" => "admin", "middleware" => ["user.auth"]],
            function () {
                // main admin page
                Route::get("/", [PagesController::class, "mainAdminPage"]);

                // companies routes
                Route::group(["prefix" => "company"], function () {
                    Route::get("/insert", [
                        CompaniesController::class,
                        "inserPage",
                    ]);
                    Route::get("/", [
                        CompaniesController::class,
                        "companyPage",
                    ])->name("indexPage");

                    Route::get("/data", [
                        CompaniesController::class,
                        "getCompaniesData",
                    ])->name("getCompaniesData");
                    Route::post("/insert", [
                        CompaniesController::class,
                        "addCompany",
                    ])->name("addCompany");
                });
                // start of plans routes-------------------------------------------

                // end of plans routes-------------------------------------------
                //start of users routes---------------------------------------------
                Route::group(["prefix" => "users"], function () {
                    ///////////////////////////////////////// users page
                    Route::get("/", [UsersController::class, "usersPage"]);
                    ///////////////////////////////////////////

                    ////////////////////page for inserting a new user////////////////////////////
                    Route::get("/insert", [
                        UsersController::class,
                        "insertPage",
                    ])->name("insertUserPage");

                    ////////////////////////////////////////////////////////
                    ////////////////////page for updating user////////////////////////////
                    Route::get("/update/{id}", [
                        UsersController::class,
                        "updatePage",
                    ])->name("updatePage");

                    Route::post("/update/{id}", [
                        UsersController::class,
                        "update",
                    ])->name("updateUser");

                    Route::patch("/toggle", [
                        UsersController::class,
                        "toggleActive",
                    ])->name("toggleActiveUser");
                    ////////////////////////////////////////////////////////////////////////////
                    Route::post("/insert", [
                        UsersController::class,
                        "createUser",
                    ])->name("addNewUser");

                    ////////////get users data for the datatable
                    Route::get("/data", [
                        UsersController::class,
                        "getUsersData",
                    ])->name("getUsersData");
                    ///////////////////////////////////////////////
                });
                //end of users routes------------------------------------------------
                // ---------------payment menthods
                Route::group(
                    [
                        "prefix" => "paymentsmethods",
                        "middleware" => ["user.auth"],
                    ],
                    function () {
                        Route::get("/", [
                            PaymentMethodController::class,
                            "PaymentMethodpage",
                        ]);
                        Route::get("/data", [
                            PaymentMethodController::class,
                            "getpaymentmethoddata",
                        ])->name("getPaymentData");
                        Route::patch("/toggleactivate", [
                            PaymentMethodController::class,
                            "toggleactivate",
                        ])->name("toggleactivate");
                        Route::get("addpaymentmethod", [
                            PaymentMethodController::class,
                            "insertpaymentmethod"
                        ])->name("addpaymentmethod");
                        Route::post("storepaymentmethod", [
                            PaymentMethodController::class,
                            "storepaymentmethod"
                        ])->name("storepaymentmethod");
                    }
                );
                Route::group(["prefix" => "alerts"], function () {
                    Route::get("/", [AlertsController::class, "alertpage"]);

                    Route::get("/data", [
                        AlertsController::class,
                        "getalertdata",
                    ])->name("getalertdata");

                    Route::patch("togglealertactivate", [
                        AlertsController::class,
                        "toggleactivate",
                    ])->name("togglealertactivate");

                    Route::delete("deletealert/{id}", [
                        AlertsController::class,
                        "deletealert",
                    ])->name("deletealert");
                    Route::get("insertalert", [
                        AlertsController::class,
                        "addalert",
                    ])->name("insertalertPage");

                    Route::post("storealert", [
                        AlertsController::class,
                        "storealert",
                    ])->name("storealert");

                    Route::post("/update", [
                        AlertsController::class,
                        "EditAlert",
                    ])->name("EditAlert");

                    Route::get("/update/{alert_id}", [
                        AlertsController::class,
                        "EditPage",
                    ]);
                });

                Route::group(["prefix" => "alertscompany"], function () {
                    Route::get('/', [AlertWithComapanyController::class, "AlertCompany"]);
                    Route::get('/data', [AlertWithComapanyController::class, "getAlertCompanyData"])->name("getAlertCompanyData");
                });
                // start of roles routes
                Route::group(["prefix" => "roles"], function () {
                    Route::get("/", [RolesController::class, "viewRoles"]);
                    Route::get("/data", [
                        RolesController::class,
                        "getRulesData",
                    ])->name("getRulesData");
                    // view for creating a new role
                    Route::get("/insert", [
                        RolesController::class,
                        "insertPage",
                    ])->name("insertRolePage");

                    Route::get("/update/{id}", [
                        RolesController::class,
                        "updatePage",
                    ])->name("updateRolePage");

                    Route::put("/update/{id}", [
                        RolesController::class,
                        "update",
                    ])->name("updateRole");

                    Route::post("/insert", [
                        RolesController::class,
                        "createRole",
                    ])->name("createRole");
                });
                // end of roles routes
                // start of terms routes
                Route::group(["prefix" => "terms"], function () {
                    Route::get("/", [TermsController::class, "termspage"]);
                    Route::get("/isnert", [
                        TermsController::class,
                        "insertTermPage",
                    ])->name("insertTermPage");

                    Route::post("/isnert", [
                        TermsController::class,
                        "insert",
                    ])->name("insertTerm");

                    Route::get("/update/{id}", [
                        TermsController::class,
                        "updatePage",
                    ])->name("updateTermPage");
                    Route::post("/update/{id}", [
                        TermsController::class,
                        "update",
                    ])->name("updateTerm");

                    Route::patch("/toggle", [
                        TermsController::class,
                        "toggleActive",
                    ])->name("toggleActiveTerm");
                });
                // end of terms routes
                // ----------------------------------< Palne >----------------------------------
                Route::group(
                    [
                        "prefix" => "Plan",
                        "middleware" => ["user.auth"],
                    ],
                    function () {
                        Route::get("/", [PlanController::class, "index"]);
                        // DataTable Get  Plans
                        Route::get("/data", [
                            PlanController::class,
                            "getPlansData",
                        ])->name("getPlansData");
                        // Insert A new Plan
                        Route::get("/insert", [
                            PlanController::class,
                            "insertPage",
                        ])->name("insertPlanPage");

                        // Create Post Route A new Plan
                        Route::post("/insert", [
                            PlanController::class,
                            "createPlan",
                        ])->name("insertPlan");
                        // Edit view Plan
                        Route::get("/update/{plan_id}", [
                            PlanController::class,
                            "EditPage",
                        ])->name("EditPage");
                        // Edit Post Route A OLD Plan
                        Route::post("/update", [
                            PlanController::class,
                            "EditPlan",
                        ])->name("EditPlan");
                    }
                );
                Route::group(["prefix" => "profile"], function () {
                    Route::get("/", [ProfileController::class, "profilepage"]);
                    Route::get("/changepassword", [
                        ProfileController::class,
                        "changepassword",
                    ]);
                    Route::post("storechangepassword", [
                        ProfileController::class,
                        "updatepassword",
                    ])->name("updatepassword");
                });
                // ----------------------------------< End Plan >--------------------------------
                // start payment details
                Route::group(["prefix" => "paymentdetails"], function () {
                    Route::get("/", [
                        PaymentDetailsController::class,
                        "paymentDetailspage",
                    ]);
                    Route::get("/data", [
                        PaymentDetailsController::class,
                        "getpaymentdetailsdata",
                    ])->name("getpaymentdetailsData");
                    Route::get("addpaymentdetails", [
                        PaymentDetailsController::class,
                        "addpaymentdetails",
                    ])->name("addpaymentdetails");
                    Route::post("storepaymentdetails", [
                        PaymentDetailsController::class,
                        "storepaymentdetails",
                    ])->name("storepaymentdetails");
                });
                // logout user
                Route::delete("/logout", [
                    LoginController::class,
                    "sign_out",
                ])->name("logout");
            }
        );
    }
);
