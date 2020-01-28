@extends('layouts.main')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/kava/cs/check-in-out.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.rateyo.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
<style>
    #itemsCard {
        max-height: 500px;
        overflow-y: scroll;
    }

    #customerItems {
        max-height: 400px;
        overflow-y: scroll;
    }

    .card-header .form-control {
        height: 100% !important;
    }

    .item-col {
        cursor: pointer;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quantity {
        border-radius: .25rem;
        box-shadow: none;
        border: 1px solid #98a6ad;
        padding: .25rem;
    }

    .form-group {
        margin-bottom: 0 !important;
    }

    .invoice-detail-value-lg {
        font-size: 32px;
        font-weight: bold;
    }

    .payment-method-card {
        width: 64px;
        height: 40px;
        border: 2px solid #6c757d;
        border-radius: 4px;
        color: #6c757d;
        cursor: pointer;
    }

    .payment-method-card:hover {
        color: white;
        background-color: #6c757d;
    }

</style>
@endsection
@section('content')
<section id="items">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" id="itemsCard">
                    <div class="card-header py-4">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addCustomerModal">Add
                            Customer</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($items as $item)
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body item-col text-center" data-item-id="{{$item->item_id}}">
                                        <img src="{{asset('img/p-250.png')}}" alt="" class="img-fluid mb-3">
                                        <h6 class="h6-responsive text-capitalize" id="itemName{{$item->item_id}}">
                                            {{$item->item_name}}
                                        </h6>
                                        <span class="text-muted text-center">Rp
                                            {{number_format(floatval($item->item_price))}}</span>
                                        <input type="hidden" id="itemPrice{{$item->item_id}}"
                                            value="{{floatval($item->item_price)}}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h2 class="h2-responsive mb-0">Subtotal</h2>
                            </div>
                            <div class="col-6 text-right align-items-center">
                                <h4 class="h4-reponsive my-auto d-inline" id="subtotal">Rp 0</h4>
                                <input type="hidden" id="total" value="0">
                                <button class="btn ml-3" id="summaryBtn" data-toggle="modal" data-target="#summary">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection
@section('modal')
<form action="{{route('POSPay')}}" method="post" id="posForm">
    @csrf
    <div class="modal animated slideInUp" id="summary" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Sumary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <section id="customerInfo">
                            <div class="row">
                                <div class="col-3">
                                    <span class=" font-weight-light">Customer Name</span>
                                </div>
                                <div class="col-5">
                                    <span class="font-weight-bold" id="customerName">: -</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span class=" font-weight-light">Vehicle</span>
                                </div>
                                <div class="col-5">
                                    <span class=" font-weight-bold" id="vehicle">: -</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span class=" font-weight-light">License Plate</span>
                                </div>
                                <div class="col-5">
                                    <span class=" font-weight-bold" id="licensePlate">: -</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span class=" font-weight-light">Check In Time</span>
                                </div>
                                <div class="col-5">
                                    <span class=" font-weight-bold" id="checkInTime">: -</span>
                                </div>
                            </div>
                        </section>
                        <section id="customerItems" class="mt-5">
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title font-weight-bold">Payment Method</div>
                                <p class="section-lead">The payment method that we provide is to make it easier for you
                                    to
                                    pay
                                    invoices.</p>
                                <div class="images">
                                    <div class="payment-method-card d-flex float-left mr-2" data-method="cash" id="cashPayment">
                                        <span class="align-self-center mx-auto font-weight-bold"
                                            >CASH</span>
                                    </div>
                                    <div class="payment-method-card d-flex float-left mr-2" data-method="debit" id="debitPayment">
                                        <span class="align-self-center mx-auto font-weight-bold">DEBIT</span>
                                    </div>
                                    <div class="payment-method-card d-flex" data-method="cc" id="ccPayment">
                                        <span class="align-self-center mx-auto font-weight-bold">CC</span>
                                    </div>
                                </div>
                                <div class="form-group row py-3">
                                    <label class="col-form-label col-12 col-lg-2">Balance</label>
                                    <div class="col-12 col-lg-6 align-items-center">
                                        <h6 id="balanceDisplay" class="font-weight-bold"></h6>
                                        <input type="hidden" id="balanceDisplayValue">
                                    </div>
                                </div>
                                <div class="form-group row py-3">
                                    <button type="button" class="btn btn-primary" id="payBtn">Process Payment</button>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value font-weight-bold" id="totalDPP"> Rp 0</div>
                                    <input type="hidden" name="total_dpp" id="totalDPPValue">
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Discount</div>
                                    <div class="invoice-detail-value font-weight-bold" id="totalDiscount"> Rp 0</div>
                                    <input type="hidden" name="total_discount" id="totalDiscountValue" value="0">
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">PPN 10%</div>
                                    <div class="invoice-detail-value font-weight-bold" id="totalPPN"> Rp 0</div>
                                    <input type="hidden" name="total_ppn" id="totalPPNValue">
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">CC Charge</div>
                                    <div class="invoice-detail-value font-weight-bold" id="totalCCCharge"> Rp 0</div>
                                    <input type="hidden" name="total_cc_charge" id="totalCCChargeValue" value="0">
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg" id="totalPrice"> Rp 0
                                    </div>
                                    <input type="hidden" name="total_price" id="totalPriceValue">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Customer Modal --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="form-group col-12">
                                <select class="form-control" id="checkedInCustomer">
                                    <option value="" disabled selected>Search Customer
                                    </option>
                                    @foreach ($customer as $item)
                                    <option value="{{$item->customer_detail_id}}">
                                        <b>{{ $item->customer_fullName}}</b>
                                        <span class="text-muted">{{ $item->customer_detail_licensePlate }}</span>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Discount Modal --}}
    <div class="modal fade" id="itemDiscountModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-5">Discount</label>
                        <div class="input-group col-12 col-lg-4">
                            <input type="text" class="form-control text-right" id="itemDiscount" data-item-id="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-5">Additional Discount</label>
                        <div class="input-group col-12 col-lg-4">
                            <input type="text" class="form-control text-right" id="itemAdditionalDiscount"
                                data-item-id="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" id="saveDiscountBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Cash Modal --}}
    <div class="modal fade payment-method-modal" id="cashModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label class="col-form-label col-12 col-lg-5">Amount</label>
                            <div class="input-group col-12 col-lg-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control text-right" id="paid" name="paid1">
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label class="col-form-label col-12 col-lg-5">Balance</label>
                            <div class="col-12 col-lg-6">
                                <h6 id="balance"></h6>
                                <input type="hidden" id="balanceValue" class="balanceValue">
                            </div>
                        </div>
                        <div class="form-group row py-3">
                            <label class="col-form-label col-12 col-lg-5">Change</label>
                            <div class="col-12 col-lg-6">
                                <h6 id="change">Rp 0</h6>
                                <input type="hidden" name="change" id="changeValue" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block payment-method-btn" data-method="1">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Debit Modal --}}
    <div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Debit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row py-3">
                        <label class="col-form-label col-12 col-lg-5">Bank</label>
                        <div class="col-12 col-lg-6">
                            <select name="bank" id="bank" disabled>
                                <option value="1">Mandiri</option>
                                <option value="2">BCA</option>
                                <option value="3">BRI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-5">Card Number</label>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control text-right" id="cardNumber" name="card_number" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-12 col-lg-5">Amount</label>
                        <div class="input-group col-12 col-lg-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control text-right" class="paid" id="paidBank" name="paid1" disabled>
                        </div>
                    </div>
                    <div class="form-group row py-3">
                        <label class="col-form-label col-12 col-lg-5">Balance</label>
                        <div class="col-12 col-lg-6">
                            <h6 id="balanceBank"></h6>
                            <input type="hidden" id="balanceValueBank">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block payment-method-btn" data-method="2">Save</button>  
                </div>
            </div>
        </div>
    </div>
    {{-- AddPaymentModal --}}
    <div class="modal fade" id="addPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" id="paymentMethod2ModalBody">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="payment_method1" id="paymentMethod1">
    <input type="hidden" name="payment_method2" id="paymentMethod2" disabled>
</form>
<input type="hidden" id="dataSettingPPN" value="{{$setting[0]->setting_pos_ppn}}">

@foreach($promos as $item)
<input type="hidden" class="item-promo" data-promo-item-id="{{$item->item_id}}"
    data-promo-free-value="{{$item->promo_freeValue}}">
@endforeach
@endsection
@section('script')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#checkedInCustomer').select2();

        $('#checkedInCustomer').on('change', function (e) {
            e.preventDefault();
            var customerDetailID = $(this).val();
            $.get('/data/checkin/getcheckedincustomer/' + customerDetailID, function (customers) {
                $('#customerItems').empty();
                // Customer Data
                $('#customerName').text(": " + customers[0].customer_fullName);
                $('#vehicle').text(": " + customers[0].vehicle_brand_name + " " + customers[0]
                    .vehicle_model_name);
                $('#licensePlate').text(": " + customers[0].customer_detail_licensePlate);
                $('#checkInTime').text(": " + customers[0].check_in_time);

                $.each(customers, function (customerIndex, cst) {
                    $('#customerItems').append('<div class="card" id="itemCard' + cst
                        .item_id +
                        '"><div class="card-body"><div class="row"><div class="col-3"><h4 id="itemAddedName' +
                        cst.item_id + '">' + cst.item_name +
                        '</h4><span>@ Rp ' +
                        thousandFormat(parseFloat(cst.item_price)) +
                        '</span><input type="hidden" name="item_id[]" value="' + cst
                        .item_id +
                        '" id="itemIDValue' + cst.item_id +
                        '" /><input type="hidden" name="item_price[]" value="' +
                        parseFloat(cst.item_price) +
                        '" id="itemPriceValue' + cst.item_id +
                        '" /></div><div class="col align-self-center text-center"><button type="button" class="btn bg-transparent sub" data-item-id="' +
                        cst.item_id +
                        '"><i class="fa fa-minus" aria-hidden="true"></i></button><input type="number" class="text-center quantity" name="item_quantity[]" value="1" min="1" max="10" id="quantity' +
                        cst.item_id +
                        '" readonly/><button type="button" class="btn bg-transparent add" data-item-id="' +
                        cst.item_id +
                        '"><i class="fa fa-plus" aria-hidden="true"></i></button></div><div class="col-5 col-lg-4 d-flex"><h4 class="align-self-center ml-auto" id="itemTotalPrice' +
                        cst.item_id +
                        '">Rp ' + thousandFormat(parseFloat(cst.item_price)) +
                        '</h4><input type="hidden" name="item_total_price[]" class="total-item-price" value="' +
                        parseFloat(cst.item_price) +
                        '" id="itemTotalPriceValue' + cst.item_id +
                        '"/><input type="hidden" id="itemDiscountPercent' + cst
                        .item_id +
                        '" value="0"><input type="hidden" name="item_discount[]" value="0" class="item-discount" id="itemDiscountValue' +
                        cst.item_id +
                        '"><input type="hidden" id="itemAdditionalDiscountPercent' +
                        cst.item_id +
                        '" value="0"><input type="hidden" name="item_additional_discount[]" class="item-additional-discount" value="0" id="itemAdditionalDiscountValue' +
                        cst.item_id +
                        '"><div class="btn-group dropleft"><button type="button" class="btn bg-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i></button><div class="dropdown-menu dropleft"><a class="dropdown-item discount-btn" data-id="' +
                        cst.item_id +
                        '" data-toggle="modal" data-target="#itemDiscountModal">Discount</a><div class="dropdown-divider"></div><a class="dropdown-item delete-item-btn" data-id="' +
                        cst.item_id +
                        '">Delete</a></div></div></div></div></div></div>'
                    );
                });
                /// Subtotal Counter
                var totalItemPrice = 0;
                $('.total-item-price').each(function () {
                    totalItemPrice += +$(this).val();
                });
                $('#totalDPP').text("Rp " + thousandFormat(totalItemPrice));
                $('#totalDPPValue').val(totalItemPrice);
                $('#subtotal').text('Rp ' + thousandFormat(totalItemPrice));
                var settingPPN = $('#dataSettingPPN').val();
                if (settingPPN !== '1') {
                    // Total Counter
                    $('#totalPrice').text("Rp " + totalItemPrice);
                    $('#totalPriceValue').val(totalItemPrice);

                    $('#balanceDisplay').text('Rp ' + totalItemPrice);
                    $('#balanceDisplayValue').val(totalItemPrice);
                } else {
                    var ppn = (10 / 100) * totalItemPrice;
                    var totalAfterPPN = totalItemPrice + ppn;
                    $('#totalPPN').text('Rp ' + thousandFormat(ppn));
                    $('#totalPPNValue').val(ppn);

                    // Total Counter
                    $('#totalPrice').text("Rp " + thousandFormat(totalAfterPPN));
                    $('#totalPriceValue').val(totalAfterPPN);

                    $('#balanceDisplay').text('Rp ' + thousandFormat(totalAfterPPN));
                    $('#balanceDisplayValue').val(totalAfterPPN);

                }

            });
            $('#addCustomerModal').modal('hide');
        });

        $('.item-col').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('item-id');
            var itemPrice = parseFloat($('#itemPrice' + id).val());
            var itemName = $('#itemName' + id).text();
            var subtotal = parseFloat($('#total').val());
            var total = subtotal + itemPrice;
            var settingPPN = $('#dataSettingPPN').val();
            if (settingPPN !== '1') {
                $('#total').val(total);
                $('#totalDPPValue').val(total);
                $('#totalDPP').text("Rp " + thousandFormat(total));
                $('#totalPriceValue').val(total);
                $('#totalPrice').text("Rp " + thousandFormat(total));
                $('#subtotal').text('Rp ' + thousandFormat(total));

                $('#balanceDisplay').text('Rp ' + thousandFormat(total));
                $('#balanceDisplayValue').val(total);
            } else {
                var ppn = (10 / 100) * total;
                $('#totalPPN').text('Rp ' + thousandFormat(ppn));
                $('#totalPPNValue').val(ppn);
                $('#total').val(total);
                $('#totalDPPValue').val(total);
                $('#totalDPP').text("Rp " + thousandFormat(total));
                $('#totalPriceValue').val(total + ppn);
                $('#totalPrice').text("Rp " + thousandFormat((total + ppn)));
                $('#subtotal').text('Rp ' + thousandFormat(total));

                $('#balanceDisplay').text('Rp ' + thousandFormat((total + ppn)));
                $('#balanceDisplayValue').val(total + ppn);
            }


            if ($('#itemCard' + id).length > 0) {
                $('#quantity' + id).val(parseFloat($('#quantity' + id).val()) + 1);
                $('#itemTotalPrice' + id).text("Rp " + thousandFormat(parseFloat($('#quantity' + id)
                        .val()) *
                    itemPrice));

            } else {
                $('#customerItems').append(
                    '<div class="card" id="itemCard' + id +
                    '"><div class="card-body"><div class="row"><div class="col-3"><h4 id="itemAddedName' +
                    id + '">' + itemName +
                    '</h4><span>@ Rp ' +
                    thousandFormat(itemPrice) +
                    '</span><input type="hidden" name="item_id[]" value="' + id +
                    '" id="itemIDValue' + id +
                    '" /><input type="hidden" name="item_price[]" value="' +
                    itemPrice +
                    '" id="itemPriceValue' + id +
                    '" /></div><div class="col align-self-center text-center"><button type="button" class="btn bg-transparent sub" data-item-id="' +
                    id +
                    '"><i class="fa fa-minus" aria-hidden="true"></i></button><input type="number" class="text-center quantity" name="item_quantity[]" value="1" min="1" max="10" id="quantity' +
                    id +
                    '" readonly/><button type="button" class="btn bg-transparent add" data-item-id="' +
                    id +
                    '"><i class="fa fa-plus" aria-hidden="true"></i></button></div><div class="col-5 col-lg-4 d-flex"><h4 class="align-self-center ml-auto" id="itemTotalPrice' +
                    id +
                    '">Rp ' + thousandFormat(itemPrice) +
                    '</h4><input type="hidden" name="item_total_price[]" class="total-item-price" value="' +
                    itemPrice +
                    '" id="itemTotalPriceValue' + id +
                    '"/><input type="hidden" id="itemDiscountPercent' + id +
                    '" value="0"><input type="hidden" name="item_discount[]" class="item-discount" value="0" id="itemDiscountValue' +
                    id + '"><input type="hidden" id="itemAdditionalDiscountPercent' + id +
                    '" value="0"><input type="hidden" name="item_additional_discount[]" class="item-additional-discount" value="0" id="itemAdditionalDiscountValue' +
                    id +
                    '"><div class="btn-group dropleft"><button type="button" class="btn bg-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i></button><div class="dropdown-menu dropleft"><a class="dropdown-item discount-btn" data-id="' +
                    id +
                    '" data-toggle="modal" data-target="#itemDiscountModal">Discount</a><div class="dropdown-divider"></div><a class="dropdown-item delete-item-btn" data-id="' +
                    id + '" >Delete</a></div></div></div></div></div></div>'
                );
            }
        });
        $(document).on('click', '.add', function (e) {
            e.preventDefault();
            var itemID = $(this).data('item-id');
            var itemPrice = $('#itemPrice' + itemID).val();
            $(this).prev().val(+$(this).prev().val() + 1);

            $('#itemTotalPrice' + itemID).text("Rp " + thousandFormat($('#quantity' + itemID).val() *
                itemPrice));
            $('#itemTotalPriceValue' + itemID).val($('#quantity' + itemID).val() * itemPrice);

            //// Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + thousandFormat(totalItemPrice));
            $('#totalDPPValue').val(totalItemPrice);
            $('#subtotal').text('Rp ' + thousandFormat(totalItemPrice));
            var settingPPN = $('#dataSettingPPN').val();
            if (settingPPN !== '1') {
                // Total Counter
                $('#totalPrice').text("Rp " + thousandFormat(totalItemPrice));
                $('#totalPriceValue').val(totalItemPrice);

                $('#balanceDisplay').text('Rp ' + thousandFormat(totalItemPrice));
                $('#balanceDisplayValue').val(totalItemPrice);
            } else {
                var ppn = (10 / 100) * totalItemPrice;
                var totalAfterPPN = totalItemPrice + ppn;
                $('#totalPPN').text('Rp ' + thousandFormat(ppn))
                $('#totalPPNValue').val(ppn)

                // Total Counter
                $('#totalPrice').text("Rp " + thousandFormat(totalAfterPPN));
                $('#totalPriceValue').val(totalAfterPPN);

                $('#balanceDisplay').text('Rp ' + thousandFormat(totalAfterPPN));
                $('#balanceDisplayValue').val(totalAfterPPN);

            }


            $('#totalDiscount').text('Rp ' + 0);
            $('#totalDiscountValue').val(0);
            $('.item-discount').each(function () {
                $(this).val(0);
            });
        });

        $(document).on('click', '.sub', function () {
            var itemID = $(this).data('item-id');
            var itemPrice = $('#itemPrice' + itemID).val();
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);

            $('#itemTotalPrice' + itemID).text("Rp " + thousandFormat($('#quantity' + itemID).val() *
                itemPrice));
            $('#itemTotalPriceValue' + itemID).val($('#quantity' + itemID).val() * itemPrice);

            //// Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + thousandFormat(totalItemPrice));
            $('#totalDPPValue').val(totalItemPrice);
            $('#subtotal').text('Rp ' + thousandFormat(totalItemPrice));
            var settingPPN = $('#dataSettingPPN').val();
            if (settingPPN !== '1') {
                // Total Counter
                $('#totalPrice').text("Rp " + thousandFormat(totalItemPrice));
                $('#totalPriceValue').val(totalItemPrice);

                $('#balanceDisplay').text('Rp ' + thousandFormat(totalItemPrice));
                $('#balanceDisplayValue').val(totalItemPrice);
            } else {
                var ppn = (10 / 100) * totalItemPrice;
                var totalAfterPPN = totalItemPrice + ppn;
                $('#totalPPN').text('Rp ' + thousandFormat(ppn))
                $('#totalPPNValue').val(ppn)

                // Total Counter
                $('#totalPrice').text("Rp " + thousandFormat(totalAfterPPN));
                $('#totalPriceValue').val(totalAfterPPN);

                $('#balanceDisplay').text('Rp ' + thousandFormat(totalAfterPPN));
                $('#balanceDisplayValue').val(totalAfterPPN);

            }

            $('#totalDiscount').text('Rp ' + 0);
            $('#totalDiscountValue').val(0);
            $('.item-discount').each(function () {
                $(this).val(0);
            });
        });


        $(document).on('click', '.discount-btn', function (e) {
            e.preventDefault();
            var itemID = $(this).data('id');
            var itemPrice = $('#itemPriceValue' + itemID).val() * $('#quantity' + itemID).val();
            var itemDiscountPercent = $('#itemDiscountPercent' + itemID).val();
            var itemAdditionalDiscountPercent = $('#itemAdditionalDiscountPercent' + itemID).val();
            $('#saveDiscountBtn').removeData('item-id');
            $('#itemDiscount').removeData('item-id');
            $('#itemAdditionalDiscount').removeData('item-id');

            $('#saveDiscountBtn').attr('data-item-id', itemID);
            $('#itemDiscount').attr('data-item-id', itemID);
            $('#itemAdditionalDiscount').attr('data-item-id', itemID);
            $('#itemDiscount').val(itemDiscountPercent);
            $('#itemAdditionalDiscount').val(itemAdditionalDiscountPercent);

        });
        $('#saveDiscountBtn').on('click', function () {
            var itemID = $(this).data('item-id');

            var quantity = $('#quantity' + itemID).val();
            var itemPrice = $('#itemPriceValue' + itemID).val();
            var discount = $('#itemDiscount[data-item-id="' + itemID + '"]').val();
            var additionalDiscount = $('#itemAdditionalDiscount[data-item-id="' + itemID + '"]').val();
            var itemTotal = itemPrice * quantity;
            var totalItemDiscount = (discount / 100 * itemTotal);
            var totalAfterDiscount = itemTotal - totalItemDiscount;
            var totalItemAdditionalDiscount = additionalDiscount / 100 * totalAfterDiscount;
            var totalAfterAdditionalDiscount = totalAfterDiscount - totalItemAdditionalDiscount;

            $('#itemTotalPrice' + itemID).text('Rp ' + thousandFormat((itemTotal - (
                totalItemAdditionalDiscount +
                totalItemDiscount))));
            $('#itemTotalPriceValue' + itemID).val((itemTotal - (totalItemAdditionalDiscount +
                totalItemDiscount)));

            $('#itemDiscountValue' + itemID).val(totalItemDiscount);
            $('#itemAdditionalDiscountValue' + itemID).val(totalItemAdditionalDiscount);
            $('#itemDiscountPercent' + itemID).val(discount);
            $('#itemAdditionalDiscountPercent' + itemID).val(additionalDiscount);


            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            // Discount Counter
            var totalDiscount = 0;
            $('.item-discount').each(function () {
                totalDiscount += +$(this).val();
            });
            // Additional Discount
            var totalAdditionalDiscount = 0;
            $('.item-additional-discount').each(function () {
                totalAdditionalDiscount += +$(this).val();
            });
            var ppn = (10 / 100) * totalItemPrice;
            $('#totalPPNValue').val(ppn);
            $('#totalPPN').text('Rp ' + thousandFormat(ppn));

            $('#totalDiscount').text('Rp ' + thousandFormat((totalDiscount + totalAdditionalDiscount)));
            $('#totalDiscountValue').val(totalDiscount + totalAdditionalDiscount);
            // Total Counter
            $('#totalPrice').text("Rp " + thousandFormat((totalItemPrice + ppn)));
            $('#totalPriceValue').val((totalItemPrice + ppn));
            $('#balanceDisplay').text('Rp ' + thousandFormat((totalItemPrice + ppn)));
            $('#balanceDisplayValue').val((totalItemPrice + ppn));
        });

        $(document).on('click', '.delete-item-btn', function () {
            var itemID = $(this).data('id');

            $('#itemCard' + itemID).remove();
            // Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + thousandFormat(totalItemPrice));
            $('#totalDPPValue').val(totalItemPrice);
            $('#subtotal').text('Rp ' + thousandFormat(totalItemPrice));

            // Total Counter
            $('#totalPrice').text("Rp " + thousandFormat(totalItemPrice));
            $('#totalPriceValue').val(totalItemPrice);
            $('#balanceDisplay').text('Rp ' + thousandFormat(totalItemPrice));
            $('#balanceDisplayValue').val(totalItemPrice);
        });

        $('#cashPayment').on('click', function () {
            var totalPrice = $('#totalPriceValue').val();
            $('#balance').text('Rp ' + thousandFormat(totalPrice));
            $('#balanceValue').val(totalPrice);

            $('#cashModal').modal('show');
        });
        $('#debitPayment').on('click', function () {
            var totalPrice = $('#totalPriceValue').val();
            $('.balance').text('Rp ' + thousandFormat(totalPrice));
            $('.balanceValue').val(totalPrice);

            $('#bank').prop('disabled', false);
            $('#paidBank').prop('disabled', false);

            $('#debitModal').modal('show');
            $('#bank').on('change', function() {
                $('#cardNumber').prop('disabled', false);
            });
        });
        $('#paid').on('input', function () {
            var value = parseFloat($(this).val());
            var totalPrice = parseFloat($('#totalPriceValue').val());

            if (value > totalPrice) {
                $('#balance').text('Rp 0');
                $('#balanceValue').val(0);
                $('#balanceDisplayValue').val(0);
                $('#balanceDisplay').text('Rp 0');
                $('#change').text('Rp ' + thousandFormat(Math.abs(totalPrice - value)));
                $('#changeValue').val(Math.abs(totalPrice - value));
            } else {
                $('#balance').text('Rp ' + thousandFormat((totalPrice - value)));
                $('#balanceValue').val(totalPrice - value);
                $('#balanceDisplayValue').val(totalPrice - value);
                $('#balanceDisplay').text('Rp ' + thousandFormat((totalPrice - value)));

                $('#change').text('Rp 0');
                $('#change').val(0);
            }
        });
        $('#paidBank').on('input', function () {
            var value = parseFloat($(this).val());
            var totalPrice = parseFloat($('#totalPriceValue').val());

            if (value > totalPrice) {
                $('#balance').text('Rp 0');
                $('#balanceBank').text('Rp 0');
                $('#balanceValue').val(0);
                $('#balanceValueBank').val(0);
                $('#balanceDisplayValue').val(0);
                $('#balanceDisplay').text('Rp 0');
                $('#change').text('Rp ' + thousandFormat(Math.abs(totalPrice - value)));
                $('#changeValue').val(Math.abs(totalPrice - value));
            } else {
                $('#balance').text('Rp ' + thousandFormat((totalPrice - value)));
                $('#balanceBank').text('Rp ' + thousandFormat((totalPrice - value)));
                $('#balanceValueBank').val(totalPrice - value);
                $('#balanceValue').val(totalPrice - value);
                $('#balanceDisplayValue').val(totalPrice - value);
                $('#balanceDisplay').text('Rp ' + thousandFormat((totalPrice - value)));

                $('#change').text('Rp 0');
                $('#change').val(0);
            }
        });
        
        $(document).on('click', '.payment-method-btn', function (e) {
            var method = $(this).data('method');
            $('#paymentMethod1').val(method);
            $('.payment-method-modal').modal('hide');
            
        });
        $('#payBtn').on('click', function() {
            var balance = $('#balanceValue').val();
            var totalPrice = $('#totalPriceValue').val();

            if(balance > 0){
                Swal.fire({
                    title: 'Payment error',
                    text: "The amount of payment is lower than total price!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Add payment method'
                    }).then((result) => {
                    if (result.value) {
                        $('#addPaymentMethodModal').modal('show');
                    }
                })
            } else if(balance == totalPrice){
                Swal.fire(
                    'Choose payment method first',
                    'warning'
                )
            } else {
                $('#posForm').submit();
            }
        });
        $('#addPaymentMethodModal').on('show.bs.modal', function() {
            $('#paymentMethod2ModalBody').empty();
            $('#paymentMethod2ModalBody').append('<div class="row justify-content-center"><div class="col text-center"><div class="images mx-auto text-center"><div class="payment-method-card d-flex float-left mr-2 payment-method-2" data-method="1"> <span class="align-self-center mx-auto font-weight-bold">CASH</span></div><div class="payment-method-card d-flex float-left mr-2 payment-method-2" data-method="2"><span class="align-self-center mx-auto font-weight-bold">DEBIT</span></div><div class="payment-method-card d-flex float-left mr-2 payment-method-2" data-method="3"><span class="align-self-center mx-auto font-weight-bold">CC</span></div><div class="payment-method-card d-flex float-left mr-2 payment-method-2" data-method="4"><span class="align-self-center mx-auto font-weight-bold">GOPAY</span></div><div class="payment-method-card d-flex float-left mr-2 payment-method-2" data-method="5"><span class="align-self-center mx-auto font-weight-bold">OVO</span></div></div></div></div>');
        });
        $(document).on('click', '.payment-method-2', function() {
            var method = $(this).data('method');
            if(method == 1){
                $('#paymentMethod2').prop('disabled', false);
                $('#paymentMethod2').val(method);
                var balance = $('#balanceDisplayValue').val();
                $('#paymentMethod2ModalBody').empty();
                $('#paymentMethod2ModalBody').append('<div class="form-group row"><label class="col-form-label col-12 col-lg-5">Amount</label><div class="input-group col-12 col-lg-6"><div class="input-group-prepend"> <div class="input-group-text">Rp</div></div><input type="text" class="form-control text-right" id="paid2" name="paid2"></div></div><div class="form-group row py-3"><label class="col-form-label col-12 col-lg-5">Balance</label><div class="col-12 col-lg-6"><h6 id="balance2">Rp '+thousandFormat(balance)+'</h6><input type="hidden" id="balanceValue2" value="'+balance+'"></div></div><div class="form-group row py-3"><label class="col-form-label col-12 col-lg-5">Change</label><div class="col-12 col-lg-6"><h6 id="change2">Rp 0</h6><input type="hidden" name="change" id="changeValue2"></div></div>');
                $('paymentMethod2').prop('disabled', false);
                $('paymentMethod2').val(method);
            }
            $('#paid2').on('input', function () {
                var value = parseFloat($(this).val());
                var totalPrice = parseFloat($('#totalPriceValue').val()) -  parseFloat($('#paid').val());

                if (value > totalPrice) {
                    $('#balance2').text('Rp 0');
                    $('#balanceValue2').val(0);
                    $('#balanceValue').val(0);
                    $('#balanceDisplay').text('Rp 0');
                    $('#balanceDisplayValue').val(0);
                    $('#change2').text('Rp ' + thousandFormat(Math.abs(totalPrice - value)));
                    $('#changeValue2').val(Math.abs(totalPrice - value));
                } else {
                    $('#balance2').text('Rp ' + thousandFormat((totalPrice - value)));
                    $('#balanceValue2').val(totalPrice - value);
                    $('#balanceValue').val(totalPrice - value);
                    $('#balanceDisplayValue').val(totalPrice - value);
                    $('#balanceDisplay').text('Rp ' + thousandFormat((totalPrice - value)));

                    $('#change2').text('Rp 0');
                    $('#change2').val(0);
                }
            });
        });
    });

    function thousandFormat(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

</script>
@endsection
