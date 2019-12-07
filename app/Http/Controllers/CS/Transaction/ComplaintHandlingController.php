<?php

namespace App\Http\Controllers\CS\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComplaintHandling;
use Illuminate\Support\Facades\Auth;

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
            $complaint_handling                     = ComplaintHandling::getComplaintHandlingList($outlet_id);
            return view('cs.transaction.complaint-handling.index', compact('complaint_handling'));

    }

    public function getLicensePlate(Request $request)
    {
        if($request->license_plate){
            $customer_detail_licensePlate           = $request->license_plate;
            $licensePlate                           = ComplaintHandling::getLicensePlate($customer_detail_licensePlate);

            return response()->json([
                'status'    => true,
                'licensePlate'  => $licensePlate
            ]);
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}