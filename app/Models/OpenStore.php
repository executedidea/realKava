<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OpenStore extends Model
{
    //
    protected $table        = 'tbl_open_store';

    public static function getOpenStoreLastID()
    {
        $lastID             = DB::select('call SP_GetLastID_Select(?)', ['open_store_id']);
        return $lastID;
    }

    public static function insertOpenStore($open_store_id, $open_store_date, $open_store_amount, $user_id)
    {
        $insert             = DB::select('call SP_POS_OpenStore_Insert(?,?,?,?)', [
            $open_store_id, $open_store_date, $open_store_amount,  $user_id
        ]);
        return $insert;
    }

}
