<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle_Color extends Model
{
    //
    protected $table    = 'tbl_vehicle_color';

    public static function getAllColor()
    {
        $color          = DB::select('call SP_CS_One_VehicleColorList_Select');
        return $color;
    }

}
