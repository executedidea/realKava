<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\ChangeShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeShiftController extends Controller
{
    //
    public function index()
    {
        $outlet_id                                  = Auth::user()->outlet_id;
        $user_id                                    = Auth::user()->user_id;   
        $change_shift_byuser                        = ChangeShift::getChangeShiftByUser($outlet_id, $user_id);
        return view('pos.transaction.change-shift.index', compact('change_shift_byuser'));
    }

    public function store(Request $request)
    {

    }

}
