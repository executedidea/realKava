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

    public static function setDeleteMembership($membership_id)
    {
        $delete                = DB::select('call SP_CS_MembershipList_Delete(?)', [$membership_id]);
        return $delete;
    }

    public static function getCustomerByID($customer_id, $outlet_id)
    {
        $customer    = DB::select('call SP_CS_CustomerMembership_ByID_Select(?,?)', [$customer_id, $outlet_id]);
        return $customer;
    }

    public static function getMembershipList($outlet_id)
    {
        $membership_list    = DB::select('call SP_CS_MembershipList_Select(?)', [$outlet_id]);
        return $membership_list;
    }

    public static function getCustomerMembership($outlet_id)
    {
        $customer_member    = DB::select('call SP_CS_MembershipRegistration_Select(?)', [$outlet_id]);
        return $customer_member;
    }

    public static function getCityList()
    {
        $city_list    = DB::select('call SP_CityList_Select');
        return $city_list;
    }

    public static function setUpdateMembershipRegistration ($customer_id, $membership_id, $membership_joinDate, $membership_expiredDate, $customer_dateOfBirth, $customer_idCardNo, $customer_religion, $customer_martialStatus, $customer_email, $customer_address, $city_id)
    {
        $set_update_membership_registration                = DB::select('call SP_CS_MembershipRegistration_Update(?,?,?,?,?,?,?,?,?,?,?)', [
        $customer_id,
        $membership_id,
        $membership_joinDate,
        $membership_expiredDate,
        $customer_dateOfBirth,
        $customer_idCardNo,
        $customer_religion,
        $customer_martialStatus,
        $customer_email,
        $customer_address,
        $city_id
        ]);
        return $set_update_membership_registration;
    }

}
