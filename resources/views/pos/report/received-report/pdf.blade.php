@section('title-tab')
<title>Received Report</title>
@endsection

@section('title')
RECEIVED
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -45px;">Payment Method </td>
    <td class="head-content" style="padding-top: -45px;">:</td>

    @if ($report_data[0]->ppayment_method == '1')
    <td class="head-content" style="padding-top: -45px;">Cash</td>
    @elseif ($report_data[0]->ppayment_method == '2')
    <td class="head-content" style="padding-top: -45px;">Debit</td>
    @elseif ($report_data[0]->ppayment_method == '3')
    <td class="head-content" style="padding-top: -45px;">Credit</td>
    @elseif ($report_data[0]->ppayment_method == '4')
    <td class="head-content" style="padding-top: -45px;">GoPay</td>
    @elseif ($report_data[0]->ppayment_method == '5')
    <td class="head-content" style="padding-top: -45px;">OVO</td>
    @elseif ($report_data[0]->ppayment_method == '6')
    <td class="head-content" style="padding-top: -45px;">All</td>
    @endif
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


@section('title-footer')
<tr>
    <td class="head-content" style="height:10px;"></td>
</tr>
<tr>
    <td class="head-content">Total Received</td>
    <td class="head-content">:</td>
    <td class="head-content head-nominal">
        {{ number_format($report_data[0]->SUMTotalReceived) }}
    </td>
</tr>
@endsection


@section('table-head')
<tr>
    <td style="width:5px;"><b>No</b></td>
    <td style="width:50px;"><b>Date</b></td>
    <td style="width:120px;"><b>Description</b></td>
    <td style="width:20px;"><b>Method</b></td>
    <td style="width:20px;"><b>Qty.</b></td>
    <td style="width:20px;"><b>Amount</b></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ date('d-m-Y', strtotime($item->point_of_sales_date)) }}</td>
        <td style="text-transform:capitalize; text-align:center;">{{ $item->item_name }}</td>
        <td>
            @if ($item->point_of_sales_paymentMethod1 == '1')
            Cash
            @elseif ($item->point_of_sales_paymentMethod1 == '2')
            Debit
            @elseif ($item->point_of_sales_paymentMethod1 == '3')
            Credit
            @elseif ($item->point_of_sales_paymentMethod1 == '4')
            GoPay
            @elseif ($item->point_of_sales_paymentMethod1 == '5')
            OVO
            @endif
        </td>
        <td style="text-align:center;">{{ $item->point_of_sales_detail_quantity }}</td>
        <td style="text-align:right;">{{ number_format($item->item_price) }}</td>
        {{-- <td>{{ $item->point_of_sales_detail_quantity }}</td> --}}


    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="5"><b>Total</b></td>
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMTotalReceived) }}</b></td>

    </tr>
</tfoot>
</table>


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
