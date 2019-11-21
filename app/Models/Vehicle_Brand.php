<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Vehicle_Brand extends Model
{
    //
    protected $table    = 'tbl_vehicle_brand';

    public static function getBrandByCategory($vehicle_category_id)
    {
        $brand          = DB::select('call SP_CS_One_VehicleBrandList_Select(?)', [$vehicle_category_id]);
        return $brand;
    }

    public static function getVehicleBrandLastID()
    {
        $brand          = DB::select('call SP_GetLastID_Select(?)', ['vehicle_brand_id']);
        return $brand;
    }
}
