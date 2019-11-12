<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table    = 'tbl_customer';
    
    public static function getCustomerByOutlet($id)
    {
        $customer       = DB::select('call SP_CS_One_CustomerList_Select(?)', [$id]);
        return $customer;
    }

    public static function getCustomerLastID()
    {
        $lastID         = DB::select('call SP_GetLastID_Select(?)',['customer_id']);
        return $lastID;
    } 

    public static function insertCustomer($customer_id, $customer_name, $customer_phone, $customer_image, $customer_detail_id, $customer_licensePlate, $vehicle_id, $vehicle_color, $vehicle_size, $outlet_id)
    {
        $insert         = DB::select('call SP_CS_One_CustomerList_Insert(?,?,?,?,?,?,?,?,?,?)', [
            $customer_id,
            $customer_name,
            $customer_phone,
            $customer_image,
            $customer_detail_id,
            $customer_licensePlate,
            $vehicle_id,
            $vehicle_color,
            $vehicle_size,
            $outlet_id
        ]);

        return $insert;
    } 
}
