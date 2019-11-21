<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle extends Model
{
    //
    protected $table            = 'tbl_vehicle';

    public static function getVehicleIDByModel($model_id)
    {
        $id                     = Vehicle::where('vehicle_model_id', $model_id)->value('vehicle_id');
        return $id;
    }

    public static function getVehicleLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['vehicle_id']);
        return $last_id;
    }

    public static function getVehicleByID($vehicle_id)
    {
        $vehicle                = DB::select('call SP_CS_Two_VehicleLibrary_Select_By_ID(?)', [$vehicle_id]);
        return $vehicle;
    }

    public static function getAllVehicle()
    {
        $vehicles               = DB::select('call SP_CS_Two_VehicleLibrary_Select()');
        return $vehicles;
    }

    public static function insertVehicle($category_id, $brand_id, $brand_name, $model_id, $model_name, $vehicle_id, $size_id)
    {
        $insert                 = DB::select('call SP_CS_Two_VehicleLibrary_Insert(?,?,?,?,?,?,?)', [$category_id, $brand_id, $brand_name, $model_id, $model_name, $vehicle_id, $size_id]);
        return $insert;
    }

    public static function updateVehicle($vehicle_brand_id, $vehicle_brand_name, $vehicle_model_id, $vehicle_model_name, $vehicle_category, $vehicle_id, $vehicle_size_id)
    {
        $update                 = DB::select('call SP_CS_Two_VehicleLibrary_Update(?,?,?,?,?,?,?)', [$vehicle_brand_id, $vehicle_brand_name, $vehicle_model_id, $vehicle_model_name, $vehicle_category, $vehicle_id, $vehicle_size_id]);
        return $update;
    }

    public static function deleteVehicle($vehicle_id)
    {
        $delete                = DB::select('call SP_CS_Two_VehicleLibrary_Delete(?)', [$vehicle_id]);
        return $delete;
    }
}
