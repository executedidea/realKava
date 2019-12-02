@extends('layouts.main')
@section('title', 'Debit & Credit Note | Point Of Sales - KAVA')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content-title', 'Transaction')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Credit/Debit Note</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addDebitCreditNoteModal">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="card-body">
                    <table id="cashierTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="th-sm font-weight-bold">No Faktur
                                </th>
                                <th class="th-sm font-weight-bold">Date
                                </th>
                                <th class="th-sm font-weight-bold">Nilai
                                </th>
                                <th class="th-sm font-weight-bold">Payment Method
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($cashier_list as $item) --}}
                            <tr>
                                <td>
                                    {{-- <a href="#">CSR{{$item->cashier_id}}</a> --}}
                                </td>
                                <td>
                                    {{-- {{$item->group_name}} --}}
                                </td>
                                <td>
                                    {{-- {{$item->name}} --}}
                                </td>
                                <td>
                                    {{-- {{$item->shift_code}} --}}
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Add Debit Credit Note Modal -->
<section id="DebitCreditNoteModal">
    <div class="modal fade" id="addDebitCreditNoteModal" tabindex="-1" role="dialog" aria-labelledby="addCashModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">

                                <form action="{{ route('storeDebitCreditNote') }}" method="post"
                                    id="addDebitCreditNoteForm" enctype="multipart/form-data">
                                    {{-- Form --}}
                                    <div class="row">
                                        <div class="col">
                                            {{csrf_field()}}

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="faktur">No Faktur</label>
                                                    <input type="text" name="input_tanggal" id="startDate"
                                                        class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="nilai">Nilai</label>
                                                    <input type="text" name="input_tanggal" id="startDate"
                                                        class="form-control text-right" placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="debit_credit_note_date" id="startDate"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="row justify-content-center">
                                                <div class="form-group col-6 pl-5">
                                                    <input class="form-check-input" type="radio"
                                                        name="debit_credit_note_type" id="debitorcredit" value="d"
                                                        checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Debit Note
                                                    </label>
                                                </div>
                                                <div class="form-group col-6 pl-5">
                                                    <input class="form-check-input" type="radio"
                                                        name="debit_credit_note_type" id="debitorcredit" value="c"
                                                        checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Credit Note
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="nilai">Nilai Koreksi</label>
                                                    <input type="text" name="debit_credit_note_amount" id="startDate"
                                                        class="form-control text-right" placeholder="0">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="nilai">Hasil Koreksi</label>
                                                    <input type="text" name="input_tanggal" id="startDate"
                                                        class="form-control text-right" placeholder="0" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control"
                                                        name="debit_credit_note_desc"></textarea>
                                                </div>
                                            </div>

                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-block"
                                                id="Bayar">Save</button>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<script>
    $(document).ready(function () {
        var table = $('#cashierTable').DataTable({
            "order": [
                [0, "desc"]
            ],
            language: {
                search: "",
                searchPlaceholder: 'Search...'
            },
            dom: 'ftp',
            buttons: [{
                    text: '<i class="fa fa-trash-alt" aria-hidden="true" data-toggle="tooltip" data-placement="top"></i>',
                    className: 'btn btn-danger',
                    action: function () {
                        $('#deleteModal').modal('show');
                    }
                },
                {
                    text: '<i class="fa fa-plus" aria-hidden="true"></i>',
                    className: 'btn btn-success',
                    action: function () {
                        $('#addVehicleModal').modal('show');
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i>',
                    className: 'btn btn-primary'
                }
            ]
        });

        $('.group').selectric();
        $('.brand').selectric();
        $('.model').selectric();
        $('.size').selectric();

        $('.category').on('change', function (e) {
            console.log(e);
            var category_id = e.target.value;
            $.get('/admin/library/vehiclebrand?vehicle_category_id=' + category_id, function (data) {
                console.log(data);
                $('.brand').empty();
                $('.brand').prop("disabled", false);
                $('.brand').append(
                    '<option value="" disabled selected="true">-- Select Vehicle Brand --</option>'
                );


                $.each(data, function (index, brandObj) {
                    $('.brand').append('<option value="' + brandObj.vehicle_brand_id +
                        '">' + brandObj.vehicle_brand_name + '</option>');
                })
                $('.brand').selectric('refresh');
            });
        });

        $('.brand').on('change', function (e) {
            console.log(e);
            var brand_id = e.target.value;
            $.get('/admin/library/vehiclemodel?vehicle_brand_id=' + brand_id, function (data) {
                console.log(data);
                $('.model').empty();
                $('.model').prop("disabled", false);
                $('.model').append(
                    '<option value="" disabled selected="true">-- Select Vehicle Model --</option>'
                );

                $.each(data, function (index, modelObj) {
                    $('.model').append('<option value="' + modelObj.vehicle_model_id +
                        '">' + modelObj.vehicle_model_name + '</option>');
                })
                $('.model').selectric('refresh');
            });
        });
        $("#checkAll").on('change', function () {
            $(".checkitem").prop('checked', $(this).is(":checked"));
        });

        $('#editCashierBtn').on('click', function () {
            var id = [];
            $('.checkitem:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length > 1) {
                Swal.fire(
                    "You can't edit data more than 1 at the same time!",
                    '',
                    'warning'
                )
            } else if (id.length == 0) {
                Swal.fire(
                    'Please select at least 1 data!',
                    '',
                    'warning'
                )
            } else {
                $.ajax({
                    url: "/admin/library/getcashier/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: id,
                    success: function (data) {
                        console.log(data);
                        if (data['status'] == true) {
                            $('#editShift option[value="' + data['cashier'][0]
                                .shift_id + '"]').prop('selected',
                                'selected');
                            $('#editShift').selectric('refresh');
                            $('#editUser option[value="' + data['cashier'][0]
                                .user_id + '"]').prop('selected',
                                'selected');
                            $('#editUser').selectric('refresh');
                            $('#editStartTime').val(data['cashier'][0].shift_startTime);
                            $('#editEndTime').val(data['cashier'][0].shift_endTime);
                            $('#editDiscPercent').val(data['cashier'][0].disc_percent);
                            $('#editDiscID').val(data['cashier'][0].disc_id);

                            $('#editCashierForm').attr('action',
                                '/admin/library/cashier/' + id + '/editcashier');
                            $('#editCashierModal').modal('show');
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

        $('#deleteCashierBtn').on('click', function () {
            var id = [];
            $('.checkitem:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length == 0) {
                Swal.fire(
                    'Please select at least 1 data!',
                    '',
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
                            url: "{{ url('/admin/library/cashier/delete') }}",
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
