<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function index()
    {
        $outlet_id                      = Auth::user()->outlet_id;
        $accounts                       = Account::getUserByOutletID($outlet_id);
        $group                          = Group::where('outlet_id', $outlet_id)->get();

        return view('user-management.account.index', compact('outlet_id', 'accounts', 'group'));
    }


    public function update(Request $request, $account_id)
    {
        $validator                      = Validator::make($request->all(), [
            'account_name'  => 'required',
            'account_group' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $account_name               = $request->account_name;
            $account_group              = $request->account_group;

            Account::updateAccount($account_id, $account_name, $account_group);
            return back()->with('accountUpdated');
        }
    }

    public function store(Request $request)
    {
        $validator                      = Validator::make($request->all(), [
            'account_name'      => 'required|string',
            'account_username'  => 'required|string',
            'account_email'     => 'required|email',
            'account_group'     => 'required',
            'password'          => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $account_lastid                 = Account::getAccountLastID();
            $account_id                     = $account_lastid[0]->user_id + 1;
            $account_name                   = $request->account_name;
            $account_email                  = $request->account_email;
            $account_username               = $request->account_username;
            $account_password               = Hash::make($request->password);
            $account_created_at             = date('Y-m-d H:i:s');
            $account_group                  = $request->account_group;
            $outlet_id                      = Auth::user()->outlet_id;

            Account::insertAccount($account_id, $account_name, $account_email, $account_username, $account_password, $account_created_at, $account_group, $outlet_id, 0);

            return back()->with('accountStored');
        }
    }







    public function getAccountByID(Request $request, $account_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;

        $account                        = Account::getAccountByID($account_id, $outlet_id);
        return response()->json([
            'status'    => true,
            'account'   => $account
        ]);
    }
}
