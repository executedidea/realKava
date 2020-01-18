<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentReport extends Model
{
    //
    protected $table        = 'tbl_outlet';

    public static function getCarwashData($outlet_detail_id)
    {
        $carwash            = DB::select('call SP_PDF_OutletHeader_Select(?)', [$outlet_detail_id]);
        return $carwash;
    }

    public static function getReportData($outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $vehicle_category)
    {
        $report            = DB::select('call SP_PDF_SalesReport_Select(?,?,?,?,?,?,?)', [$outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $vehicle_category]);
        return $report;
    }

    // public static function getReportDataNoByCategory($outlet_id, $period_StartDate, $period_EndDate)
    // {
    //     $report_nobycategory            = DB::select('call SP_SalesReport_PDF_NoByCategory_Select(?,?,?)', [$outlet_id, $period_StartDate, $period_EndDate]);
    //     return $report_nobycategory;
    // }

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
