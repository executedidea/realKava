<?php

namespace App\Http\Controllers\POS\Master;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CashAccountController extends Controller
{
    //
    public function index()
    {
        $outlet_id          = Auth::user()->outlet_id;
        $bank_account       = BankAccount::getBankAccount($outlet_id);
        $petty_cash         = PettyCash::getPettyCash($outlet_id);
        $bank               = Bank::getAllBank();
        return view('pos.master.cash-account.index', compact('bank_account', 'petty_cash', 'bank'));
    }

    public function storeBankAccount(Request $request)
    {
        $validator          = Validator::make($request->all(), [
            'bank'              => 'required',
            'account_number'    => 'required',
            'branch'            => 'required',
            'opening_date'      => 'required',
            'opening_balance'   => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with($validator);
        } else {
            if (count(BankAccount::all()) <= 0) {
                $account_id     = 1;
            } else {
                $account_lastID = BankAccount::getBankAccountLastID();
                $account_id     = $account_lastID[0]->bank_account_id + 1;
            }
            $outlet_id          = Auth::user()->outlet_id;
            $bank_id            = $request->bank;
            $account_number     = $request->account_number;
            $branch             = $request->branch;
            $opening_date       = $request->opening_date;
            $opening_balance    = $request->opening_balance;

            BankAccount::insertBankAccount($account_id, $account_number, $branch, $opening_date, $opening_balance, $bank_id, $outlet_id);

            return back()->with('bankAccountStored');
        }
    }
}
