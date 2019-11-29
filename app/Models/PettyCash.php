<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PettyCash extends Model
{
    //
    protected $table        = 'tbl_petty_cash';

    public static function getPettyCash($outlet_id)
    {
        $petty_cash         = DB::select('call SP_POS_PettyCash_Select(?)', [$outlet_id]);
        return $petty_cash;
    }
}
