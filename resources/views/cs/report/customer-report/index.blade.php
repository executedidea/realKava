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
@section('title', 'Customer Report | Customer Service - KAVA')
@section('content')
<section id="customerReport">
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
                        <h4>Customer Report</h4>
                        <form action="{{ route('customerReportPrint') }}" method="get" class="validate-this ml-auto">
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
                                <select name="customer" class="form-control customer">
                                    <option selected disabled>Customer</option>
                                    <option value="all">
                                        All Customer
                                    </option>
                                    <option value="detail">
                                        Detail Customer
                                    </option>
                                </select>
                            </div>
                            <div id="customerFullName" class="form-group col-10">
                                <select name="customer_fullName" class="form-control customer-fullname">
                                    <option selected disabled>Customer Name</option>
                                    @foreach ($customer_all as $item)
                                    <option value="{{ $item->customer_id }}">
                                        {{ $item->customer_fullName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                <select name="filter_date" class="form-control filter-date">
                                    <option selected disabled>Filter Date</option>
                                    <option value="period_date">Period Date</option>
                                    <option value="as_of">As Of</option>
                                </select>
                            </div>
                            {{-- <label>Period Date</label> --}}
                        </div>
                        <div class="row justify-content-center asof-date">
                            <div class="form-group">
                                <input name="asof_StartDate" type="text" class="form-control datepicker"
                                    id="asofStartDate" placeholder="Start Date">
                            </div>
                            <div class="form-group col-5">
                                <input name="asof_EndDate" type="text" class="form-control datepicker" id="asofEndDate"
                                    placeholder="End Date">
                            </div>
                        </div>

                        <div class="row justify-content-center period-date-date">
                            <div class="form-group col-5">
                                <input name="period_StartDate" type="text" class="form-control datepicker"
                                    id="periodStartDate" placeholder="Start Date">
                            </div>
                            <div class="mt-2">-</div>
                            <div class="form-group col-5">
                                <input name="period_EndDate" type="text" class="form-control datepicker"
                                    id="periodEndDate" placeholder="End Date">
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
        $('#customerFullName').hide();
        $('.asof-date').hide();
        $('.period-date-date').hide();
        $('#asofStartDate').hide();

        $('.customer').on('change', function () {
            if ($('.customer').val() == 'all') {
                $('#customerFullName').hide();
            } else if ($('.customer').val() == 'detail') {
                $('#customerFullName').show();
            }
        });


        $('.filter-date').on('change', function () {

            if ($('.filter-date').val() == 'period_date') {
                $('.asof-date').hide();
                $('.period-date-date').show();
                var date = new Date();

                $('#periodStartDate').daterangepicker({
                    locale: {
                        format: "YYYY-MM-DD",
                        separator: " - "
                    },
                    startDate: moment(date),
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901
                });
                // $('#periodStartDate').val('Start Date');

                $('#periodEndDate').daterangepicker({
                    locale: {
                        format: "YYYY-MM-DD",
                        separator: " - "
                    },
                    startDate: moment(date),
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901
                });
                // $('#periodEndDate').val('End Date');

                console.log($('#periodStartDate').val());
                console.log($('#periodEndDate').val());

            } else if ($('.filter-date').val() == 'as_of') {
                $('.period-date-date').hide();
                $('.asof-date').show();
                var date = new Date();

                $('#asofStartDate').daterangepicker({
                    locale: {
                        format: "YYYY-MM-DD",
                        separator: " - "
                    },
                    startDate: "2001-10-01",
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901
                });
                // $('#asofStartDate').val('Start Date');

                $('#asofEndDate').daterangepicker({
                    locale: {
                        format: "YYYY-MM-DD",
                        separator: " - "
                    },
                    startDate: moment(date),
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901
                });
                // $('#asofEndDate').val('End Date');

                console.log($('#asofStartDate').val());
                console.log($('#asofEndDate').val());
                // var msg = '{{Session::get('
                // alert ')}}';
                // var exist = '{{Session::has('
                // alert ')}}';
                // if (exist) {
                //     Swal.fire(
                //         'No Data',
                //         'Choose another option!'
                //     );
                // }

            }



        });
    });

</script>
@endsection
