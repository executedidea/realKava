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

</style>
@endsection
@section('content')
<section id="items">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" id="itemsCard">
                    <div class="card-header">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($items as $item)
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body product-col text-center">
                                        <img src="{{asset('img/p-250.png')}}" alt="" class="img-fluid mb-3">
                                        <h6 class="h6-responsive text-capitalize">{{$item->item_name}}</h6>
                                        <span class="text-muted">Rp 50.000</span>
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
                                <h2 class="h2-responsive mb-0">Total</h2>
                            </div>
                            <div class="col-6 text-right align-items-center">
                                <h4 class="h4-reponsive my-auto d-inline ">Rp 400.000</h2>
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
            <div class="modal-body">
                <div class="container-fluid">
                    <section id="customerInfo">
                        <div class="row">
                            <div class="col-3">
                                <span class=" font-weight-light">Customer Name</span>
                            </div>
                            <div class="col-4">
                                <span class=" font-weight-bold">: Alfathya Dzisulthani</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span class=" font-weight-light">Vehicle</span>
                            </div>
                            <div class="col-4">
                                <span class=" font-weight-bold">: Honda Civic</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span class=" font-weight-light">License Plate</span>
                            </div>
                            <div class="col-4">
                                <span class=" font-weight-bold">: D23BA</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span class=" font-weight-light">Check In Time</span>
                            </div>
                            <div class="col-4">
                                <span class=" font-weight-bold">: Sun 12 May 2019 12:00 PM</span>
                            </div>
                        </div>
                    </section>
                    <section id="customerItems" class="my-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h4>Washing</h4>
                                        <span>Rp 20.000</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="minus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number"
                                                value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="plus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h4>Rp 150.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h4>Washing</h4>
                                        <span>Rp 20.000</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="minus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number"
                                                value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="plus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h4>Rp 150.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h4>Washing</h4>
                                        <span>Rp 20.000</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="minus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number"
                                                value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="plus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h4>Rp 150.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h4>Washing</h4>
                                        <span>Rp 20.000</span>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="minus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number"
                                                value="1" min="1" max="100">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-number" data-type="plus"
                                                    data-field="quant[2]">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h4>Rp 150.000</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal-footer">
                <h4>Rp 200.000,-</h4>
                <button class="btn btn-primary">Pay</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

</script>
@endsection
