<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $accounts       = Account::getUserByOutletID($outlet_id);

        return view('user-management.account.index', compact('outlet_id', 'accounts'));
    }
}
