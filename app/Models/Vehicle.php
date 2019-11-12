<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table    = 'tbl_vehicle';

    public static function getVehicleIDByModel($model_id)
    {
        $id             = Vehicle::where('vehicle_model_id', $model_id)->value('vehicle_id');
        return $id;
    }

}
