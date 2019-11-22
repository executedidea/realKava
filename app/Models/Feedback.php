<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feedback extends Model
{
    protected $table        = 'tbl_feedback';
    //
    public static function getAllCategory()
    {
        $category           = DB::select('call SP_CS_Five_FeedbackCategory_Select');
        return $category;
    }
}
