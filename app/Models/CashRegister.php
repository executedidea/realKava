<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CashRegister extends Model
{
    //
    public static function getCustomerDetailLicensePlate($customer_detail_licensePlate)
    {
        $point_of_sales_list    = DB::select('call SP_POS_CashRegister_ByLicensePlate_Select(?)', [$customer_detail_licensePlate]);
        return $point_of_sales_list;
    }
    public static function getSubTotal($customer_detail_licensePlate)
    {
        $point_of_sales_subtotal = DB::select('call SP_POS_CashRegister_NettPrice_Select(?)', [$customer_detail_licensePlate]);
        return $point_of_sales_subtotal;
    }

    public static function getBankNameList()
    {
        $bank_name_list          = DB::select('call SP_POS_BankList_Name_Select');
        return $bank_name_list;
    }

    public static function getPointOfSalesLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['point_of_sales_id']);
        return $last_id;
    }
}
