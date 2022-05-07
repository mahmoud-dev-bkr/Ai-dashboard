<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //
    public function PaymentMethodpage()
    {
        return view('Dashboard-pages.PaymentMethod.Payment_method');
    }

    public function getpaymentmethoddata()
    {
        $query = PaymentMethod::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn('isActive', function (PaymentMethod $pay) {
                $active = $pay->isActive;
                $id = $pay->id;
                return view("Dashboard-pages.PaymentMethod.action", [
                    "type" => "is_active",
                    "active_state" => $active,
                    "id" => $id,
                ]);
            })
            ->toJson();
        return $data;
    }

    public function toggleactivate(Request $req)
    {
        $id = $req->id;
        $type = $req->isActive;

        $activeprocess = PaymentMethod::find($id);
        if ($type == 1) {
            $activeprocess->isActive = false;
        }
        $activeprocess->save();
        return response()->json(['msg' => "Payment Method : " . $activeprocess->name . ' is activated now']);
    }

    // public function changeStatus(Request $request)
    // {
    //     $paymentmethod = PaymentMethod::find($request->user_id);
    //     $$paymentmethod->isActive = $request->status;
    //     $$paymentmethod->save();
    //     return response()->json(['success' => 'Status change successfully.']);
    // }
}
