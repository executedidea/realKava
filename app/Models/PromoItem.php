<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoItem extends Model
{
    //
    public static function insertPromo($promo_id, $promo_name, $promo_type_id, $promo_startDate, $promo_endDate, $outlet_id, $promo_status, $promo_all_item)
    {
        $insert         = DB::select('call SP_POS_Promo_Insert(?,?,?,?,?,?,?,?)', [$promo_id, $promo_name, $promo_type_id, $promo_startDate, $promo_endDate, $outlet_id, $promo_status, $promo_all_item]);

        return $insert;
    }

    public static function getAllPromo($outlet_id)
    {
        $promo          = DB::select('call SP_POS_Promo_Select(?)', [$outlet_id]);
        return $promo;
    }

    public static function getAllInactivePromo($outlet_id)
    {
        $promo          = DB::select('call SP_POS_InactivePromo_Select(?)', [$outlet_id]);
        return $promo;
    }

    public static function getTodaysPromo($outlet_id) 
    {
        $promo          = DB::select('call SP_POS_Promo_GetTodaysPromo_Select(?)', [$outlet_id]);
        return $promo;
    }

    public static function getPromoItem($outlet_id)
    {
        $promo          = DB::select('call SP_POS_Promo_GetTodaysPromo_Select_Items(?)', [$outlet_id]);
        return $promo;
    }

    public static function getVisitPromo($outlet_id)
    {
        $promo          = DB::select('call SP_POS_Promo_GetTodaysPromo_Select_Visit(?)', [$outlet_id]);
        return $promo;
    }
    
    public static function setDeletePromoItem($promo_id)
    {
        $delete                = DB::select('call SP_Promo_Delete(?)', [$promo_id]);
        return $delete;
    }
    
    public static function setDeactivatePromoItem($promo_id)
    {
        $delete                = DB::select('call SP_Promo_Deactivate(?)', [$promo_id]);
        return $delete;
    }
}
