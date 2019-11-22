<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function index()
    {
        $category       = Feedback::getAllCategory();
        return view('cs.master.feedback.index', compact('category'));
    }
}
