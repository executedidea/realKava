@section('title-tab')
<title>Service Report</title>
@endsection

@section('title')
SERVICES
@endsection

@if ( $report_data[0]->pcustomer == 'all')

@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -47px; text-transform:capitalize;">
        {{ $report_data[0]->pcustomer }} Customer
    </td>
    <td class="head-content" style="padding-top: -47px;"></td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -45px;">As Of </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>

    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -45px;">Periode </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_StartDate)) }}
        s/d
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_EndDate)) }}
    </td>
    @endif
</tr>
@endsection


@section('table-head')
<tr>
    <td style="width:20px;" rowspan="2"><b>No</b></td>
    <td style="width:100px;" rowspan="2"><b>Name</b></td>
    <td style="width:100px;" colspan="2"><b>Date</b></td>
    <td style="width:10px;" rowspan="2"><b>Service & Item</b></td>
    <td style="width:40px;" rowspan="2"><b>Purchased</b></td>
    <td style="width:30px; text-transform:capitalize;" rowspan="2"><b>Status</b></td>
    <td style="width:150px;" rowspan="2"><b>Remark</b></td>
</tr>
@endsection

@section('table-head-sub')
<tr>
    <td style="width:50px;"><b>Check In</b></td>
    <td style="width:50px;"><b>Check Out</b></td>
</tr>
@endsection

@section('title-footer')
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td style="text-transform:capitalize;">{{ $item->customer_fullName }}</td>
        <td>{{ date('d-m-Y', strtotime($item->check_in_time)) }}</td>
        @if ( $item->check_out_time < $item->check_in_time ) <td>-</td>
            @else
            <td>{{ date('d-m-Y', strtotime($item->check_out_time)) }}</td>
            @endif
            <td style="text-transform:capitalize;">{{ $item->item_category }}</td>
            <td style="text-align:right;">{{ number_format($item->item_price) }}</td>
            @if ($item->check_out_status == '0')
            <td>Checked</td>
            @else
            <td>OK</td>
            @endif
            {{-- <td style="text-transform:capitalize;">{{ $item->check_out_status }}</td> --}}
            <td style="text-transform:capitalize;">{{ $item->item_name }}</td>
    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="5"><b>Total</b></td>
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMAllItemPrice) }}</b></td>
        <td><b></b></td>
        <td><b></b></td>
    </tr>
</tfoot>
</table>

</table>

@elseif ( $report_data[0]->pcustomer == 'detail')

@section('title-caption')
<tr>
    <td class="head-content" colspan="7" style="padding-top: -47px; text-transform:capitalize;">
        {{ $report_data[0]->pcustomer }} Customer
    </td>
    <td class="head-content" style="padding-top: -47px;"></td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -45px;">As Of </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>

    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -45px;">Periode </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_StartDate)) }}
        s/d
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_EndDate)) }}
    </td>
    @endif
</tr>
@endsection


@section('table-head')
<tr>
    <td style="width:20px;" rowspan="2"><b>No</b></td>
    <td style="width:100px;" colspan="2"><b>Date</b></td>
    <td style="width:10px;" rowspan="2"><b>Service & Item</b></td>
    <td style="width:40px;" rowspan="2"><b>Purchased</b></td>
    <td style="width:30px; text-transform:capitalize;" rowspan="2"><b>Status</b></td>
    <td style="width:150px;" rowspan="2"><b>Remark</b></td>
</tr>
@endsection

@section('table-head-sub')
<tr>
    <td style="width:50px;"><b>Check In</b></td>
    <td style="width:50px;"><b>Check Out</b></td>
</tr>
@endsection

@section('title-footer')
<tr>
    <td class="head-content">License Number</td>
    <td class="head-content">:</td>
    <td colspan="4" class="head-content">{{ $report_data[0]->customer_detail_licensePlate }}</td>
    <td width="100px"> </td>
    <td class="head-content">Brand</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left" colspan="4">
        {{ $report_data[0]->vehicle_brand_name }}
    </td>

</tr>
<tr>
    <td class="head-content">Customer</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left" colspan="4">
        {{ $report_data[0]->customer_fullName }}
    </td>
    <td> </td>

    <td class="head-content">Model</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left" colspan="4">
        {{ $report_data[0]->vehicle_model_name }}
    </td>
</tr>
<tr>
    <td class="head-content">Phone</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left" colspan="4">
        {{ $report_data[0]->customer_phone }}
    </td>
    <td> </td>

    <td class="head-content">Size</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left" colspan="4">
        {{ $report_data[0]->vehicle_size_name }}
    </td>
</tr>
<tr>
    <td colspan="7"> </td>
    <td class="head-content">Color</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:left; text-transform:capitalize;" colspan="4">
        {{ $report_data[0]->vehicle_color_name }}
    </td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ date('d-m-Y', strtotime($item->check_in_time)) }}</td>
        @if ( $item->check_out_time < $item->check_in_time ) <td>-</td>
            @else
            <td>{{ date('d-m-Y', strtotime($item->check_out_time)) }}</td>
            @endif
            <td style="text-transform:capitalize;">{{ $item->item_category }}</td>
            <td style="text-align:right;">{{ number_format($item->item_price) }}</td>
            @if ($item->check_out_status == '0')
            <td>Checked</td>
            @else
            <td>OK</td>
            @endif
            {{-- <td style="text-transform:capitalize;">{{ $item->check_out_status }}</td> --}}
            <td style="text-transform:capitalize;">{{ $item->item_name }}</td>
    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="4"><b>Total</b></td>
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMItemPrice) }}</b></td>
        <td><b></b></td>
        <td><b></b></td>
    </tr>
</tfoot>
</table>

</table>

@endif

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
