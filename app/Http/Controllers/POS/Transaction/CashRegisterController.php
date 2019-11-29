<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use Illuminate\Http\Request;

class CashRegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->license_plate){
            $customer_detail_licensePlate         = $request->license_plate;
            $point_of_sales_list                  = CashRegister::getCustomerDetailLicensePlate($customer_detail_licensePlate);
            $point_of_sales_subtotal              = CashRegister::getSubTotal($customer_detail_licensePlate);
            $bank_name_list                       = CashRegister::getBankNameList();
            return view('pos.transaction.cash-register.index', compact('point_of_sales_list', 'point_of_sales_subtotal', 'bank_name_list'));
        } else {
            $bank_name_list                       = CashRegister::getBankNameList();
            return view('pos.transaction.cash-register.index', compact('bank_name_list'));
        }
    }
}
