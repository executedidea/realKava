@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')

@endsection
@section('content')
<section id="customerDetail">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Detail</h4>
                        <button class="btn btn-info ml-1" id="editCustomerBtn" data-id="{{$customer_id}}">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <h4 class="ml-auto">Export to:</h4>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/pdf.png')}}" alt="pdf" height="50px">
                        </a>
                        <a href="http://" class="ml-1">
                            <img src="{{asset('img/icons/excel.png')}}" alt="excel" height="50px">
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @foreach ($customer as $item)
                        <div class="card card-large-icons card-inside">
                            <div class="card-icon outlet-card">
                                <div class="circular">
                                    <img src="{{asset('storage/images/customer_images/thumbnails/'.$item->customer_image)}}"
                                        alt="{{$item->customer_image}}">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletName">Name</label>
                                        <input type="text" class="form-control" value="{{$item->customer_fullName}}"
                                            disabled>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletName">Phone Number</label>
                                        <input type="text" class="form-control" value="{{$item->customer_phone}}"
                                            disabled>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletName">Membership</label>
                                        <input type="text" class="form-control" value="Non Member" disabled>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="outletName">Last Visit</label>
                                        <input type="text" class="form-control" value="--" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer's Vehicle</h4>
                        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-info ml-1" id="editBtn">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-danger ml-1" id="deleteBtn">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="customerVehicleTable">
                            <thead>
                                <tr>
                                    <th class="th-sm text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="customers"
                                                class="custom-control-input" name="id[]" id="checkAll" value="">
                                            <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>License Plate</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_detail as $item)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="rights"
                                                class="custom-control-input checkitem" name="id[]"
                                                id="checkbox{{$item->customer_detail_id}}"
                                                value="{{$item->customer_detail_id}}">
                                            <label for="checkbox{{$item->customer_detail_id}}"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{$item->customer_detail_licensePlate}}</td>
                                    <td>{{$item->vehicle_category_name}}</td>
                                    <td>{{$item->vehicle_brand_name}}</td>
                                    <td>{{$item->vehicle_model_name}}</td>
                                    <td>{{$item->vehicle_color_name}}</td>
                                    <td>{{$item->vehicle_size_name}}</td>
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
    <div class="modal-dialog" role="document">
        <form action="{{route('addCustomerDetail', $customer_id)}}" method="post" class="validate-this">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer's Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            @csrf
                            <div class="form-group col-12">
                                <label for="customerLicensePlate">License Plate</label>
                                <input type="text" name="customer_licensePlate" class="form-control"
                                    id="customerLicensePlate" placeholder="e.g D123AB">
                            </div>
                            <div class="form-group col-12 p-0 ml-3 mb-3">
                                <span class="text-muted font-italic">Vehicle</span>
                            </div>
                            <div class="form-group col-12">
                                <select name="vehicle_category" id="vehicleCategory">
                                    <option disabled selected>--Select Category--</option>
                                    @foreach ($vehicle_category as $item)
                                    <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <select name="vehicle_brand" class="form-control" id="vehicleBrand" disabled required>
                                    <option disabled selected>---Select Brand---</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <select name="vehicle_model" class="form-control" id="vehicleModel" disabled required>
                                    <option disabled selected>---Select Model---</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <select name="vehicle_color" class="form-control" id="vehicleColor" disabled required>
                                    <option disabled selected>---Select Color---</option>
                                    @foreach($vehicle_color as $item)
                                    <option value="{{$item->vehicle_color_id}}">{{$item->vehicle_color_name}}
                                    </option>
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
{{-- Edit Customer Modal --}}
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModal"
    aria-hidden="true">
    <div class="modal-dialog lg" role="document">
        <form action="{{ route('editCustomer', $customer_id) }}" method="post" enctype="multipart/form-data"
            class="validate-this">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Customer Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Profile --}}
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            <div id="image-preview" class="mx-auto" @if ($customer[0]->customer_image !== 'default.png')
                                style="background-image:
                                url({{asset('storage/images/customer_images/thumbnails/'.$customer[0]->customer_image)}})"
                                @endif>
                                <input type="file" name="customer_image" id="image-upload" />
                            </div>
                            <label for="image-upload" id="image-label" class="btn btn-secondary btn-sm mt-2">Upload
                                Image</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="editCustomerName">Name</label>
                            <input type="text" class="form-control" id="editCustomerName" name="customer_name" value="">
                        </div>
                        <div class="form-group col-12">
                            <label for="editCustomerPhone">Phone</label>
                            <input type="text" class="form-control numeric-input" id="editCustomerPhone"
                                name="customer_phone" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_customer" class="btn btn-primary btn-block">Save</button>
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
        var customerVehicleTable = $('#customerVehicleTable').dataTable({
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
            } else if (customerVehicleTable.fnGetData().length <= 1 || id.length == customerVehicleTable
                .fnGetData().length) {
                Swal.fire(
                    'Sorry',
                    'You can not delete all of them!',
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
                            url: "{{ route('deleteCustomerDetail') }}",
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
                                        'Your data has been deleted!',
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

        $('#editCustomerBtn').on('click', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "/data/customer/getcustomer/" + id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: id,
                success: function (data) {
                    if (data['status'] == true) {
                        $('#editCustomerName').val(data['customer'][0].customer_fullName);
                        $('#editCustomerPhone').val(data['customer'][0].customer_phone);

                        $('#editCustomerModal').modal('show');
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        });
    });

</script>
@endsection
