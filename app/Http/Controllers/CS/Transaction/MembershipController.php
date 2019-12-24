<?php

namespace App\Http\Controllers\CS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_Detail;
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
        $membership_list     = Membership::getMembershipList($outlet_id);
        $city_list          = Membership::getCityList();
        $customer_member    = Membership::getCustomerMembership($outlet_id);
        return view('cs.transaction.membership.index', compact('customer', 'membership_list', 'city_list', 'customer_member'));
    }

    public function update(Request $request)
    {
        $customer_id                = $request->customer_id;
        $membership_id              = $request->membership_id;
        $membership_joinDate        = $request->membership_joinDate;
        $membership_expiredDate     = $request->membership_expiredDate;
        $customer_dateOfBirth       = $request->customer_dateOfBirth;
        $customer_idCardNo          = $request->customer_idCardNo;
        $customer_religion          = $request->customer_religion;
        $customer_martialStatus     = $request->customer_martialStatus;
        $customer_email             = $request->customer_email;
        $customer_address           = $request->customer_address;
        $city_id                    = $request->city_id;
        Membership::setUpdateMembershipRegistration(
            $customer_id, 
            $membership_id, 
            $membership_joinDate, 
            $membership_expiredDate, 
            $customer_dateOfBirth, 
            $customer_idCardNo, 
            $customer_religion, 
            $customer_martialStatus, 
            $customer_email, 
            $customer_address, 
            $city_id
        );
        return back()->with('membershipEdited');        
    }

    public function getMembershipByID($membership_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;
        $membership                     = Membership::getMembershipByID($membership_id, $outlet_id);
        return response()->json($membership);
    }

    public function getCustomerByID($customer_id)
    {
        $outlet_id              = Auth::user()->outlet_id;
        $customer               = Membership::getCustomerByID($customer_id, $outlet_id);

        return response()->json($customer);
    }

    public function getMembershipList()
    {
        $outlet_id              = Auth::user()->outlet_id;
        $membership_list               = Membership::getMembershipList($outlet_id);
        return response()->json([
            'status'    => true,
            'membership_list'  => $membership_list
        ]);
    }
    
}
