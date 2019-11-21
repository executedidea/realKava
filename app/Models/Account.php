<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    //
    protected $table    = 'tbl_users';

    public static function getUserByOutletID($outlet_id)
    {
        $accounts       = DB::select('call SP_Account_Select_ByOutletID(?)', [$outlet_id]);
        return $accounts;
    }
}
