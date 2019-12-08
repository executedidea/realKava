<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoFree extends Model
{
    //
    protected $table        = 'tbl_promo_free';

    public static function getPromoFreeByCustomerAndPromoID($promo_id, $customer_detail_id)
    {
        $promo_free         = DB::select('call SP_POS_PromoFree_Select(?,?)', [$promo_id, $customer_detail_id]);
        return $promo_free;
    }
}
