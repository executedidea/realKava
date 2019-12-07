@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
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
                            <tr>
                                @foreach($complaint_handling as $item)
                                <td>{{ $item->complaint_handling_date }}</td>
                                <td>{{ $item->customer_fullName }}</td>
                                <td>{{ $item->complaint_type_name }}</td>
                                <td>{{ $item->complaint_handling_status }}</td>
                                @endforeach
                            </tr>
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
<div class="modal fade" id="addComplaintHandlingModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
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
                                                <form action="" method="get">
                                                    <div class="row justify-content-center">
                                                        <div class="form-group col-12">
                                                            <input type="text" name="license_plate" class="form-control"
                                                                placeholder="Search License Plate"
                                                                id="licensePlateSearch">
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block col-10">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="customerName" value="Customer Name"
                                        disabled>
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="vehicle" value="Vehicle" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="licensePlate" value="License Plate"
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
                                        <input type="text" name="complaint_handling_customerType" class="form-control"
                                            id="complaintHandlingType" value="" placeholder="Complaint Type">
                                    </div>
                                    <div class="form-group col-6">
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

                                <div class="row justify-content-center range-form">
                                    <div class="form-group col-6">
                                        <select name="complaint_handling_item" class="form-control"
                                            id="complaintHandlingItem">
                                            <option disabled selected>Service/Product Item</option>
                                            <option value=""></option>
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

        $('#licensePlateSearch').on('change', function () {

            var licensePlateSearch = $('#licensePlateSearch').val();;
            // $('.checkitem:checked').each(function () {
            //     licensePlateSearch.push($(this).val());
            // });
            if (licensePlateSearch.length == 0) {
                Swal.fire(
                    '',
                    'Please input License Plate!',
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

    });

</script>
@endsection
