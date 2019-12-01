<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettingPOS extends Model
{
    //
    protected $table        = 'tbl_setting_pos';

    public static function getSettingPOSLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['setting_pos_id']);
        return $lastID;
    }

    public static function getSettingByOutletID($outlet_id)
    {
        $setting            = DB::select('call SP_POS_LocalSetting_Select(?)', [$outlet_id]);
        return $setting;
    }

    public static function insertSetting($setting_id, $setting_batch, $setting_pc_code, $setting_pc_no, $setting_cd_code, $setting_cd_no, $setting_cc_charge, $setting_ppn, $outlet_id)
    {
        $insert             = DB::select('call SP_POS_LocalSetting_Insert(?,?,?,?,?,?,?,?,?)', [$setting_id, $setting_batch, $setting_pc_code, $setting_pc_no, $setting_cd_code, $setting_cd_no, $setting_cc_charge, $setting_ppn, $outlet_id]);
        return $insert;
    }
}
