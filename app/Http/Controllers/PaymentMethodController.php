<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    //
    public function PaymentMethodpage()
    {
        return view("Dashboard-pages.PaymentMethod.Payment_method");
    }

    public function getpaymentmethoddata()
    {
        $query = PaymentMethod::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("isActive", function (PaymentMethod $pay) {
                $active = $pay->isActive;
                $id = $pay->id;
                return view("Dashboard-pages.PaymentMethod.action", [
                    "type" => "togglePMethodsActive",
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
        $state = $req->active_state;

        $payment_method = PaymentMethod::find($id);

        $payment_method->isActive = $state ? false : true;
        $payment_method->save();
        if ($state) {
            return response()->json([
                "error" => "payment method is not active any more",
            ]);
        } else {
            return response()->json([
                "msg" => "payment method is active now",
            ]);
        }
    }

    public function insertpaymentmethod()
    {
        return view("Dashboard-pages.PaymentMethod.insertpaymentmethod");
    }
    public function storepaymentmethod(Request $request)
    {
        $request->validate([
            'name' => "required",
            'details' => 'required',
            "note" => "required",
        ]);
        $paymethod = new PaymentMethod();
        $paymethod->name = $request->name;
        $paymethod->details = $request->details;
        $paymethod->note = $request->note;
        $paymethod->update_user_id = Auth::id();
        $paymethod->save();
        return response()->json([
            'msg' => "Payment Methods Inserted Successfuly",
        ]);
    }
}
