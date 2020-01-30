@section('title-tab')
<title>Payment Report</title>
@endsection

@section('title')
PAYMENT
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -45px; text-transform: capitalize;">
        Payment Type
    </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px; text-transform: capitalize;">
        {{ $report_data[0]->ppayment_type }}
    </td>
</tr>
<tr>
    <td></td>
    <td class="head-content" colspan="3" style="padding-top: -45px; text-transform: capitalize;">
        Payment Source
    </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px; text-transform: capitalize;">
        {{ $report_data[0]->ppayment_source }}
    </td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -20px;">As Of </td>
    <td class="head-content" style="padding-top: -20px;">:</td>
    <td class="head-content" style="padding-top: -20px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>

    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -20px;">Periode </td>
    <td class="head-content" style="padding-top: -20px;">:</td>
    <td class="head-content" style="padding-top: -20px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_StartDate)) }}
        s/d
        {{ date('d-m-Y', strtotime($report_data[0]->pperiod_EndDate)) }}
    </td>
    @endif

</tr>
@endsection


@section('table-head')
<tr>
    <td style="width:20px;"><b>No</b></td>
    <td style="width:40px;"><b>Date</b></td>
    <td style="width:30px;"><b>Description</b></td>
    <td style="width:40px;"><b>Amount</b></td>
    <td style="width:40px;"><b>Method</b></td>
    <td style="width:120px;"><b>Remark</b></td>
</tr>
@endsection

@section('table-head-sub')
@endsection

@section('title-footer')
<tr>
    <td height="25px"></td>
</tr>
<tr>
    <td class="head-content" style="padding-top: 0px;">Total Payment</td>
    <td class="head-content" style="padding-top: 0px;">:</td>
    <td class="head-content" style="padding-top: 0px; text-align:right;">{{ number_format($report_data[0]->SUMAmount) }}
    </td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ date('d-m-Y', strtotime($item->petty_cash_detail_date)) }}</td>
        <td style="text-transform:capitalize;">{{ $item->petty_cash_detail_category }}</td>
        <td style="text-align:right;">{{ number_format($item->petty_cash_detail_amount) }}</td>
        <td style="text-transform:capitalize;">{{ $item->petty_cash_detail_paymentMethod }}</td>
        <td style="text-align:left;">{{ $item->petty_cash_detail_desc }}</td>
    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="3"><b>Total</b></td>
        <td style="text-align:right;"><b>{{ number_format($report_data[0]->SUMAmount) }}</b></td>
        <td><b></b></td>
        <td><b></b></td>
    </tr>
</tfoot>
</table>

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
