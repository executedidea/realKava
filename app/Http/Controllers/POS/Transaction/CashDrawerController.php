<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\CheckInOut;
use App\Models\Item;
use App\Models\PointOfSales;
use App\Models\PointOfSales_Detail;
use App\Models\PromoItem;
use App\Models\SettingPOS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashDrawerController extends Controller
{
    //
    public function index()
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $bank_name_list                       = CashRegister::getBankNameList();
        $items                                = Item::getAllItem($outlet_id);
        $customer                             = CheckInOut::getTodayCustomer($outlet_id);
        $setting                              = SettingPOS::getSettingByOutletID($outlet_id);
        $promos                               = PromoItem::getTodaysPromo($outlet_id);
        return view('pos.transaction.cash-drawer.index', compact('bank_name_list', 'items', 'customer', 'setting', 'promos'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        if ($request->has('check_in_id')) {
            $check_in_id = $request->check_in_id;
        } else {
            $check_in_id = 0;
        }
        if ($request->has('customer_detail_id')) {
            $customer_detail_id = $request->customer_detail_id;
        } else {
            $customer_detail_id = 0;
        }
        $outlet_id              = Auth::user()->outlet_id;
        if (count(PointOfSales::all()) == 0) {
            $pos_id             = 1;
        } else {
            $pos_lastID         = PointOfSales::getPOSLastID();
            $pos_id             = $pos_lastID[0]->point_of_sales_id + 1;
        }
        if (count(PointOfSales_Detail::all()) == 0) {
            $pos_detail_id             = 1;
        } else {
            $pos_detail_lastID         = PointOfSales_Detail::getPOSDetailLastID();
            $pos_detail_id             = $pos_detail_lastID[0]->point_of_sales_detail_id + 1;
        }
        $pos_date               = date('Y-m-d H:i:s');
        $pos_total_dpp          = $request->total_dpp;
        $pos_totalDiscount      = $request->total_discount;
        $pos_ccCharge           = $request->total_cc_charge;
        $pos_ppn                = $request->total_ppn;
        $pos_paymentMethod1     = 1;
        $pos_paid1              = $request->paid;
        if ($request->has('payment_method2')) {
            $pos_paymentMethod2 = $request->payment_method2;
            $pos_paid2          = $request->paid2;
        } else {
            $pos_paymentMethod2 = 0;
            $pos_paid2          = 0;
        }
        if ($request->has('card_number')) {
            $pos_cardNo         = $request->card_number;
        } else {
            $pos_cardNo         = 0;
        }
        $pos_change             = $request->change;
        $pos_totalPayment       = $request->total_price;
        if ($request->has('bank')) {
            $bank_id           = $request->bank;
        } else {
            $bank_id           = 0;
        }
        PointOfSales::setInsertPOS($pos_id, $pos_date, $pos_total_dpp, $pos_totalDiscount, $pos_ccCharge, $pos_ppn, $pos_paymentMethod1, $pos_paymentMethod2, $pos_cardNo, $pos_paid1, $pos_paid2, $pos_change, $pos_totalPayment, $bank_id, $customer_detail_id, $outlet_id);

        foreach ($request->item_id as $index => $item) {
            PointOfSales_Detail::setInsertPOSDetail($pos_detail_id, $pos_id, $item, $request->item_quantity[$index], $request->item_discount[$index], $request->item_additional_discount[$index]);
        }
        CheckInOut::setUpdateCheckInPaid($check_in_id);

        return back()->with('paid');
    }
}
