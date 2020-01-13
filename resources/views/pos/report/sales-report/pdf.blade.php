@include('layouts.partials.pdf.head')
@foreach($report_data as $index => $item)
<tbody class="table-content">
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $item->customer_fullName }}</td>
        <td>{{ $item->customer_detail_licensePlate }}</td>
        <td>{{ $item->vehicle_category_name }}</td>
        <td>{{ $item->vehicle_size_name }}</td>
        <td>{{ number_format($item->point_of_sales_totalPayment) }}</td>
        @if (($item->point_of_sales_paid1 + $item->point_of_sales_paid2) >= $item->point_of_sales_totalPayment)) 
            <td>{{ number_format($item->point_of_sales_totalPayment) }}</td>
            <td>{{ number_format(($item->point_of_sales_totalPayment)-($item->point_of_sales_totalPayment)) }}</td>
        @else
        <td>{{ number_format($item->point_of_sales_paid1 + $item->point_of_sales_paid2) }}</td>
        <td>{{ number_format(($item->point_of_sales_paid1 + $item->point_of_sales_paid2)-($item->point_of_sales_totalPayment)) }}</td>
        @endif
    </tr>
</tbody>
@endforeach

</table>

<table class="table-head">
    <tfoot>
        <tr>
            <td colspan="5" width="357px"><b>Total</b></td>
            <td width="57px"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>
            @if (($item->point_of_sales_paid1 + $item->point_of_sales_paid2) >= $item->point_of_sales_totalPayment)) 
            <td width="120px"><b>{{ number_format($report_data[0]->SUMTotalPayment) }}</b></td>
            <td width="157px"><b>{{ number_format(($item->point_of_sales_totalPayment)-($item->point_of_sales_totalPayment)) }}</b></td>

        @else
        <td width="120px"><b>{{ number_format($item->point_of_sales_paid1 + $item->point_of_sales_paid2) }}</b></td>
        <td width="157px"><b>{{ number_format(($item->point_of_sales_paid1 + $item->point_of_sales_paid2)-($item->point_of_sales_totalPayment)) }}</b></td>
        @endif
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
