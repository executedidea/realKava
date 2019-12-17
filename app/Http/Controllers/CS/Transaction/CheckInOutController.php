<?php

namespace App\Http\Controllers\CS\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CheckInOut;
use App\Models\CheckInOutDetail;
use App\Models\ComplaintType;
use App\Models\Customer_Detail;
use App\Models\Feedback;
use App\Models\Item;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckInOutController extends Controller
{
    //
    public function index()
    {
        $outlet_id              = Auth::user()->outlet_id;
        $checked_in_customer    = CheckInOut::getTodayCustomer($outlet_id);
        $customer_detail        = Customer_Detail::getAllCustomerDetail($outlet_id);
        $items                  = Item::getServiceItemByOutletID($outlet_id);
        $complaint_type         = ComplaintType::getComplaintTypeList();

        return view('cs.transaction.check-in-out.index', compact('customer_detail', 'checked_in_customer', 'items', 'complaint_type'));
    }

    public function store(Request $request)
    {
        $validator              = Validator::make($request->all(), [
            'item_id'           => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        } else {
            if(count(CheckInOut::all()) == 0){
                $check_in_id    = 1;
            } else {
                $check_in_lastID= CheckInOut::getCheckInLastID();
                $check_in_id    = $check_in_lastID[0]->check_in_id+1;
            }
            if(count(CheckInOutDetail::all()) == 0){
                $check_in_detail_id    = 1;
            } else {
                $check_in_detail_lastID= CheckInOutDetail::getCheckInDetailLastID();
                $check_in_detail_id    = $check_in_detail_lastID[0]->check_in_detail_id+1;
            }

            $customer_detail_id = $request->customer_detail_id;
            $check_in_time      = date('Y-m-d H:i:s');
            $outlet_id          = Auth::user()->outlet_id;

            CheckInOut::setInsertCheckIn($check_in_id, $customer_detail_id, $check_in_time, $outlet_id);
            $i = 0;
            foreach($request->item_id as $item){
                CheckInOutDetail::setInsertCheckInDetail($check_in_detail_id+$i++, $check_in_id, $item);
            }
            return back()->with('checkedIn');
        }
    }

    public function checkOut(Request $request, $check_in_id)
    {
        $validator              = Validator::make($request->all(), [
            'feedback_category'          => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        } else {
            $outlet_id = Auth::user()->outlet_id;
            if(count(Feedback::getFeedbackLastID()) == 0){
                $feedback_id     = 1;
            } else {
                $feedback_lastID = Feedback::getFeedbackLastID();
                $feedback_id     = $feedback_lastID[0]->feedback_id+1;
            }
            $i =0;
            foreach($request->feedback_category as $index => $item){
                Feedback::setInsertFeedback($feedback_id+$i++, $request->feedback_key[$index], $check_in_id, $request->keterangan, $item, 'good', $outlet_id);
                if($item <= 3) {
                    dump($item);
                }
            }die;
            $check_out_time = date('Y-m-d H:i:s');
            CheckInOut::setUpdateCheckIn($check_in_id, $check_out_time);
            return back()->with('checkedOut');
        }
    }


































    public function searchCustomer(Request $request)
    {
        $customer               = Customer_Detail::searchCustomerDetailByKey($request->q);
        return response()->json($customer);
    }

    public function getCustomerDetailByID($customer_detail)
    {
        $outlet_id              = Auth::user()->outlet_id;
        $customer               = Customer_Detail::getCustomerDetailByID($customer_detail, $outlet_id);

        return response()->json($customer);
    }

    public function getServiceItem($outlet_id)
    {
        $outlet_id              = Auth::user()->outlet_id;
        $item                   = Item::getServiceItemByOutletID($outlet_id);

        return response()->json($item);
    }

    public function getCheckedInCustomerDetail($customer_id)
    {
        $outlet_id              = Auth::user()->outlet_id;
        $customer_detail        = CheckInOutDetail::getCheckInDetail($outlet_id, $customer_id);

        return response()->json($customer_detail);
    }

    public function getCheckedInCustomer($customer_id)
    {
        $outlet_id              = Auth::user()->outlet_id;
        $customer               = CheckInOut::getCheckedInCustomerByID($outlet_id, $customer_id);

        return response()->json($customer);
    }
}
