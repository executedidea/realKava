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
                            <div class="form-group text-center col-4">

                                <select name="payment_source" class="form-control payment-resource" id="paymentSource">
                                    <option disabled selected>Source Payment</option>
                                    <option value="pc">Petty Cash</option>
                                    <option value="b">Bank</option>
                                </select>
                            </div>
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
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="form-group text-center col-4">
                                <input type="text" name="cash_bank_saldo" id="cashBankSaldo"
                                    class="form-control text-center cash-bank-saldo" value="" placeholder="Saldo"
                                    readonly>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-12 col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="col-9">
                        <h4>Transaction</h4>
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
                        {{-- <input type="hidden" name="bank_out_type" id="bankOutType" class="bank-out-type" value="d"> --}}
                        <div class="form-group text-center col-4">
                            <input type="text" name="cash_bank_amount" id="cashBankAmount"
                                class="form-control cash-bank-amount" placeholder="Amount">
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
