<?php

namespace App\Http\Controllers\POS\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentReport;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;

// use Barryvdh\Snappy\Facade as PDF;



class PaymentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pos.report.payment-report.index');
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
        $validator                     = Validator::make($request->all(), [
            'vehicle_category'                  => 'required',
            'period_StartDate'                  => 'required',
            'period_EndDate'                    => 'required',
            'asof_StartDate'                    => 'required',
            'asof_EndDate'                      => 'required',
            'outlet_name_report'                => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $period_StartDate                   = $request->period_StartDate;
            $period_EndDate                     = $request->period_EndDate;
            $asof_StartDate                     = $request->asof_StartDate;
            $asof_EndDate                       = $request->asof_EndDate;
            $filter_date                        = $request->filter_date;
            $vehicle_category                   = $request->vehicle_category;
            $outlet_id                          = Auth::user()->outlet_id;
            $name                               = Auth::user()->name;
            $date_now                           = date('d-m-Y H:i:s');
            // $carwash_data                       = PaymentReport::getCarwashData($outlet_id);
            // $report_data                        = PaymentReport::getReportData($outlet_id, $period_StartDate, $period_EndDate, $asof_StartDate, $asof_EndDate, $filter_date, $vehicle_category);
            // dd($report_data);
            if(empty($report_data)) {              
                return back()->with('alert', 'Data kosong');   
            } elseif(!empty($report_data)) {
                $pdf                                = PDF::loadView('pos/report/payment-report/pdf', compact('carwash_data', 'name', 'date_now', 'report_data'));
                // return $pdf->stream('PaymentReport-pdf.pdf');
                return $pdf->download('PaymentReport-pdf (' . date('d-m-Y') . ').pdf');
            }
        }
    }
}
