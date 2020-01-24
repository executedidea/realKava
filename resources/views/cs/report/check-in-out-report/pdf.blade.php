@section('title')
CHECK IN OUT
@endsection

@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -29px; text-transform: capitalize;">
        Status
    </td>
    <td class="head-content" style="padding-top: -29px;">:</td>
    <td class="head-content" colspan="2" style="padding-top: -29px; text-transform:capitalize;">
        {{ $report_data[0]->pstatus }}
    </td>
</tr>
<tr>
    <td></td>
    <td class="head-content" colspan="3" style="padding-top: -20px;">Date </td>
    <td class="head-content" style="padding-top: -20px;">:</td>
    <td class="head-content" style="padding-top: -20px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pcheck_in_out_date)) }}
    </td>

</tr>
@endsection


@section('title-footer')

@endsection


@section('table-head')
<tr>
    <td style="width:20px;"><b>No</b></td>
    <td style="width:20px;"><b>No. Que</b></td>
    <td style="width:60px;"><b>Status</b></td>
    <td style="width:70px;"><b>Services</b></td>
    <td style="width:70px;"><b>License Plate</b></td>
    <td style="width:70px;"><b>Brand Type</b></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $item->check_in_ticket }}</td>
        @if ( $item->check_out_status == '0' )
        <td>Checked In</td>
        @elseif ( $item->check_out_status == '1' )
        <td>Checked Out</td>
        @endif
        <td style="text-transform:capitalize;">{{ $item->item_name }}</td>
        <td>{{ $item->customer_detail_licensePlate }}</td>
        <td>{{ $item->vehicle_brand_name}} - {{ $item->vehicle_model_name }}</td>
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
