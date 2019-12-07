<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckInOutDetail extends Model
{
    //
    protected $table    = 'tbl_check_in_detail';

    public static function setInsertCheckInDetail($check_in_detail_id, $check_in_id, $item_id)
    {
        $insert         = DB::select('call SP_CS_CheckIn_Detail_Insert(?,?,?)', [$check_in_detail_id, $check_in_id, $item_id]);
        return $insert;
    }
}
