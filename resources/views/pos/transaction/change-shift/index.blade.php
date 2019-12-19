@extends('layouts.main')
@section('title', 'Change Shift | Finance - KAVA')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
@endsection
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group text-center col-6">
                            <label for="">Date Now</label>
                            <input type="text" name="" class="form-control text-center" id=""
                                value="{{date("Y-m-d H:i:s")}}" readonly>
                        </div>
                        <div class="form-group text-center col-6">
                            <label for="">Cashier Name</label>
                            <input type="text" name="" class="form-control text-center" id=""
                                value="{{Auth::user()->name}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <label for="">Change to</label>
                            <select name="" class="form-control">
                                <option disabled selected><a>Select Cashier Name</a></option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-center col-12">
                        <button type="submit" class="btn btn-primary btn-block">Closing</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <label for="">
                                <h4>Total Received</h4>
                            </label>
                            <input type="text" name="" class="form-control text-center" id=""
                                value="{{ number_format($change_shift_byuser[0]->totalPayment) }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <label for="">Opening Cash Drawer</label>
                            <input type="text" name="" class="form-control text-center" id=""
                                value="{{ number_format($change_shift_byuser[0]->open_store_amount) }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-6">
                            <label for="">Cash</label>
                            <input type="text" name="" class="form-control text-center" id="" value="" readonly>
                        </div>
                        <div class="form-group text-center col-6">
                            <label for="">Debit</label>
                            <input type="text" name="" class="form-control text-center" id="" value="" readonly>
                        </div>
                        <div class="form-group text-center col-6">
                            <label for="">Credit Card</label>
                            <input type="text" name="" class="form-control text-center" id="" value="" readonly>
                        </div>
                        <div class="form-group text-center col-6">
                            <label for="">CC Charge</label>
                            <input type="text" name="" class="form-control text-center" id="" value="" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-center col-12">
                            <button type="submit" class="btn btn-primary btn-block">Posting</button>
                        </div>
                    </div>
                </div>
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
<script src="{{ asset('/js/kava/pos/change-shift/index.js') }}"></script>
@endsection
