@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/cs/customer-report.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('title', 'Check In Out Report | Customer Service - KAVA')
@section('content')
<section id="checkInOutReport">
    <div class="container">

        @if(Session::has('alert'))
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>Data kosong!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Check In Out Report</h4>
                        <form action="{{ route('checkInOutReportPrint') }}" method="get" class="validate-this ml-auto">
                            @csrf
                            <button type="submit" class="pdf-btn">
                                <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="40px">
                            </button>
                            <button type="submit" class="xls-btn">
                                <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="40px">
                            </button>
                    </div>
                    <div class="card-body p-2">
                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                <select name="outlet_name_report" class="form-control category">
                                    <option selected disabled>Outlet</option>
                                    @foreach ($outlet_all as $item)
                                    <option value="{{ $item->outlet_id }}">
                                        {{ $item->outlet_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                <select name="status" class="form-control status">
                                    <option selected disabled>Status</option>
                                    <option value="all">
                                        All
                                    </option>
                                    <option value="checked in">
                                        Checked In
                                    </option>
                                    <option value="checked out">
                                        Checked Out
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center check-in-out-date">
                            <div class="form-group">
                                <input name="check_in_out_date" type="text" class="form-control datepicker"
                                    id="checkInOutDate" placeholder="Date">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary btn-export">
                                Print
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('/js/page/modules-ion-icons.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // $('#checkInOutDate').hide();

        var date = new Date();

        $('#checkInOutDate').daterangepicker({
            locale: {
                format: "YYYY-MM-DD",
                separator: " - "
            },
            startDate: moment(date),
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901
        });

        $('#checkInOutDate').val('Date');

    });

</script>
@endsection
