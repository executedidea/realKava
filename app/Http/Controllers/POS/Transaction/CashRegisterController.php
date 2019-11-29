<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashRegisterController extends Controller
{
    //
    public function index()
    {
        return view('pos.transaction.cash-register.index');
    }
}
