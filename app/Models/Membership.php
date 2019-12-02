<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Membership extends Model
{
    //
    protected $table    = 'tbl_membership';

    public static function getMembershipLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['membership_id']);
        return $last_id;
    }

    public static function getAllMembership($outlet_id)
    {
        $membership     = DB::select('call SP_CS_MembershipList_Select(?)', [$outlet_id]);
        return $membership;
    }
    
    public static function getMembershipByID($membership_id, $outlet_id)
    {
        $membership       = DB::select('call SP_CS_MembershipList_ByID_Select(?,?)', [$membership_id, $outlet_id]);
        return $membership;
    }

    public static function setMembership($membership_id, $membership_name, $membership_type, $membership_startDate, $membership_endDate, $outlet_id)
    {
        $set_membership                = DB::select('call SP_CS_MembershipList_Insert(?,?,?,?,?,?)', [$membership_id, $membership_name, $membership_type, $membership_startDate, $membership_endDate, $outlet_id]);
        return $set_membership;
    }

    public static function setUpdateMembership($membership_id, $membership_name, $membership_type, $membership_startDate, $membership_endDate)
    {
        $set_update_membership                = DB::select('call SP_CS_MembershipList_Update(?,?,?,?,?)', [$membership_id, $membership_name, $membership_type, $membership_startDate, $membership_endDate]);
        return $set_update_membership;
    }

}
