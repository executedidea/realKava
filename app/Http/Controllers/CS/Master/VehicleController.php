<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Vehicle_Brand;
use App\Models\Vehicle_Category;
use App\Models\Vehicle_Color;
use App\Models\Vehicle_Model;
use App\Models\Vehicle_Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    //
    public function index()
    {
        $vehicle_category               = Vehicle_Category::getAllCategory();
        $vehicle_size                   = Vehicle_Size::getAllSize();
        $vehicle_color                  = Vehicle_Color::getAllColor();
        $vehicles                       = Vehicle::getAllVehicle();

        return view('cs.master.vehicle.index', compact('vehicle_category', 'vehicle_size', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validator                      = Validator::make($request->all(), [
            'vehicle_brand'             => 'required|string',
            'vehicle_model'             => 'required|string'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Brand Condition--------------------------------------------------------
            if (count(Vehicle_brand::all()) <= 0) {
                $vehicle_brand_id       = 1;
            } else {
                $vehicle_brand_lastID   = Vehicle_Brand::getVehicleBrandLastID();
                $vehicle_brand_id       = $vehicle_brand_lastID[0]->vehicle_brand_id + 1;
            }
            // -----------------------------------------------------------------------
            // Model Condition--------------------------------------------------------
            if (count(Vehicle_Model::all()) <= 0) {
                $vehicle_model_id       = 1;
            } else {
                $vehicle_model_lastID   = Vehicle_Model::getVehicleModelLastID();
                $vehicle_model_id       = $vehicle_model_lastID[0]->vehicle_model_id + 1;
            }
            // ------------------------------------------------------------------------
            // Vehicle Condition-------------------------------------------------------
            if (count(Vehicle::all()) <= 0) {
                $vehicle_id             = 1;
            } else {
                $vehicle_lastID         = Vehicle::getVehicleLastID();
                $vehicle_id             = $vehicle_lastID[0]->vehicle_id + 1;
            }
            // ------------------------------------------------------------------------

            $vehicle_category_id        = $request->vehicle_category;
            $vehicle_brand_name         = $request->vehicle_brand;
            $vehicle_model_name         = $request->vehicle_model;
            $vehicle_size_id            = $request->vehicle_size;

            Vehicle::insertVehicle(
                $vehicle_category_id,
                $vehicle_brand_id,
                $vehicle_brand_name,
                $vehicle_model_id,
                $vehicle_model_name,
                $vehicle_id,
                $vehicle_size_id
            );

            return back()->with('vehicleAdded');
        }
    }

    public function update(Request $request, $vehicle_id)
    {
        $validator                     = Validator::make($request->all(), [
            'vehicle_category_id'      => 'required',
            'vehicle_brand_name'       => 'required',
            'vehicle_model_name'       => 'required',
            'vehicle_size_id'          => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $vehicle_category_id        = $request->vehicle_category_id;
            $vehicle_brand_id           = $request->vehicle_brand_id;
            $vehicle_brand_name         = $request->vehicle_brand_name;
            $vehicle_model_id           = $request->vehicle_model_id;
            $vehicle_model_name         = $request->vehicle_model_name;
            $vehicle_id                 = $vehicle_id;
            $vehicle_size_id            = $request->vehicle_size_id;

            Vehicle::updateVehicle($vehicle_brand_id, $vehicle_brand_name, $vehicle_model_id, $vehicle_model_name, $vehicle_category_id, $vehicle_id, $vehicle_size_id);
            return back()->with('vehicleEdited');
        }
    }

    public function destroy(Request $request)
    {
        $vehicle_id                    = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if (!strpos($vehicle_id, ',') !== false) {
            Vehicle::deleteVehicle($vehicle_id);
        } else {
            $customer_ids               = explode(",", $vehicle_id);
            foreach ($customer_ids as $item) {
                Vehicle::deleteVehicle($item);
            }
        }
        // -------------------------------------------------------------------------------------

        return response()->json(['status' => true, 'message' => 'Vehicle deleted successfuly!']);
    }



    public function getVehicleByID($vehicle_id)
    {
        $vehicle = Vehicle::getVehicleByID($vehicle_id);
        return response()->json([
            'status'    => true,
            'vehicle'  => $vehicle
        ]);
    }
}
