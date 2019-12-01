<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\OpenStore;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpenStoreController extends Controller
{
    //
    public function index()
    {
        return view('pos.transaction.open-store.index');
    }

    public function store(Request $request)
    {
        $validator      = Validator::make($request->all(), [
            'open_cashdrawer' => 'required',
            'open_date'       => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        } else {
            if(count(OpenStore::all()) <= 0){
                $open_store_id      = 1;
            } else {
                $open_store_lastID  = OpenStore::getOpenStoreLastID();
                $open_store_id      = $open_store_lastID[0]->open_store_id+1;
            }
            $user_id                = User::select('user_id')->where('name', $request->cashier_name)->value('user_id');

            $open_date              = $request->open_date;
            $open_cashdrawer        = $request->open_cashdrawer;
            $total_cashdrawer       = $request->total_cashdrawer;

            OpenStore::insertOpenStore($open_store_id, $open_date, $open_cashdrawer, $total_cashdrawer, $user_id);

            return back()->with('storeOpened', 'thank you');
        }
    }
}
