<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\SettingPOS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocalSettingController extends Controller
{
    //
    public function index()
    {
        $outlet_id              = Auth::user()->outlet_id;
        if( count(SettingPOS::getSettingByOutletID($outlet_id)) == 0){
            $condition          = 0;
            return view('pos.local-setting', compact('condition'));
        } else {
            $setting            = SettingPOS::getSettingByOutletID($outlet_id);
            $condition          = 1;
            return view('pos.local-setting', compact('setting', 'condition'));
        }
    }

    public function store(Request $request)
    {
        $validator              = Validator::make($request->all(), [
            'batch'             => 'required',
            'pettycash_code'    => 'required|string',
            'pettycash_number'  => 'required|string',
            'cashdetail_code'   => 'required|string',
            'cashdetail_number' => 'required|string',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        } else {
            if(count(SettingPOS::all()) == 0){
                $setting_id     = 1;
            } else {
                $setting_lastID = SettingPOS::getSettingPOSLastID();
                $setting_id     = $setting_lastID[0]->setting_pos_id+1;
            }

            $outlet_id          = Auth::user()->outlet_id;
            $batch              = $request->batch;
            $pettycash_code     = $request->pettycash_code;
            $pettycash_number   = $request->pettycash_number;
            $cashdetail_code    = $request->cashdetail_code;
            $cashdetail_number  = $request->cashdetail_number;
            $cc_charge          = $request->cc_charge;

            if($request->has('ppn')){
                $ppn            = $request->ppn;
            } else {
                $ppn            = 0;
            }

            SettingPOS::insertSetting($setting_id, $batch, $pettycash_code, $pettycash_number, $cashdetail_code, $cashdetail_number, $cc_charge, $ppn, $outlet_id);
            return back()->with('settingStored');
        }
    }
}
