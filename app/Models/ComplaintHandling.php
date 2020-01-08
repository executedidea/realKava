<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComplaintHandling extends Model
{
    protected $table        = 'tbl_complaint_handling';

    public static function getComplaintHandlingList($outlet_id)
    {
        $complaint_handling           = DB::select('call SP_CS_ComplaintHandling_Select_Test(?)', [$outlet_id]);
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

    public static function getComplaintCustomerByID($outlet_id, $complaint_handling_id)
    {
        $complaint_customer    = DB::select('call SP_CS_ComplaintHandling_ByID_Select(?,?)', [$outlet_id, $complaint_handling_id]);
        return $complaint_customer;
    }

    public static function getComplaintHandlingLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['complaint_handling_id']);
        return $last_id;
    }

    public static function getComplaintHandlingDetailLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['complaint_handling_detail_id']);
        return $last_id;
    }

    public static function setComplaintHandling($complaint_handling_id, $complaint_handling_date, $complaint_handling_targetDate, $complaint_handling_handler, $complaint_handling_status, $complaint_handling_desc, $complaint_handling_fee, $customer_detail_id, $complaint_type_id, $item_id, $outlet_id)
    {
        $set_complaint_handling                = DB::select('call SP_CS_ComplaintHandling_Insert(?,?,?,?,?,?,?,?,?,?,?)', [
            $complaint_handling_id, 
            $complaint_handling_date,
            $complaint_handling_targetDate,
            $complaint_handling_handler,
            $complaint_handling_status,
            $complaint_handling_desc,
            $complaint_handling_fee,
            $customer_detail_id,
            $complaint_type_id,
            $item_id,
            $outlet_id
        ]);
        return $set_complaint_handling;
    }
    
    public static function setDeleteComplaintHandling($complaint_handling_id)
    {
        $delete                = DB::select('call SP_CS_ComplaintHandling_Delete(?)', [$complaint_handling_id]);
        return $delete;
    }

    public static function setUpdateComplaintHandlingDetailStatus($complaint_handling_detail_id, $complaint_handling_detail_status, $complaint_handling_detail_desc, $complaint_handling_status, $complaint_handling_desc, $complaint_handling_id)
    {
        $set_update_complaint_handling_detail_status                = DB::select('call SP_ComplaintHandling_FollowUp(?,?,?,?,?,?)', [$complaint_handling_detail_id, $complaint_handling_detail_status, $complaint_handling_detail_desc, $complaint_handling_status, $complaint_handling_desc, $complaint_handling_id]);
        return $set_update_complaint_handling_detail_status;
    }

}
