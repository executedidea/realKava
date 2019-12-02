@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cashier</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addCashierModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-info ml-1" id="editBtn" data-toggle="modal" data-target="#editCashierModal">
                        <i class="fas fa-edit" aria-hidden="true"></i>
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="th-sm text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights" class="custom-control-input"
                                            name="id[]" id="checkAll" value="">
                                        <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Group</th>
                                <th>Name</th>
                                <th>Shift Code</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Max Discount</th>
                                <th>Max Add Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashier_list as $index => $item)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input checkitem" name="id[]"
                                            id="checkbox{{ $item->cashier_id }}" value="{{ $item->cashier_id }}">
                                        <label for="checkbox{{ $item->cashier_id }}"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>BA{{ $index+1 }}</td>
                                <td>{{ $item->group_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->shift_code }}</td>
                                <td>{{ $item->shift_startTime }}</td>
                                <td>{{ $item->shift_endTime }}</td>
                                <td>{{ $item->disc_percent }}%</td>
                                <td>{{ $item->disc_add_1 }}%</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
{{-- Add Cashier Modal --}}
<div class="modal fade" id="addCashierModal" tabindex="-1" role="dialog" aria-labelledby="addBankModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Add Cashier List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <form action="{{ route('storeCashier') }}" method="post" id="addCashierForm">
                                @csrf

                                {{-- Form --}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Group</label>
                                                <select name="group_id" class="form-control category">
                                                    <option disabled selected>--Select Group--</option>

                                                    @foreach ($group as $item)
                                                    <option value="">
                                                        {{$item->group_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Name</label>
                                                <select name="user_id" class="form-control category">
                                                    <option disabled selected>--Select Name--</option>

                                                    @foreach ($user_name as $item)
                                                    <option value="{{$item->user_id}}">
                                                        {{$item->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="form-group col-6">
                                                <label for="">Shift</label>
                                                <select name="shift_id" class="form-control category">
                                                    <option disabled selected>--Select Shift Time--</option>

                                                    @foreach ($shift_code_all as $item)
                                                    <option value="{{$item->shift_id}}">
                                                        {{$item->shift_code}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="startTime">Start Time</label>
                                                <input type="time" name="shift_startTime" step="1" class="form-control"
                                                    value="">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="endTime">End Time</label>
                                                <input type="time" name="shift_endTime" step="1" class="form-control"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Max Discount</label>
                                                <div class="input-group" data-colorpicker-id="2">
                                                    <input type="number" id="editDiscPercentPercent"
                                                        class="form-control" name="disc_percent" value="">
                                                    <div class="input-group-append">
                                                        editAddDiscPercent <div class="input-group-text">
                                                            <i class="fas fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Max Add Discount</label>
                                                <div class="input-group" data-colorpicker-id="2">
                                                    <input type="number" id="editAddDiscPercent" class="form-control"
                                                        name="add_disc_percent" value="">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                {{-- End Form --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Cashier Modal --}}
<div class="modal fade" id="editCashierModal" tabindex="-1" role="dialog" aria-labelledby="editCashierModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Edit Cashier List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <form action="" method="post" id="editCashierForm">
                                @csrf

                                {{-- Form --}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Group</label>
                                                <select name="edit_group_id" class="form-control category" id="">
                                                    <option disabled selected>--Select Group--</option>

                                                    @foreach ($group as $item)
                                                    <option value="">
                                                        {{$item->group_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Name</label>
                                                <select name="edit_user_id" class="form-control category"
                                                    id="editUserid">
                                                    <option disabled selected>--Select Name--</option>

                                                    @foreach ($user_name as $item)
                                                    <option value="{{$item->user_id}}">
                                                        {{$item->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="form-group col-6">
                                                <label for="">Shift</label>
                                                <select name="edit_shift_id" class="form-control category"
                                                    id="editShiftId">
                                                    <option disabled selected>--Select Shift Time--</option>

                                                    @foreach ($shift_code_all as $item)
                                                    <option value="{{$item->shift_id}}">
                                                        {{$item->shift_code}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="startTime">Start Time</label>
                                                <input type="time" id="editShiftStartTime" name="shift_startTime"
                                                    step="1" class="form-control" value="">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="endTime">End Time</label>
                                                <input type="time" id="editShiftEndTime" name="shift_endTime" step="1"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Max Discount</label>
                                                <div class="input-group" data-colorpicker-id="2">
                                                    <input type="number" class="form-control" name="edit_disc_percent"
                                                        value="0">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Max Add Discount</label>
                                                <div class="input-group" data-colorpicker-id="2">
                                                    <input type="number" class="form-control"
                                                        name="edit_add_disc_percent" value="0">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                {{-- End Form --}}

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
        input_field: "#image-upload",
        preview_box: "#image-preview",
        no_label: true
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

        $('.vehicle-category').selectric({
            disableOnMobile: false,
            nativeOnMobile: false
        });
        $('.vehicle-brand').selectric();
        $('.vehicle-model').selectric();
        $('.vehicle-color').selectric();

        $('.vehicle-category').on('change', function (e) {
            var vehicle_category_id = e.target.value;
            $.get('/data/vehicle/vehiclebrand?category_id=' + vehicle_category_id, function (data) {
                $('.vehicle-brand').empty();
                $('.vehicle-brand').prop("disabled", false);
                $('.vehicle-brand').append(
                    '<option value="" disabled selected>Select Brand</option>'
                );
                $('.vehicle-model').prop("disabled", true);
                $('.vehicle-model').selectric('refresh');
                $('.vehicle-color').prop("disabled", true);
                $('.vehicle-color').selectric('refresh');



                $.each(data, function (index, brandObj) {
                    $('.vehicle-brand').append('<option value="' + brandObj
                        .vehicle_brand_id +
                        '">' + brandObj.vehicle_brand_name + '</option>');
                })
                $('.vehicle-brand').selectric('refresh');
            });
        });
        $('.vehicle-brand').on('change', function (e) {
            var vehicle_brand_id = e.target.value;
            $.get('/data/vehicle/vehiclemodel?brand_id=' + vehicle_brand_id, function (data) {
                $('.vehicle-model').empty();
                $('.vehicle-model').prop("disabled", false);
                $('.vehicle-model').append(
                    '<option value="" disabled selected>Select Model</option>'
                );
                $('.vehicle-color').prop("disabled", true);
                $('.vehicle-color').selectric('refresh');


                $.each(data, function (index, modelObj) {
                    $('.vehicle-model').append('<option value="' + modelObj
                        .vehicle_model_id +
                        '">' + modelObj.vehicle_model_name + '</option>');
                })
                $('.vehicle-model').selectric('refresh');
            });
        });
        $('.vehicle-model').on('change', function () {
            $('.vehicle-color').prop("disabled", false);
            $('.vehicle-color').selectric('refresh');
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
                $('#editCashierForm').attr('action',
                    '/cs/master/cashier/' + id + '/edit');
                $.ajax({
                    url: "/data/cashier/get/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: id,
                    success: function (data) {
                        if (data['status'] == true) {
                            console.log(data);
                            $('#editUserId option[value="' + data['cashier_by_id'][0]
                                .edit_user_id + '"]').prop('selected',
                                'selected');
                            $('#editShiftId option[value="' + data['cashier_by_id'][0]
                                .edit_shift_id + '"]').prop('selected',
                                'selected');
                            $('#editDiscPercent').val(data['cashier_by_id'][0]
                                .edit_disc_percent);
                            $('#editAddDiscPercent').val(data['cashier_by_id'][0]
                                .edit_add_disc_percent);
                            $('#editCashierModal').modal('show');

                        } else {
                            alert('Whoops Shing went wrong!!');
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
