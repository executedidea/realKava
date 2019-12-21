@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/kava/cs/check-in-out.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<section id="customerCheck">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Membership</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-12">
                                <select name="key" id="customerSearch">
                                    <option value="" disabled selected>Search Name or Phone Number
                                    </option>
                                    @foreach ($customer as $item)
                                    <option value="{{$item->customer_id}}"><b>{{ $item->customer_fullName}}</b>
                                        <span class="text-muted">{{ $item->customer_phone }}</span>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="CheckInTable">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Membership</h4>
                        <h4 class="ml-auto action-btn">Export to:</h4>
                        <a href="http://" class="action-btn ml-1">
                            <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                        </a>
                        <a href="http://" class="action-btn ml-1">
                            <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Member Since</th>
                                    <th>Expired</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('modal')
{{-- Membership Modal --}}
<div class="modal fade" id="customerCheckInModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="form-group col-4">
                            <label for="checkInCustomerName">Customer Name</label>
                            <input type="text" class="form-control" id="checkInCustomerName" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">Phone Number</label>
                            <input type="text" class="form-control" id="checkInCustomerPhone" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">No. Membership</label>
                            <input type="text" class="form-control" id="checkInCustomerPhone" value="001201911230012"
                                disabled>
                        </div>
                        <div class="form-group col-6">
                            <select name="" id="" class="form-control membership-name">
                                <option disabled selected>Membership Name</option>

                                @foreach ($membership_all as $item)
                                <option value="{{$item->membership_id}}">{{$item->membership_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">

                            <select name="membership_type" class="form-control membership-type" id="membershipType"
                                disabled required>
                                <option disabled selected>Membership Type</option>
                            </select>
                            {{-- <select name="" id="" class="form-control membership-type">
                                <option disabled selected>Membership Type</option>

                                @foreach ($membership_all as $item)
                                <option value="{{$item->membership_id}}">{{$item->membership_type}}
                            </option>
                            @endforeach
                            </select> --}}
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control datepicker" id="checkInCustomerJoinDate">
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control datepicker" id="checkInCustomerExpiredDate">
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control datepicker" id="birthDate">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-4">
                            <input type="text" class="form-control" placeholder="NIK">
                        </div>
                        <div class="form-group col-4">
                            <select name="" id="" class="form-control membership-type">
                                <option disabled selected>Religion</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <select name="" id="" class="form-control membership-type">
                                <option disabled selected>Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-4">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group col-4">
                            <select name="" id="" class="form-control membership-type">
                                <option disabled selected>City</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-12">
                            <textarea type="text" class="form-control" placeholder="Note"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Detail Modal --}}
<div class="modal fade" id="customerCheckedInDetailModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="customerName">Name</label>
                            <input type="text" class="form-control" id="customerName">
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPhone">Phone Number</label>
                            <input type="text" class="form-control" id="customerPhone">
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPlate">License Plate</label>
                            <input type="text" class="form-control" id="customerPlate">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-block">Check Out</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>

<script src="{{asset('/js/page/modules-ion-icons.js')}}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#checkInCustomerJoinDate').val('Join Date');
        $('#checkInCustomerExpiredDate').val('Expired Date');
        $('#birthDate').val('Birth Date');

        // $('#bankName').prop('disabled', true);
        // $('.membership-type').prop('disabled', true);
        $('.membership-name').selectric();
        $('#customerSearch').select2();

        $('#customerSearch').on('change', function () {
            var id = $(this).val();
            $.get('/data/checkin/customer/' + id, function (data) {
                console.log(data);
                $('#checkInCustomerName').val(data[0].customer_fullName);
                $('#checkInCustomerPhone').val(data[0].customer_phone);
                $('#checkInCustomerLicensePlate').val(data[0].customer_detail_licensePlate);
            });
            $('#customerCheckInModal').modal('show')
        });



        // $('.membership-name').on('change', function (e) {
        //     var membership_id = e.target.value;
        //     $.get('/data/membership/getMembershipByID?membership_id=' + membership_id,
        //         function (data) {
        //             console.log(membership_id);

        //             $('.membership-type').empty();
        //             $('.membership-type').prop("disabled", false);
        //             $('.membership-type').append(
        //                 '<option value="" disabled selected>Account Number</option>'
        //             );

        //             $.each(data, function (index, membershipTypeObj) {
        //                 $('.membership-type').append(
        //                     '<option class="text-center" value="' +
        //                     membershipTypeObj.membership_id + '">' +
        //                     membershipTypeObj
        //                     .membership_type + '</option>');
        //             })
        //         });
        // });



    });

</script>
@endsection
