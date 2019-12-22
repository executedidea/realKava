@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Member Since</th>
                                    <th class="text-center">Expired</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_member as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index+1 }}</td>
                                    <td class="text-center">{{ $item->customer_fullName }}</td>
                                    <td class="text-center">{{ $item->customer_phone }}</td>
                                    <td class="text-center">{{ $item->membership_name }}</td>
                                    <td class="text-center">{{ $item->membership_joinDate }}</td>
                                    <td class="text-center">{{ $item->membership_expiredDate }}</td>
                                </tr>
                                @endforeach

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
<div class="modal fade" id="customerMembershipModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('updateMembershipTransaction')}}" method="post" id="editMembershipRegistrationForm">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="form-group col-4">
                                <input name="customer_id" type="hidden" id="customerID">
                                <label for="checkInCustomerName">Customer Name</label>
                                <input type="text" class="form-control" id="membershipCustomerName" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="checkInCustomerPhone">Phone Number</label>
                                <input type="text" class="form-control" id="membershipCustomerPhone" disabled>
                            </div>
                            <div class="form-group col-4">
                                <label for="checkInCustomerPhone">No. Membership</label>
                                <input type="text" class="form-control" id="membershipCustomerPhone"
                                    value="001201911230012" disabled>
                            </div>
                            <div class="form-group col-6">
                                <select name="membership_id" id="membershipName" class="form-control membership-name">
                                    <option disabled selected>Membership Name</option>

                                    @foreach ($membership_list as $item)
                                    <option value="{{$item->membership_id}}">{{$item->membership_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">

                                <select name="membership_type" class="form-control membership-type" id="membershipType"
                                    required>
                                    <option disabled selected>Membership Type</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <input name="membership_joinDate" type="text" class="form-control datepicker"
                                    id="membershipCustomerJoinDate">
                            </div>
                            <div class="form-group col-4">
                                <input name="membership_expiredDate" type="text" class="form-control datepicker"
                                    id="membershipCustomerExpiredDate">
                            </div>
                            <div class="form-group col-4">
                                <input name="customer_dateOfBirth" type="text" class="form-control datepicker"
                                    id="membershipCustomerBirthDate">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-4">
                                <input name="customer_idCardNo" type="text" class="form-control" placeholder="NIK"
                                    id="membershipCustomerIDCardNo">
                            </div>
                            <div class="form-group col-4">
                                <select name="customer_religion" id="" class="form-control" required>
                                    <option disabled selected>Religion</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <select name="customer_martialStatus" id="" class="form-control">
                                    <option disabled selected>Status</option>
                                    <option value="menikah">Menikah</option>
                                    <option value="belum menikah">Belum Menikah</option>
                                    <option value="pernah menikah">Penah Menikah</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-4">
                                <input name="customer_email" type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group col-4">
                                <input name="customer_address" type="text" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group col-4">
                                <select name="city_id" id="" class="form-control">
                                    <option disabled selected>City</option>
                                    @foreach ($city_list as $item)
                                    <option value="{{$item->city_id}}">{{$item->city_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-12">
                                <textarea type="text" class="form-control" placeholder="Note" id=""></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block" id="submit">Submit</button>
                </div>
            </form>
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
        $('#membershipCustomerJoinDate').val('Join Date');
        $('#membershipCustomerExpiredDate').val('Expired Date');
        $('#membershipCustomerBirthDate').val('Birth Date');

        // $('#bankName').prop('disabled', true);
        // $('.membership-type').prop('disabled', true);
        $('.membership-name').selectric();
        $('#customerSearch').select2();

        $('#customerSearch').on('change', function () {

            var customer_id = $(this).val();
            // console.log(customer_id);
            $('#customerID').val(customer_id);
            $.get('/data/membership/getcustomerbyid/' + customer_id, function (data) {
                $('#membershipCustomerName').val(data[0].customer_fullName);
                $('#membershipCustomerPhone').val(data[0].customer_phone);
                $('#membershipCustomerLicensePlate').val(data[0].customer_detail_licensePlate);
            });
            $('#customerMembershipModal').modal('show');

        });



        $('.membership-name').select2();

        $('.membership-name').on('change', function (e) {
            var id = e.target.value;
            $.get('/data/membership/getmembershipbyid/' + id, function (data) {
                $('.membership-type').empty();
                $('.membership-type').append(
                    '<option disabled selected>Membership Type</option>');
                $.each(data, function (index, membershipTypeObj) {
                    $('.membership-type').append(
                        '<option class="text-center" value="' +
                        membershipTypeObj.membership_id + '">' +
                        membershipTypeObj.membership_type + '</option>');
                });
            });
        });

        $('#membershipCustomerBirthDate').daterangepicker({
            locale: {
                format: "DD-MM-YYYY",
                separator: " - "
            },
            startDate: "01-01-1980",
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: 2001
        });
        $('#membershipCustomerBirthDate').val('Birth Date');

        var date = new Date();

        $('#membershipCustomerJoinDate').daterangepicker({
            locale: {
                format: "DD-MM-YYYY",
                separator: " - "
            },
            startDate: moment(date),
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901
        });
        $('#membershipCustomerJoinDate').val('Join Date');

        $('#membershipCustomerExpiredDate').daterangepicker({
            locale: {
                format: "DD-MM-YYYY",
                separator: " - "
            },
            startDate: moment(date),
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901
        });
        $('#membershipCustomerExpiredDate').val('Expired Date');

    });

</script>
@endsection
