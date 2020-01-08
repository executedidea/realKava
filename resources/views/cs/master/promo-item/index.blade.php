@extends('layouts.main')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
@endsection
@section('title', 'Promo | Customer Service - KAVA')
@section('content')

<section id="promoList">
    <div class="container">
        <div class="row mb-5">
            <div class="col-6">
                <button class="btn btn-lg bg-white w-100" id="bankAccountBtn">Active Promo</button>
            </div>
            <div class="col-6">
                <button class="btn btn-lg bg-white w-100" id="pettyCashBtn">Inactive Promo</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Active Promo</h4>
                        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
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
                                            <input type="checkbox" data-checkboxes="customers"
                                                class="custom-control-input" name="id[]" id="checkAll" value="">
                                            <label for="checkAll" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Promo ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promos as $item)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="promo"
                                                class="custom-control-input checkitem" name="id[]"
                                                id="checkbox{{$item->promo_id}}" value="{{$item->promo_id}}">
                                            <label for="checkbox{{$item->promo_id}}"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    <td>
                                        <a href="">{{ $item->promo_id }}</a>
                                    </td>
                                    <td>{{ $item->promo_name }}</td>
                                    <td>{{ $item->promo_type_name }}</td>
                                    <td>
                                        @if($item->promo_startDate == '1111-11-11')
                                        -
                                        @else
                                        {{ date('d M Y', strtotime($item->promo_startDate)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->promo_endDate == '9999-12-31')
                                        -
                                        @else
                                        {{ date('d M Y', strtotime($item->promo_endDate)) }}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-danger">Deactive</button>
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
{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storePromoItem') }}" method="post" id="promoItemForm">
                    @csrf
                    <section id="promoItem">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Promo Listing</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_id" class="form-control" value=""
                                                        placeholder="Promo Code">
                                                </div>
                                                <div class="form-group col-6">
                                                    <input type="text" name="promo_name" class="form-control" value=""
                                                        placeholder="Promo Name">
                                                </div>
                                                <div class="form-group col-3">
                                                    <select name="promo_type" class="form-control" id="promoType"
                                                        required>
                                                        <option disabled selected>Select Promo Type</option>
                                                        @foreach ($promo_type as $item)
                                                        <option value="{{$item->promo_type_id}}">
                                                            {{$item->promo_type_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" value="1" name="promo_all_item"
                                                                class="custom-switch-input" id="allItem">
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">All Items</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" value="1" name="promo_periode"
                                                                class="custom-switch-input" id="nonPeriode">
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Non Periode</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_maxValue" class="form-control"
                                                        value="" placeholder="Promo Max Value" id="promoMaxValue"
                                                        disabled>
                                                </div>
                                                <div class="form-group col-3">
                                                    <div class="input-group">
                                                        <input type="text" name="promo_free" class="form-control"
                                                            value="" placeholder="Free Value" id="promoFreeValue"
                                                            disabled>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-percent"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_startDate"
                                                        class="form-control datepicker" id="startDate"
                                                        placeholder="Start Date" required>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_endDate"
                                                        class="form-control datepicker" id="endDate"
                                                        placeholder="Expired Date" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="customerItem">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-striped table-responsive" id="promoItems">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Item(s)</th>
                                                                <th class="text-center">Max Value</th>
                                                                <th class="text-center">Free Item</th>
                                                                <th class="text-center">Free Value</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <form id="promoItemsForm">
                                                                @csrf
                                                                <tr id="row1">
                                                                    <td class="" width="30%">
                                                                        <div class="form-group mx-auto">
                                                                            <select class="form-control px-3 item-name"
                                                                                id="itemName">
                                                                                <option value="" disabled selected>
                                                                                    Select Item</option>
                                                                            </select>
                                                                            <input type="hidden" name="promo_item[]"
                                                                                id="itemValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="">
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control numeric-input max-value text-right"
                                                                                id="maxValue" placeholder="0">
                                                                            <input type="hidden" name="promo_maxValue[]"
                                                                                id="maxValueValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="" width="30%">
                                                                        <div class="form-group mx-auto">
                                                                            <select class="form-control item-name"
                                                                                id="freeItem" required>
                                                                                <option disabled selected>Select Item
                                                                                </option>
                                                                            </select>
                                                                            <input type="hidden" name="promo_freeItem[]"
                                                                                id="freeItemValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="">
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    class="form-control text-right item-discount"
                                                                                    id="freeValue" placeholder="0">
                                                                                <input type="hidden"
                                                                                    name="promo_freeValue[]"
                                                                                    id="freeValueValue">
                                                                                <div class="input-group-append">
                                                                                    <div class="input-group-text">
                                                                                        <i class="fas fa-percent"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-success" id="addForm">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storePromoItem') }}" method="post" id="promoItemForm">
                    @csrf
                    <section id="promoItem">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Promo Listing</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_id" class="form-control" value=""
                                                        placeholder="Promo Code">
                                                </div>
                                                <div class="form-group col-6">
                                                    <input type="text" name="promo_name" class="form-control" value=""
                                                        placeholder="Promo Name">
                                                </div>
                                                <div class="form-group col-3">
                                                    <select name="promo_type" class="form-control" id="promoType"
                                                        required>
                                                        <option disabled selected>Select Promo Type</option>
                                                        @foreach ($promo_type as $item)
                                                        <option value="{{$item->promo_type_id}}">
                                                            {{$item->promo_type_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" value="1" name="promo_all_item"
                                                                class="custom-switch-input" id="allItem">
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">All Items</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <div class="form-group">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" value="1" name="promo_periode"
                                                                class="custom-switch-input" id="nonPeriode">
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Non Periode</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_maxValue" class="form-control"
                                                        value="" placeholder="Promo Max Value" id="promoMaxValue"
                                                        disabled>
                                                </div>
                                                <div class="form-group col-3">
                                                    <div class="input-group">
                                                        <input type="text" name="promo_free" class="form-control"
                                                            value="" placeholder="Free Value" id="promoFreeValue"
                                                            disabled>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-percent"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_startDate"
                                                        class="form-control datepicker" id="startDate"
                                                        placeholder="Start Date" required>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="text" name="promo_endDate"
                                                        class="form-control datepicker" id="endDate"
                                                        placeholder="Expired Date" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="customerItem">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-striped table-responsive" id="promoItems">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Item(s)</th>
                                                                <th class="text-center">Max Value</th>
                                                                <th class="text-center">Free Item</th>
                                                                <th class="text-center">Free Value</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <form id="promoItemsForm">
                                                                <tr id="row1">
                                                                    <td class="" width="30%">
                                                                        <div class="form-group mx-auto">
                                                                            <select class="form-control px-3 item-name"
                                                                                id="itemName">
                                                                                <option value="" disabled selected>
                                                                                    Select Item</option>
                                                                            </select>
                                                                            <input type="hidden" name="promo_item[]"
                                                                                id="itemValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="">
                                                                        <div class="form-group">
                                                                            <input type="text"
                                                                                class="form-control numeric-input max-value text-right"
                                                                                id="maxValue" placeholder="0">
                                                                            <input type="hidden" name="promo_maxValue[]"
                                                                                id="maxValueValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="" width="30%">
                                                                        <div class="form-group mx-auto">
                                                                            <select class="form-control item-name"
                                                                                id="freeItem" required>
                                                                                <option disabled selected>Select Item
                                                                                </option>
                                                                            </select>
                                                                            <input type="hidden" name="promo_freeItem[]"
                                                                                id="freeItemValue">
                                                                        </div>
                                                                    </td>
                                                                    <td class="">
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    class="form-control text-right item-discount"
                                                                                    id="freeValue" placeholder="0">
                                                                                <input type="hidden"
                                                                                    name="promo_freeValue[]"
                                                                                    id="freeValueValue">
                                                                                <div class="input-group-append">
                                                                                    <div class="input-group-text">
                                                                                        <i class="fas fa-percent"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-success" id="addForm">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>

<script>
    $(document).ready(function () {
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
        $('#promoType').select2();
        $('#itemName').select2();
        $('#itemName').on('select2:open', function () {
            $.get('/data/items/getitems', function (items) {
                $.each(items, function (index, Obj) {
                    $('#itemName').append('<option value="' + Obj.item_id + '">' + Obj
                        .item_name + '</option>');
                });
            });
        });
        $('#itemName').on('change', function () {
            $('#itemValue').val($(this).val());
        });
        $('#maxValue').on('change', function () {
            $('#maxValueValue').val($(this).val());
        });
        $('#freeItem').select2();
        $('#freeItem').on('select2:open', function () {
            $.get('/data/items/getitems', function (items) {
                $.each(items, function (index, Obj) {
                    $('#freeItem').append('<option value="' + Obj.item_id + '">' + Obj
                        .item_name + '</option>');
                });
            });
        });
        $('#freeItem').on('change', function () {
            $('#freeItemValue').val($(this).val());
        });
        $('#freeValue').on('change', function () {
            $('#freeValueValue').val($(this).val());
        });


        $('#allItem').on('change', function () {
            if ($('#allItem:checked').length) {
                $('#itemName').prop('disabled', true);
                $('#itemValue').prop('disabled', true);
                $('#maxValue').prop('disabled', true);
                $('#maxValueValue').prop('disabled', true);
                $('#freeItem').prop('disabled', true);
                $('#freeItemValue').prop('disabled', true);
                $('#freeValue').prop('disabled', true);
                $('#freeValueValue').prop('disabled', true);

                $('#promoMaxValue').prop('disabled', false);
                $('#promoFreeValue').prop('disabled', false);
            } else {
                $('#itemName').prop('disabled', false);
                $('#itemValue').prop('disabled', false);
                $('#maxValue').prop('disabled', false);
                $('#maxValueValue').prop('disabled', false);
                $('#freeItem').prop('disabled', false);
                $('#freeItemValue').prop('disabled', false);
                $('#freeValue').prop('disabled', false);
                $('#freeValueValue').prop('disabled', false);

                $('#promoMaxValue').prop('disabled', false);
                $('#promoFreeValue').prop('disabled', false);
            }
        });

        $('#nonPeriode').on('change', function () {
            if ($('#nonPeriode:checked').length) {
                $('#startDate').prop('disabled', true);
                $('#endDate').prop('disabled', true);
            } else {
                $('#startDate').prop('disabled', false);
                $('#endDate').prop('disabled', false);
            }
        });

        var i = 1;
        $('#addForm').on('click', function (e) {
            e.preventDefault();
            i++;
            $('#itemName').prop('disabled', true);
            $('#maxValue').prop('disabled', true);
            $('#freeItem').prop('disabled', true);
            $('#freeValue').prop('disabled', true);

            var id = $('#itemSelect').val();
            $('#itemName').removeAttr('id');
            $('#itemValue').removeAttr('id');
            $('#maxValue').removeAttr('id');
            $('#maxValueValue').removeAttr('id');
            $('#freeItem').removeAttr('id');
            $('#freeItemValue').removeAttr('id');
            $('#freeValue').removeAttr('id');
            $('#freeValueValue').removeAttr('id');
            $('#promoItems tbody').append(
                '<tr id="row' + i +
                '"><td class="" width="30%"><div class="form-group mx-auto"><select class="form-control px-3 item-name" id="itemName"><option value="" disabled selected>Select Item</option></select><input type="hidden" name="promo_item[]" id="itemValue"></div></td><td class=""><div class="form-group"><input type="text" class="form-control numeric-input max-value text-right" id="maxValue" placeholder="0"><input type="hidden" name="promo_maxValue[]" id="maxValueValue"></div></td><td class="" width="30%"><div class="form-group mx-auto"><select class="form-control item-name" id="freeItem" required><option disabled selected>Select Item</option></select><input type="hidden" name="promo_freeItem[]" id="freeItemValue"></div></td><td class=""><div class="form-group"><div class="input-group"><input type="text" class="form-control text-right item-discount" id="freeValue" placeholder="0"><input type="hidden" name="promo_freeValue[]" id="freeValueValue"><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td><button type="button" class="btn btn-danger remove-row" data-id="' +
                i + '"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>'
            );
            $('#itemName').select2();
            $('#itemName').on('select2:open', function () {
                $.get('/data/items/getitems', function (items) {
                    $.each(items, function (index, Obj) {
                        $('#itemName').append('<option value="' + Obj.item_id +
                            '">' + Obj
                            .item_name + '</option>');
                    });
                });
            });
            $('#itemName').on('change', function () {
                $('#itemValue').val($(this).val());
            });
            $('#maxValue').on('change', function () {
                $('#maxValueValue').val($(this).val());
            });
            $('#freeItem').select2();
            $('#freeItem').on('select2:open', function () {
                $.get('/data/items/getitems', function (items) {
                    $.each(items, function (index, Obj) {
                        $('#freeItem').append('<option value="' + Obj.item_id +
                            '">' + Obj
                            .item_name + '</option>');
                    });
                });
            });
            $('#freeItem').on('change', function () {
                $('#freeItemValue').val($(this).val());
            });
            $('#freeValue').on('change', function () {
                $('#freeValueValue').val($(this).val());
            });
        });

        $(document).on('click', '.remove-row', function () {
            var id = $(this).data('id');
            $('#row' + id).remove();
            if ($('#promoItems tbody tr').length <= 1) {
                $('.item-name').prop('disabled', false);
                $('.max-value').attr('id', 'maxValue');
                $('#maxValue').prop('disabled', false);
                $('#freeValue').prop('disabled', false);

            }
        });

        $('#startDate').val('Start Date');
        $('#endDate').val('Expire Date');


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
                            url: "{{ route('destroyPromoItem') }}",
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
