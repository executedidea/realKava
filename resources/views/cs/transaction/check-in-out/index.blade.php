@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
<section id="customerCheck">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Check In</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-12">
                                <select name="key" id="customerSearch">
                                    <option value="" disabled selected>Search Name, License Plate, or Phone Number</option>
                                    @foreach ($customer_detail as $item)
                                        <option value=""><b>{{ $item->customer_fullName}}</b> <span class="text-muted">{{ $item->customer_detail_licensePlate }}</span></option>
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
                        <h4>Today's Customer</h4>
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
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>License Plate</th>
                                    <th>Vehicle</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer_checked_in as $index => $item)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $item->customer_fullName }}</td>
                                            <td>{{ $item->customer_detail_licensePlate }}</td>
                                            <td>{{ $item->vehicle_brand_name . " " . $item->vehicle_model_name }}</td>
                                            <td>{{ $item->service_name }}</td>
                                                <td>
                                                    <div class="badge badge-info">In Progress</div>
                                                </td>
                                            <td>
                                                <button class="btn btn-danger">Check Out</button>
                                            </td>
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
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function(){
    $('#customerSearch').select2();
});
</script>
@endsection