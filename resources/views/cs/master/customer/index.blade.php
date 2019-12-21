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
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer List</h4>
                        <button class="btn btn-success action-btn" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger action-btn ml-1" id="deleteBtn">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
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
                                    <td><a
                                            href="{{route('customerDetail', $item->customer_id)}}">{{$item->customer_fullName}}</a>
                                    </td>
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
                                <input type="text" name="customer_name" class="form-control" id="customerName"
                                    placeholder="Customer Name">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <input type="text" name="customer_phone" class="form-control numeric-input"
                                    id="customerPhone" placeholder="Phone">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <input type="text" name="customer_licensePlate" class="form-control"
                                    id="customerLicensePlate" placeholder="License Plate" required>
                            </div>
                            <div class="form-group col-12 col-lg-5">
                                <select name="vehicle_category" class="form-control" id="vehicleCategory" required>
                                    <option disabled selected>Category</option>
                                    @foreach ($vehicle_category as $item)
                                    <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-5">
                                <select name="vehicle_brand" class="form-control" id="vehicleBrand" disabled required>
                                    <option disabled selected>Brand</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-5">
                                <select name="vehicle_model" class="form-control" id="vehicleModel" disabled required>
                                    <option disabled selected>Model</option>
                                </select>
                            </div>
                            <div class="form-group col-10 col-lg-5">
                                <select name="vehicle_color" class="form-control" id="vehicleColor" disabled required>
                                    <option disabled selected>Color</option>
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

    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        no_label: true // Default: false
    });

    $(document).ready(function () {

        var customerTable = $('#customerTable').dataTable({
            "lengthMenu": [8, 10, 25, 50, 75, 100],
            dom: "frtipl",
            bInfo: false,
            responsive: true,
            columnDefs: [{
                sortable: false,
                targets: [0]
            }],
            language: {
                sLengthMenu: "Show _MENU_",
                search: "",
                searchPlaceholder: "Search..."
            }
        });

        $('#vehicleCategory').selectric();
        $('#vehicleBrand').selectric();
        $('#vehicleModel').selectric();
        $('#vehicleColor').selectric();

        $('#vehicleCategory').on('change', function (e) {
            var vehicle_category_id = e.target.value;
            $.get('/data/vehicle/vehiclebrand?category_id=' + vehicle_category_id, function (data) {
                $('#vehicleBrand').empty();
                $('#vehicleBrand').prop("disabled", false);
                $('#vehicleBrand').append(
                    '<option value="" disabled selected>Brand</option>'
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
                    '<option value="" disabled selected>Model</option>'
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
                            url: "{{ route('deleteCustomer') }}",
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
    });

</script>
@endsection
