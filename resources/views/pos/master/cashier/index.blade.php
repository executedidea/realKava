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
                    <button class="btn btn-info ml-1" id="editBtn">
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
                                        <input type="checkbox" data-checkboxes="rights"
                                            class="custom-control-input" name="id[]" id="checkAll" value="">
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
                                            id="checkbox{{ $item->cashier_id }}"
                                            value="{{ $item->cashier_id }}">
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
                        <form action="{{ route('storeCashier') }}" method="post"
                                id="addCashierForm">
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
                                                    <input type="number" class="form-control" name="disc_percent" value="0">
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
                                                    <input type="number" class="form-control" name="add_disc_percent" value="0">
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
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
$(document).ready(function(){
    $("#checkAllBankAccount").on('change', function () {
        $(".checkitem-bankaccount").prop('checked', $(this).is(":checked"));
    });
    $('.checkitem-bankaccount').on('change', function () {
        if ($('.checkitem-bankaccount:checked').length !== $('.checkitem-bankaccount').length) {
            $('#checkAllBankAccount').prop('checked', false);
        } else {
            $('#checkAllBankAccount').prop('checked', true);
        }
    });

    $("#checkAllPettyCash").on('change', function () {
        $(".checkitem-pettycash").prop('checked', $(this).is(":checked"));
    });
    $('.checkitem-pettycash').on('change', function () {
        if ($('.checkitem-pettycash:checked').length !== $('.checkitem-pettycash').length) {
            $('#checkAllPettyCash').prop('checked', false);
        } else {
            $('#checkAllPettyCash').prop('checked', true);
        }
    });

    $('#bank').selectric();

    $('#bankAccountBtn').on('click', function(){
        $('#pettyCash').hide();
        $('#bankAccount').show(200, 'swing');
    });
    $('#pettyCashBtn').on('click', function(){
        $('#bankAccount').hide();
        $('#pettyCash').show(200, 'swing');
    });
});
</script>
@endsection
