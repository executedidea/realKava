<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoItem extends Model
{
    //
    public static function insertPromo($promo_id, $promo_name, $promo_type_id, $promo_maxValue, $promo_free, $promo_startDate, $promo_endDate, $outlet_id, $promo_status)
    {
        $insert         = DB::select('call SP_POS_Promo_Insert(?,?,?,?,?,?,?,?,?)', [$promo_id, $promo_name, $promo_type_id, $promo_maxValue, $promo_free, $promo_startDate, $promo_endDate, $outlet_id, $promo_status]);

        return $insert;
    }

    public static function insertPromoDetail($promo_detail_id, $promo_id, $promo_maxValue, $promo_freeValue, $item_id, $item_free_id, $outlet_id)
    {
        $insert         = DB::select('call SP_POS_PromoDetail_Insert(?,?,?,?,?,?,?)', [$promo_detail_id, $promo_id, $promo_maxValue, $promo_freeValue, $item_id, $item_free_id, $outlet_id]);

        return $insert;
    }

    public static function getAllPromo($outlet_id)
    {
        $promo          = DB::select('call SP_POS_Promo_Select(?)', [$outlet_id]);
        return $promo;
    }
}
