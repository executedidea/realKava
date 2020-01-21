<?php

namespace App\Http\Controllers\CS\Report;

use App\Http\Controllers\Controller;
use App\Models\CheckInOutReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;

// use Barryvdh\Snappy\Facade as PDF;



class CheckInOutReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $outlet_all     = CheckInOutReport::getOutletAll($outlet_id);
        return view('cs.report.check-in-out-report.index', compact('outlet_all'));
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

    public function reportPDF(Request $request)
    {
        // $validator                     = Validator::make($request->all(), [
        //     'vehicle_category'                  => 'required',
        //     'period_StartDate'                  => 'required',
        //     'period_EndDate'                    => 'required',
        //     'asof_StartDate'                    => 'required',
        //     'asof_EndDate'                      => 'required',
        //     'outlet_name_report'                => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator);
        // } else {
            $status                             = $request->status;
            $check_in_out_date                  = $request->check_in_out_date;

            $outlet_id                          = Auth::user()->outlet_id;
            $name                               = Auth::user()->name;
            $date_now                           = date('d-m-Y H:i:s');
            $carwash_data                       = CheckInOutReport::getCarwashData($outlet_id);
            $report_data                        = CheckInOutReport::getReportData($outlet_id, $status, $check_in_out_date);
            // dd($report_data);
            // if(empty($report_data)) {              
            //     return back()->with('alert', 'Data kosong');   
            // } elseif(!empty($report_data)) {
                $pdf                            = PDF::loadView('cs/report/check-in-out-report/pdf', compact('name', 'date_now', 'carwash_data', 'report_data'));
                return $pdf->stream('CheckInOutReport-pdf.pdf');
                // return $pdf->download('CheckInOutReport-pdf (' . date('d-m-Y') . ').pdf');
            // }
        // }
    }
}
