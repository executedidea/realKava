@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
<section id="promoItem">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Promo Listing</h4>
                    </div>
                    <form action="{{ route('storePromoItem') }}" method="post" id="promoItemForm">
                        <div class="card-body">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-3">
                                    <input type="text" name="promo_code" class="form-control" value=""
                                        placeholder="Promo Code">
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" name="promo_name" class="form-control" value=""
                                        placeholder="Promo Name">
                                </div>
                                <div class="form-group col-3">
                                    <select name="promo_type" class="form-control" id="promoType" required>
                                        <option disabled selected>Select Promo Type</option>
                                        <option value="product">Product</option>
                                        <option value="service">Visit</option>
                                        <option value="service">Cashback</option>
                                        <option value="service">Discount</option>
                                        <option value="service">Point</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">

                                <div class="form-group col-3">
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" value="1" name="periode" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">All Items</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" value="1" name="periode" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Period</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-3">
                                    <input type="text" name="promo_maxValue" class="form-control" value=""
                                        placeholder="Promo Max Value">
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" name="promo_free" class="form-control" value=""
                                        placeholder="Free Value">
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" name="promo_startDate" class="form-control datepicker"
                                        placeholder="Start Date" readonly required>
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" name="promo_endDate" class="form-control datepicker"
                                        placeholder="Expired Date" readonly required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="customerItem">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-responsive" id="customerItems">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Item(s)</th>
                                            <th class="text-center">Max Value</th>
                                            <th class="text-center">Free Item</th>
                                            <th class="text-center">Free Value</th>
                                            {{-- <th class="text-center">Start Date</th>
                                            <th class="text-center">Expire Date</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="" method="post" id="customerItemsForm">
                                            <tr id="row1">
                                                <td class="" width="30%">
                                                    <div class="form-group mx-auto">
                                                        <select name="item" class="form-control items px-3"
                                                            id="promoType">
                                                            <option value="" disabled selected>Item Name</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control numeric-input text-right item-quantity"
                                                            value="0" id="quantity">
                                                    </div>
                                                </td>
                                                <td class="" width="30%">
                                                    <div class="form-group mx-auto">
                                                        <select name="item" class="form-control" id="promoType"
                                                            required>
                                                            <option disabled selected>Select Item</option>
                                                            <option value="product">Product</option>
                                                            <option value="service">Visit</option>
                                                            <option value="service">CashBack</option>
                                                            <option value="service">Discount</option>
                                                            <option value="service">Free Item</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-right item-price"
                                                            placeholder="0" id="itemPrice">
                                                    </div>
                                                    {{-- </td>
                                                <td class="">
                                                    <div class="form-group">
                                                        <input type="text" name="promo_startDate"
                                                            class="form-control datepicker" required>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="form-group">
                                                        <input type="text" name="promo_endDate"
                                                            class="form-control datepicker" required>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                    </tbody>
                                </table>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    <div class="card-footer">
                                        <button class="btn btn-primary btn-block">Save</button>
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
    </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/js/cleave.min.js') }}"></script>
<script src="{{ asset('/js/kava/cs/promo/index.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#openCashDrawer').on('keyup', function () {
            var result = parseInt($(this).val(), 10);
            var lastCashDrawer = parseInt($('#lastCashDrawer').val(), 10);
            $('#totalCashDrawer').val(result + lastCashDrawer);
        });
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY/MM/DD'
            }
        });

        $('#openStoreForm').on('submit', function () {

        });

    });

</script>
@endsection
