<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\BankOut;
use App\Models\PettyCashOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBankOutController extends Controller
{
    //
    public function index()
    {
        $outlet_id                                 = Auth::user()->outlet_id;
        $bank_list                                 = BankOut::getBankListByOutlet($outlet_id);    
        
        return view('pos.transaction.cash-bank-out.index', compact('bank_list'));
    }

    public function store(Request $request)
    {
        if (count(PettyCashOut::all()) <= 0) {
            $petty_cash_detail_id               = 1;
        } else {
            $petty_cash_detail_lastID           = PettyCashOut::getPettyCashDetailLastID();
            $petty_cash_detail_id               = $petty_cash_detail_lastID[0]->petty_cash_detail_id + 1;
        }
        
        $petty_cash_detail_date                 = $request->petty_cash_detail_date;
        $petty_cash_detail_category             = $request->petty_cash_detail_category;
        $petty_cash_detail_amount               = $request->petty_cash_detail_amount;
        // $petty_cash_detail_balanced             = $request->petty_cash_detail_balanced;
        $petty_cash_detail_desc                 = $request->petty_cash_detail_desc;
        // $petty_cash_id                          = $request->petty_cash_id;
        
        PettyCashOut::setPettyCashDetail(
            $petty_cash_detail_id,
            $petty_cash_detail_date,
            $petty_cash_detail_category,
            $petty_cash_detail_amount, 
            // $petty_cash_detail_balanced, 
            $petty_cash_detail_desc, 
            // $petty_cash_id
        );

        return back()->with('pettyCashDetailAdded');
    }

    public function getBankAccountNumberByBankID(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $bank_id                              = $request->bank_id;
        $bank_account_number                  = BankOut::getBankAccountNumberByBankID($bank_id, $outlet_id);
        return response()->json($bank_account_number);
    }
}
