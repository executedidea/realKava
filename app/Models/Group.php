<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Group extends Model
{
    //
    protected $table    = 'tbl_group';

    public static function insertUserGroup()
    {

    }

    public static function getGroupLastID()
    {
        $group_lastID               = DB::select('call SP_GetLastID_Select(?)', ['group_id']);
        return $group_lastID[0];
    }


}
