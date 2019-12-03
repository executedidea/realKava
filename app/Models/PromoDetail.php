<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoDetail extends Model
{
    //
    protected $table        = 'tbl_promo_detail';

    public static function insertPromoDetail($promo_detail_id, $promo_id, $promo_maxValue, $promo_freeValue, $item_id, $item_free_id, $outlet_id)
    {
        $insert         = DB::select('call SP_POS_PromoDetail_Insert(?,?,?,?,?,?,?)', [$promo_detail_id, $promo_id, $promo_maxValue, $promo_freeValue, $item_id, $item_free_id, $outlet_id]);
        
        return $insert;
    }

    public static function getPromoDetailLastID()
    {
        $lastID         = DB::select('call SP_GetLastID_Select(?)', ['promo_detail_id']);
        return $lastID;
    }
}
