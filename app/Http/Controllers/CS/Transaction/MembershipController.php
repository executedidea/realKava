<?php

namespace App\Http\Controllers\CS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    //
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $customer       = Customer::getCustomerByOutlet($outlet_id);
        return view('cs.transaction.membership.index', compact('customer'));
    }
}
