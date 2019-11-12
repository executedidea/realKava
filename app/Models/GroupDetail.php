<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupDetail extends Model
{
    //
    protected $table = 'tbl_group_detail';

    public static function getGroupDetailLastID()
    {   
        $group_detail_lastID        = DB::select('call SP_GetLastID_Select(?)', ['group_detail_id']);
        return $group_detail_lastID;
    }

    public static function insertGroupDetail($group_detail_id, $right_code, $menu_detail_id, $group_id)
    {
        $inserGroup                 = DB::select('call SP_UserManagement_Insert(?,?,?,?)', [$group_detail_id, $right_code , $menu_detail_id, $group_id]);
        return $inserGroup;
    }
}
