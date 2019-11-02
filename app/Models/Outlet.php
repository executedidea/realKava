<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Outlet extends Model
{
    //
    protected $table    = 'tbl_outlet';

    public static function getUserOutlet($id)
    {
        $outlet     = DB::select('call SP_Outlet_SELECT(?)', [$id]);

        return $outlet;
    }
}
