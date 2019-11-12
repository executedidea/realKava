<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle_Size extends Model
{
    //
    protected $table    = 'tbl_vehicle_size';

    public static function getAllSize()
    {
        $size           = DB::select('call SP_CS_One_VehicleSizeList_Select');
        return $size;
    }
}
