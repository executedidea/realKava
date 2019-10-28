<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UMDashboardController extends Controller
{
    //
    public function index()
    {
        return view('user-management.dashboard');
    }
}
