<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CSDashboardController extends Controller
{
    //
    public function index()
    {
        return view('cs.dashboard');
    }
}