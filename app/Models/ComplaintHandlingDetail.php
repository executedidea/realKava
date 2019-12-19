<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComplaintHandlingDetail extends Model
{
    //
    protected $table    = 'tbl_complaint_handling_detail';

    public static function getComplaintHandlingDetailLastID()
    {
        $lastID         = DB::select('call SP_GetLastID_Select(?)', ['complaint_handling_detail_id']);
        return $lastID;
    }

    public static function setInsertComplaintHandlingDetail($complaint_handling_detail_id, $complaint_handling_detail_date, $complaint_handling_detail_status, $complaint_handling_detail_handler, $complaint_handling_detail_note, $complaint_handling_id)
    {
        $insert         = DB::select('call SP_POS_ComplaintDetail_Insert(?,?,?,?,?,?)', [$complaint_handling_detail_id, $complaint_handling_detail_date, $complaint_handling_detail_status, $complaint_handling_detail_handler, $complaint_handling_detail_note, $complaint_handling_id]);
        return $insert;
    }
}
