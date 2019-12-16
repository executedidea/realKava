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

    public static function getBankAccountNumberByBankID($bank_id, $outlet_id)
    {
        $bank_account_number          = DB::select('call SP_POS_BankAccountNumber_ByBankID_Select(?,?)', [$bank_id, $outlet_id]);
        return $bank_account_number;
    }
}
