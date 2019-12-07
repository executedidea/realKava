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

    public static function getLicensePlate($customer_detail_licensePlate)
    {
        $licensePlate    = DB::select('call SP_CustomerVehicleLicense_ByLicensePlate_Select(?)', [$customer_detail_licensePlate]);
        return $licensePlate;
    }

    public static function setFeedback($feedback_category_id, $feedback_category_name, $feedback_type_id, $feedback_type_name)
    {
        $set_feedback                = DB::select('call SP_CS_Five_FeedbackList_Insert(?,?,?,?)', [$feedback_category_id, $feedback_category_name, $feedback_type_id, $feedback_type_name]);
        return $set_feedback;
    }

    public static function setUpdateFeedback($feedback_category_id, $feedback_category_name, $feedback_type_name)
    {
        $set_update_feedback                = DB::select('call SP_CS_Five_FeedbackList_Update(?,?,?)', [$feedback_category_id, $feedback_category_name, $feedback_type_name]);
        return $set_update_feedback;
    }
    
    public static function getFeedbackByID($feedback_category_id)
    {
        $feedback       = DB::select('call SP_CS_FeedbackList_ByID_Select(?)', [$feedback_category_id]);
        return $feedback;
    }

    public static function setDeleteFeedback($feedback_category_id)
    {
        $delete                = DB::select('call SP_CS_Five_FeedbackList_Delete(?)', [$feedback_category_id]);
        return $delete;
    }
}
