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
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get("/test", function () {
//     Permission::create([
//         "name" => "payment_details_add",
//         "display_name" => "add payment details", // optional
//     ]);

//     Permission::create([
//         "name" => "payment_details_view",
//         "display_name" => "view payment details", // optional
//     ]);

//     Permission::create([
//         "name" => "payment_details_edit",
//         "display_name" => "edit payment details", // optional
//     ]);

//     // //////////////////////////////////////////////
//     Permission::create([
//         "name" => "plans_add",
//         "display_name" => "add a new plan", // optional
//     ]);

//     Permission::create([
//         "name" => "plans_edit",
//         "display_name" => "edit a plan", // optional
//     ]);

//     Permission::create([
//         "name" => "plans_view",
//         "display_name" => "view plans", // optional
//     ]);

//     Permission::create([
//         "name" => "plans_delete",
//         "display_name" => "delete plans", // optional
//     ]);
//     // /////////////////////////////////////////////////////////////////////
//     Permission::create([
//         "name" => "users_add",
//         "display_name" => "add users", // optional
//     ]);

//     Permission::create([
//         "name" => "users_edit",
//         "display_name" => "edit users", // optional
//     ]);

//     Permission::create([
//         "name" => "users_view",
//         "display_name" => "view users", // optional
//     ]);

//     Permission::create([
//         "name" => "users_activate",
//         "display_name" => "active/disactive users", // optional
//     ]);
//     // ////////////////////////////////////////////////////////////
//     Permission::create([
//         "name" => "payment_method_add",
//         "display_name" => "add payment method", // optional
//     ]);

//     Permission::create([
//         "name" => "payment_method_view",
//         "display_name" => "view payment methods", // optional
//     ]);

//     Permission::create([
//         "name" => "payment_method_edit",
//         "display_name" => "edit payment method", // optional
//     ]);

//     Permission::create([
//         "name" => "payment_method_activate",
//         "display_name" => "active/disactive payment methods", // optional
//     ]);
//     // ////////////////////////////////////////////////////////////
//     Permission::create([
//         "name" => "alerts_add",
//         "display_name" => "add a new alert", // optional
//     ]);

//     Permission::create([
//         "name" => "alerts_view",
//         "display_name" => "view alerts", // optional
//     ]);

//     Permission::create([
//         "name" => "alerts_edit",
//         "display_name" => "edit alerts", // optional
//     ]);

//     Permission::create([
//         "name" => "alerts_activate",
//         "display_name" => "active/disactive alerts", // optional
//     ]);
//     Permission::create([
//         "name" => "alerts_delete",
//         "display_name" => "delete alerts", // optional
//     ]);
//     // ////////////////////////////////////////////////////////////
//     Permission::create([
//         "name" => "notifications_add",
//         "display_name" => "add a new notification", // optional
//     ]);

//     Permission::create([
//         "name" => "notifications_view",
//         "display_name" => "view notifications", // optional
//     ]);

//     Permission::create([
//         "name" => "notifications_activate",
//         "display_name" => "active/disactive notifications", // optional
//     ]);

//     Permission::create([
//         "name" => "notifications_delete",
//         "display_name" => "delete notifications", // optional
//     ]);
//     // ////////////////////////////////////////////////////////////

//     Permission::create([
//         "name" => "roles_permissions_add",
//         "display_name" => "add a new role", // optional
//     ]);

//     Permission::create([
//         "name" => "roles_permissions_view",
//         "display_name" => "view roles", // optional
//     ]);

//     Permission::create([
//         "name" => "roles_permissions_update",
//         "display_name" => "update roles", // optional
//     ]);
//     // ////////////////////////////////////////////////////////////
//     Permission::create([
//         "name" => "manage_landpage",
//         "display_name" => "manage landpage data", // optional
//     ]);
// });

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

                // fag
                Route::group(["prefix" => "faq"], function () {
                    Route::get("/", [LandpageController::class, "view_faq"]);
                    Route::get("/data", [
                        LandpageController::class,
                        "getfaqData",
                    ])->name("getfaqData");
                    Route::delete("/delete/{id}", [
                        LandpageController::class,
                        "deletefaq",
                    ])->name("deletefaq");
                    Route::get("/create", [
                        LandpageController::class,
                        "createFaq",
                    ])->name("createFaq");
                    Route::post("/store", [
                        LandpageController::class,
                        "storeFaQ",
                    ])->name("storeFaQ");
                    Route::get("/update/{id}", [
                        LandpageController::class,
                        "update",
                    ]);
                    Route::post("/edit", [
                        LandpageController::class,
                        "editfaq",
                    ])->name("editfaq");
                });

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
                            "insertpaymentmethod",
                        ])->name("addpaymentmethod");
                        Route::post("storepaymentmethod", [
                            PaymentMethodController::class,
                            "storepaymentmethod",
                        ])->name("storepaymentmethod");
                    }
                );
                Route::group(["prefix" => "alertscompany"], function () {
                    Route::get("/", [
                        AlertWithComapanyController::class,
                        "AlertCompany",
                    ]);
                    Route::get("/data", [
                        AlertWithComapanyController::class,
                        "getAlertCompanyData",
                    ])->name("getAlertCompanyData");
                    Route::patch("/togglealertcomapanyactivate", [
                        AlertWithComapanyController::class,
                        "togglealertcompanyactivate",
                    ])->name("togglealertcompanyactivate");
                    Route::delete("/deletealertcompany/{id}", [
                        AlertWithComapanyController::class,
                        "deletealertcompany",
                    ])->name("deletealertcompany");
                    Route::get("/insertalertmessage", [
                        AlertWithComapanyController::class,
                        "InsertAlertPage",
                    ])->name("insertalertmessage");
                    Route::post("storealertmsg", [
                        AlertWithComapanyController::class,
                        "storealertcompany",
                    ])->name("storealertmsg");
                });

                Route::group(["prefix" => "reviews"], function () {
                    Route::get("/", [
                        LandpageController::class,
                        "reviews_pages",
                    ]);
                    Route::get("/data", [
                        LandpageController::class,
                        "GetReviewsData",
                    ])->name("GetReviewsData");
                    Route::delete("/delete/{id}", [
                        LandpageController::class,
                        "deletereviews",
                    ])->name("deletereviews");
                    Route::get("/insert", [
                        LandpageController::class,
                        "insertreviews",
                    ])->name("insertreviews");
                    Route::post("/store", [
                        LandpageController::class,
                        "storeReviews",
                    ])->name("storeReviews");
                });

                Route::group(["prefix" => "profile_land"], function () {
                    Route::get("/", [
                        LandpageController::class,
                        "profile_landpage",
                    ]);
                    Route::get("/update/{id}", [
                        LandpageController::class,
                        "update_land_page",
                    ])->name("update_land_page");
                    Route::post("/edit", [
                        LandpageController::class,
                        "edit_land_page",
                    ])->name("edit_land_page");
                });

                Route::group(["prefix" => "features_land"], function () {
                    Route::get("/", [
                        LandpageController::class,
                        "feature_land",
                    ]);
                    Route::get("/data", [
                        LandpageController::class,
                        "GetProfile_featureData",
                    ])->name("GetProfile_featureData");
                    Route::delete("/delete/{id}", [
                        LandpageController::class,
                        "delete_feature_land",
                    ])->name("delete_feature_land");
                    Route::get("/insert", [
                        LandpageController::class,
                        "insert_feature_land",
                    ])->name("insert_feature_land");
                    Route::post("/store", [
                        LandpageController::class,
                        "store_feature_land",
                    ])->name("store_feature_land");
                });
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
                    Route::get("/", [
                        AlertWithComapanyController::class,
                        "AlertCompany",
                    ]);
                    Route::get("/data", [
                        AlertWithComapanyController::class,
                        "getAlertCompanyData",
                    ])->name("getAlertCompanyData");
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
                Route::group(["prefix" => "header"], function () {
                    Route::get("/", [LandpageController::class, "headerpage"]);
                    // Route::get("/data", [
                    //     LandpageController::class,
                    //     "GetHeaderData",
                    // ])->name("GetHeaderData");
                    // Route::get("/view/{id}", [
                    //     LandpageController::class,
                    //     "view_header",
                    // ]);
                    Route::get("/update/{id}/", [
                        LandpageController::class,
                        "update_header",
                    ])->name("update_header");
                    Route::post("/edit", [
                        LandpageController::class,
                        "edit_header",
                    ])->name("edit_header");
                });
                Route::group(["prefix" => "sentance"], function () {
                    Route::get("/", [
                        LandpageController::class,
                        "Sentancepage",
                    ]);
                    Route::get("/data", [
                        LandpageController::class,
                        "GetSentaceData",
                    ])->name("GetSentaceData");
                    Route::get("/create", [
                        LandpageController::class,
                        "createSentance",
                    ])->name("createSentance");
                    Route::post("/store", [
                        LandpageController::class,
                        "storeSentance",
                    ])->name("storeSentance");
                    Route::delete("deletesentace/{id}", [
                        LandpageController::class,
                        "deletesentace",
                    ])->name("deletesentace");
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
                    Route::get("updatepaymentdetails/{id}", [
                        PaymentDetailsController::class,
                        "update_paymentdetails",
                    ])->name("update_paymentdetails");
                    Route::post("edit_paymentdetials", [
                        PaymentDetailsController::class,
                        "edit_paymentdetails",
                    ])->name("edit_paymentdetails");
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
