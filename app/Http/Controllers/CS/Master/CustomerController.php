<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('cs.master.customer-list.customer-list');
    }
}
