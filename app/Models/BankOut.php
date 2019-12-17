<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankOut extends Model
{
    //
    protected $table        = 'tbl_bank_out';

    public static function getBankListByOutlet($outlet_id)
    {
        $bank_list         = DB::select('call SP_POS_BankList_ByOutletID_Select(?)', [$outlet_id]);
        return $bank_list;
    }

    public static function getBankOutLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['bank_out_id']);
        return $last_id;
    }

    public static function getBankAccountNumberByBankID($bank_id, $outlet_id)
    {
        $bank_account_number          = DB::select('call SP_POS_BankAccountNumber_ByBankID_Select(?,?)', [$bank_id, $outlet_id]);
        return $bank_account_number;
    }

    public static function getBankAccountBeginingBalanceByBankAccountID($bank_account_id, $outlet_id)
    {
        $bank_account_beginingBalance          = DB::select('call SP_POS_BankAccountBeginingBalance_ByBankAccountID_Select(?,?)', [$bank_account_id, $outlet_id]);
        return $bank_account_beginingBalance;
    }

    public static function setBankOut($bank_out_id, $bank_out_date, $bank_out_amount, $bank_out_type, $bank_out_desc, $bank_account_id, $outlet_id)
    {
        $set_bank_out                = DB::select('call SP_BankOut_Insert(?,?,?,?,?,?,?)', [$bank_out_id, $bank_out_date, $bank_out_amount, $bank_out_type, $bank_out_desc, $bank_account_id, $outlet_id]);
        return $set_bank_out;
    }
}
