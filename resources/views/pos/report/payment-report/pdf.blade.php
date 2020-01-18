@include('layouts.partials.pdf.head')
{{-- @foreach($report_data as $index => $item) --}}
<tbody class="table-content">
    {{-- <tr>
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
    </tr> --}}
</tbody>
{{-- @endforeach --}}
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
