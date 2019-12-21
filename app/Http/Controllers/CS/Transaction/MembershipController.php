<?php

namespace App\Http\Controllers\CS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    //
    public function index()
    {
        $outlet_id          = Auth::user()->outlet_id;
        $customer           = Customer::getCustomerByOutlet($outlet_id);
        $membership_all     = Membership::getAllMembership($outlet_id);
        return view('cs.transaction.membership.index', compact('customer', 'membership_all'));
    }

    public function getMembershipByID($membership_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;
        $membership                     = Membership::getMembershipByID($membership_id, $outlet_id);
        return response()->json([
            'status'    => true,
            'membership'  => $membership
        ]);
    }
}
