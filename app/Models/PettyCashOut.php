<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PettyCashOut extends Model
{
    //
    protected $table        = 'tbl_petty_cash_detail';

    // public static function setPettyCashDetail($petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc)
    // {
    //     $set_petty_cash_detail                = DB::select('call SP_POS_PettyCashDetail_Insert(?,?,?,?,?)', [$petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc]);
    //     return $set_petty_cash_detail;
    // }

    public static function getPettyCashDetailLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['petty_cash_detail_id']);
        return $last_id;
    }

    public static function getPettyCashDetailList()
    {
        $petty_cash_detail_list                 = DB::select('call SP_POS_PettyCashDetail_Select');
        return $petty_cash_detail_list;
    }

    public static function getPettyCashRemainingBalanceByOutlet($outlet_id)
    {
        $petty_cash_remaining_balance                 = DB::select('call SP_PettyCash_RemainingBalance_Select(?)', [$outlet_id]);
        return $petty_cash_remaining_balance;
    }

    public static function getPettyCashBalanceByOutlet($outlet_id)
    {
        $petty_cash_balance                 = DB::select('call SP_PettyCash_Balance_Select(?)', [$outlet_id]);
        return $petty_cash_balance;
    }

    public static function setPettyCashOut($petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc, $petty_cash_id, $bank_out_id, $outlet_id, $petty_cash_detail_paymentMethod)
    {
        $set_petty_cash_out                = DB::select('call SP_PettyCashOut_Insert(?,?,?,?,?,?,?,?,?)', [$petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc, $petty_cash_id, $bank_out_id, $outlet_id, $petty_cash_detail_paymentMethod]);
        return $set_petty_cash_out;
    }

    public static function getPettyCashIDByLastDate($outlet_id)
    {
        $petty_cash_id                 = DB::select('call SP_PettyCashID_ByLastDate_Select(?)', [$outlet_id]);
        return $petty_cash_id;
    }

    public static function getPettyCashDetailBalancedList($outlet_id)
    {
        $petty_cash_detail_balance_list                 = DB::select('call SP_PettyCashDetail_BalancedList_Select(?)', [$outlet_id]);
        return $petty_cash_detail_balance_list;
    }

    public static function getPettyCashAmountByFlag($outlet_id)
    {
        $petty_cash_amount_byflag                 = DB::select('call SP_PettyCashAmount_ByFlag_Select(?)', [$outlet_id]);
        return $petty_cash_amount_byflag;
    }


    

    
}
