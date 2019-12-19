<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChangeShift extends Model
{
    //
    protected $table        = 'tbl_change_shift';

    public static function getPettyCash($outlet_id)
    {
        $petty_cash         = DB::select('call SP_POS_PettyCash_Select(?)', [$outlet_id]);
        return $petty_cash;
    }

    public static function getChangeShiftByUser($outlet_id, $user_id)
    {
        $change_shift_byuser         = DB::select('call SP_ChangeShift_ByUser_Select(?,?)', [$outlet_id, $user_id]);
        return $change_shift_byuser;
    }
}
