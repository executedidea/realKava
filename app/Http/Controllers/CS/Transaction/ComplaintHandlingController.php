<?php

namespace App\Http\Controllers\CS\Transaction;

use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComplaintHandling;
use App\Models\ComplaintType;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintHandlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $outlet_id                                  = Auth::user()->outlet_id;
        if($request->license_plate){
            $customer_detail_licensePlate           = $request->license_plate;
            $complaint_handling                     = ComplaintHandling::getComplaintHandlingList($outlet_id);
            $item_list                              = Item::getAllItem($outlet_id);
            $complaint_type_list                    = ComplaintType::getComplaintTypeList($outlet_id);
            return view('cs.transaction.complaint-handling.index', compact('complaint_handling', 'item_list', 'complaint_type_list'));
        } else {
            $complaint_customer_list                = ComplaintHandling::getCustomerLicenseList($outlet_id);
            $complaint_handling                     = ComplaintHandling::getComplaintHandlingList($outlet_id);
            $item_list                              = Item::getAllItem($outlet_id);
            $complaint_type_list                    = ComplaintType::getComplaintTypeList($outlet_id);
            return view('cs.transaction.complaint-handling.index', compact('complaint_handling','complaint_customer_list', 'item_list', 'complaint_type_list'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator                     = Validator::make($request->all(), [
            'customer_name'                     => 'required',
            'vehicle'                           => 'required',
            'license_plate'                     => 'required',
            'complaint_handling_date'           => 'required',
            'complaint_handling_targetDate'     => 'required',
            'complaint_handling_handler'        => 'required|min:3',
            'complaint_handling_status'         => 'required',
            'complaint_handling_desc'           => 'required',
            'complaint_handling_fee'            => 'required',
            'complaint_type_id'                 => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $outlet_id              = Auth::user()->outlet_id;

            if (count(ComplaintHandling::all()) <= 0) {
                $complaint_handling_id             = 1;
            } else {
                $complaint_handling_lastID         = ComplaintHandling::getComplaintHandlingLastID();
                $complaint_handling_id             = $complaint_handling_lastID[0]->complaint_handling_id + 1;
            }

            if (count(ComplaintType::all()) <= 0) {
                $complaint_type_id             = 1;
            } else {
                $complaint_type_lastID         = ComplaintType::getComplaintTypeLastID();
                $complaint_type_id             = $complaint_type_lastID[0]->complaint_type_id + 1;
            }

            $complaint_handling_date            = $request->complaint_handling_date;
            $complaint_handling_targetDate      = $request->complaint_handling_targetDate;
            $complaint_handling_handler         = $request->complaint_handling_handler;
            $complaint_handling_status          = $request->complaint_handling_status;
            $complaint_handling_desc            = $request->complaint_handling_desc;
            $complaint_handling_fee             = $request->complaint_handling_fee;
            $customer_detail_id                 = $request->customer_detail_id;
            $complaint_type_id                  = $request->complaint_type_id;
            $item_id                            = $request->item_id;

            ComplaintHandling::setComplaintHandling(
                $complaint_handling_id, 
                $complaint_handling_date,
                $complaint_handling_targetDate,
                $complaint_handling_handler,
                $complaint_handling_status,
                $complaint_handling_desc,
                $complaint_handling_fee,
                $customer_detail_id,
                $complaint_type_id,
                $item_id,
                $outlet_id
            );

            return back()->with('complaintHandlingAdded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $complaint_handling_id)
    {
        // $validator                     = Validator::make($request->all(), [
        //     'customer_name'                     => 'required',
        //     'vehicle'                           => 'required',
        //     'license_plate'                     => 'required',
        //     'complaint_handling_date'           => 'required',
        //     'complaint_handling_targetDate'     => 'required',
        //     'complaint_handling_handler'        => 'required',
        //     'complaint_handling_status'         => 'required',
        //     'complaint_handling_desc'           => 'required',
        //     'complaint_handling_fee'            => 'required',
        //     'complaint_type_id'                 => 'required'
        // ]);
        // if ($validator->fails()) {
            // return back()->withErrors($validator);
        // } else {
            if (count(ComplaintHandling::all()) <= 0) {
                $complaint_handling_detail_id             = 1;
            } else {
                $complaint_handling_detail_lastID         = ComplaintHandling::getComplaintHandlingDetailLastID();
                $complaint_handling_detail_id             = $complaint_handling_detail_lastID[0]->complaint_handling_detail_id + 1;
            }

            $complaint_handling_status          = $request->complaint_handling_status;
            $complaint_handling_detail_status   = $request->complaint_handling_status;
            $complaint_handling_detail_desc     = $request->complaint_handling_desc;
            $complaint_handling_id              = $request->complaint_handling_id;

            ComplaintHandling::setUpdateComplaintHandlingDetailStatus(
                $complaint_handling_detail_id, 
                $complaint_handling_detail_status, 
                $complaint_handling_detail_desc, 
                $complaint_handling_status, 
                $complaint_handling_id
            ); 

            return back()->with('complaintHandlingEdited');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $complaint_handling_id                    = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if (!strpos($complaint_handling_id, ',') !== false) {
            ComplaintHandling::setDeleteComplaintHandling($complaint_handling_id);
        } else {
            $complaint_handling_ids               = explode(",", $complaint_handling_id);
            foreach ($complaint_handling_ids as $item) {
                ComplaintHandling::setDeleteComplaintHandling($item);
            }
        }
        // -------------------------------------------------------------------------------------

        return response()->json(['status' => true, 'message' => 'Complaint Handling deleted successfuly!']);
    }

    public function getComplaintCustomer($customer_detail_licensePlate)
    {
        $outlet_id                          = Auth::user()->outlet_id;
        $license_plate                      = ComplaintHandling::getCustomerVehicleLicenseByLicense($customer_detail_licensePlate, $outlet_id);
        
        return response()->json([
            'status'    => true,
            'license_plate'  => $license_plate
        ]);
    }

    public function getComplaintCustomerByID($complaint_handling_id)
    {
        $outlet_id                          = Auth::user()->outlet_id;
        $complaint_customer                 = ComplaintHandling::getComplaintCustomerByID($outlet_id, $complaint_handling_id);
        return response()->json([
            'status'    => true,
            'complaint_customer'  => $complaint_customer
        ]);
    }

    public function testPrint(Request $request)
    {
        $outlet_id                                  = Auth::user()->outlet_id;
        $complaint_handling                     = ComplaintHandling::getComplaintHandlingList($outlet_id);
        return view('cs.transaction.complaint-handling.testprint', compact('complaint_handling'));
    }

    // public function testPrint()
    // {
    //     $ip = '192.168.100.9'; // IP Komputer kita atau printer lain yang masih satu jaringan
    //     $printer = 'RP58EN'; // Nama Printer yang di sharing
    //         $connector = new WindowsPrintConnector("smb://" . $ip . "/" . $printer);
    //         $printer = new Printer($connector);
    //         $printer -> text("Email :");
    //         $printer -> text("Username:");
    //         $printer -> cut();
    //         $printer -> close();
    // }
    
    // public function getComplaintCustomerID($customer_detail_licensePlate)
    // {
    //     $outlet_id                          = Auth::user()->outlet_id;
    //     $license_plate                      = ComplaintHandling::getCustomerVehicleLicenseByLicense($customer_detail_licensePlate, $outlet_id);
    //     return response()->json([
    //         'status'    => true,
    //         'license_plate'  => $license_plate
    //     ]);
    // }
}
