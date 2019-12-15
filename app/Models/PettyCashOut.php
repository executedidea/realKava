<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PettyCashOut extends Model
{
    //
    protected $table        = 'tbl_petty_cash_detail';

    public static function setPettyCashDetail($petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc)
    {
        $set_petty_cash_detail                = DB::select('call SP_POS_PettyCashDetail_Insert(?,?,?,?,?)', [$petty_cash_detail_id, $petty_cash_detail_date, $petty_cash_detail_category, $petty_cash_detail_amount, $petty_cash_detail_desc]);
        return $set_petty_cash_detail;
    }

    public static function getPettyCashDetailLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['petty_cash_detail_id']);
        return $last_id;
    }

    public static function getPettyCashDetailList()
    {
        $petty_cash_detail_list                 = DB::select('call SP_POS_PettyCashDetail_Select');
        return $petty_cash_detail_list;
    }
}
