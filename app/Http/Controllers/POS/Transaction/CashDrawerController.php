<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\CheckInOut;
use App\Models\Item;
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
        return view('pos.transaction.cash-drawer.index', compact('bank_name_list', 'items', 'customer'));
    }
}
