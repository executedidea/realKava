@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('title', 'Customer Service - KAVA')
@section('content-title', 'Complaint Handling')
@section('content')

<div class="container">

    <section id="customerCheck">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <input type="text" name="license_plate" class="form-control"
                                            placeholder="Search License Plate">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block col-10">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body justify-content-center">
                    <div class="row">
                        <div class="form-group col-4">
                            <input type="text" class="form-control" id="customerName" value="Customer Name" disabled>
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control" id="vehicle" value="Vehicle" disabled>
                        </div>
                        <div class="form-group col-4">
                            <input type="text" class="form-control" id="licensePlate" value="License Plate" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeComplaintHandlingTransaction') }}" method="post" id="openStoreForm">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-1"></div>
                            <div class="form-group col-3">
                                <input type="text" name="complaint_handling_date" class="form-control datepicker"
                                    id="complaintHandlingDate" value="" placeholder="Date">
                            </div>
                            <div class="form-group col-4">
                            </div>
                            <div class="form-group col-3">
                                <input type="text" name="complaint_handling_targetDate" class="form-control datepicker"
                                    id="complaintHandlingTargetDate" placeholder="Target Handling">
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-5">
                                <input type="text" name="complaint_handling_customerName" class="form-control"
                                    id="complaintHandlingCustomerName" value="" placeholder="Customer Name">
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="complaint_handling_handler" class="form-control"
                                    id="complaintHandlingHandler" placeholder="Handler">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-5">
                                <input type="text" name="complaint_handling_customerType" class="form-control"
                                    id="complaintHandlingType" value="" placeholder="Complaint Type">
                            </div>
                            <div class="form-group col-5">
                                <select name="complaint_handling_status" class="form-control"
                                    id="complaintHandlingStatus">
                                    <option disabled selected>Status Handling</option>
                                    <option value="">Progress</option>
                                    <option value="">Pending</option>
                                    <option value="">Done</option>
                                    <option value="">Decline</option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-5">
                                <select name="complaint_handling_item" class="form-control" id="complaintHandlingItem">
                                    <option disabled selected>Service/Product Item</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <input type="text" name="complaint_handling_fee" class="form-control"
                                    id="complaintHandlingFee" placeholder="Handling Fee">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-8">
                            </div>

                            <div class="col-1"></div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                <textarea class="form-control" name="complaint_handling_desc"
                                    placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-10">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('modal')
@endsection
@section('script')
<script src="{{asset('/js/page/modules-ion-icons.js')}}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
@endsection
