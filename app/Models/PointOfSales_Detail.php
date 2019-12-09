<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointOfSales_Detail extends Model
{
    //
    protected $table        = 'tbl_point_of_sales_detail';

    public static function getPOSDetailLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['point_of_sales_detail_id']);
        return $lastID;
    }

    public static function setInsertPOSDetail($pos_detail_id, $pos_id, $item_id, $pos_quantity, $pos_discount_percent, $pos_addDiscount_percent)
    {
        $insert             = DB::select('call SP_POS_CashRegister_Detail_Insert(?,?,?,?,?,?)', [$pos_detail_id, $pos_id, $item_id, $pos_quantity, $pos_discount_percent, $pos_addDiscount_percent]);

        return $insert;
    }
}
