<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_Detail;
use App\Models\Vehicle;
use App\Models\Vehicle_Brand;
use App\Models\Vehicle_Category;
use App\Models\Vehicle_Color;
use App\Models\Vehicle_Model;
use App\Models\Vehicle_Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class CustomerController extends Controller
{
    public function index()
    {
        $outlet_id                      = Auth::user()->outlet_id;

        $customers                      = Customer::getCustomerByOutlet($outlet_id);
        $vehicle_category               = Vehicle_Category::getAllCategory();
        $vehicle_color                  = Vehicle_Color::getAllColor();
        return view('cs.master.customer.index', compact('customers', 'vehicle_category', 'vehicle_color'));
    }

    public function store(Request $request)
    {
        $validator          = Validator::make($request->all(), [
            'customer_image'            => 'image|mimes:jpeg,png,jpg,gif,svg',
            'customer_name'             => 'required|min:3|max:32',
            'customer_phone'            => 'required|min:7:max:15',
            'customer_licensePlate'     => 'required|min:3|max:8',
            'vehicle_category'          => 'required',
            'vehicle_brand'             => 'required',
            'vehicle_model'             => 'required',
            'vehicle_color'             => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } else{
            // IMAGE ---------------------------------------------------------------------------
            if($request->hasFile('customer_image')){
                $originalImage          = $request->file('customer_image');
                $image_name             = time().$request->file('customer_image')->getClientOriginalName();
                $thumbnailImage         = Image::make($originalImage);
                $thumbnailPath          = public_path('storage\images\customer_images\thumbnails');
                $originalPath           = public_path('storage\images\customer_images');
                $thumbnailImage->save($originalPath . '/' . $image_name);
                $thumbnailImage->resize(null, 120, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $thumbnailImage->save($thumbnailPath . '/' . $image_name);
                $customer_image         = $image_name;
            } else{
                $customer_image         = 'default.png';
            }
            // --------------------------------------------------------------------------------

            // INSERT -------------------------------------------------------------------------
            $customer_lastID            = Customer::getCustomerLastID();
            $customer_detail_lastID     = Customer_Detail::getCustomerDetailLastID();
            $vehicle_id                 = Vehicle::getVehicleIDByModel($request->vehicle_model);
            $outlet_id                  = Auth::user()->outlet_id;

            if( count(Customer::all()) == 0 ){
                $customer_id            = 1;
            } else{
                $customer_id            = $customer_lastID[0]->customer_id+1;
            }
            if( count(Customer_Detail::all()) == 0 ){
                $customer_detail_id     = 1;
            } else{
                $customer_detail_id     = $customer_detail_lastID[0]->customer_detail_id+1;
            }

            $customer_name              = $request->customer_name;
            $customer_phone             = $request->customer_phone;
            $customer_licensePlate      = $request->customer_licensePlate;
            $vehicle_color              = $request->vehicle_color;

            Customer::insertCustomer($customer_id, $customer_name, $customer_phone, $customer_image, $customer_detail_id, $customer_licensePlate, $vehicle_id, $vehicle_color, $outlet_id);

            return back()->with('customerAdded');
            // --------------------------------------------------------------------------------
        }

    }
    
    public function destroy(Request $request)
    {
        $customer_id                    = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if(!strpos($customer_id, ',') !== false){
            Customer::deleteCustomer($customer_id);
        } else {
            $customer_ids               = explode(",", $customer_id);
            foreach($customer_ids as $item){
                Customer::deleteCustomer($item);
            }
        }
        // -------------------------------------------------------------------------------------

        return response()->json(['status'=>true,'message'=>'Customer deleted successfuly!']);
    }

    public function show($customer_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;
        $customer                       = Customer::getCustomerByID($customer_id, $outlet_id);
        $customer_detail                = Customer_Detail::getCustomerDetailByCustomerID($customer_id, $outlet_id);
        $vehicle_category               = Vehicle_Category::getAllCategory();
        $vehicle_color                  = Vehicle_Color::getAllColor();
        return view('cs.master.customer.detail', compact('customer', 'customer_detail', 'vehicle_category', 'vehicle_color', 'customer_id'));
    }

    public function storeDetail(Request $request, $customer_id)
    {
        $validator                      = Validator::make($request->all(), [
            'customer_licensePlate'     => 'required|min:3|max:8',
            'vehicle_category'          => 'required',
            'vehicle_brand'             => 'required',
            'vehicle_model'             => 'required',
            'vehicle_color'             => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        } else{
            $customer_detail_lastID      = Customer_Detail::getCustomerDetailLastID();
            $vehicle_id                  = Vehicle::getVehicleIDByModel($request->vehicle_model);

                // INSERT-------------------------------------------------------------------------------
            $customer_detail_id          = $customer_detail_lastID[0]->customer_detail_id+1;
            $customer_licensePlate       = $request->customer_licensePlate;
            $vehicle_color               = $request->vehicle_color;

            Customer_Detail::insertCustomerDetail($customer_detail_id, $customer_licensePlate, $vehicle_id, $customer_id, $vehicle_id);
            return back()->with('customerDetailAdded');
            // -------------------------------------------------------------------------------------
        }

    }

    public function updateDetail(Request $request, $customer_id, $customer_detail_id = null)
    {
        if($request->has('edit_customer')){
            $validator                      = Validator::make($request->all(), [
                'customer_image'            => 'image|mimes:jpeg,png,jpg,gif,svg',
                'customer_name'             => 'required|min:3|max:32',
                'customer_phone'            => 'required|min:7:max:15',
            ]);
            $outlet_id                      = Auth::user()->outlet_id;
            $customer                       = Customer::getCustomerByID($customer_id, $outlet_id);
            if($validator->fails()){
                return back()->withErrors($validator);
            } else{
                if($request->hasFile('customer_image')){
                    Storage::delete('public/images/customer_images/' . $customer[0]->customer_image);
                    Storage::delete('public/images/customer_images/thumbnails/' . $customer[0]->customer_image);

                    $originalImage          = $request->file('customer_image');
                    $image_name             = time().$request->file('customer_image')->getClientOriginalName();
                    $thumbnailImage         = Image::make($originalImage);
                    $thumbnailPath          = public_path('storage\images\customer_images\thumbnails');
                    $originalPath           = public_path('storage\images\customer_images');
                    $thumbnailImage->save($originalPath . '/' . $image_name);
                    $thumbnailImage->resize(null, 120, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $thumbnailImage->save($thumbnailPath . '/' . $image_name);
                    $customer_image         = $image_name;
                } else{
                    $customer_image         = 'default.png';
                }

                $customer_name              = $request->customer_name;
                $customer_phone             = $request->customer_phone;

                Customer::updateCustomer($customer_id, $customer_name, $customer_phone, $customer_image);
                return back()->with('customerUpdated');
            }
        } elseif($request->has('edit_customer_detail')){
            $validator                      = Validator::make($request->all(), [
                'customer_licensePlate'     => 'required|min:3',
                'vehicle_category'          => 'required',
                'vehicle_brand'             => 'required',
                'vehicle_model'             => 'required',
                'vehicle_color'             => 'required'
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            } else{
                $customer_licensePlate        = $request->customer_licensePlate;
                $vehicle_id                   = Vehicle::getVehicleIDByModel($request->vehicle_model);
                $vehicle_color                = $request->vehicle_color;
                Customer_Detail::updateCustomerDetail($customer_detail_id, $customer_licensePlate, $vehicle_id, $vehicle_color);
                return back()->with('customerDetailUpdated');
            }
        }
    }

    public function destroyDetail(Request $request)
    {
        $customer_detail_id                  = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if(!strpos($customer_detail_id, ',') !== false){
            Customer_Detail::deleteCustomerDetail($customer_detail_id);
        } else {
            $customer_detail_ids             = explode(",", $customer_detail_id);
            // INSERT---------------------------------------------------------------------------
            foreach($customer_detail_ids as $item){
                Customer_Detail::deleteCustomerDetail($item);
            }
            // ---------------------------------------------------------------------------------
        }
        // -------------------------------------------------------------------------------------
        return response()->json(['status'=>true, 'message'=>'Data deleted successfuly!']);
    }









    public function getBrandByCategory(Request $request)
    {
        $vehicle_category_id            = $request->category_id;
        $vehicle_brand                  = Vehicle_Brand::getBrandByCategory($vehicle_category_id);
        return response()->json($vehicle_brand);
    }
    public function getModelByBrand(Request $request)
    {
        $vehicle_brand_id               = $request->brand_id;
        $vehicle_model                  = Vehicle_Model::getModelByBrand($vehicle_brand_id);
        return response()->json($vehicle_model);
    }
    public function getCustomerByID(Request $request, $customer_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;

        $customer                       = Customer::getCustomerByID($customer_id, $outlet_id);
        return response()->json([
            'status'    => true,
            'customer'  => $customer
        ]);
    }
    public function getCustomerDetail($customer_detail_id)
    {
        $outlet_id                      = Auth::user()->outlet_id;
        $customer_detail                = Customer_Detail::getCustomerDetailByID($customer_detail_id, $outlet_id);
        return response()->json([
            'customerDetail' => $customer_detail,
            'status'         => true
        ]);

    }
}
