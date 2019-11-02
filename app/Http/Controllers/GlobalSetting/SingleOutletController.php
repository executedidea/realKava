<?php

namespace App\Http\Controllers\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleOutletController extends Controller
{
    //
    public function index()
    {
        return view('global-setting.single-outlet.index');
    }
}
