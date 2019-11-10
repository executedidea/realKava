<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Menu_Detail;
use App\Models\Module;
use App\Models\Outlet;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    //
    public function index()
    {
        $outlet_id         = Auth::user()->outlet_id;

        $groups     = Group::where('outlet_id', $outlet_id)->get();
        return view('user-management.group.index', compact('groups', 'outlet_id'));
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
    public function userGroupsDetail(Request $request, $group)
    {
        $id         = Auth::user()->group_id;
        $module_id  = $request->module;
        $outlet_id  = $request->outlet;

        $modules    = Module::all();
        $menu_detail= Menu_Detail::getMenuDetailByModuleID($module_id);
        $group      = Group::where('group_name', $group)->where('group_id', $id)->value('group_name');
        $outlet     = Outlet::getUserOutlet($outlet_id);

        return view('user-management.group.detail', compact('modules', 'group', 'menu_detail', 'outlet'));
    }
    public function getMenuDetail($id)
    {
        $menu_detail= Menu_Detail::getMenuDetailByModuleID($id);
        return response()->json($menu_detail);        
    }

    public function addGroup(Request $request)
    {
        $outlet_id          = Auth::user()->outlet_id;
        $allModules         = Module::all();
        $outlet             = DB::select('call SP_Outlet_Select(?)', [$outlet_id]);
        $menu_detail_cs     = DB::select('call TEST_MENU_DETAIL_ALL(?)', [1]);
        $menu_detail_pos    = DB::select('call TEST_MENU_DETAIL_ALL(?)', [2]);
        $menu_detail_sam    = DB::select('call TEST_MENU_DETAIL_ALL(?)', [3]);
        $menu_detail_emp    = DB::select('call TEST_MENU_DETAIL_ALL(?)', [4]);
        $menu_detail_pcs    = DB::select('call TEST_MENU_DETAIL_ALL(?)', [5]);
        $menu_detail_gs     = DB::select('call TEST_MENU_DETAIL_ALL(?)', [6]);
        $menu_detail_um     = DB::select('call TEST_MENU_DETAIL_ALL(?)', [7]);
        return view('user-management.group.add-group', compact('menu_detail_cs', 'menu_detail_pos', 'menu_detail_sam', 'menu_detail_emp', 'menu_detail_pcs', 'menu_detail_gs', 'menu_detail_um', 'allModules', 'outlet', 'outlet_id'));
    }

    public function addGroupPost(Request $request)
    {
        if(count(Group::all()) == 0){
            $group_detail_lastid = 1;
            $group_lastid        = 1;
        } else{
            $group_lastID               = DB::select('call SP_GetLastID_Select(?)', ['group_id']);
            $group_detail_lastID        = DB::select('call SP_GetLastID_Select(?)', ['group_detail_id']);
            $group_detail_id    = $group_detail_lastID[0]->group_detail_id;
            $group_id           = $group_lastID[0]->group_id+1;
        };
        $group_name     = $request->group_name;
        $outlet_id      = $request->outlet;
        $plusID         = 1;
        $i              = 0;
        DB::select('call SP_Group_Insert(?,?,?)', [$group_id, $group_name, $outlet_id]);
        foreach($request->right as $rights){
            $menu_detail_id     = array_keys($rights);
            foreach($rights as $value){
                $right_code     = implode("", $value);
                DB::select('call SP_UserManagement_Insert(?,?,?,?)', [$group_detail_id+$plusID++, $right_code , $menu_detail_id[$i++], $group_id]);
            };
        };
        return redirect(route('userGroups'));
    }
}
