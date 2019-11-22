<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    //
    protected $table    = 'tbl_users';

    public static function getUserByOutletID($outlet_id)
    {
        $accounts       = DB::select('call SP_Account_Select_ByOutletID(?)', [$outlet_id]);
        return $accounts;
    }

    public static function getAccountByID($account_id, $outlet_id)
    {
        $account        = DB::select('call SP_Account_ByID_Select(?,?)', [$account_id, $outlet_id]);
        return $account;
    }

    public static function getAccountLastID()
    {
        $last_id        = DB::select('call SP_GetLastID_Select(?)', ['user_id']);
        return $last_id;
    }

    public static function insertAccount($id, $name, $email, $username, $password, $created_at, $group_id, $outlet_id, $is_active)
    {
        $insert         = DB::select('call SP_Account_Insert(?,?,?,?,?,?,?,?,?)', [$id, $name, $email, $username, $password, $created_at, $group_id, $outlet_id, $is_active]);
        return $insert;
    }

    public static function updateAccount($account_id, $account_name, $account_group)
    {
        $update         = DB::select('call SP_Account_Update(?,?,?)', [$account_id, $account_name, $account_group]);
        return $update;
    }
}
