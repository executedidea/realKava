<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $category       = Feedback::getAllCategory($outlet_id);
        return view('cs.master.feedback.index', compact('category'));
    }
}
