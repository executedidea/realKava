<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    //
    protected $table        = 'tbl_service';

    public static function getServiceByOutletID($outlet_id)
    {
        $service            = DB::select('call SP_CS_Four_ServiceLibrary_Select(?)', [$outlet_id]);
        return $service;
    }

    public static function getServiceByID($service_id)
    {
        $service            = DB::select('call SP_CS_Four_ServiceLibrary_Select_ID(?)', [$service_id]);
        return $service;
    }

    public static function getServiceLastID()
    {
        $last_id            = DB::select('call SP_GetLastID_Select(?)', ['service_id']);
        return $last_id;
    }

    public static function insertService($service_id, $service_name, $vehicle_category_id, $vehicle_size_id, $service_price, $outlet_id)
    {
        $insert             = DB::select('call SP_CS_Four_ServiceLibrary_Insert(?,?,?,?,?,?)', [$service_id, $service_name, $vehicle_category_id, $vehicle_size_id, $service_price, $outlet_id]);
        return $insert;
    }

    public static function updateService($service_id, $service_name, $vehicle_category_id, $vehicle_size_id, $service_price)
    {
        $update             = DB::select('call SP_CS_Four_ServiceLibrary_Update(?,?,?,?,?)', [$service_id, $service_name, $vehicle_category_id, $vehicle_size_id, $service_price]);
        return $update;
    }

    public static function deleteService($service_id)
    {
        $delete             = DB::select('call SP_CS_Four_ServiceLibrary_Delete(?)', [$service_id]);
        return $delete;
    }
}
