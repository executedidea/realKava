<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Vehicle_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    //
    public function index()
    {
        $outlet_id          = Auth::user()->outlet_id;
        $memberships        = Membership::getAllMembership($outlet_id);
        $vehicle_category   = Vehicle_Category::getAllCategory();
        return view('cs.master.membership.index', compact('memberships', 'vehicle_category'));
    }
}
