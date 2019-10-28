<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Menu_Detail;
use App\Models\Module;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    //
    public function index()
    {
        return view('user-management.group.index');
    }
    public function getUserGroups()
    {
        $outlet_id  = Auth::user()->outlet_id;
        $groups     = Group::where('outlet_id', $outlet_id)->get();
        return Datatables::of($groups)
                ->addIndexColumn()      
                ->addColumn('action', function ($groups) {
                    return '<a href="'.route('userGroupsDetail', $groups->group_name).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
                })  
                ->make();
    }
    public function userGroupsDetail($group)
    {
        $id         = Auth::user()->group_id;

        $modules    = Module::all();
        $group      = Group::where('group_name', $group)->where('group_id', $id)->value('group_name');

        return view('user-management.group.detail', compact('modules', 'group'));
    }
    public function getMenuDetail($id)
    {
        $menu_detail= Menu_Detail::getMenuDetailByModuleID($id);
        return response()->json($menu_detail);        
    }
}
