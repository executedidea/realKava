<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class POSDashboardController extends Controller
{
    //
    public function index()
    {
        return view('pos.dashboard');
    }
}
