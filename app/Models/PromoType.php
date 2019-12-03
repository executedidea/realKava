<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoType extends Model
{
    //
    protected $table        = 'tbl_promo_type';

    public static function getAllPromoType()
    {
        $type               = DB::select('call SP_POS_PromoType_Select');
        return $type;
    }
}
