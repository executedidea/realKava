@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

@endsection
@section('title', 'Customer Service - KAVA')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Complaint Handling</h4>
                    <button class="btn btn-success action-btn" data-toggle="modal"
                        data-target="#addComplaintHandlingModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-info action-btn ml-1" id="editBtn">
                        <i class="fas fa-edit" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-danger action-btn ml-1" id="deleteBtn">
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                    </button>

                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaint_handling as $item)
                            <tr>
                                <td>{{ $item->complaint_handling_date }}</td>
                                <td>{{ $item->customer_fullName }}</td>
                                <td>{{ $item->complaint_type_name }}</td>
                                <td>{{ $item->complaint_handling_status }}</td>
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
{{-- Add Complaint Handling --}}
<div class="modal fade" id="addComplaintHandlingModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Complaint Handling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="{{route('storeComplaintHandlingTransaction')}}"
                                                    method="post" class="validate-this">
                                                    <div class="row justify-content-center">
                                                        <div class="form-group col-12">
                                                            <select class="form-control" id="complaintCustomer">
                                                                <option value="" readonly selected>Search Name or
                                                                    License Plate</option>
                                                                @foreach ($complaint_customer_list as $item)
                                                                <option value="{{$item->customer_detail_id}}">
                                                                    <b>{{ $item->customer_fullName}}</b>
                                                                    <span
                                                                        class="text-muted">{{ $item->customer_detail_licensePlate }}
                                                                    </span>
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="customerName" value=""
                                        placeholder="Customer Name" name="customer_name" disabled>
                                    <input type="type" name="customer_id" value="" id="customerID" disabled>

                                </div>
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="vehicle" placeholder="Vehicle"
                                        name="vehicle" disabled>
                                    <input type="type" name="vehicle_brand_id" value="" id="vehicleBrandID" disabled>
                                    <input type="type" name="vehicle_model_id" value="" id="vehicleModelID" disabled>

                                </div>
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="licensePlate"
                                        placeholder="License Plate" name="license_plate" disabled>
                                    <input type="type" name="customer_detail_id" value="" id="customerDetailID"
                                        disabled>

                                </div>
                            </div>

                            <form action="{{ route('storeComplaintHandlingTransaction') }}" method="post"
                                id="complaintHandlingForm">
                                @csrf
                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-3">
                                        <input type="text" name="complaint_handling_date"
                                            class="form-control datepicker" id="complaintHandlingDate" value=""
                                            placeholder="Date">
                                    </div>
                                    <div class="form-group col-3">
                                        <input type="text" name="complaint_handling_targetDate"
                                            class="form-control datepicker" id="complaintHandlingTargetDate"
                                            placeholder="Target Handling">
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" name="complaint_handling_handler" class="form-control"
                                            id="complaintHandlingHandler" placeholder="Handler">
                                    </div>
                                </div>

                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-6">
                                        <select name="complaint_type" class="form-control" id="complaintType">
                                            <option disabled selected>Complaint Type</option>
                                            @foreach ($complaint_type_list as $item)
                                            <option value="{{$item->complaint_type_id}}">{{$item->complaint_type_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <select name="complaint_handling_status" class="form-control"
                                            id="complaintHandlingStatus">
                                            <option disabled selected>Status Handling</option>
                                            <option value="progress">Progress</option>
                                            <option value="pending">Pending</option>
                                            <option value="done">Done</option>
                                            <option value="decline">Decline</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-6">
                                        <select name="item_name" class="form-control" id="itemName">
                                            <option disabled selected>Service/Product Item</option>
                                            @foreach ($item_list as $item)
                                            <option value="{{$item->item_id}}">{{$item->item_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" name="complaint_handling_fee" class="form-control"
                                            id="complaintHandlingFee" placeholder="Handling Fee">
                                    </div>
                                </div>


                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <textarea class="form-control" name="complaint_handling_desc"
                                            placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

<script>
    $(document).ready(function () {
        $('#complaintHandlingDate').val('Handling Date');
        $('#complaintHandlingTargetDate').val('Target Handling');
        $('#complaintCustomer').select2();
        $('#itemName').select2();

        $('#complaintCustomer').on('change', function () {
            var id = $(this).val();
            $.get('/data/complaint-handling/getcustomer/' + id, function (data) {
                $('#customerName').val(data[0].customer_fullName);
                $('#vehicle').val(data[0].vehicle_brand_name + ' ' + data[0]
                    .vehicle_model_name);
                $('#licensePlate').val(data[0].customer_detail_licensePlate);
            });

        });

        $.ajax({
            url: '/data/complaint-handling/getcustomerid/' + id,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: id,
            success: function (data) {
                if (data['status'] == true) {
                    console.log(data);
                    $('#customerID').val(data['license_plate'][0].customer_id);
                    $('#vehicleModelID').val(data['license_plate'][0].vehicle_model_id);
                    $('#vehicleBrandID').val(data['license_plate'][0].vehicle_brand_id);
                    $('#customerDetailID').val(cst[0].customer_detail_id);

                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });

        // $('#licensePlateSearch').on('change', function () {

        //     var licensePlateSearch = $('#licensePlateSearch').val();;
        //     // $('.checkitem:checked').each(function () {
        //     //     licensePlateSearch.push($(this).val());
        //     // });
        //     if (licensePlateSearch.length == 0) {
        //         Swal.fire(
        //             '',
        //             'Please input License Plate!',
        //             'warning'
        //         )
        //     } else {
        //         $.ajax({
        //             url: "/data/vehicle/get/" + id,
        //             type: 'GET',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
        //                     'content')
        //             },
        //             data: id,
        //             success: function (data) {
        //                 if (data['status'] == true) {
        //                     console.log(data);
        //                     $('#editVehicleCategory option[value="' + data['vehicle'][0]
        //                         .vehicle_category_id + '"]').prop('selected',
        //                         'selected');
        //                     $('#editVehicleCategory').selectric('refresh');
        //                     $('#editVehicleBrand').val(data['vehicle'][0]
        //                         .vehicle_brand_name);
        //                     $('#editVehicleBrandID').val(data['vehicle'][0]
        //                         .vehicle_brand_id);
        //                     $('#editVehicleModel').val(data['vehicle'][0]
        //                         .vehicle_model_name);
        //                     $('#editVehicleModelID').val(data['vehicle'][0]
        //                         .vehicle_model_id);
        //                     $('#editVehicleSize option[value="' + data['vehicle'][0]
        //                         .vehicle_size_id + '"]').prop('selected',
        //                         'selected');
        //                     $('#editVehicleSize').selectric('refresh');

        //                     $('#editModal').modal('show');

        //                 } else {
        //                     alert('Whoops Something went wrong!!');
        //                 }
        //             },
        //             error: function (data) {
        //                 alert(data.responseText);
        //             }
        //         });
        //     };
        // });

    });

</script>
@endsection
