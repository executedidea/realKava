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

    public static function setInsertCheckIn($check_in_id, $ucstomer_detail_id, $check_in_time, $outlet_id)
    {
        $insert             = DB::select('call SP_CS_CheckIn_Insert(?,?,?,?)', [$check_in_id, $ucstomer_detail_id, $check_in_time, $outlet_id]);
        return $insert;
    }

}
