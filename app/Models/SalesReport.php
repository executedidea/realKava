<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalesReport extends Model
{
    //
    protected $table        = 'tbl_outlet';

    public static function getCarwashData($outlet_detail_id)
    {
        $carwash            = DB::select('call SP_SalesReport_HeaderPDF_Select(?)', [$outlet_detail_id]);
        return $carwash;
    }

    public static function getReportData($outlet_id, $period_StartDate, $period_EndDate, $vehicle_category)
    {
        $report            = DB::select('call SP_SalesReport_PDF_Select(?,?,?,?)', [$outlet_id, $period_StartDate, $period_EndDate, $vehicle_category]);
        return $report;
    }

    public static function getOutletAll($outlet_id)
    {
        $outlet_all            = DB::select('call SP_Outlet_All_Select(?)', [$outlet_id]);
        return $outlet_all;
    }

    public static function getVehicleCategory()
    {
        $vehicle_category_all            = DB::select('call 	SP_CS_One_VehicleCategoryList_Select');
        return $vehicle_category_all;
    }

}
