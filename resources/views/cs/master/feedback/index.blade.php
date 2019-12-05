@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<section id="feedbackList">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Feedback List</h4>
                        <button class="btn btn-success action-btn" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-info action-btn ml-1" id="editBtn">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger action-btn ml-1" id="deleteBtn">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button>
                        <h4 class="ml-auto action-btn">Export to:</h4>
                        <a href="http://" class="action-btn ml-1">
                            <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                        </a>
                        <a href="http://" class="action-btn ml-1">
                            <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="vehicleTable">
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
                                    <th>Feedback Category</th>
                                    <th>Feedback Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($memberships as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="rights"
                                                class="custom-control-input checkitem" name="id[]"
                                                id="checkbox{{$item->membership_id}}" value="{{$item->membership_id}}">
                                <label for="checkbox{{$item->membership_id}}"
                                    class="custom-control-label">&nbsp;</label>
                    </div>
                    </td>
                    <td>MBR{{ $item->membership_id }}</td>
                    <td>{{ $item->membership_startDate }}</td>
                    <td>{{ $item->membership_endDate }}</td>
                    <td>{{ $item->membership_category }}</td>
                    <td>{{ $item->vehicle_category_name }}</td>
                    </tr>
                    @endforeach --}}
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
        <form action="" method="post" class="validate-this">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Membership</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-lg-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            @csrf
                            <div class="form-group col-12">
                                <label for="membershipName">Membership Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="membershipType">Membership Type</label>
                                <select name="membership_type" id="membershipType" required>
                                    <option value="" selected disabled>Select Membership type</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12 col-lg-6">
                                <label>Start Date</label>
                                <input type="text" name="membership_startDate" class="form-control datepicker" required>
                            </div>
                            <div class="form-group col-lg-12 col-lg-6">
                                <label>Start Date</label>
                                <input type="text" name="membership_endDate" class="form-control datepicker" required>
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
{{-- Edit --}}
{{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="edtModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="deleteModalLabel">Edit Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 py-5">
                            <form method="post" id="editVehicleForm">
                                {{ csrf_field() }}
<div class="form-group">
    <label for="editVehicleCategory">Category</label>
    <select name="vehicle_category_id" class="form-control category" id="editVehicleCategory">
        <option value="" selected disabled>--Select Category--</option>
        @foreach ($vehicle_category as $item)
        <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="editVehicleBrand">Brand</label>
    <input type="text" name="vehicle_brand_name" class="form-control" id="editVehicleBrand" value="">
    <input type="hidden" name="vehicle_brand_id" value="" id="editVehicleBrandID">
</div>
<div class="form-group">
    <label for="editVehicleModel">Model</label>
    <input type="text" name="vehicle_model_name" class="form-control" id="editVehicleModel" value="">
    <input type="hidden" name="vehicle_model_id" value="" id="editVehicleModelID">

</div>
<div class="form-group">
    <label for="editVehicleSize">Size</label>
    <select name="vehicle_size_id" class="form-control size" id="editVehicleSize">
        <option value="" selected disabled>--Select Size--</option>
        @foreach ($vehicle_size as $item)
        <option value="{{$item->vehicle_size_id}}">{{$item->vehicle_size_name}}
        </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $("#checkAll").on('change', function () {
        $(".checkitem").prop('checked', $(this).is(":checked"));
    });
    $('.checkitem').on('change', function () {
        if ($('.checkitem:checked').length !== $('.checkitem').length) {
            $('#checkAll').prop('checked', false);
        } else {
            $('#checkAll').prop('checked', true);
        }
    });
    $(document).ready(function () {
        $('.vehicle-category').selectric({
            disableOnMobile: false,
            nativeOnMobile: false
        });
        $('.vehicle-size').selectric({
            disableOnMobile: false,
            nativeOnMobile: false
        });
        $('#membershipType').selectric({
            disableOnMobile: false,
            nativeOnMobile: false
        });

        $('#deleteBtn').on('click', function () {
            var id = [];
            $('.checkitem:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length == 0) {
                Swal.fire(
                    '',
                    'Please select at least 1 data!',
                    'warning'
                )
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete them!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        var strIds = id.join(",");

                        $.ajax({
                            url: "{{ route('destroyVehicle') }}",
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: 'id=' + strIds,
                            success: function (data) {
                                if (data['status'] == true) {
                                    $(".checkitem:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });

                    }
                });
            };
        });

        $('#editBtn').on('click', function () {
            var id = [];
            $('.checkitem:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length > 1) {
                Swal.fire(
                    "",
                    "You can't edit data more than 1 at the same time!",
                    'warning'
                )
            } else if (id.length == 0) {
                Swal.fire(
                    '',
                    'Please select at least 1 data!',
                    'warning'
                )
            } else {
                $('#editVehicleForm').attr('action',
                    '/cs/master/vehicle/' + id + '/edit');

                $.ajax({
                    url: "/data/vehicle/get/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: id,
                    success: function (data) {
                        if (data['status'] == true) {
                            console.log(data);
                            $('#editVehicleCategory option[value="' + data['vehicle'][0]
                                .vehicle_category_id + '"]').prop('selected',
                                'selected');
                            $('#editVehicleCategory').selectric('refresh');
                            $('#editVehicleBrand').val(data['vehicle'][0]
                                .vehicle_brand_name);
                            $('#editVehicleBrandID').val(data['vehicle'][0]
                                .vehicle_brand_id);
                            $('#editVehicleModel').val(data['vehicle'][0]
                                .vehicle_model_name);
                            $('#editVehicleModelID').val(data['vehicle'][0]
                                .vehicle_model_id);
                            $('#editVehicleSize option[value="' + data['vehicle'][0]
                                .vehicle_size_id + '"]').prop('selected',
                                'selected');
                            $('#editVehicleSize').selectric('refresh');

                            $('#editModal').modal('show');

                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            }
        });
    });

</script>
@endsection
