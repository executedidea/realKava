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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (count(Membership::all()) <= 0) {
            $membership_id              = 1;
        } else {
            $membership_lastID          = Membership::getMembershipLastID();
            $membership_id              = $membership_lastID[0]->membership_id + 1;
        }
        
        $membership_name                = $request->membership_name;
        $membership_type                = $request->membership_type;
        $membership_startDate           = $request->membership_startDate;
        $membership_endDate             = $request->membership_endDate;
        $outlet_id                      = Auth::user()->outlet_id;


        Membership::setMembership(
            $membership_id,
            $membership_name,
            $membership_type,
            $membership_startDate,
            $membership_endDate,
            $outlet_id
        );
        
        return back()->with('debitCreditNoteAdded');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $membership_id)
    {
        
        $membership_name                = $request->membership_name;
        $membership_type                = $request->membership_type;
        $membership_startDate           = $request->membership_startDate;
        $membership_endDate             = $request->membership_endDate;


        Membership::setUpdateMembership(
            $membership_id,
            $membership_name,
            $membership_type,
            $membership_startDate,
            $membership_endDate
        );
        
        return back()->with('debitCreditNoteAdded');
    }
}
