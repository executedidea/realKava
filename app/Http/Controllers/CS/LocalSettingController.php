<?php

namespace App\Http\Controllers\CS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalSettingController extends Controller
{
    //
    public function index()
    {
        return view('cs.local-setting');
    }
}
