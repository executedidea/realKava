@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/kava/cs/check-in-out.css') }}">
@endsection
@section('content')
<section id="customerCheck">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Membership</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-12">
                                <select name="key" id="customerSearch">
                                    <option value="" disabled selected>Search Name or Phone Number
                                    </option>
                                    @foreach ($customer as $item)
                                    <option value="{{$item->customer_id}}"><b>{{ $item->customer_fullName}}</b>
                                        <span class="text-muted">{{ $item->customer_phone }}</span>
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
                        <h4>Membership</h4>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Member Since</th>
                                    <th>Expired</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
                <h5 class="modal-title">Customer Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-lg-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="form-group col-4">
                            <label for="checkInCustomerName">Customer Name</label>
                            <input type="text" class="form-control" id="checkInCustomerName" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">Phone Number</label>
                            <input type="text" class="form-control" id="checkInCustomerPhone" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">No. Membership</label>
                            <input type="text" class="form-control" id="checkInCustomerPhone" value="001201911230012"
                                disabled>
                        </div>
                        <div class="form-group col-6">
                            <label for="checkInCustomerPhone">Membership Category</label>
                            <select name="" id="" class="form-control membership-category">
                                <option value="">Bronze</option>
                                <option value="">Gold</option>
                                <option value="">Platinum</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="checkInCustomerPhone">Memberhip Name</label>
                            <input type="text" class="form-control" id="checkInCustomerPhone">
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">Start Date</label>
                            <input type="date" class="form-control" id="checkInCustomerPhone">
                        </div>
                        <div class="form-group col-4">
                            <label for="checkInCustomerPhone">End Date</label>
                            <input type="date" class="form-control" id="checkInCustomerPhone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Customer Detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="form-group col-4">
                                                <label for="">Birth Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">NIK</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">Religion</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">Status</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="">City</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="">Note</label>
                                                <textarea type="text" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-block">Check In</button>
            </div>
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
                            <input type="text" class="form-control" id="customerName">
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPhone">Phone Number</label>
                            <input type="text" class="form-control" id="customerPhone">
                        </div>
                        <div class="form-group col-4">
                            <label for="customerPlate">License Plate</label>
                            <input type="text" class="form-control" id="customerPlate">
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
@endsection
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#customerSearch').select2();
        $('.membership-category').selectric();
        $('#customerSearch').on('change', function () {
            var id = $(this).val();
            $.get('/data/checkin/customer/' + id, function (data) {
                $('#checkInCustomerName').val(data[0].customer_fullName);
                $('#checkInCustomerPhone').val(data[0].customer_phone);
                $('#checkInCustomerLicensePlate').val(data[0].customer_detail_licensePlate);
            });
            $('#customerCheckInModal').modal('show')
        });
    });

</script>
@endsection
