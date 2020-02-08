<?php

namespace App\Http\Controllers\POS\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CloseStoreReport;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;

// use Barryvdh\Snappy\Facade as PDF;



class CloseStoreReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id      = Auth::user()->outlet_id;
        $outlet_all     = CloseStoreReport::getOutletAll($outlet_id);
        $vehicle_category_all     = CloseStoreReport::getVehicleCategory();
        return view('pos.report.close-store-report.index', compact('outlet_all', 'vehicle_category_all'));
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
            $close_store_date                   = $request->close_store_date;
            
            $outlet_id                          = Auth::user()->outlet_id;
            $name                               = Auth::user()->name;
            $date_now                           = date('d-m-Y H:i:s');
            $carwash_data                       = CloseStoreReport::getCarwashData($outlet_id);
            $report_data                        = CloseStoreReport::getReportData($outlet_id, $close_store_date);
            $report_data_tbl                    = CloseStoreReport::getReportDataTable($outlet_id, $close_store_date);
            
            // dd($report_data);
            // if(empty($report_data)) {              
            //     return redirect()->back()->with('alert', 'Data kosong');   
            // } elseif(!empty($report_data)) {
                $pdf                                = PDF::loadView('pos/report/close-store-report/pdf', compact('carwash_data', 'name', 'date_now', 'report_data', 'report_data_tbl'));
                return $pdf->stream('CloseStoreReport-pdf.pdf');
                // return $pdf->download('SalesReport-pdf (' . date('d-m-Y') . ').pdf');
            // }
        // }
    }
}
