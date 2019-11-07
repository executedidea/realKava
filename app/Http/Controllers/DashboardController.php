<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Outlet;
use App\Models\OutletDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Image;

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

    public function newUser_1()
    {
        return view('auth.newUser-step1');
    }
    public function newUser_2()
    {
        return view('auth.newUser-step2');
    }
    
    public function newOutlet(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'outlet_image'  => 'image|mimes:jpeg,jpg,bmp,png',
            'brand'         => 'required',
            'outlet_name'          => 'required',
            'phone'         => 'required|numeric|min:7',
            'email'         => 'required|email',
            'address'       => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        } else{

            // Outlet ID
            if(count(Outlet::all()) <= 0){
                $outlet_id  = 1;
            } else {
                $outlet_lastID  = Outlet::getOutletLastID();
                $outlet_id      = $outlet_lastID[0]->outlet_id+1;
            }
            // Outlet_Detail ID
            if(count(OutletDetail::all()) <= 0){
                $outlet_detail_id   = 1;
            } else {
                $outlet_detail_lastID   = OutletDetail::getOutletLastID();
                $outlet_detail_id       = $outlet_detail_lastID[0]->outlet_detail_id+1;
            }
            // Image Manager
            if($request->hasFile('outlet_image')){
                $originalImage  = $request->file('outlet_image');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath  = public_path('storage\images\outlet_logo\thumbnails');
                $originalPath   = public_path('storage\images\outlet_logo');
                $thumbnailImage->save($originalPath . '/' . time() .  $originalImage->getClientOriginalName());
                $thumbnailImage->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $thumbnailImage->save($thumbnailPath . '/' . time() .  $originalImage->getClientOriginalName());
                $outlet_logo    = time().$request->file('outlet_image')->getClientOriginalName();
            } else{
                $outlet_logo    = 'default_outlet_logo.png';
            }

            $outlet_brand   = $request->brand;
            $outlet_name    = $request->outlet_name;
            $outlet_address = $request->address;
            $outlet_phone   = $request->phone;
            $outlet_email   = $request->email;

            DB::select('call SP_GlobalSetting_Outlet_Insert(?,?,?,?,?,?,?,?)', [
                $outlet_id,
                $outlet_logo,
                $outlet_brand,
                $outlet_name,
                $outlet_address,
                $outlet_phone,
                $outlet_email,
                $outlet_detail_id
            ]);
                
            $user   = User::find(Auth::user()->id);
            $user->outlet_id = $outlet_id;
            $user->save();

            return redirect('/')->with('accountCreated');
        }
    }
}
