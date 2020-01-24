@section('title')
MEMBERSHIP
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -29px; text-transform: capitalize;">
        Membership
    </td>
    <td class="head-content" style="padding-top: -29px;">:</td>
    <td class="head-content" style="padding-top: -29px; text-transform: capitalize;">
        {{ $report_data[0]->pmembership }}
    </td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -25px;">As Of </td>
    <td class="head-content" style="padding-top: -25px;">:</td>
    <td class="head-content" style="padding-top: -25px;">
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
    <td style="width:20px;" rowspan="2"><b>No</b></td>
    <td style="width:100px;" rowspan="2"><b>Customer</b></td>
    <td style="width:100px;" colspan="2"><b>Membership</b></td>
    <td style="width:100px;" colspan="2"><b>Date</b></td>
    <td style="width:40px;" rowspan="2"><b>Status</b></td>
</tr>
@endsection

@section('table-head-sub')
<tr>
    <td style="width:50px;"><b>Type</b></td>
    <td style="width:50px;"><b>Number</b></td>
    <td style="width:50px;"><b>Join Date</b></td>
    <td style="width:50px;"><b>Expired Date</b></td>
</tr>
@endsection

@section('title-footer')
<tr>
    <td class="head-content"></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $item->customer_fullName }}</td>
        <td>{{ $item->membership_name }}</td>
        <td></td>
        <td>{{ date('d-m-Y', strtotime($item->membership_joinDate)) }}</td>
        <td>{{ date('d-m-Y', strtotime($item->membership_expiredDate)) }}</td>
        @if ( $item->status_name == 'member' )
        <td>Active</td>
        @elseif ( $item->status_name == 'expired' )
        <td>Non-Active</td>
        @endif
    </tr>
</tbody>
@endforeach
<tfoot>
    {{-- <tr>
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
    </tr> --}}
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
