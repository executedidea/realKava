@section('title')
PENJUALAN
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -29px;">Kategori </td>
    <td class="head-content" style="padding-top: -29px;">:</td>
    <td class="head-content" style="padding-top: -29px;">
        @if (count($report_data) === 1)
        {{ $report_data[0]->vehicle_category_name }}
        @elseif (count($report_data) > 1)
        All
        @endif
    </td>
</tr>
<tr>
    <td></td>


    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -20px;">As Of </td>
    <td class="head-content" style="padding-top: -29px;">:</td>
    <td class="head-content" style="padding-top: -29px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>
    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -20px;">Periode </td>
    <td class="head-content">:</td>
    <td class="head-content">
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_StartDate)) }}
        s/d
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_EndDate)) }}
    </td>
    @endif

</tr>
@endsection


@section('title-footer')
<tr>
    <td class="head-content">Total Penjualan</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format($report_data[0]->SUMTotalPayment) }}
    </td>
</tr>

@if (($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2) >=
$report_data[0]->point_of_sales_totalPayment))
<tr>
    <td class="head-content">Total Pembayaran</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format($report_data[0]->SUMTotalPayment) }}
    </td>
</tr>
<tr>
    <td class="head-content">Sisa Pembayaran</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format(($report_data[0]->SUMTotalPayment)-($report_data[0]->SUMTotalPayment)) }}
    </td>
</tr>
@else
<tr>
    <td class="head-content">Total Pembayaran</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2) }}

    </td>
</tr>
<tr>
    <td class="head-content">Sisa Pembayaran</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format(($report_data[0]->SUMTotalPayment)-($report_data[0]->point_of_sales_paid1 + $report_data[0]->point_of_sales_paid2)) }}

    </td>
</tr>
@endif
@endsection


@section('table-head')
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
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td style="text-align:left;">{{ $item->customer_fullName }}</td>
        <td>{{ $item->customer_detail_licensePlate }}</td>
        <td>{{ $item->vehicle_category_name }}</td>
        <td>{{ $item->vehicle_size_name }}</td>
        <td style="text-align:right;">{{ number_format($item->point_of_sales_totalPayment) }}</td>
        @if (($item->point_of_sales_paid1 + $item->point_of_sales_paid2) >= $item->point_of_sales_totalPayment))
        <td style="text-align:right;">{{ number_format($item->point_of_sales_totalPayment) }}</td>
        <td style="text-align:right;">
            {{ number_format(($item->point_of_sales_totalPayment)-($item->point_of_sales_totalPayment)) }}</td>
        @else
        <td style="text-align:right;">{{ number_format($item->point_of_sales_paid1 + $item->point_of_sales_paid2) }}
        </td>
        <td style="text-align:right;">
            {{ number_format(($item->point_of_sales_paid1 + $item->point_of_sales_paid2)-($item->point_of_sales_totalPayment)) }}
        </td style="text-align:right;">
        @endif
    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="5"><b>Total</b></td>
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>

        @if (($item->point_of_sales_paid1 + $item->point_of_sales_paid2) >= $item->point_of_sales_totalPayment))
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>
        <td style="text-align:right;">
            <b>{{ number_format(($item->point_of_sales_totalPayment)-($item->point_of_sales_totalPayment)) }}</b></td>

        @else
        <td style="text-align:right;">
            <b>{{ number_format($item->point_of_sales_paid1 + $item->point_of_sales_paid2) }}</b>
        </td>
        <td style="text-align:right;">
            <b>{{ number_format(($item->point_of_sales_paid1 + $item->point_of_sales_paid2)-($item->point_of_sales_totalPayment)) }}</b>
        </td>
        @endif
    </tr>
</tfoot>
</table>

{{-- <table class="table-head">
    <tfoot>
        <tr>
            <td colspan="5" width="357px"><b>Total</b></td>
            <td width="57px"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>
@if (($item->point_of_sales_paid1 + $item->point_of_sales_paid2) >= $item->point_of_sales_totalPayment))
<td width="120px"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>
<td width="157px"><b>{{ number_format(($item->point_of_sales_totalPayment)-($item->point_of_sales_totalPayment)) }}</b>
</td>

@else
<td width="120px"><b>{{ number_format($item->point_of_sales_paid1 + $item->point_of_sales_paid2) }}</b></td>
<td width="157px">
    <b>{{ number_format(($item->point_of_sales_paid1 + $item->point_of_sales_paid2)-($item->point_of_sales_totalPayment)) }}</b>
</td>
@endif
</tr>
</tfoot>
</table> --}}


<div class="page-no">
    <script type="text/php">
        if (isset($pdf)) {
            $x = 285;
            $y = 810;
            $text = "Page {PAGE_NUM}";
            $font = null;
            $size = 9;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</div>
</body>

</html>
