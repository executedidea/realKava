@extends('layouts.main')
@section('title', 'Cash & Bank Listing | Finance - KAVA')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <button class="btn btn-lg bg-white w-100" id="bankAccountBtn">Bank Account</button>
        </div>
        <div class="col-6">
            <button class="btn btn-lg bg-white w-100" id="pettyCashBtn">Petty Cash</button>
        </div>
    </div>
    <div class="row mt-4" id="bankAccount">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Bank Account</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addBankAccountModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-info ml-1" id="editBankAccountBtn">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-danger ml-1" id="deleteBankAccountBtn">
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
                                        <input type="checkbox" data-checkboxes="rights" class="custom-control-input"
                                            name="id[]" id="checkAllBankAccount" value="">
                                        <label for="checkAllBankAccount" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Branch</th>
                                <th>Opening Date</th>
                                <th>Opening Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bank_account as $index => $item)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input checkitem-bankaccount" name="id[]"
                                            id="checkbox{{$item->bank_account_id}}" value="{{$item->bank_account_id}}">
                                        <label for="checkbox{{$item->bank_account_id}}"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>BA{{ $index+1 }}</td>
                                <td>{{ $item->bank_name }}</td>
                                <td>{{ $item->bank_account_number }}</td>
                                <td>{{ $item->bank_account_branch }}</td>
                                <td>{{ $item->bank_account_openingDate }}</td>
                                <td>{{ number_format($item->bank_account_openingBalanced) }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4" id="pettyCash">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Petty Cash</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addPettyCashModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-info ml-1" id="editPettyCashBtn">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="th-sm text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights" class="custom-control-input"
                                            name="id[]" id="checkAllPettyCash" value="">
                                        <label for="checkAllPettyCash" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Saldo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petty_cash as $index => $item)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input checkitem-pettycash" name="id[]"
                                            id="checkbox{{$item->petty_cash_id}}" value="{{$item->petty_cash_id}}">
                                        <label for="checkbox{{$item->petty_cash_id}}"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->petty_cash_date }}</td>
                                <td>{{ number_format($item->petty_cash_amount) }}</td>

                                @if (($item->flag) == 1)
                                @php
                                $flag = 'open'
                                @endphp
                                <td><span class="badge badge-success">{{ $flag }}</span></td>
                                @elseif (($item->flag) == 0)
                                @php
                                $flag = 'close'
                                @endphp
                                <td><span class="badge badge-danger">{{ $flag }}</span></td>

                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                                    @foreach($bank as $item)
                                    <option value="{{ $item->bank_id }}">{{ $item->bank_name }}</option>
                                    @endforeach
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

<!-- Petty Cash Modal -->
<section id="pettyCashModal">
    <div class="modal fade" id="addPettyCashModal" tabindex="-1" role="dialog" aria-labelledby="addCashModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="deleteModalLabel">Add Petty Cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <form action="/admin/library/cashbank/addpettycash" method="POST" id="addCustomerForm"
                                    enctype="multipart/form-data">
                                    {{-- Form --}}
                                    <div class="row pt-5">
                                        <div class="col">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <input type="text" name="petty_bank_date"
                                                        class="form-control datepicker" id="pettyCashDate"
                                                        placeholder="Date">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="date">Saldo Petty Cash</label>
                                                    <input type="text" name="" id="pettyCashDetailBalanced"
                                                        class="form-control text-right"
                                                        value="{{ number_format($petty_cash_saldo[0]->petty_cash_detail_balanced) }}"
                                                        placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="">Open Petty Cash</label>
                                                    <input type="text" name="" id="pettyCashOpen"
                                                        class="form-control text-right petty-cash-open" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="">Total Petty Cash</label>
                                                    <input type="text" name="petty_cash_amount" id="pettyCashAmount"
                                                        class="form-control text-right petty-cash-amount" value=""
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control" name="petty_cash_desc"></textarea>
                                                </div>
                                            </div>

                                            <hr>

                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>

                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#pettyCashDate').val('Date');

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
