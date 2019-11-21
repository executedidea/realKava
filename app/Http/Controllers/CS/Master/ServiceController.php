<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vehicle_Category;
use App\Models\Vehicle_Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    public function index()
    {
        $outlet_id              = Auth::user()->outlet_id;
        $vehicle_category       = Vehicle_Category::getAllCategory();
        $vehicle_size           = Vehicle_Size::getAllSize();
        $services               = Service::getServiceByOutletID($outlet_id);

        return view('cs.master.service.index', compact('services', 'vehicle_category', 'vehicle_size'));
    }
    public function update(Request $request, $service_id)
    {
        $validator              = Validator::make($request->all(), [
            'service_name'      => 'required',
            'service_price'     => 'required',
            'vehicle_category'  => 'required',
            'vehicle_size'      => 'required'
        ]);

        if ($validator->fails()) {
            dd('hehe');
        } else {
            $service_name       = $request->service_name;
            $vehicle_category   = $request->vehicle_category;
            $vehicle_size       = $request->vehicle_size;
            $service_price      = $request->service_price;

            Service::updateService($service_id, $service_name, $vehicle_category, $vehicle_size, $service_price);
            return back()->with('serviceEdited');
        }
    }
    public function store(Request $request)
    {
        $validator              = Validator::make($request->all(), [
            'service_name'      => 'required',
            'service_price'     => 'required',
            'vehicle_category'  => 'required',
            'vehicle_size'      => 'required'
        ]);

        if ($validator->fails()) {
            dd('hehe');
        } else {
            // Service Condition
            if (count(Service::all()) <= 0) {
                $service_id     = 1;
            } else {
                $service_lastID = Service::getServiceLastID();
                $service_id     = $service_lastID[0]->service_id + 1;
            }
            $outlet_id          = Auth::user()->outlet_id;
            $service_name       = $request->service_name;
            $vehicle_category   = $request->vehicle_category;
            $vehicle_size       = $request->vehicle_size;
            $service_price      = $request->service_price;

            Service::insertService($service_id, $service_name, $vehicle_category, $vehicle_size, $service_price, $outlet_id);
            return back()->with('serviceAdded');
        }
    }

    public function destroy(Request $request)
    {
        $service_id                    = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if (!strpos($service_id, ',') !== false) {
            Service::deleteService($service_id);
        } else {
            $service_ids               = explode(",", $service_id);
            foreach ($service_ids as $item) {
                Service::deleteService($item);
            }
        }
        // -------------------------------------------------------------------------------------

        return response()->json(['status' => true, 'message' => 'Service deleted successfuly!']);
    }






    public function getServiceByID($service_id)
    {
        $service = Service::getServiceByID($service_id);
        return response()->json([
            'status'    => true,
            'service'  => $service
        ]);
    }
}
