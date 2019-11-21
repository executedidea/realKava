<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer_Detail extends Model
{
    protected $table        = 'tbl_customer_detail';
    //
    public static function getAllCustomerDetail($outlet_id)
    {
        $customer_detail    = DB::select('call SP_CS_One_CustomerDetail_Select_All(?)', [$outlet_id]);
        return $customer_detail;
    }

    public static function getCustomerDetailLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['customer_detail_id']);
        return $lastID;
    }

    public static function getCustomerDetailByCustomerID($customer_id, $outlet_id)
    {
        $customer_detail    = DB::select('call SP_CS_One_CustomerDetail_Select(?,?)', [$customer_id, $outlet_id]);
        return $customer_detail;
    }

    public static function getCustomerDetailByID($customer_detail_id, $outlet_id)
    {
        $customer_detail    = DB::select('call SP_CS_One_CustomerDetail_Select_ID(?,?)', [$customer_detail_id, $outlet_id]);
        return $customer_detail;
    }

    public static function insertCustomerDetail($customer_detail_id, $customer_licensePlate, $vehicle_id, $customer_id, $vehicle_color_id)
    {
        $insert             = DB::select('call SP_CS_One_CustomerDetail_Insert(?,?,?,?,?)', [
            $customer_detail_id,
            $customer_licensePlate,
            $vehicle_id,
            $customer_id,
            $vehicle_color_id
        ]);
        return $insert;
    }

    public static function updateCustomerDetail($customer_detail_id, $customer_licensePlate, $vehicle_id, $vehicle_color)
    {
        $update             = DB::select('call SP_CS_One_CustomerDetail_Update(?,?,?,?)', [$customer_detail_id, $customer_licensePlate, $vehicle_id, $vehicle_color]);
        return $update;
    }

    public static function deleteCustomerDetail($customer_detail_id)
    {
        $delete         = DB::select('call SP_CS_One_CustomerDetail_Delete(?)', [$customer_detail_id]);
        return $delete;
    }

    public static function searchCustomerDetailByKey($key)
    {
        $customer_detail    = DB::select('call SP_CS_CustomerDetail_Search(?)', ['%' . $key . '%']);
        return $customer_detail;
    }
}
