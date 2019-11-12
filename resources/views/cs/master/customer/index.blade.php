@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')

@endsection
@section('content')
<section id="customerList">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer List</h4>
                        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger ml-1" id="deleteBtn">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                        <h4 class="ml-auto">Export to:</h4>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                        </a>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="customerTable">
                            <thead>
                                <tr>
                                    <th class="th-sm text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="customers"
                                                class="custom-control-input" name="id[]" id="checkAll" value="">
                                            <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="rights"
                                                class="custom-control-input checkitem" name="id[]"
                                                id="checkbox{{$item->customer_id}}" value="{{$item->customer_id}}">
                                            <label for="checkbox{{$item->customer_id}}"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('customerDetail', $item->customer_id)}}">CUST{{$index+1}}</a>
                                    </td>
                                    <td>{{$item->customer_fullName}}</td>
                                    <td>{{$item->customer_phone}}</td>
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
{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('addCustomerPost')}}" method="post" enctype="multipart/form-data" class="validate-this">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-lg-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            @csrf
                            <div class="col-12 text-center">
                                <div id="image-preview" class="mx-auto">
                                    <input type="file" name="customer_image" id="image-upload" />
                                </div>
                                <label for="image-upload" id="image-label" class="btn btn-secondary btn-sm mt-2">Upload
                                    Image</label>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="form-group col-12 col-lg-4">
                                <label for="customerName">Name</label>
                                <input type="text" name="customer_name" class="form-control" id="customerName">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="customerPhone">Phone</label>
                                <input type="text" name="customer_phone" class="form-control" id="customerPhone">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="customerLicensePlate">License Plate</label>
                                <input type="text" name="customer_licensePlate" class="form-control"
                                    id="customerLicensePlate" placeholder="e.g D123AB" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <select name="vehicle_category" class="form-control" id="vehicleCategory" required>
                                    <option disabled selected>---Select Category---</option>
                                    @foreach ($vehicle_category as $item)
                                    <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <select name="vehicle_brand" class="form-control" id="vehicleBrand" disabled required>
                                    <option disabled selected>---Select Brand---</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <select name="vehicle_model" class="form-control" id="vehicleModel" disabled required>
                                    <option disabled selected>---Select Model---</option>
                                </select>
                            </div>
                            <div class="form-group col-10 col-lg-5">
                                <select name="vehicle_size" class="form-control" id="vehicleSize" disabled required>
                                    <option disabled selected>---Select Size---</option>
                                    @foreach($vehicle_size as $item)
                                    <option value="{{$item->vehicle_size_id}}">{{$item->vehicle_size_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-10 col-lg-5">
                                <select name="vehicle_color" class="form-control" id="vehicleColor" disabled required>
                                    <option disabled selected>---Select Color---</option>
                                    @foreach($vehicle_color as $item)
                                    <option value="{{$item->vehicle_color_id}}">{{$item->vehicle_color_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#vehicleCategory').selectric();
        $('#vehicleBrand').selectric();
        $('#vehicleModel').selectric();
        $('#vehicleSize').selectric();
        $('#vehicleColor').selectric();

        $('#vehicleCategory').on('change', function (e) {
            var vehicle_category_id = e.target.value;
            $.get('/data/vehicle/vehiclebrand?category_id=' + vehicle_category_id, function (data) {
                $('#vehicleBrand').empty();
                $('#vehicleBrand').prop("disabled", false);
                $('#vehicleBrand').append(
                    '<option value="" disabled selected>--Select Brand--</option>'
                );


                $.each(data, function (index, brandObj) {
                    $('#vehicleBrand').append('<option value="' + brandObj
                        .vehicle_brand_id +
                        '">' + brandObj.vehicle_brand_name + '</option>');
                })
                $('#vehicleBrand').selectric('refresh');
            });
        });
        $('#vehicleBrand').on('change', function (e) {
            var vehicle_brand_id = e.target.value;
            $.get('/data/vehicle/vehiclemodel?brand_id=' + vehicle_brand_id, function (data) {
                $('#vehicleModel').empty();
                $('#vehicleModel').prop("disabled", false);
                $('#vehicleModel').append(
                    '<option value="" disabled selected>--Select Model--</option>'
                );

                $.each(data, function (index, modelObj) {
                    $('#vehicleModel').append('<option value="' + modelObj
                        .vehicle_model_id +
                        '">' + modelObj.vehicle_model_name + '</option>');
                })
                $('#vehicleModel').selectric('refresh');
            });
        });
        $('#vehicleModel').on('change', function () {
            $('#vehicleColor').prop("disabled", false);
            $('#vehicleColor').selectric('refresh');
            $('#vehicleSize').prop("disabled", false);
            $('#vehicleSize').selectric('refresh');
        });
    });

</script>
@endsection
