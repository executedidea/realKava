<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer_Detail extends Model
{
    protected $table    = 'tbl_customer_detail';
    //
    public static function getCustomerDetailLastID()
    {
        $lastID         = DB::select('call SP_GetLastID_Select(?)',['customer_detail_id']);
        return $lastID;
    }
}
