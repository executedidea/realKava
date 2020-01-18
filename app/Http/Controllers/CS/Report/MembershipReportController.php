<?php

namespace App\Http\Controllers\CS\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipReport;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;

// use Barryvdh\Snappy\Facade as PDF;



class MembershipReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $outlet_all     = MembershipReport::getOutletAll($outlet_id);
        return view('cs.report.membership-report.index', compact('outlet_all'));
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
            $membership                         = $request->membership;
            $period_StartDate                   = $request->period_StartDate;
            $period_EndDate                     = $request->period_EndDate;
            $asof_StartDate                     = $request->asof_StartDate;
            $asof_EndDate                       = $request->asof_EndDate;
            $filter_date                        = $request->filter_date;

            $outlet_id                          = Auth::user()->outlet_id;
            $name                               = Auth::user()->name;
            $date_now                           = date('d-m-Y H:i:s');
            $carwash_data                       = MembershipReport::getCarwashData($outlet_id);
            $report_data                        = MembershipReport::getReportData($outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $membership);
            // dd($report_data);
            // if(empty($report_data)) {              
            //     return back()->with('alert', 'Data kosong');   
            // } elseif(!empty($report_data)) {
                $pdf                                = PDF::loadView('cs/report/membership-report/pdf', compact('name', 'date_now', 'carwash_data', 'report_data'));
                return $pdf->stream('MembershipReport-pdf.pdf');
                // return $pdf->download('MembershipReport-pdf (' . date('d-m-Y') . ').pdf');
            // }
        // }
    }
}
