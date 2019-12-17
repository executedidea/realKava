@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/kava/cs/check-in-out.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.rateyo.min.css') }}">
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
                                    <option value="" disabled selected>Search Name, License Plate, or Phone Number
                                    </option>
                                    @foreach ($customer_detail as $item)
                                    <option value="{{$item->customer_detail_id}}"><b>{{ $item->customer_fullName}}</b>
                                        <span class="text-muted">{{ $item->customer_detail_licensePlate }}</span>
                                    </option>
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
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Ticket No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">License Plate</th>
                                    <th class="text-center">Vehicle</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checked_in_customer as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index+1 }}</td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$item->customer_detail_id}}"
                                            class="customer-detail">{{ $item->customer_fullName }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$item->customer_detail_id}}"
                                            class="customer-detail">{{ $item->customer_detail_licensePlate }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" data-id="{{$item->customer_detail_id}}"
                                            class="customer-detail">{{ $item->vehicle_brand_name . " " . $item->vehicle_model_name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger check-out-btn"
                                            data-id="{{$item->check_in_id}}">Check Out</button>
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
@section('modal')
{{-- Check In Modal --}}
<div class="modal fade" id="customerCheckInModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Check In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('checkIn')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" name="customer_detail_id" id="checkInCustomerID">
                            <div class="form-group col-4">
                                <label for="checkInCustomerName">Customer Name</label>
                                <input type="text" class="form-control" id="checkInCustomerName" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label for="checkInCustomerPhone">Phone Number</label>
                                <input type="text" class="form-control" id="checkInCustomerPhone" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label for="checkInCustomerLicensePlate">License Plate</label>
                                <input type="text" class="form-control" id="checkInCustomerLicensePlate" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Service</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($items as $item)
                                            <div class="custom-checkbox custom-control col-3 my-2">
                                                <input type="checkbox" data-checkboxes="services"
                                                    class="custom-control-input" name="item_id[]"
                                                    id="check{{$item->item_id}}" value="{{$item->item_id}}">
                                                <label for="check{{$item->item_id}}"
                                                    class="custom-control-label text-capitalize font-weight-bold">{{$item->item_name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Check In</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Detail Modal --}}
<div class="modal fade" id="customerCheckedInDetailModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="customerName">Name</label>
                            <input type="text" class="form-control" id="customerName" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPhone">Phone Number</label>
                            <input type="text" class="form-control" id="customerPhone" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPlate">License Plate</label>
                            <input type="text" class="form-control" id="customerPlate" disabled>
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-3">
                            <h6>Check In Time</h6>
                        </div>
                        <div class="col-3">
                            <span class="text-muted" id="checkInTime"></span>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <table class="table table-striped" id="checkedInDetailTable">
                                <thead>
                                    <th>No</th>
                                    <th>Service Name</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-block">Check Out</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="feedbackForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            @foreach ($complaint_type as $item)
                            <div class="form-group col-5">
                                <h5 for="{{$item->complaint_type_name}}"
                                    class="font-weight-bold text-danger text-center">{{$item->complaint_type_name}}</h5>
                                <div id="{{$item->complaint_type_name}}" class="mx-auto"></div>
                                <input type="hidden" name="feedback_category[]"
                                    id="{{$item->complaint_type_name}}Rating" value="">
                                <input type="hidden" name="feedback_key[]" id="{{$item->complaint_type_name}}Key"
                                    value="{{$item->complaint_type_name}}">
                            </div>
                            @endforeach
                            <div class="form-group col-10">
                                <h5 for="keterangan">Keterangan</h5>
                                <textarea name="keterangan" id="keterangan" rows="50" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/jquery.rateyo.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#customerSearch').select2();
        $('#customerSearch').on('change', function () {
            var id = $(this).val();
            $.get('/data/checkin/customer/' + id, function (data) {
                $('#checkInCustomerID').val(data[0].customer_detail_id);
                $('#checkInCustomerName').val(data[0].customer_fullName);
                $('#checkInCustomerPhone').val(data[0].customer_phone);
                $('#checkInCustomerLicensePlate').val(data[0].customer_detail_licensePlate);
            });
            $('#customerCheckInModal').modal('show')
        });

        $(document).on('click', '.customer-detail', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.get('/data/checkin/getcustomer/' + id, function (customer) {
                $('#customerName').val(customer[0].customer_fullName);
                $('#customerPhone').val(customer[0].customer_phone);
                $('#customerPlate').val(customer[0].customer_detail_licensePlate);
                $('#checkInTime').html(customer[0].check_in_time);

            });
            $.get('/data/checkin/getcustomerdetail/' + id, function (detail) {
                $('#checkedInDetailTable tbody tr').empty();
                $.each(detail, function (index, Obj) {
                    $('#checkedInDetailTable tbody').append('<tr><td>' + (index + 1) +
                        '</td><td>' + Obj.item_name +
                        '</td></tr>');
                });
            });
            $('#customerCheckedInDetailModal').modal('show');
        });

        $(document).on('click', '.check-out-btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'Check Out',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#keamanan').rateYo({
                        fullStar: true,
                        onSet: function (rating) {
                            $('#keamananRating').val(rating);
                        }
                    });
                    $('#kebersihan').rateYo({
                        fullStar: true,
                        onSet: function (rating) {
                            $('#kebersihanRating').val(rating);
                        }
                    });
                    $('#pelayanan').rateYo({
                        fullStar: true,
                        onSet: function (rating) {
                            $('#pelayananRating').val(rating);
                        }
                    });
                    $('#kualitas').rateYo({
                        fullStar: true,
                        onSet: function (rating) {
                            $('#kualitasRating').val(rating);
                        }
                    });
                    $('#kenyamanan').rateYo({
                        fullStar: true,
                        onSet: function (rating) {
                            $('#kenyamananRating').val(rating);
                        }
                    });
                    $('#feedbackForm').attr('action', '/cs/transaction/check-in-out/checkout/' +
                        id);
                    $('#feedbackModal').modal('show');
                }
            })
        });


    });

</script>
@endsection
