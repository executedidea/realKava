@section('title-tab')
<title>Customer Report</title>
@endsection

@section('title')
CUSTOMER
@endsection

@if ( $report_data[0]->pcustomer == 'all')

@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -47px; text-transform: capitalize;">
        {{ $report_data[0]->pcustomer }} Customer </td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -47px;">As Of </td>
    <td class="head-content" style="padding-top: -47px;">:</td>
    <td class="head-content" style="padding-top: -47px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>

    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -47px;">Periode </td>
    <td class="head-content" style="padding-top: -47px;">:</td>
    <td class="head-content" style="padding-top: -47px;">
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
    <td style="width:20px;"><b>No</b></td>
    <td style="width:150px;"><b>Customer</b></td>
    <td style="width:90px;"><b>Phone</b></td>
    <td style="width:70px;"><b>License Number</b></td>
    <td style="width:70px;"><b>Brand</b></td>
    <td style="width:70px;"><b>Brand Type</b></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')

@php
$rowid = 0;
$rowspan = 0;
@endphp
@foreach($report_data as $index => $item)
<tbody class="table-content">
    @php
    $rowid += 1
    @endphp
    <tr>

        @if ($index == 0 || $rowspan == $rowid)
        @php
        $rowid = 0;
        $rowspan = $item->customerCount;
        @endphp

        <td rowspan="{{ $rowspan }}">{{ $index+1 }}</td>
        <td style="text-align:left;" rowspan="{{ $rowspan }}">{{ $item->customer_fullName }}</td>
        <td rowspan="{{ $rowspan }}">{{ $item->customer_phone }}</td>
        @endif
        <td>{{ $item->customer_detail_licensePlate }}</td>
        <td>{{ $item->vehicle_brand_name }}</td>
        <td>{{ $item->vehicle_model_name }}</td>

    </tr>
</tbody>
@endforeach

<tfoot>
</tfoot>
</table>

</table>

@elseif ( $report_data[0]->pcustomer == 'detail' )

@section('title-caption')
<tr>
    <td class="head-content" colspan="3" style="padding-top: -47px; text-transform: capitalize;">
        {{ $report_data[0]->pcustomer }} Customer </td>
</tr>
<tr>
    <td></td>
    @if (empty($report_data[0]->pperiod_StartDate) AND empty($report_data[0]->pperiod_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -47px;">As Of </td>
    <td class="head-content" style="padding-top: -47px;">:</td>
    <td class="head-content" style="padding-top: -47px;">
        {{ date('d-m-Y', strtotime($report_data[0]->pasof_EndDate)) }}
    </td>

    @elseif (empty($report_data[0]->pasof_StartDate) AND empty($report_data[0]->pasof_EndDate))
    <td class="head-content" colspan="3" style="padding-top: -47px;">Periode </td>
    <td class="head-content" style="padding-top: -47px;">:</td>
    <td class="head-content" style="padding-top: -47px;">
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
    <td style="width:60px;"><b>Vehicle Type</b></td>
    <td style="width:60px;"><b>License Number</b></td>
    <td style="width:60px;"><b>Size</b></td>
    <td style="width:60px;"><b>Brand</b></td>
    <td style="width:60px;"><b>Brand Type</b></td>
</tr>
@endsection


@section('title-footer')
<tr>
    <td height="10px"></td>
</tr>
<tr>
    <td class="head-content">Name</td>
    <td class="head-content">:</td>
    <td class="head-content" colspan="4">
        {{ $report_data[0]->customer_fullName }}
    </td>
</tr>

<tr>
    <td class="head-content">Phone</td>
    <td class="head-content">:</td>
    <td class="head-content" colspan="4">
        {{ $report_data[0]->customer_phone }}
    </td>
</tr>
<tr>
    <td class="head-content">Membership Type</td>
    <td class="head-content">:</td>
    <td class="head-content" style="text-transform: capitalize;" colspan="4">
        {{ $report_data[0]->membership_type }}
    </td>
</tr>
<tr>
    <td height="10"></td>
</tr>
<tr>
    <td class="head-content"><b>Listing Vehicle</b></td>
</tr>
@endsection


@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $item->vehicle_category_name }}</td>
        <td>{{ $item->customer_detail_licensePlate }}</td>
        <td>{{ $item->vehicle_size_name }}</td>
        <td>{{ $item->vehicle_brand_name }}</td>
        <td>{{ $item->vehicle_model_name }}</td>
    </tr>
</tbody>
@endforeach
<tfoot>
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
