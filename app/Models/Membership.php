<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Membership extends Model
{
    //
    protected $table    = 'tbl_membership';

    public static function getAllMembership($outlet_id)
    {
        $membership     = DB::select('call SP_CS_Three_Membership_Select(?)', [$outlet_id]);
        return $membership;
    }
}
