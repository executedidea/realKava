<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // $id         = Auth::user()->group_id;
        // $modules    = Module::usersModules($id);
        $modules    = Module::all();

        return view('dashboard', compact('modules'));
    }
}
