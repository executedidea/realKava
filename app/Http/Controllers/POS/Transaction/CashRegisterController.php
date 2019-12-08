<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\CheckInOut;
use App\Models\Item;
use App\Models\PointOfSales;
use App\Models\PromoFree;
use App\Models\PromoItem;
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
            $customer                             = CheckInOut::getTodayCustomer($outlet_id);
            return view('pos.transaction.cash-register.index', compact('bank_name_list', 'items', 'cashier', 'customer'));
        }
    }

    public function store(Request $request, $customer_detail_id)
    {
        $outlet_id              = Auth::user()->outlet_id;
        if(count(PointOfSales::all()) == 0){
            $pos_id             = 1;
        } else {
            $pos_lastID         = PointOfSales::getPOSLastID();
            $pos_id             = $pos_lastID[0]->point_of_sales_id+1;
        }
        $pos_date               = date('Y-m-d H:i:s');
        $pos_total_dpp          = $request->total_dpp;
        $pos_totalDiscount      = $request->total_discount;
        $pos_ccCharge           = $request->cc_charge;
        $pos_ppn                = $request->ppn;
        $pos_paymentMethod1     = $request->payment_method1;
        $pos_paid1              = $request->paid1;
        if($request->payment_method2 !== null){
            $pos_paymentMethod2 = $request->payment_method2;
            $pos_paid2          = $request->paid2;
        } else {
            $pos_paymentMethod2 = 0;
            $pos_paid2          = 0;
        }
        if($request->card_namber !== null) {
            $pos_cardNo         = $request->card_number;
        } else {
            $pos_cardNo         = 0;
        }
        $pos_change             = $request->change;
        $pos_totalPayment       = $request->total_payment;
        if($request->bank2 !== null) {
            $bank_id           = $request->bank;
        } else {
            $bank_id           = 0;
        }

        // PointOfSales::setInsertPOS($pos_id, $pos_date, $pos_total_dpp, $pos_totalDiscount, $pos_ccCharge, $pos_ppn, $pos_paymentMethod1, $pos_paymentMethod2, $pos_cardNo, $pos_paid1, $pos_paid2, $pos_change, $pos_totalPayment, $bank_id, $customer_detail_id, $outlet_id);

        foreach($request->item as $index => $item) {
            dump($item. ' ' . $request->item_quantity[$index] . ' ' . $request->item_discount[$index]. ' ' . $request->item_add_discount[$index]);
        } die;

        return back()->with('paid');

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

    public function getTodaysPromo()
    {
        $outlet_id       = Auth::user()->outlet_id;
        $promos          = PromoItem::getTodaysPromo($outlet_id);

        return response()->json($promos);
    }

    public function getCustomerVisitByItemID($customer_detail_id, $item_id)
    {
        $outlet_id      = Auth::user()->outlet_id;
        $visit          = count(CheckInOut::countVisitByItemID($customer_detail_id, $item_id, $outlet_id));

        return response()->json($visit);
    }

    public function getPromoFree($promo_id, $customer_detail_id)
    {
        $promo_free     = PromoFree::getPromoFreeByCustomerAndPromoID($promo_id, $customer_detail_id);

        return response()->json($promo_free);
    }
}
