<?php

namespace App\Http\Controllers\CS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CheckInOut;
use App\Models\Customer_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInOutController extends Controller
{
    //
    public function index()
    {
        $outlet_id              = Auth::user()->outlet_id;
        $customer_checked_in    = CheckInOut::getTodayCustomer($outlet_id);
        $customer_detail        = Customer_Detail::getAllCustomerDetail($outlet_id);

        return view('cs.transaction.check-in-out.index', compact('customer_detail', 'customer_checked_in'));
    }

    public function searchCustomer(Request $request)
    {
        $customer               = Customer_Detail::searchCustomerDetailByKey($request->q);
        return response()->json($customer);
    }
}
