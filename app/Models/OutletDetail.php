<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OutletDetail extends Model
{
    //
    protected $table    = 'tbl_outlet_detail';

    public static function getOutletLastID()
    {
        $outlet_detail_lastID  = DB::select('call SP_GetLastID_Select(?)', ['outlet_detail_id']);

        return $outlet_detail_lastID;
    }
}
