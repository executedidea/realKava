<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PettyCashController extends Controller
{
    //
    public function index()
    {
        return view('pos.transaction.petty-cash.index');
    }
}
