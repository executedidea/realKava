<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankAccount extends Model
{
    //
    protected $table        = 'tbl_bank_account';

    public static function getBankAccount($outlet_id)
    {
        $bank_account       = DB::select('call SP_POS_One_BankList_Select(?)', [$outlet_id]);
        return $bank_account;
    }

    public static function getBankAccountLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['bank_account_id']);
        return $lastID;
    }

    public static function insertBankAccount($bank_account_id, $bank_account_number, $bank_account_branch, $bank_account_openingDate, $bank_account_openingBalance, $bank_id, $outlet_id)
    {
        $insert              = DB::select('call SP_POS_One_BankList_Insert(?,?,?,?,?,?,?)', [$bank_account_id, $bank_account_number, $bank_account_branch, $bank_account_openingDate, $bank_account_openingBalance, $bank_id, $outlet_id]);

        return $insert;
    }
}
