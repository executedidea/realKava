@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Cash & Bank Out | Point Of Sales - KAVA')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Payment Source</h4>
                </div>
                <form action="{{ route('storeCashBankOutTransaction') }}" method="post" id="addCashBankOut"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group text-center col-6">

                                <select name="payment_resource" class="form-control payment-resource"
                                    id="paymentResource">
                                    <option disabled selected>Payment Resource</option>
                                    <option value="work equipment">Cash</option>
                                    <option value="operational">Bank</option>
                                </select>
                            </div>
                            <div class="form-group text-center col-6">
                                {{-- <label for="">Saldo Petty Cash</label> --}}
                                <input type="text" name="petty_cash_balance" class="form-control text-right"
                                    id="pettyCashBalance" placeholder="Saldo"
                                    value="{{ $petty_cash_balance[0]->pettyCashBalance }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group text-center col-4">
                                <select id="bankName" name="bank_name" class="form-control bank-name">
                                    <option disabled selected>Bank</option>
                                    @foreach ($bank_list as $item)
                                    <option value="{{$item->bank_id}}">{{$item->bank_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-center col-4">
                                <select name="bank_account_number" class="form-control bank-account-number"
                                    id="bankAccountNumber" disabled required>
                                    <option disabled selected>Account Number</option>
                                </select>
                            </div>
                            <div class="form-group text-center col-4">
                                <input type="text" name="bank_account_openingBalanced" id="bankAccountOpeningBalanced"
                                    class="form-control text-center bank-account-opening-balanced" value=""
                                    placeholder="Saldo" readonly>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-12 col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="col-9">
                        <h4>Pembayaran</h4>
                    </div>
                    <div class="col-3 text-right">
                        <label class="custom-switch mt-2">
                            <input type="checkbox" value="1" name="use_bank" class="custom-switch-input" id="useBank">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Use Bank</span>
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-4">
                            <input type="text" name="cash_bank_date" class="form-control datepicker" id="cashBankDate"
                                placeholder="Date">
                        </div>
                        <div class="form-group text-center col-4">
                            <select name="petty_cash_detail_category" class="form-control petty-cash-detail-category"
                                id="pettyCashDetailCategory">
                                <option disabled selected>Category</option>
                                <option value="work equipment">Peralatan Kerja</option>
                                <option value="operational">Operasional</option>
                                <option value="salary">Upah</option>
                                <option value="marketing">Marketing</option>
                                <option value="etc">Lain-lain</option>
                            </select>
                        </div>
                        {{-- <div class="form-group text-center col-4">
                            <select name="bank_out_type" class="form-control bank-out-type">
                                <option disabled selected>Payment Type</option>
                                <option value="d">Debit</option>
                                <option value="c">Credit</option>
                            </select>
                        </div> --}}
                        <div class="form-group text-center col-4">
                            <input type="text" name="cash_bank_amount" id="pettyCashDetailAmount" class="form-control"
                                placeholder="Amount">
                        </div>
                        <div class="form-group col-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="cash_bank_desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary btn-block" id="Bayar">Bayar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('/js/page/modules-ion-icons.js')}}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/js/kava/pos/cash-bank-out/index.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular-resource.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.0.3/autoNumeric.js"></script> --}}
@endsection
