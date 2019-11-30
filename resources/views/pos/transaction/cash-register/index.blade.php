@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<div class="container-fluid">
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
    <section id="customerItem">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row my-4">
                                <div class="form-group col-4">
                                    <label for="customerName">Customer Name</label>
                                    <input type="text" class="form-control" id="customerName" value="" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="vehicle">Vehicle</label>
                                    <input type="text" class="form-control" id="vehicle" value="" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="licensePlate">License Plate</label>
                                    <input type="text" class="form-control" id="licensePlate" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-responsive" id="customerItems">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Item(s)</th>
                                            <th class="text-center">Qty.</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Disc</th>
                                            <th class="text-center">Add Disc</th>
                                            <th class="text-center">Total Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(request('license_plate'))
                                        @foreach($point_of_sales_list as $index => $item)
                                        <tr>
                                            <td>{{ $item->item_name }}</td>
                                            <td class="text-right">{{ $item->point_of_sales_quantity }}</td>
                                            <td class="text-right">{{ $item->item_price }}</td>
                                            <td class="text-right">{{ $item->point_of_sales_discPercent * 100 }}%</td>
                                            <td class="text-right">{{ $item->point_of_sales_addDiscount * 100 }}%</td>
                                            <td class="text-right">
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
                                        @endif
                                        <form action="" method="post" id="customerItemsForm">
                                            <tr id="row1">
                                                <td class="py-2" width="20%">
                                                    <div class="form-group">
                                                        <select name="item" class="items px-3" id="itemSelect">
                                                            <option value="" disabled selected>Item Name</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="py-2" width="10%">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numeric-input text-right item-quantity"
                                                            value="0" id="quantity" disabled>
                                                    </div>
                                                </td>
                                                <td class="py-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-right item-price"
                                                            placeholder="Rp 0,-" id="itemPrice" disabled>
                                                    </div>
                                                </td>
                                                <td class="py-2" width="10%">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control item-discount" name="discount"
                                                                id="itemDiscount" disabled>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-percent"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-2" width="10%">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control item-add-discount" name="add_discount"
                                                                id="itemAddDiscount" disabled>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-percent"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-right total-price"
                                                            placeholder="Rp 0,-" id="itemTotalPrice" disabled>
                                                    </div>
                                                </td>
                                                <td >
                                                    
                                                </td>
                                                <td class="py-2 d-none">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-right total-discount"
                                                            placeholder="0" id="itemTotalDiscount" disabled>
                                                    </div>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" id="calculatePrice">
                                        Calculate
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            
                            <div class="col-3 bg-success p-3 align-self-center text-right">
                                <h1 class="text-white align-items-center totaltotal" id="Total">0</h1>
                            </div>
                            <div class="form-group col-3 totalPrice">
                                <label for="">Total Price</label>
                                <input type="text" id="totalPrice" class="form-control text-center" value="" disabled>
                            </div>
                            <div class="form-group col-3">
                                <label for="">PPN</label>
                                <input type="text" class="form-control text-center" id="ppn" disabled>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Total Discount</label>
                                <input type="text" class="form-control text-center" id="totalAllDiscount" disabled>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        $('#itemSelect').select2();
        $('#itemSelect').on('select2:open', function(){
            $.get('/data/items/getitems', function(items) {
                $.each(items, function(index, Obj){
                    $('#itemSelect').append('<option value="' + Obj.item_id + '">' + Obj.item_name + '</option>');
                });
            });
        });
        
        $('#itemSelect').on('change', function () {
            var id = $(this).val();
            $('#quantity').prop('disabled', false);
            $('#quantity').val(1);
            $('#itemDiscount').val(0);
            $('#itemAddDiscount').val(0);


            $.get('/data/items/getitem/' + id, function (item) {
                $('#itemPrice').val(item[0].item_price);
                $('#itemTotalPrice').val($('#itemPrice').val());
            });
            $.get('/data/cashier/getcashierbyid', function(cashier){
                if(cashier[0].disc_percent <= 0){
                    $('#itemDiscount').prop('disabled', true);
                } else {
                    $('#itemDiscount').prop('disabled', false);
                }
                if(cashier[0].disc_add_1 <= 0){
                    $('#itemAddDiscount').prop('disabled', true);
                } else{
                    $('#itemAddDiscount').prop('disabled', false);
                }
            });
        });
        $('#quantity').on('keyup', function () {
            $('#itemTotalPrice').val($('#quantity').val() * $('#itemPrice').val());
            
        });
        // $('#itemDiscount').on('keyup', function () {
        //     $.get('/data/cashier/getcashierbyid', function(cashier){
        //         if ($('#itemDiscount').val() > cashier[0].disc_percent) {
        //             alert('You are not allowed to give discount that much!');
        //             $('#itemDiscount').val(0);
        //             console.log(cashier[0].disc_percent);
        //         }
        //     });
        //     var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
        //     var discount = priceQuantity * $('#itemDiscount').val() / 100;
        //     $('#itemTotalPrice').val(priceQuantity - discount);

        // });
        $('#itemDiscount').on('change', function () {
            $.get('/data/cashier/getcashierbyid', function(cashier){
                if ($('#itemDiscount').val() > cashier[0].disc_percent || $('#itemDiscount').val() >= 100) {
                    alert('You are not allowed to give discount that much!');
                    $('#itemDiscount').val(0);
                }
                var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
                var discount = priceQuantity * $('#itemDiscount').val() / 100;
                var priceAfterDisc = priceQuantity - discount;
                var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
                // $('#itemTotalPrice').val(priceQuantity - discount);
                $('#itemTotalPrice').val(priceAfterDisc - addDisc);

                
            });
        });

        $('#itemAddDiscount').on('change', function () {
            $.get('/data/cashier/getcashierbyid', function(cashier){
                if ($('#itemAddDiscount').val() > cashier[0].disc_add_1 || $('#itemAddDiscount').val() >= 100) {
                    alert('You are not allowed to give discount that much!');
                    $('#itemAddDiscount').val(0);
                }
                // var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
                // var discount = priceQuantity * $('#itemDiscount').val() / 100;
                // var priceAfterDisc = priceQuantity - discount;
                // var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
                // $('#itemTotalPrice').val(priceAfterDisc - addDisc);
                var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
                var discount = priceQuantity * $('#itemDiscount').val() / 100;
                var priceAfterDisc = priceQuantity - discount;
                var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
                // $('#itemTotalPrice').val(priceQuantity - discount);
                $('#itemTotalPrice').val(priceAfterDisc - addDisc);
            });
            
        });


        $('#bankAccountBtn').on('click', function () {
            $('#pettyCash').hide();
            $('#bankAccount').show(200, 'swing');
        });
        $('#pettyCashBtn').on('click', function () {
            $('#bankAccount').hide();
            $('#pettyCash').show(200, 'swing');
        });
        var i = 1;
        $('#customerItemsForm').on('submit', function (e) {
            e.preventDefault();
            i++;
            $('#itemSelect').prop('disabled', true);
            $('#quantity').prop('disabled', true);
            $('#itemDiscount').prop('disabled', true);
            $('#itemAddDiscount').prop('disabled', true);
            $('#itemAddDiscount').prop('disabled', true);

            var totalWithoutDisc = $('#itemPrice').val()*$('#quantity').val();
            var disc = totalWithoutDisc*$('#itemDiscount').val()/100;
            var totalDisc   = totalWithoutDisc - disc;
            var addDisc     = totalDisc*$('#itemAddDiscount').val()/100;
            $('#itemTotalDiscount').val(addDisc+disc);

            var id  = $('#itemSelect').val();
            $('#itemSelect').removeAttr('id');
            $('#quantity').removeAttr('id');
            $('#itemPrice').removeAttr('id');
            $('#itemDiscount').removeAttr('id');
            $('#itemAddDiscount').removeAttr('id');
            $('#itemTotalPrice').removeAttr('id');
            $('#itemTotalDiscount').removeAttr('id');
            $.get('/data/items/getitem/' + id, function (item) {
                $('#customerItems tbody').append(
                    '<tr id="row'+i+'"><td class="" width="20%"><div class="form-group"><select name="item" class="items px-3" id="itemSelect"><option value="" disabled selected>Item Name</option></select></div></td><td class="" width="10%"><div class="form-group"><input type="text" class="form-control numeric-input text-right item-quantity" value="0" id="quantity" disabled></div></td><td class=""><div class="form-group"><input type="text" class="form-control text-right item-price" placeholder="Rp 0,-" id="itemPrice" disabled></div></td><td class="" width="10%"><div class="form-group"><div class="input-group"><input type="text" class="form-control item-discount" name="discount" id="itemDiscount" disabled><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td class="" width="10%"><div class="form-group"><div class="input-group"><input type="text" class="form-control item-add-discount" name="add_discount" id="itemAddDiscount" disabled><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td class=""><div class="form-group"><input placeholder="Rp 0,-" id="itemTotalPrice" class="form-control total-price text-right" disabled></div></td><td><button type="button" class="btn btn-danger remove-row" data-id="'+i+'"><i class="fas fa-trash" aria-hidden="true"></i></button></td><td class="py-2"><div class="form-group"><input type="text" class="form-control text-right total-discount d-none" placeholder="0" id="itemTotalDiscount" disabled></div></td></tr>'
                );
                $('#itemSelect').select2();
                $('#itemSelect').on('select2:open', function(){
                    $.get('/data/items/getitems', function(items) {
                        $.each(items, function(index, Obj){
                            $('#itemSelect').append('<option value="' + Obj.item_id + '">' + Obj.item_name + '</option>');
                        });
                    });
                });
                $('#quantity').on('keyup', function () {
                    $('#itemTotalPrice').val($('#quantity').val() * $('#itemPrice').val());
                });
                $('#itemDiscount').on('change', function () {
                    $.get('/data/cashier/getcashierbyid', function(cashier){
                        if ($('#itemDiscount').val() > cashier[0].disc_percent || $('#itemDiscount').val() >= 100) {
                            alert('You are not allowed to give discount that much!');
                            $('#itemDiscount').val(0);
                        }
                        var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
                        var discount = priceQuantity * $('#itemDiscount').val() / 100;
                        $('#itemTotalPrice').val(priceQuantity - discount);
                        console.log(cashier[0].disc_percent);
                    });
                });

                $('#itemAddDiscount').on('keyup', function () {
                    if ($('#itemAddDiscount').val() > 100) {
                        alert('Max 100%');
                        $('#itemAddDiscount').val(0);
                    }
                    var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
                    var discount = priceQuantity * $('#itemDiscount').val() / 100;
                    var priceAfterDisc = priceQuantity - discount;
                    var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
                    $('#itemTotalPrice').val(priceAfterDisc - addDisc);
                });
                $('#itemSelect').on('change', function () {
                    var id = $(this).val();
                    $('#quantity').prop('disabled', false);
                    $('#quantity').val(1);
                    $('#itemTotalDiscount').prop('disabled', false);
                    $.get('/data/items/getitem/' + id, function (item) {
                        $('#itemPrice').val(item[0].item_price);
                        $('#itemTotalPrice').val($('#itemPrice').val());
                    });
                    $.get('/data/cashier/getcashierbyid', function(cashier){
                        if(cashier[0].disc_percent <= 0){
                            $('#itemDiscount').prop('disabled', true);
                        } else {
                            $('#itemDiscount').prop('disabled', false);
                        }
                        if(cashier[0].disc_add_1 <= 0){
                            $('#itemAddDiscount').prop('disabled', true);
                        } else{
                            $('#itemAddDiscount').prop('disabled', false);
                        }
                    });
                });
            });
        });
        $(document).on('click', '.remove-row', function(){
            var id = $(this).data('id');
            $('#row'+id).remove();
        });
        $('#calculatePrice').on('click', function(){
            var totalPrice   = 0;
            $('.total-price').each(function(){
                totalPrice += +$(this).val();
            });
            var totalAllDiscount = 0;
            $('.total-discount').each(function(){
                totalAllDiscount += +$(this).val();
            });
            
            
            $('#totalPrice').val(totalPrice);
            $('#ppn').val($('#totalPrice').val()*10/100);
            $('#totalAllDiscount').val(totalAllDiscount);
            $('#Total').html(parseFloat($('#totalPrice').val())+parseFloat($('#ppn').val()));
        });



    });
</script>
@endsection
