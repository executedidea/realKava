<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashRegister;
use App\Models\Item;
use App\Models\PromoDetail;
use App\Models\PromoItem;
use App\Models\PromoType;
use App\Models\SettingPOS;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PromoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $promo_type     = PromoType::getAllPromoType();
        $items          = Item::getAllItem(Auth::user()->outlet_id);
        $promos         = PromoItem::getAllPromo($outlet_id);
        return view('cs.master.promo-item.index', compact('items', 'promo_type', 'promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validator      = Validator::make($request->all(), [
            'promo_id'        => 'required|string',
            'promo_name'        => 'required|string',
            'promo_type'        => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            if ($request->has('promo_all_item')) {
                $promo_id           = $request->promo_id;
                $promo_name         = $request->promo_name;
                $promo_type         = $request->promo_type;
                $promo_maxValue     = $request->promo_maxValue;
                $promo_free         = $request->promo_free;
                if (!$request->has('promo_periode')) {
                    $promo_startDate    = $request->promo_startDate;
                    $promo_endDate      = $request->promo_endDate;
                } else {
                    $promo_startDate    = null;
                    $promo_endDate      = null;
                }

                $outlet_id          = Auth::user()->outlet_id;
                $promo_status       = 1;
                $promo_all_item     = 1;

                PromoItem::insertPromo($promo_id, $promo_name, $promo_type, $promo_maxValue, $promo_free, $promo_startDate, $promo_endDate, $outlet_id, $promo_status, $promo_all_item);

                return back()->with('promoStored');
                die;
            } else {
                if (count(PromoDetail::all()) == 0) {
                    $promo_detail_id    = 1;
                } else {
                    $promo_detail_lastID = PromoDetail::getPromoDetailLastID();
                    $promo_detail_id     = $promo_detail_lastID[0]->promo_detail_id + 1;
                }
                $promo_id         = $request->promo_id;
                $promo_name         = $request->promo_name;
                $promo_type         = $request->promo_type;
                $promo_maxValue     = 0;
                $promo_free         = 0;
                if (!$request->has('promo_periode')) {
                    $promo_startDate    = $request->promo_startDate;
                    $promo_endDate      = $request->promo_endDate;
                } else {
                    $promo_startDate    = null;
                    $promo_endDate      = null;
                }
                $outlet_id          = Auth::user()->outlet_id;
                $promo_status       = 1;
                $promo_all_item     = 0;

                PromoItem::insertPromo($promo_id, $promo_name, $promo_type, $promo_maxValue, $promo_free, $promo_startDate, $promo_endDate, $outlet_id, $promo_status, $promo_all_item);
                foreach ($request->promo_item as $key => $item) {
                    PromoDetail::insertPromoDetail($promo_detail_id, $request->promo_maxValue[$key], $request->promo_freeValue[$key], $promo_id, $request->promo_item[$key], $request->promo_freeItem[$key], $outlet_id);
                }

                return back()->with('promoDetailStored');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
