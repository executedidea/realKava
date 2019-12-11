<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComplaintType extends Model
{
    protected $table        = 'tbl_complaint_type';


    public static function getComplaintTypeLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['complaint_type_id']);
        return $last_id;
    }

    public static function getComplaintTypeList($outlet_id)
    {
        $complaint_type_list                = DB::select('call SP_CS_ComplaintType_Select(?)', [$outlet_id]);
        return $complaint_type_list;
    }


}
