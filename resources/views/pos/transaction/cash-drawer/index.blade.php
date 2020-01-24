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
<div class="modal animated slideInUp" id="summary" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Sumary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
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
                                    <div class="payment-method-card d-flex float-left mr-2" data-method="cash">
                                        <span class="align-self-center mx-auto font-weight-bold">CASH</span>
                                    </div>
                                    <div class="payment-method-card d-flex float-left mr-2" data-method="debit">
                                        <span class="align-self-center mx-auto font-weight-bold">DEBIT</span>
                                    </div>
                                    <div class="payment-method-card d-flex" data-method="cc">
                                        <span class="align-self-center mx-auto font-weight-bold">CC</span>
                                    </div>
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
                                    <input type="hidden" name="total_discount" id="totalDiscountValue">
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">PPN 10%</div>
                                    <div class="invoice-detail-value font-weight-bold" id="totalPPN"> Rp 0</div>
                                    <input type="hidden" name="total_ppn" id="totalPPNValue">
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
            </form>
        </div>
    </div>
</div>

{{-- Add Customer Modal --}}
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- Discount Modal --}}
<div class="modal fade" id="itemDiscountModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                        <input type="text" class="form-control text-right" id="itemAdditionalDiscount" data-item-id="">
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
                <button type="button" class="btn bg-transparent" data-container="body" data-toggle="popover" data-placement="left" aria-describedby="popover634014"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
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
                        parseFloat(cst.item_price) +
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
                        '">Rp ' + parseFloat(cst.item_price) +
                        '</h4><input type="hidden" name="total_item_price" class="total-item-price" value="' +
                        parseFloat(cst.item_price) +
                        '" id="itemTotalPriceValue' + cst.item_id +
                        '"/><input type="hidden" id="itemDiscountPercent'+cst.item_id+'" value="0"><input type="hidden" name="item_discount" value="0" id="itemDiscountValue'+cst.item_id+'"><input type="hidden" id="itemAdditionalDiscountPercent'+cst.item_id+'" value="0"><input type="hidden" name="item_additional_discount" value="0" id="itemAdditionalDiscountValue'+cst.item_id+'"><div class="btn-group dropleft"><button type="button" class="btn bg-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i></button><div class="dropdown-menu dropleft"><a class="dropdown-item discount-btn" data-id="' +
                        cst.item_id +
                        '" data-toggle="modal" data-target="#itemDiscountModal">Discount</a><div class="dropdown-divider"></div><a class="dropdown-item delete-item-btn" data-id="' +
                        cst.item_id +
                        '">Delete</a></div></div></div></div></div></div>'
                    );
                });
                // Subtotal Counter
                var totalItemPrice = 0;
                $('.total-item-price').each(function () {
                    totalItemPrice += +$(this).val();
                });
                $('#totalDPP').text("Rp " + totalItemPrice);
                $('#totalDPPValue').val(totalItemPrice);

                // Total Counter
                $('#totalPrice').text("Rp " + totalItemPrice);
                $('#totalPriceValue').val(totalItemPrice);
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
            $('#total').val(total);
            $('#totalDPPValue').val(total);
            $('#totalDPP').text("Rp " + total);
            $('#totalPriceValue').val(total);
            $('#totalPrice').text("Rp " + total);
            $('#subtotal').text('Rp ' + total);


            if ($('#itemCard' + id).length > 0) {
                $('#quantity' + id).val(parseFloat($('#quantity' + id).val()) + 1);
                $('#itemTotalPrice' + id).text("Rp " + parseFloat($('#quantity' + id).val()) *
                    itemPrice);

            } else {
                $('#customerItems').append(
                    '<div class="card" id="itemCard' + id +
                    '"><div class="card-body"><div class="row"><div class="col-3"><h4 id="itemAddedName' +
                    id + '">' + itemName +
                    '</h4><span>@ Rp ' +
                    itemPrice +
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
                    '">Rp ' + itemPrice +
                    '</h4><input type="hidden" name="total_item_price" class="total-item-price" value="' +
                    itemPrice +
                    '" id="itemTotalPriceValue' + id +
                    '"/><input type="hidden" id="itemDiscountPercent'+id+'" value="0"><input type="hidden" name="item_discount" class="item-discount" value="0" id="itemDiscountValue'+id+'"><input type="hidden" id="itemAdditionalDiscountPercent'+id+'" value="0"><input type="hidden" name="item_additional_discount" class="item-additional-discount" value="0" id="itemAdditionalDiscountValue'+id+'"><div class="btn-group dropleft"><button type="button" class="btn bg-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i></button><div class="dropdown-menu dropleft"><a class="dropdown-item discount-btn" data-id="' +
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

            $('#itemTotalPrice' + itemID).text("Rp " + $('#quantity' + itemID).val() * itemPrice);
            $('#itemTotalPriceValue' + itemID).val($('#quantity' + itemID).val() * itemPrice);

            // Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + totalItemPrice);
            $('#totalDPPValue').val(totalItemPrice);

            // Total Counter
            $('#totalPrice').text("Rp " + totalItemPrice);
            $('#totalPriceValue').val(totalItemPrice);


        });

        $(document).on('click', '.sub', function () {
            var itemID = $(this).data('item-id');
            var itemPrice = $('#itemPrice' + itemID).val();
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);

            $('#itemTotalPrice' + itemID).text("Rp " + $('#quantity' + itemID).val() * itemPrice);
            $('#itemTotalPriceValue' + itemID).val($('#quantity' + itemID).val() * itemPrice);

            // Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + totalItemPrice);
            $('#totalDPPValue').val(totalItemPrice);

            // Total Counter
            $('#totalPrice').text("Rp " + totalItemPrice);
            $('#totalPriceValue').val(totalItemPrice);


        });
        $(document).on('input', '.quantity', function () {
            console.log('ok');
        });


        $(document).on('click', '.discount-btn', function (e) {
            e.preventDefault();
            var itemID = $(this).data('id');
            var itemPrice = $('#itemPriceValue'+itemID).val()*$('#quantity'+itemID).val();
            var itemDiscountPercent = $('#itemDiscountPercent'+itemID).val();
            var itemAdditionalDiscountPercent = $('#itemAdditionalDiscountPercent'+itemID).val();
            $('#saveDiscountBtn').removeData('item-id');
            $('#itemDiscount').removeData('item-id');
            $('#itemAdditionalDiscount').removeData('item-id');

            $('#saveDiscountBtn').attr('data-item-id', itemID);
            $('#itemDiscount').attr('data-item-id', itemID);
            $('#itemAdditionalDiscount').attr('data-item-id', itemID);
console.log(itemDiscountPercent);
            $('#itemDiscount').val(itemDiscountPercent);
            $('#itemAdditionalDiscount').val(itemAdditionalDiscountPercent);

        });
        $('#saveDiscountBtn').on('click', function () {
            var itemID = $(this).data('item-id');

            var quantity = $('#quantity' + itemID).val();
            var itemPrice = $('#itemPriceValue' + itemID).val();
            var discount = $('#itemDiscount[data-item-id="'+itemID+'"]').val();
            var additionalDiscount = $('#itemAdditionalDiscount[data-item-id="'+itemID+'"]').val();
            var itemTotal = itemPrice * quantity;
            var totalItemDiscount = (discount / 100 * itemTotal);
            var totalAfterDiscount = itemTotal - totalItemDiscount;
            var totalItemAdditionalDiscount = additionalDiscount / 100 * totalItemDiscount;
            var totalAfterAdditionalDiscount = totalAfterDiscount - totalItemAdditionalDiscount;

            $('#itemTotalPrice' + itemID).text('Rp ' + (itemTotal - (totalItemAdditionalDiscount +
                totalItemDiscount)));
            $('#itemTotalPriceValue' + itemID).val((itemTotal - (totalItemAdditionalDiscount +
                totalItemDiscount)));

            $('#itemDiscountValue'+itemID).val(totalItemDiscount);
            $('#itemAdditionalDiscountValue'+itemID).val(totalItemAdditionalDiscount);
            console.log(discount);
            $('#itemDiscountPercent'+itemID).val(discount);
            $('#itemAdditionalDiscountPercent'+itemID).val(additionalDiscount);


            // Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            // Total Counter
            $('#totalPrice').text("Rp " + totalItemPrice);
            $('#totalPriceValue').val(totalItemPrice);
        });

        $(document).on('click', '.delete-item-btn', function () {
            var itemID = $(this).data('id');

            $('#itemCard' + itemID).remove();
            // Subtotal Counter
            var totalItemPrice = 0;
            $('.total-item-price').each(function () {
                totalItemPrice += +$(this).val();
            });
            $('#totalDPP').text("Rp " + totalItemPrice);
            $('#totalDPPValue').val(totalItemPrice);
            $('#subtotal').text('Rp ' + totalItemPrice);

            // Total Counter
            $('#totalPrice').text("Rp " + totalItemPrice);
            $('#totalPriceValue').val(totalItemPrice);
        });
    });

</script>
@endsection
