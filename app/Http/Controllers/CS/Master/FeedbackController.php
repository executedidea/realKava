<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function index()
    {
        return view('cs.master.feedback.index');
    }
}
