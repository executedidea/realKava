@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cashier</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-info ml-1" id="editBtn">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-danger ml-1" id="deleteBtn">
                        <i class="fas fa-trash" aria-hidden="true"></i>
                    </button>
                    <h4 class="ml-auto">Export to:</h4>
                    <a href="http://" class="ml-1">
                        <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                    </a>
                    <a href="http://" class="ml-1">
                        <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="th-sm text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input" name="id[]" id="checkAll" value="">
                                        <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Group</th>
                                <th>Name</th>
                                <th>Shift Code</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Max Discount Allowed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashier as $index => $item)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input checkitem" name="id[]"
                                            id="checkbox{{ $item->cashier_id }}"
                                            value="{{ $item->cashier_id }}">
                                        <label for="checkbox{{ $item->cashier_id }}"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>BA{{ $index+1 }}</td>
                                <td>{{ $item->group_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->shift_code }}</td>
                                <td>{{ $item->shift_startTime }}</td>
                                <td>{{ $item->shift_endTime }}</td>
                                <td>{{ $item->disc_percent }}%</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
{{-- BankAccount AddModal --}}
<div class="modal fade" id="addBankAccountModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                <input type="text" name="account_number" class="form-control" id="accountNumber" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="openingBalance">Opening Balance</label>
                                <input type="text" name="opening_balance" class="form-control" id="openingBalance" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="openingDate">Opening Date</label>
                                <input type="text" name="opening_date" class="form-control datepicker" id="openingDate" required>
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
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
$(document).ready(function(){
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

    $('#bankAccountBtn').on('click', function(){
        $('#pettyCash').hide();
        $('#bankAccount').show(200, 'swing');
    });
    $('#pettyCashBtn').on('click', function(){
        $('#bankAccount').hide();
        $('#pettyCash').show(200, 'swing');
    });
});
</script>
@endsection
