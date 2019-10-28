<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu_Detail extends Model
{
    //
    public static function getMenuDetailByModuleID($id)
    {
        $menu_detail    = DB::select('call TEST_MENU_DETAIL1(?)', [$id]);

        return $menu_detail;
    }
}
