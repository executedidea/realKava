<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    //
    protected $table    = 'tbl_bank';

    public static function getAllBank()
    {
        $bank           = DB::select('call 	SP_POS_One_BankAll_Select');
        return $bank;
    }
}
