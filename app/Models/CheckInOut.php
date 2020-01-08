<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckInOut extends Model
{
    //
    protected $table        = 'tbl_check_in';

    public static function getTodayCustomer($outlet_id)
    {
        $customer           = DB::select('call SP_CS_CheckIn_Select(?)', [$outlet_id]);
        return $customer;
    }

    public static function getCheckInLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['check_in_id']);
        return $lastID;
    }

    public static function getCheckedInCustomer($customer_detail_id, $outlet_id)
    {
        $customer           = DB::select('call SP_CS_CheckedIn_Select(?,?)', [$customer_detail_id, $outlet_id]);
        return $customer;
    }

    public static function getCheckedInCustomerByID($outlet_id, $customer_detail_id)
    {
        $customer           = DB::select('call SP_CS_CheckIn_ByID_Select(?,?)', [$outlet_id, $customer_detail_id]);
        return $customer;
    }

    public static function countVisitByItemID($customer_id, $item_id, $outlet_id)
    {
        $visit              = DB::select('call SP_POS_CheckVisit(?,?,?)', [$customer_id, $item_id, $outlet_id]);
        return $visit;
    }

    public static function setInsertCheckIn($check_in_id, $customer_detail_id, $check_in_time, $outlet_id)
    {
        $insert             = DB::select('call SP_CS_CheckIn_Insert(?,?,?,?)', [$check_in_id, $customer_detail_id, $check_in_time, $outlet_id]);
        return $insert;
    }

    public static function setUpdateCheckIn($check_in_id, $check_out_time)
    {
        $update             = DB::select('call SP_CS_CheckIn_Update(?)', [$check_in_id, $check_out_time]);
        return $update;
    }

}
