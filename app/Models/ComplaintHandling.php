<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComplaintHandling extends Model
{
    protected $table        = 'tbl_complaint_handling';

    public static function getFeedbackCategoryLastID()
    {
        $category_last_id                = DB::select('call SP_GetLastID_Select(?)', ['feedback_category_id']);
        return $category_last_id;
    }

    public static function getComplaintHandlingList($outlet_id)
    {
        $complaint_handling           = DB::select('call SP_CS_ComplaintHandling_Select(?)', [$outlet_id]);
        return $complaint_handling;
    }

    public static function getCustomerLicenseList($outlet_id)
    {
        $license_plate    = DB::select('call SP_CustomerLicenseList_ByOutletID_Select(?)', [$outlet_id]);
        return $license_plate;
    }

    public static function getCustomerVehicleLicenseByLicense($customer_detail_licensePlate, $outlet_id)
    {
        $license_plate    = DB::select('call SP_CustomerVehicleLicense_ByLicensePlate_Select(?,?)', [$customer_detail_licensePlate, $outlet_id]);
        return $license_plate;
    }

}
