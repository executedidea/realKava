<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceReport extends Model
{
    //
    protected $table        = 'tbl_outlet';

    public static function getCarwashData($outlet_detail_id)
    {
        $carwash            = DB::select('call SP_PDF_OutletHeader_Select(?)', [$outlet_detail_id]);
        return $carwash;
    }

    public static function getReportData($outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $customer_detail, $customer)
    {
        $report            = DB::select('call SP_PDF_ServiceReport_Select(?,?,?,?,?,?,?,?)', [$outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $customer_detail, $customer]);
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

    public static function getCustomerAll($outlet_id)
    {
        $customer_all            = DB::select('call SP_CS_One_CustomerList_Select(?)', [$outlet_id]);
        return $customer_all;
    }

    public static function getCustomerAndLicense($outlet_id)
    {
        $customer           = DB::select('call SP_CustomerLicenseList_ByOutletID_Select(?)', [$outlet_id]);
        return $customer;
    }

}
