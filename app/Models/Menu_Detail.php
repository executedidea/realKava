<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu_Detail extends Model
{
    //
    public static function getMenuDetailByModuleID($id)
    {
        $menu_detail        = DB::select('call SP_GetMenuDetail_ByModule_Select(?)', [$id]);

        return $menu_detail;
    }

    public static function getMenuDetailByMenuName($module_url, $group_id, $menu_name)
    {
        $menu_detail        = DB::select('call SP_GetMenuDetail_ByMenu_Select(?,?,?)', [$module_url, $group_id, $menu_name]);
        return $menu_detail;
    }
}
