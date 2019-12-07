<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    //
    protected $table    = 'tbl_item';

    public static function getAllItem($outlet_id)
    {
        $items          = DB::select('call 	SP_POS_ItemList_Select(?)', [$outlet_id]);
        return $items;
    }

    public static function getItemByID($outlet_id, $item_id)
    {
        $item           = DB::select('call SP_POS_ItemList_ByID_Select(?,?)', [$outlet_id, $item_id]);
        return $item;
    }

    public static function getServiceItemByOutletID($outlet_id)
    {
        $item           = DB::select('call SP_POS_Item_GetService_Select(?)', [$outlet_id]);
        return $item;
    }
}
