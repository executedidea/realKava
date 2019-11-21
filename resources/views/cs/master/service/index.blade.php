@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')

@endsection
@section('content')
<section id="serviceList">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Service List</h4>
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
                        <table class="table table-striped" id="serviceTable">
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
                                    <th>Service Name</th>
                                    <th>Vehicle Category</th>
                                    <th>Vehicle Size</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="rights"
                                                class="custom-control-input checkitem" name="id[]"
                                                id="checkbox{{$item->service_id}}" value="{{$item->service_id}}">
                                            <label for="checkbox{{$item->service_id}}"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>SRV{{ $index+1 }}</td>
                                    <td>{{ $item->service_name }}</td>
                                    <td>{{ $item->vehicle_category_name }}</td>
                                    <td>{{ $item->vehicle_size_name }}</td>
                                    <td>Rp {{ $item->service_price }},00</td>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="deleteModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 py-4">
                            <form action="{{route('storeService')}}" method="POST" id="addServiceForm" class="validate-this">
                                @csrf
                                <div class="form-group">
                                    <label for="serviceName">Service Name</label>
                                    <input type="text" name="service_name" class="form-control" id="serviceName" required>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleCategory">Vehicle Category</label>
                                    <select name="vehicle_category" id="vehicleCategory" class="vehicle-category" required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($vehicle_category as $item)
                                        <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleSize">Vehicle Size</label>
                                    <select name="vehicle_size" id="vehicleSize" class="vehicle-size" required>
                                        <option value="" selected disabled>Select Size</option>
                                        @foreach($vehicle_size as $item)
                                        <option value="{{$item->vehicle_size_id}}">{{$item->vehicle_size_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleCategory">Price</label>
                                    <input type="text" class="form-control" name="service_price" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ediModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="deleteModalLabel">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 py-4">
                            <form action="" method="POST" id="editServiceForm" class="validate-this">
                                @csrf
                                <div class="form-group">
                                    <label for="serviceName">Service Name</label>
                                    <input type="text" name="service_name" class="form-control" id="editServiceName" required>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleCategory">Vehicle Category</label>
                                    <select name="vehicle_category" id="editVehicleCategory" required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($vehicle_category as $item)
                                        <option value="{{$item->vehicle_category_id}}">{{$item->vehicle_category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleSize">Vehicle Size</label>
                                    <select name="vehicle_size" id="editVehicleSize" required>
                                        <option value="" selected disabled>Select Size</option>
                                        @foreach($vehicle_size as $item)
                                        <option value="{{$item->vehicle_size_id}}">{{$item->vehicle_size_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleCategory">Price</label>
                                    <input type="text" class="form-control" name="service_price" id="editServicePrice" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
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
    $(document).ready(function () {
        $('.vehicle-category').selectric({
            disableOnMobile: false,
            nativeOnMobile: false
        });
        $('.vehicle-size').selectric({
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
                            url: "{{ route('destroyService') }}",
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
                $('#editServiceForm').attr('action',
                    '/cs/master/service/'+id+'/edit');

                $.ajax({
                    url: "/data/service/get/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: id,
                    success: function (data) {
                        if (data['status'] == true) {
                            console.log(data);
                            $('#editServiceName').val(data['service'][0].service_name);
                            $('#editVehicleCategory option[value="' + data['service'][0]
                                .vehicle_category_id + '"]').prop('selected',
                                'selected');
                            $('#editVehicleCategory').selectric('refresh');
                            $('#editVehicleSize option[value="' + data['service'][0]
                                .vehicle_size_id + '"]').prop('selected',
                                'selected');
                            $('#editVehicleSize').selectric('refresh');
                            $('#editServicePrice').val(data['service'][0].service_price);

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
