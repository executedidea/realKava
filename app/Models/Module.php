<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    protected $table    = 'tbl_modul';
    //
    public static function usersModules($id)
    {
        $modules    = DB::select('call TEST_MODULES(?)', [$id]);

        return $modules;
    }

}
