@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<div class="container">
    <section id="customerCheck">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Checked In Customer</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <input type="text" name="license_plate" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(request('license_plate'))
    <section id="customerItem">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-4">
                            <div class="form-group col-4">
                                <label for="customerName">Customer Name</label>
                                <input type="text" class="form-control" id="customerName"
                                    value="{{ $point_of_sales_list[0]->customer_fullName }}" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="vehicle">Vehicle</label>
                                <input type="text" class="form-control" id="vehicle"
                                    value="{{ $point_of_sales_list[0]->vehicle_model_name }}" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="licensePlate">License Plate</label>
                                <input type="text" class="form-control" id="licensePlate"
                                    value="{{ $point_of_sales_list[0]->customer_detail_licensePlate }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Item(s)</th>
                                            <th>Qty.</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Disc</th>
                                            <th>Add Disc</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($point_of_sales_list as $index => $item)
                                        <tr>
                                            <td>POS{{ $index+1 }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->point_of_sales_quantity }}</td>
                                            <td>{{ $item->item_price }}</td>
                                            <td>{{ $item->point_of_sales_price }}</td>
                                            <td>{{ $item->point_of_sales_discPercent * 100 }}%</td>
                                            <td>{{ $item->point_of_sales_addDiscount * 100 }}%</td>
                                            <td>
                                                @if ($item->point_of_sales_discPercent == NULL AND
                                                $item->point_of_sales_addDiscount == NULL)
                                                {{$item->point_of_sales_price}}
                                                @elseif ($item->point_of_sales_addDiscount == NULL)
                                                {{number_format($item->point_of_sales_price - ($item->point_of_sales_price * $item->point_of_sales_discPercent))}}
                                                @else
                                                {{number_format($item->point_of_sales_price - ($item->point_of_sales_price * ($item->point_of_sales_discPercent+$item->point_of_sales_addDiscount)))}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="form-group col-3">
                                <label for="">Subtotal</label>
                                <input type="text" id="" class="form-control text-center"
                                    value="{{number_format($point_of_sales_subtotal[0]->subTotal)}}" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label for="">PPN</label>
                                <input type="text" id="" class="form-control text-center" value="20%" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Disc</label>
                                <input type="text" id="" class="form-control text-center" value="30%" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
@section('modal')
{{-- BankAccount AddModal --}}
<div class="modal fade" id="addBankAccountModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('storeBankAccount') }}" method="post" class="validate-this">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Bank Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-12 col-lg-6">
                                <label for="bank">Bank</label>
                                <select name="bank" id="bank" required>
                                    <option value="" disabled selected>Select Bank</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="branch">Branch</label>
                                <input type="text" name="branch" class="form-control" id="branch" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="accountNumber">Account Number</label>
                                <input type="text" name="account_number" class="form-control" id="accountNumber"
                                    required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="openingBalance">Opening Balance</label>
                                <input type="text" name="opening_balance" class="form-control" id="openingBalance"
                                    required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="openingDate">Opening Date</label>
                                <input type="text" name="opening_date" class="form-control datepicker" id="openingDate"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#checkAllBankAccount").on('change', function () {
            $(".checkitem-bankaccount").prop('checked', $(this).is(":checked"));
        });
        $('.checkitem-bankaccount').on('change', function () {
            if ($('.checkitem-bankaccount:checked').length !== $('.checkitem-bankaccount').length) {
                $('#checkAllBankAccount').prop('checked', false);
            } else {
                $('#checkAllBankAccount').prop('checked', true);
            }
        });

        $("#checkAllPettyCash").on('change', function () {
            $(".checkitem-pettycash").prop('checked', $(this).is(":checked"));
        });
        $('.checkitem-pettycash').on('change', function () {
            if ($('.checkitem-pettycash:checked').length !== $('.checkitem-pettycash').length) {
                $('#checkAllPettyCash').prop('checked', false);
            } else {
                $('#checkAllPettyCash').prop('checked', true);
            }
        });

        $('#bank').selectric();
        $('#customerSearch').select2();

        $('#bankAccountBtn').on('click', function () {
            $('#pettyCash').hide();
            $('#bankAccount').show(200, 'swing');
        });
        $('#pettyCashBtn').on('click', function () {
            $('#bankAccount').hide();
            $('#pettyCash').show(200, 'swing');
        });
    });

</script>
@endsection
