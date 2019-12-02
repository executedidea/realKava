<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cashier extends Model
{
    //
    protected $table        = 'tbl_cashier';

    public static function getCashierByOutletID($outlet_id)
    {
        $cashier            = DB::select('call SP_POS_Three_CashierList_Select(?)', [$outlet_id]);
        return $cashier;
    }

    public static function getCashierByID($cashier_id)
    {
        $cashier                = DB::select('call SP_POS_CashierList_ByID_Select(?)', [$cashier_id]);
        return $cashier;
    }
}
