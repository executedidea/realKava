<?php

namespace App\Http\Controllers\POS\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReport;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\Snappy\Facade as PDF;



class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $outlet_all     = SalesReport::getOutletAll($outlet_id);
        $vehicle_category_all     = SalesReport::getVehicleCategory();
        return view('pos.report.sales-report.index', compact('outlet_all', 'vehicle_category_all'));
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
        $period_StartDate                   = $request->period_StartDate;
        $period_EndDate                     = $request->period_EndDate;
        $vehicle_category                   = $request->vehicle_category;
        $outlet_id                          = Auth::user()->outlet_id;
        $name                               = Auth::user()->name;
        $date_now                           = date('d-m-Y H:i:s');
        $carwash_data                       = SalesReport::getCarwashData($outlet_id);
        $report_data                        = SalesReport::getReportData($outlet_id, $period_StartDate, $period_EndDate, $vehicle_category);
        // dd($report_data);
        $pdf                                = PDF::loadView('pos/report/sales-report/pdf', compact('carwash_data', 'name', 'date_now', 'report_data'));
        return $pdf->stream('SalesReport-pdf.pdf');
        // return $pdf->download('SalesReport-pdf.pdf');
    }
}
