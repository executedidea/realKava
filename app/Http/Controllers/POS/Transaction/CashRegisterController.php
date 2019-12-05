<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Item;
use App\Models\SettingPOS;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashRegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        $outlet_id                                = Auth::user()->outlet_id;
        $user_id                                  = Auth::user()->user_id;
        if($request->license_plate){
            $customer_detail_licensePlate         = $request->license_plate;
            $point_of_sales_list                  = CashRegister::getCustomerDetailLicensePlate($customer_detail_licensePlate);
            $point_of_sales_subtotal              = CashRegister::getSubTotal($customer_detail_licensePlate);
            $bank_name_list                       = CashRegister::getBankNameList();
            $items                                = Item::getAllItem($outlet_id);
            $cashier                              = Shift::getCashierByID($outlet_id, $user_id);
            return view('pos.transaction.cash-register.index', compact('point_of_sales_list', 'point_of_sales_subtotal', 'bank_name_list', 'items', 'cashier'));
        } else {
            $bank_name_list                       = CashRegister::getBankNameList();
            $items                                = Item::getAllItem($outlet_id);
            $cashier                              = Shift::getCashierByID($outlet_id, $user_id);
            return view('pos.transaction.cash-register.index', compact('bank_name_list', 'items', 'cashier'));
        }
    }



    public function getAllItems()
    {
        $outlet_id             = Auth::user()->outlet_id;
        $items                 = Item::getAllItem($outlet_id);
        return response()->json($items);
    }

    public function getItemByID($id)
    {
        $outlet_id                                = Auth::user()->outlet_id;
        $item                                     = Item::getItemByID($outlet_id, $id);
        return response()->json($item);
    }

    public function getCashierByID()
    {
        $user_id        = Auth::user()->user_id;
        $outlet_id      = Auth::user()->outlet_id;
        $cashier        = Shift::getCashierByID($outlet_id, $user_id);

        return response()->json($cashier);
    }

    public function getSetting()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $setting        = SettingPOS::getSettingByOutletID($outlet_id);
        
        return response()->json($setting);
    }
}