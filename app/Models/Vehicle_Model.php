<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle_Model extends Model
{
    //
    protected $table    = 'tbl_vehicle_model';

    public static function getModelByBrand($vehicle_brand_id)
    {
        $model                  = DB::select('call SP_CS_One_VehicleModelList_Select(?)', [$vehicle_brand_id]);
        return $model;
    }

    public static function getVehicleModelLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['vehicle_model_id']);
        return $last_id;
    }
}
