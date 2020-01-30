@section('title-tab')
<title>Close Store Report</title>
@endsection

@section('title')
CLOSE STORE
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -45px;">Closing Date </td>
    <td class="head-content" style="padding-top: -45px;">:</td>
    <td class="head-content" style="padding-top: -45px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pclose_store_date)) }}
    </td>
</tr>
@endsection


@section('title-footer')
<tr>
    <td class="head-content"><b>Begining Saldo</b></td>
    <td colspan="4"></td>
    <td width="100px"> </td>
    <td> </td>
    <td class="head-content"><b>Total Sales</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>

</tr>
<tr>
    <td class="head-content">- Cash on Hand</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
    <td> </td>
    <td> </td>


    <td class="head-content"><b>Total Payment</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
</tr>
<tr>
    <td class="head-content">- Previous Balanced</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content"><b>Balanced</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
</tr>

<tr>
    <td class="head-content" style="height:10px;"></td>
</tr>

<tr>
    <td class="head-content" colspan="5"><b>Received</b></td>
    <td> </td>
    <td> </td>
    <td class="head-content"><b>Payment</b></td>
</tr>
<tr>
    <td class="head-content">- Cash</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedCash) }}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content">- Cash</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{ number_format($report_data[0]->TotalPaymentCash) }}
    </td>
</tr>
<tr>
    <td class="head-content">- Debit</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedDebit) }}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content">- Transfer</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{ number_format($report_data[0]->TotalPaymentTransfer) }}
    </td>
</tr>
<tr>
    <td class="head-content">- Credit Card</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedCreditCard) }}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content">- Credit Card</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{ number_format($report_data[0]->TotalPaymentCreditCard) }}
    </td>
</tr>
<tr>
    <td class="head-content">- Charge CC</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedCreditCardCharge) }}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content">- Charge CC</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
</tr>
<tr>
    <td class="head-content">- GoPay</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedGopay) }}
    </td>
    <td> </td>
    <td> </td>
</tr>
<tr>
    <td class="head-content">- OVO</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceivedOvo) }}
    </td>
    <td> </td>
    <td> </td>
</tr>
<tr>
    <td class="head-content"><b>Total Received</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{ number_format($report_data[0]->TotalReceived) }}
    </td>
    <td> </td>
    <td> </td>

    <td class="head-content"><b>Total Payment</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{ number_format($report_data[0]->TotalPayment) }}
    </td>
</tr>

<tr>
    <td class="head-content" style="height:10px;"></td>
</tr>

<tr>
    <td class="head-content"><b>Total Discount</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="3">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>

    <td class="head-content"><b>Total PPN</b></td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-align:right" colspan="4">
        {{-- {{ number_format($report_data[0]->SUMTotalPayment) }} --}}
    </td>
</tr>

@endsection


@section('table-head')
<tr>
    <td style="width:5px; font-size:9px;" rowspan="2"><b>No</b></td>
    <td style="width:40px; font-size:9px;" rowspan="2"><b>Service & Item </b></td>
    <td style="width:150px; font-size:9px;" colspan="6"><b>Received</b></td>
    <td style="width:10px; font-size:9px;" rowspan="2"><b>License No</b></td>
</tr>
@endsection

@section('table-head-sub')
<tr>
    <td style="font-size:9px;"><b>Cash</b></td>
    <td style="font-size:9px;"><b>Debit</b></td>
    <td style="font-size:9px;"><b>Credit Card</b></td>
    <td style="font-size:9px;"><b>CC Charge</b></td>
    <td style="font-size:9px;"><b>GoPay</b></td>
    <td style="font-size:9px;"><b>OVO</b></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td style="text-transform:capitalize; text-align:center;">{{ $item->item_name }}</td>
        <td>{{ number_format($item->TotalReceivedCash) }}</td>
        <td>{{ number_format($item->TotalReceivedDebit) }}</td>
        <td>{{ number_format($item->TotalReceivedCreditCard) }}</td>
        <td>{{ number_format($item->TotalReceivedCreditCardCharge) }}</td>
        <td>{{ number_format($item->TotalReceivedGopay) }}</td>
        <td>{{ number_format($item->TotalReceivedOvo) }}</td>
        <td></td>
    </tr>
</tbody>
@endforeach
<tfoot>
    <tr>
        <td colspan="2" style="font-size:9px;"><b>Total</b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style="text-align:right;" style="font-size:9px;"><b></b></td>
        <td style=""></td>

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
