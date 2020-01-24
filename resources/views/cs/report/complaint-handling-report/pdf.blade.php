@section('title')
COMPLAINT HANDLING
@endsection


@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -29px; text-transform: capitalize;">
        Complaint Type
    </td>
    <td class="head-content" style="padding-top: -29px;">:</td>
    <td class="head-content" colspan="2" style="padding-top: -29px; text-transform:capitalize;">
        {{ $report_data[0]->pcomplaint_status }}
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


@section('title-footer')

@endsection


@section('table-head')
<tr>
    <td style="width:20px;" rowspan="2"><b>No</b></td>
    <td style="width:70px;" rowspan="2"><b>Complaint</b></td>
    <td style="width:60px;" colspan="2"><b>Date</b></td>
    <td style="width:45px;" rowspan="2"><b>Duration<br>(Day)</b></td>
    <td style="width:40px;" rowspan="2"><b>PIC</b></td>
    <td style="width:40px;" rowspan="2"><b>Status</b></td>
    <td style="width:70px;" rowspan="2"><b>License Number</b></td>
</tr>
@endsection

@section('table-head-sub')
<tr>
    <td style="width:50px;"><b>C. Date</b></td>
    <td style="width:50px;"><b>S. Date</b></td>
</tr>
@endsection

@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td style="text-align:center; text-transform:capitalize;">{{ $item->complaint_type_name }}</td>
        <td>{{ date('d-m-Y', strtotime($item->complaint_handling_date)) }}</td>
        @if ( $item->complaint_handling_detail_date > $item->complaint_handling_targetDate)
        {{-- <td>{{ date('d-m-Y', strtotime($item->complaint_handling_detail_date)) }}</td> --}}
        <td>{{ date('d-m-Y', strtotime($item->complaint_handling_targetDate)) }}</td>

        @else
        <td>{{ date('d-m-Y', strtotime($item->complaint_handling_targetDate)) }}</td>
        @endif
        <td>{{ $item->complaint_handling_dateDifference }}</td>
        <td>{{ $item->complaint_handling_handler }}</td>
        <td style="text-transform:capitalize;">{{ $item->complaint_handling_status }}</td>
        <td>{{ $item->customer_detail_licensePlate }}</td>
    </tr>
</tbody>
@endforeach
<tfoot>
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
