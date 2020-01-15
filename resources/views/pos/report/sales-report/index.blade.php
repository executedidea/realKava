@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('title', 'Sales Report | Customer Service - KAVA')
@section('content')
<section id="openStore">
    <div class="container">
        @if(Session::has('storeOpened'))
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>The store is open now!</span>
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
                        <h4>Sales Report</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('salesReportPrint') }}" method="get" id="">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-10">
                                    <select name="vehicle_category" class="form-control vehicle_category">
                                        <option selected disabled>Vehicle</option>
                                        <option value="4">
                                            All
                                        </option>
                                        @foreach ($vehicle_category_all as $item)
                                        <option value="{{ $item->vehicle_category_id }}">
                                            {{ $item->vehicle_category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-10">
                                    <select name="outlet" class="form-control category">
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
                                <label>Period Date</label>
                            </div>
                            <div class="row justify-content-center">
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

                            <div class="form-group col-12 text-center mt-3">
                                <button type="submit" class="pdf-btn">
                                    <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                                </button>
                                <button type="submit" class="xls-btn">
                                    <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
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
        $('#periodStartDate').val('Start Date');
        $('#periodEndDate').val('End Date');


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
        $('#periodStartDate').val('Start Date');

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
        $('#periodEndDate').val('End Date');

    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        Swal.fire(
            'No Data',
            'Choose another option!'
        );
    }


        // $(document).on('click', '.pdf-btn', function (e) {
        //     var vehicle_category_id = $(this).data('id');
        //     console.log(vehicle_category_id);
        //     $.get('/data/membership/getcustomerbyid/' + customer_id, function (data) {
        //         $('#membershipCustomerName').val(data[0].customer_fullName);
        //     });
        //     $('#customerMembershipModal').modal('show');
        // });



    });

</script>
@endsection
