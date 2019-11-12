<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle_Category extends Model
{
    //
    protected $table    = 'tbl_vehicle_category';

    public static function getAllCategory()
    {
        $category       = DB::select('call SP_CS_One_VehicleCategoryList_Select');
        return $category;
    }

}
