@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                                <th class="th-sm text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="customers" class="custom-control-input"
                                            name="id[]" id="checkAll" value="">
                                        <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaint_handling as $item)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input checkitem" name="id[]"
                                            id="checkbox{{$item->complaint_handling_id}}"
                                            value="{{$item->complaint_handling_id}}">
                                        <label for="checkbox{{$item->complaint_handling_id}}"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('storeComplaintHandlingTransaction') }}" method="post"
                                id="complaintHandlingForm" class="validate-this">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="customerName" value=""
                                            placeholder="Customer Name" name="customer_name" readonly>
                                        <input type="hidden" name="customer_id" value="" id="customerID" readonly>

                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="vehicle" placeholder="Vehicle"
                                            name="vehicle" readonly>
                                        <input type="hidden" name="vehicle_brand_id" value="" id="vehicleBrandID"
                                            readonly>
                                        <input type="hidden" name="vehicle_model_id" value="" id="vehicleModelID"
                                            readonly>

                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="licensePlate"
                                            placeholder="License Plate" name="license_plate" readonly>
                                        <input type="hidden" name="customer_detail_id" value="" id="customerDetailID"
                                            readonly>

                                    </div>
                                </div>

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
                                        <select name="complaint_type_id" class="form-control" id="complaintType">
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
                                        <select name="item_id" class="form-control" id="itemName">
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
{{-- Edit Complaint Handling --}}
<div class="modal fade" id="editComplaintHandlingModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Complaint Handling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="editComplaintHandlingForm" class="validate-this">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="editCustomerName" value=""
                                            placeholder="Customer Name" name="customer_fullName" readonly>
                                        <input type="hidden" name="customer_id" value="" id="editCustomerID" readonly>

                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="vehicle" placeholder="Vehicle"
                                            name="vehicle" readonly>
                                        <input type="hidden" name="vehicle_brand_id" value="" id="editVehicleBrandID"
                                            readonly>
                                        <input type="hidden" name="vehicle_model_id" value="" id="editVehicleModelID"
                                            readonly>

                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" class="form-control" id="editLicensePlate"
                                            placeholder="License Plate" name="license_plate" readonly>
                                        <input type="hidden" name="customer_detail_id" value=""
                                            id="editCustomerDetailID" readonly>

                                    </div>
                                </div>

                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-3">
                                        <input type="text" name="complaint_handling_date"
                                            class="form-control datepicker" id="editComplaintHandlingDate" value=""
                                            placeholder="Date">
                                    </div>
                                    <div class="form-group col-3">
                                        <input type="text" name="complaint_handling_targetDate"
                                            class="form-control datepicker" id="editComplaintHandlingTargetDate"
                                            placeholder="Target Handling">
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" name="complaint_handling_handler" class="form-control"
                                            id="editComplaintHandlingHandler" placeholder="Handler">
                                    </div>
                                </div>

                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-6">
                                        <select name="complaint_type_id" class="form-control" id="editComplaintType">
                                            <option disabled selected>Complaint Type</option>
                                            @foreach ($complaint_type_list as $item)editItemId
                                            <option value="{{$item->complaint_type_id}}">{{$item->complaint_type_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <select name="complaint_handling_status" class="form-control"
                                            id="editComplaintHandlingStatus">
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
                                        <select name="item_id" class="form-control" id="editItemName">
                                            <option disabled selected>Service/Product Item</option>
                                            @foreach ($item_list as $item)
                                            <option value="{{$item->item_id}}">{{$item->item_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" name="complaint_handling_fee" class="form-control"
                                            id="editComplaintHandlingFee" placeholder="Handling Fee">
                                    </div>
                                </div>


                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <textarea class="form-control" name="complaint_handling_desc"
                                            id="editComplaintHandlingDesc" placeholder="Description"></textarea>
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
@endsection
@section('script')
<script src="{{asset('/js/page/modules-ion-icons.js')}}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/js/kava/cs/complaint-handling/index.js') }}"></script>
@endsection
