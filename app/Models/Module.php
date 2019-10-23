<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    public static function getUserModules()
    {
        $modules    =   DB::select('call SP_ModulList_Select()');
        return $modules;
    }
}
