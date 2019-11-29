<?php

namespace App\Http\Controllers\POS\Master;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    //
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $cashier        = Cashier::getCashierByOutletID($outlet_id);
        return view('pos.master.cashier.index', compact('cashier'));
    }
}
