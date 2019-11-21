<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupDetail;
use App\Models\Menu_Detail;
use App\Models\Module;
use App\Models\Outlet;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class GroupController extends Controller
{
    //
    public function index()
    {
        $outlet_id          = Auth::user()->outlet_id;

        $groups             = Group::where('outlet_id', $outlet_id)->get();
        return view('user-management.group.index', compact('groups', 'outlet_id'));
    }

    public function getMenuDetail($id)
    {
        $menu_detail = Menu_Detail::getMenuDetailByModuleID($id);
        return response()->json($menu_detail);
    }

    public function create(Request $request)
    {
        $outlet_id          = Auth::user()->outlet_id;
        $allModules         = Module::all();
        $outlet             = DB::select('call SP_Outlet_Select(?)', [$outlet_id]);
        $menu_detail_cs     = Menu_Detail::getMenuDetailByModuleID(1);
        $menu_detail_pos    = Menu_Detail::getMenuDetailByModuleID(2);
        $menu_detail_sam    = Menu_Detail::getMenuDetailByModuleID(3);
        $menu_detail_emp    = Menu_Detail::getMenuDetailByModuleID(4);
        $menu_detail_pcs    = Menu_Detail::getMenuDetailByModuleID(5);
        $menu_detail_gs     = Menu_Detail::getMenuDetailByModuleID(6);
        $menu_detail_um     = Menu_Detail::getMenuDetailByModuleID(7);
        return view('user-management.group.add-group', compact('menu_detail_cs', 'menu_detail_pos', 'menu_detail_sam', 'menu_detail_emp', 'menu_detail_pcs', 'menu_detail_gs', 'menu_detail_um', 'allModules', 'outlet', 'outlet_id'));
    }

    public function store(Request $request)
    {
        // Group Detail
        if (count(GroupDetail::all()) === 0) {
            $group_detail_id = 1;
        } else {
            $group_detail_lastID        = GroupDetail::getGroupDetailLastID();
            $group_detail_id            = $group_detail_lastID[0]->group_detail_id + 1;
        }
        // Group
        if (count(Group::all()) === 0) {
            $group_id        = 1;
        } else {
            $group_lastID               = Group::getGroupLastID();
            $group_id                   = $group_lastID[0]->group_id + 1;
        }

        $group_name                     = $request->group_name;
        $outlet_id                      = Auth::user()->outlet_id;
        $plusID                         = 0;
        $i                              = 0;
        DB::select('call SP_Group_Insert(?,?,?)', [$group_id, $group_name, $outlet_id]);
        foreach ($request->right as $rights) {
            $menu_detail_id     = array_keys($rights);
            foreach ($rights as $value) {
                $right_code     = implode("", $value);
                GroupDetail::insertGroupDetail($group_detail_id + $plusID++, $right_code, $menu_detail_id[$i++], $group_id);
                // DB::select('call SP_UserManagement_Insert(?,?,?,?)', [$group_detail_id+$plusID++, $right_code , $menu_detail_id[$i++], $group_id]);
            };
        };
        return redirect(route('userGroups'));
    }

    public function edit($group_id)
    {
        $outlet_id          = Auth::user()->outlet_id;
        $allModules         = Module::all();
        $outlet             = DB::select('call SP_Outlet_Select(?)', [$outlet_id]);
        $menu_detail_cs     = GroupDetail::getGroupDetailRights($group_id, 1);
        $menu_detail_pos    = GroupDetail::getGroupDetailRights($group_id, 2);
        $menu_detail_sam    = GroupDetail::getGroupDetailRights($group_id, 3);
        $menu_detail_emp    = GroupDetail::getGroupDetailRights($group_id, 4);
        $menu_detail_pcs    = GroupDetail::getGroupDetailRights($group_id, 5);
        $menu_detail_gs     = GroupDetail::getGroupDetailRights($group_id, 6);
        $menu_detail_um     = GroupDetail::getGroupDetailRights($group_id, 7);
        $group_detail       = GroupDetail::getGroupDetailByID($group_id);

        return view('user-management.group.edit', compact('menu_detail_cs', 'menu_detail_pos', 'menu_detail_sam', 'menu_detail_emp', 'menu_detail_pcs', 'menu_detail_gs', 'menu_detail_um', 'allModules', 'outlet', 'outlet_id', 'group_detail', 'group_id'));
    }

    public function update(Request $request, $id)
    {
        $validator                      = Validator::make($request->all(), [
            'group_name'                => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $group_id                   = (int) $id;
            $group_name                 = $request->group_name;
            $i                          = 0;

            foreach ($request->right as $rights) {
                $menu_detail_id         = array_keys($rights);
                foreach ($rights as $value) {
                    $right_code         = implode("", $value);
                    GroupDetail::updateGroupDetail($right_code, $menu_detail_id[$i++], $group_id, $group_name);
                };
            };
            return back()->with('groupEdited');
        }
    }
}
