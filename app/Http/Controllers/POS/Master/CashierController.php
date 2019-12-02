<?php

namespace App\Http\Controllers\POS\Master;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Discount;
use App\Models\Group;
use App\Models\Shift;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    //
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $cashier_list   = Shift::getCashierByOutlet($outlet_id);
        $shift_code_all = Shift::getShiftCodeByOutlet($outlet_id);
        $group          = Group::all();
        $user_name      = User::all();
        return view('pos.master.cashier.index', compact('outlet_id', 'cashier_list', 'shift_code_all', 'group', 'user_name'));
    }

    public function destroyCashier(Request $request)
    {
        $id = $request->id;
        Cashier::whereIn('cashier_id',explode(",",$id))->update(['flag'=>0]);
        return response()->json(['status'=>true,'message'=>"Cashier deleted successfully."]);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'vehicle_brand_name' => 'required|string',
        //     'vehicle_model_name' => 'required|string'
        // ]);
        // $vehicle_category_id    = $request->vehicle_category;
        // brand
        
        if( count(Cashier::all()) <= 0 ){
            $cashier_id      = 1;
        } else{
            $cashier_lastID     = DB::select('call SP_GetLastID_Select(?)', ['cashier_id']);
            $cashier_id         = $cashier_lastID[0]->cashier_id+1;
        }

        // discount
        if( count(Discount::all()) <= 0 ){
            $disc_id      = 1;
        } else{
            $disc_lastID    = DB::select('call SP_GetLastID_Select(?)', ['disc_id']);
            $disc_id        = $disc_lastID[0]->disc_id+1;
        }
        $outlet_id              = Auth::user()->outlet_id;
        $shift_id               = $request->shift_id;
        $user_id                = $request->user_id;
        $disc_percent           = $request->disc_percent;
        $add_disc               = $request->add_disc_percent;
        
        DB::select('call SP_POS_CashierList_Insert(?,?,?,?,?,?,?)', [
            $cashier_id, $shift_id, $user_id, $disc_id, $disc_percent, $outlet_id, $add_disc
        ]);
        return back()->with('cashierAdded', 'Cashier has been added successfully!');
        
    }

    public function editCashier(Request $request, $cashier_id)
    {  
        DB::select('call SP_POS_CashierList_Update(?,?,?,?,?,?,?)', [
            $cashier_id,
            $request->shift_id,
            $request->user_id,
            $request->shift_startTime,
            $request->shift_endTime,
            $request->disc_percent,
            $request->disc_id,
        ]);
        return back()->with('cashierUpdate', 'Cashier has been edited successfully!');
    }

    public function getCashier($cashier_id)
    {
        $cashier = DB::select('call SP_POS_CashierList_ByID_Select(?)', [$cashier_id]);
        return response()->json([
            'status'    => true,
            'cashier'  => $cashier
        ]);
    }

    public function getCashierByID($cashier_id)
    {
        $cashier_by_id = Cashier::getCashierByID($cashier_id);
        return response()->json([
            'status'    => true,
            'cashier_by_id'  => $cashier_by_id
        ]);
    }

    public function user()
    {
        $group_id        = Input::get('group_id');
        $user_selectWhere    = new User;
        $user      = $user_selectWhere->selectWhere($group_id);

        return response()->json($user);
    }
    
}
