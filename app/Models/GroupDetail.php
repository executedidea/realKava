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
        $group_detail_lastID    = DB::select('call SP_GetLastID_Select(?)', ['group_detail_id']);
        return $group_detail_lastID;
    }

    public static function getGroupDetailByID($group_id)
    {
        $group_detail           = DB::select('call SP_GroupDetail_Select_ByID(?)', [$group_id]);
        return $group_detail;
    }

    public static function getGroupDetailRights($group_id, $modul_id)
    {
        $rights                 = DB::select('call SP_UserManagement_Select_TEST1(?,?)', [$group_id, $modul_id]);
        return $rights;
    }

    public static function insertGroupDetail($group_detail_id, $right_code, $menu_detail_id, $group_id)
    {
        $insert                 = DB::select('call SP_UserManagement_Insert(?,?,?,?)', [$group_detail_id, $right_code, $menu_detail_id, $group_id]);
        return $insert;
    }

    public static function updateGroupDetail($right_code, $menu_detail_id, $group_id, $group_name)
    {
        $update                 = DB::select('call SP_UserManagement_Update(?,?,?,?)', [$right_code, $menu_detail_id, $group_id, $group_name]);
        return $update;
    }
}
