<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointOfSales extends Model
{
    //
    protected $table        = 'tbl_point_of_sales';

    public static function getPOSLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['point_of_sales_id']);
        return $lastID;
    }

    public static function setInsertPOS($pos_id, $pos_date, $pos_total_dpp, $pos_totalDiscount, $pos_ccCharge, $pos_ppn, $pos_paymentMethod1, $pos_paymentMethod2, $pos_cardNo, $pos_paid1, $pos_paid2, $pos_change, $pos_totalPayment, $bank_id, $customer_detail_id, $outlet_id)
    {
        $insert             = DB::select('call SP_POS_CashRegister_Insert(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$pos_id, $pos_date, $pos_total_dpp, $pos_totalDiscount, $pos_ccCharge, $pos_ppn, $pos_paymentMethod1, $pos_paymentMethod2, $pos_cardNo, $pos_paid1, $pos_paid2, $pos_change, $pos_totalPayment, $bank_id, $customer_detail_id, $outlet_id]);

        return $insert;
    }
}
