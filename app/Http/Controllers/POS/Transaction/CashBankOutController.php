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
        $petty_cash_remaining_balance              = PettyCashOut::getPettyCashRemainingBalanceByOutlet($outlet_id);    
        $petty_cash_balance                        = PettyCashOut::getPettyCashBalanceByOutlet($outlet_id);
        $petty_cash_detail_balance_list            = PettyCashOut::getPettyCashDetailBalancedList($outlet_id);    
        
        return view('pos.transaction.cash-bank-out.index', compact('bank_list', 'petty_cash_remaining_balance', 'petty_cash_balance', 'petty_cash_detail_balance_list'));
    }

    public function store(Request $request)
    {
        if ($request->payment_source == 'b') {
            if (count(PettyCashOut::all()) <= 0) {
                $petty_cash_detail_id               = 1;
            } else {
                $petty_cash_detail_lastID           = PettyCashOut::getPettyCashDetailLastID();
                $petty_cash_detail_id               = $petty_cash_detail_lastID[0]->petty_cash_detail_id + 1;
            }

            if (count(BankOut::all()) <= 0) {
                $bank_out_id               = 1;
            } else {
                $bank_out_lastID           = BankOut::getBankOutLastID();
                $bank_out_id               = $bank_out_lastID[0]->bank_out_id + 1;
            }
            
            $bank_out_date                 = $request->cash_bank_date;
            $bank_out_amount               = $request->cash_bank_amount;
            // $bank_out_type                 = $request->bank_out_type;
            $bank_out_desc                 = $request->cash_bank_desc;
            $bank_account_id               = $request->bank_account_number;
            $outlet_id                     = Auth::user()->outlet_id;

            $petty_cash_detail_date        = $request->cash_bank_date;
            $petty_cash_detail_category    = $request->petty_cash_detail_category;
            $petty_cash_detail_amount      = $request->cash_bank_amount;
            $petty_cash_detail_desc        = $request->cash_bank_desc;
            $petty_cash_id                 = NULL;

            // dd($bank_out_type);

            

            BankOut::setBankOut(
                $bank_out_id, 
                $bank_out_date, 
                $bank_out_amount, 
                // $bank_out_type, 
                $bank_out_desc, 
                $bank_account_id, 
                $outlet_id
            );

            PettyCashOut::setPettyCashOut(
                $petty_cash_detail_id,
                $petty_cash_detail_date,
                $petty_cash_detail_category,
                $petty_cash_detail_amount,
                $petty_cash_detail_desc,
                $petty_cash_id,
                $bank_out_id,
                $outlet_id
            );
            
        } elseif ($request->payment_source == 'pc') {

            if (count(PettyCashOut::all()) <= 0) {
                $petty_cash_detail_id               = 1;
            } else {
                $petty_cash_detail_lastID           = PettyCashOut::getPettyCashDetailLastID();
                $petty_cash_detail_id               = $petty_cash_detail_lastID[0]->petty_cash_detail_id + 1;
            }
            
            $petty_cash_detail_date                 = $request->cash_bank_date;
            $petty_cash_detail_category             = $request->petty_cash_detail_category;
            $petty_cash_detail_amount               = $request->cash_bank_amount;
            $petty_cash_detail_desc                 = $request->cash_bank_desc;
            $outlet_id                              = Auth::user()->outlet_id;
            $petty_cash_id_array                    = PettyCashOut::getPettyCashIDByLastDate($outlet_id);
            $petty_cash_id                          = $petty_cash_id_array[0]->petty_cash_id;
            $bank_out_id                            = NULL;

            
            PettyCashOut::setPettyCashOut(
                $petty_cash_detail_id,
                $petty_cash_detail_date,
                $petty_cash_detail_category,
                $petty_cash_detail_amount,
                $petty_cash_detail_desc,
                $petty_cash_id,
                $bank_out_id,
                $outlet_id
            );
        }
        

        return back()->with('cashBankOutAdded');
    }

    public function getBankAccountNumberByBankID(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $bank_id                              = $request->bank_id;
        $bank_account_number                  = BankOut::getBankAccountNumberByBankID($bank_id, $outlet_id);
        return response()->json($bank_account_number);
    }

    public function getBankAccountBeginingBalanceByBankAccountID(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $bank_account_id                      = $request->bank_account_id;
        $bank_account_beginingBalance         = BankOut::getBankAccountBeginingBalanceByBankAccountID($bank_account_id, $outlet_id);
        return response()->json($bank_account_beginingBalance);
    }

    public function getPettyCashRemainingBalanceByOutlet(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $petty_cash_remaining_balance         = PettyCashOut::getPettyCashRemainingBalanceByOutlet($outlet_id);
        // return response()->json($petty_cash_remaining_balance);
        return response()->json([
            'status'    => true,
            'petty_cash_remaining_balance'  => $petty_cash_remaining_balance
        ]);
    }

    public function getPettyCashIDByLastDate(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $petty_cash_last_date                 = PettyCashOut::getPettyCashIDByLastDate($outlet_id);
        // return response()->json($petty_cash_remaining_balance);
        return response()->json([
            'status'    => true,
            'petty_cash_last_date'  => $petty_cash_last_date
        ]);
    }

    public function getPettyCashDetailBalancedList(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $petty_cash_detail_balance_list                 = PettyCashOut::getPettyCashDetailBalancedList($outlet_id);
        // return response()->json($petty_cash_remaining_balance);
        return response()->json([
            'status'    => true,
            'petty_cash_detail_balance_list'  => $petty_cash_detail_balance_list
        ]);
    }

    public function getPettyCashAmountByFlag(Request $request)
    {
        $outlet_id                            = Auth::user()->outlet_id;
        $petty_cash_amount_byflag             = PettyCashOut::getPettyCashAmountByFlag($outlet_id);
        // return response()->json($petty_cash_remaining_balance);
        return response()->json([
            'status'    => true,
            'petty_cash_amount_byflag'  => $petty_cash_amount_byflag
        ]);
    }
}
