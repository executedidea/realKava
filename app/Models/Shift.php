<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shift extends Model
{
    //
    protected $table    = 'tbl_cashier';

    public static function getCashierByOutlet($outlet_id)
    {
        $cashier_list       = DB::select('call SP_POS_CashierList_Select(?)', [$outlet_id]);
        return $cashier_list;
    }

    public static function getShiftCodeByOutlet($outlet_id)
    {
        $shift_code         = DB::select('call SP_ShiftCode_All_Select(?)', [$outlet_id]);
        return $shift_code;
    }

    public static function getCashierByID($user_id)
    {
        $cashier            = DB::select('call SP_POS_CashierList_ByID_Select(?)', [$user_id]);
        return $cashier;
    }

}
