<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <title>Sales Report</title>

    <style>
        /* PDF */
        @page {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .author {
            font-size: 7px;
            text-align: right;
            position: fixed;
            top: -30px;
            right: -10px;
        }

        .head-content {
            font-size: 11px;
        }

        .head-title {
            font-size: 13px;
            font-weight: bold;
        }

        .table-head {
            font-size: 11px;
            border-collapse: collapse;
            text-align: center;
        }

        .table-head tr td {
            border: 1px solid #000;
        }

        .table-content {
            /* border: 1px solid white; */
            /* background-color: red; */
        }

        .page-no {
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 9px;
        }

        thead {
            position: fixed;
        }

        .head-nominal {
            text-align: right;
        }

    </style>
</head>

<body>
    <div class="author">
        User: {{ $name }} | Print: {{ $date_now }}
    </div>
    <table border="0">

        <tr>
            <td class="logo" rowspan="4">
                <?php $image_path = 'storage/images/outlet_logo/thumbnails/' . $carwash_data[0]->outlet_logo ; ?>
                <img src="{{ $image_path }}" height="75px">
            </td>
            <td></td>
            <td class="head-title" colspan="3">LAPORAN PENJUALAN</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3">{{ $carwash_data[0]->outlet_name }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3" style="padding-top: -15px;">
                {{ $carwash_data[0]->outlet_detail_address }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="head-content" colspan="3" style="padding-top: -29px;">Kategori :
                @if (count($report_data) === 1)
                {{ $report_data[0]->vehicle_category_name }}
                @elseif (count($report_data) > 1)
                All
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>


            @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
            <td class="head-content" colspan="3" style="padding-top: -20px;">As Of :
                {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
            </td>
            @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
            <td class="head-content" colspan="3" style="padding-top: -20px;">Periode :
                {{ date('d-m-Y', strtotime($report_data[0]->pperiod_StartDate)) }}
                s/d
                {{ date('d-m-Y', strtotime($report_data[0]->pperiod_EndDate)) }}
            </td>
            @endif

        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td class="head-content">Total Penjualan</td>
            <td class="head-content">:</td>
            <td class="head-content head-nominal">{{ number_format($report_data[0]->SUMTotalPayment) }}</td>
        </tr>

        @if (($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2) >=
        $report_data[0]->point_of_sales_totalPayment))
        <tr>
            <td class="head-content">Total Penerimaan</td>
            <td class="head-content">:</td>
            <td class="head-content head-nominal">{{ number_format($report_data[0]->SUMTotalPayment) }}</td>
        </tr>
        <tr>
            <td class="head-content">Sisa Penerimaan</td>
            <td class="head-content">:</td>
            <td class="head-content head-nominal">
                {{ number_format(($report_data[0]->SUMTotalPayment)-($report_data[0]->SUMTotalPayment)) }}</td>
        </tr>
        @else
        <tr>
            <td class="head-content">Total Penerimaan</td>
            <td class="head-content">:</td>
            <td class="head-content head-nominal">
                {{ number_format($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2) }}</td>
        </tr>
        <tr>
            <td class="head-content">Sisa Penerimaan</td>
            <td class="head-content">:</td>
            <td class="head-content head-nominal">
                {{ number_format(($report_data[0]->SUMTotalPayment)-($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2)) }}
            </td>
        </tr>
        @endif

        <tr>
            <td height="10"></td>
        </tr>



    </table>
    <table class="table-head" width="100%">
        <thead>
            <tr>
                <td style="width:20px;"><b>No</b></td>
                <td style="width:150px;"><b>Customer</b></td>
                <td style="width:70px;"><b>Plat Nomor</b></td>
                <td style="width:60px;"><b>Jenis</b></td>
                <td style="width:70px;"><b>Ukuran</b></td>
                <td style="width:75;"><b>Harga</b></td>
                <td style="width:75;"><b>Pembayaran</b></td>
                <td style="width:75;"><b>Sisa</b></td>
            </tr>
        </thead>
