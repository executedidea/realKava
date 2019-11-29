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

}
