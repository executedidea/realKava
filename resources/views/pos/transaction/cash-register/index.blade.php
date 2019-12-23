@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/kava/pos/cash-account.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

@endsection
@section('content')
<form method="post" id="cashDrawerForm">
    @csrf
    <div class="container-fluid">
        <section id="customerCheck">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Customer</h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="form-group col-12">
                                        <select class="form-control" id="checkedInCustomer">
                                            <option value="" disabled selected>Search Name, License Plate, or Phone
                                                Number
                                            </option>
                                            @foreach ($customer as $item)
                                            <option value="{{$item->customer_detail_id}}">
                                                <b>{{ $item->customer_fullName}}</b>
                                                <span
                                                    class="text-muted">{{ $item->customer_detail_licensePlate }}</span>
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
        <section id="customerItem">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-center" id="customerInfo">
                                    <div class="form-group col-3">
                                        <input type="text" class="form-control" id="customerName" value="Customer Name"
                                            readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <input type="text" class="form-control" id="vehicle" value="Vehicle" readonly>
                                    </div>
                                    <div class="form-group col-3">
                                        <input type="text" class="form-control" id="licensePlate" value="License Plate"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-responsive" id="customerItems">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Item(s)</th>
                                                <th class="text-center">Qty.</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Disc</th>
                                                <th class="text-center">Add Disc</th>
                                                <th class="text-center">Total Price</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">Total Discount</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="row1">
                                                <td class="pt-3" width="20%">
                                                    <div class="form-group mx-auto">
                                                        <select class="items px-3" id="itemSelect">
                                                            <option value="" readonly selected>Item Name</option>
                                                        </select>
                                                        <input type="hidden" name="item[]" id="itemValue">
                                                    </div>
                                                </td>
                                                <td class="pt-3" width="10%">
                                                    <div class="form-group">
                                                        <input type="text" name="item_quantity[]"
                                                            class="form-control numeric-input text-right item-quantity"
                                                            value="0" id="quantity" readonly>
                                                    </div>
                                                </td>
                                                <td class="pt-3">
                                                    <div class="form-group">
                                                        <input type="text" name="item_price[]"
                                                            class="form-control text-right item-price" placeholder="0"
                                                            id="itemPrice" readonly>
                                                    </div>
                                                </td>
                                                <td class="pt-3" width="10%">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control text-right item-discount"
                                                                name="item_discount[]" id="itemDiscount" value="0"
                                                                readonly>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-percent"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pt-3" width="10%">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control text-right item-add-discount"
                                                                name="item_add_discount[]" id="itemAddDiscount"
                                                                value="0" readonly>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-percent"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pt-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control text-right total-price"
                                                            placeholder="0" id="itemTotalPrice" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                </td>
                                                <td class="pt-3">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control text-right total-discount"
                                                            placeholder="0" id="itemTotalDiscount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group text-right">
                                        <button type="button" class="btn btn-success" id="addRow">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4" id="calculated">
                                <div class="col-3 p-4 align-self-center text-right">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" name="total_payment" class="totaltotal form-control"
                                                    id="Total" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-2 totalPrice">
                                    <label for="">Total Price</label>
                                    <input type="text" id="totalPrice" name="total_dpp"
                                        class="form-control text-center rupiah" value="0" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="">PPN</label>
                                    <input type="text" name="ppn" class="form-control text-center" id="ppn" value="0"
                                        readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="">Total Discount</label>
                                    <input type="text" name="total_discount" class="form-control text-center"
                                        id="totalAllDiscount" value="0" readonly>
                                </div>
                                <div class="form-group col-2">
                                    <label for="ccCharge">CC Charge</label>
                                    <input type="text" name="cc_charge" class="form-control" id="ccCharge" value="0"
                                        readonly>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary btn-block btn-lg"
                                        id="payBtn">Pay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section id="paymentMethodSection" style="display:none">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-3">
                                    <select name="payment_method1" id="paymentMethod">
                                        <option selected disabled>Payment Method</option>
                                        <option value="1">Cash</option>
                                        <option value="2">Debit</option>
                                        <option value="3">Credit Card</option>
                                        <option value="4">Gopay</option>
                                        <option value="5">OVO</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <select name="credit_card" id="paymentCC" disabled>
                                        <option selected disabled>Credit Card</option>
                                        <option value="1">Master Card</option>
                                        <option value="2">Visa</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <select name="bank" id="paymentBank" disabled>
                                        <option selected disabled>Bank</option>
                                        <option value="1">BCA</option>
                                        <option value="2">Mandiri</option>
                                        <option value="3">Suzuki</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <input type="text" name="card_number" class="form-control" id="cardNo"
                                        placeholder="Card Number" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="Payment">Payment</label>
                                    <input type="text" name="paid1" class="form-control" id="Payment" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="Balance">Balance</label>
                                    <input type="text" class="form-control" id="Balance" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label for="Change">Change</label>
                                    <input type="text" name="change" class="form-control" id="Change" disabled>
                                </div>
                                <div class="form-group col-12 text-right">
                                    <button type="button" id="addPaymentMethodBtn" class="btn btn-info">Additional
                                        Payment</button>
                                </div>
                            </div>
                            <div class="card d-none" id="addPaymentMethodSection">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-3">
                                            <select name="payment_method2" id="AddpaymentMethod">
                                                <option value="" selected readonly>Payment Method</option>
                                                <option value="1">Cash</option>
                                                <option value="2">Debit</option>
                                                <option value="3">Credit Card</option>
                                                <option value="4">Gopay</option>
                                                <option value="5">OVO</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <select name="credit_card2" id="AddpaymentCC" readonly>
                                                <option value="" selected readonly>Credit Card</option>
                                                <option value="1">Master Card</option>
                                                <option value="2">Visa</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <select name="bank2" id="AddpaymentBank" readonly>
                                                <option value="" selected readonly>Bank</option>
                                                <option value="">BCA</option>
                                                <option value="">Mandiri</option>
                                                <option value="">Suzuki</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="text" name="card_number2" class="form-control" id="AddcardNo"
                                                placeholder="Card Number" readonly>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="Payment">Payment</label>
                                            <input type="text" name="paid2" class="form-control" id="AddPayment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <button type="submit">Pay</button>
                </div>
            </div>
        </section>
    </div>
</form>
@endsection
@section('modal')

<div class="modal fade" id="todaysPromo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Today's Promo(s)</h5>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <th>Promo Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/modules/cleave-js/dist/cleave.min.js')}}"></script>
<script src="{{ asset('/js/kava/pos/cash-register/index.js') }}"></script>
<script>


</script>
@endsection
