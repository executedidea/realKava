// $(document).ready(function () {
//     $("#checkAllBankAccount").on('change', function () {
//         $(".checkitem-bankaccount").prop('checked', $(this).is(":checked"));
//     });
//     $('.checkitem-bankaccount').on('change', function () {
//         if ($('.checkitem-bankaccount:checked').length !== $('.checkitem-bankaccount').length) {
//             $('#checkAllBankAccount').prop('checked', false);
//         } else {
//             $('#checkAllBankAccount').prop('checked', true);
//         }
//     });

//     $("#checkAllPettyCash").on('change', function () {
//         $(".checkitem-pettycash").prop('checked', $(this).is(":checked"));
//     });
//     $('.checkitem-pettycash').on('change', function () {
//         if ($('.checkitem-pettycash:checked').length !== $('.checkitem-pettycash').length) {
//             $('#checkAllPettyCash').prop('checked', false);
//         } else {
//             $('#checkAllPettyCash').prop('checked', true);
//         }
//     });

//     $('#bank').selectric();
//     $('#checkedInCustomer').select2();
//     $('#itemSelect').select2();
//     $('#itemSelect').on('select2:open', function () {
//         $.get('/data/items/getitems', function (items) {
//             $.each(items, function (index, Obj) {
//                 $('#itemSelect').append('<option value="' + Obj.item_id + '">' + Obj
//                     .item_name + '</option>');
//             });
//         });
//     });
//     // PROMO CONDITION
//     $('#checkedInCustomer').on('change', function () {
//         var id = $(this).val();
//         $.get('/data/checkin/getcustomer/' + id, function (cst) {
//             $('#customerName').val(cst[0].customer_fullName);
//             $('#vehicle').val(cst[0].vehicle_brand_name + ' ' + cst[0].vehicle_model_name);
//             $('#licensePlate').val(cst[0].customer_detail_licensePlate);
//         });
//         $.get('/data/checkin/getcustomerdetail/' + id, function (item) {
//             $.get('/data/promo/get', function (promo) {
//                 $.each(item, function (index, Obj) {
//                     $.get('/data/checkin/countVisitItem/' + id + '/' + Obj.item_id, function (visit) {
//                         $.get('/data/promo/get', function (promo) {
//                             $.each(promo, function (indexP, prm) {
//                                 $.get('/data/promo/getpromofree/' + prm.promo_id + '/' + id, function (prmfree) {
//                                     console.log(Obj.item_name + ' ' + visit + 'x' + ' promo: ' + prm.promo_maxValue + ' x gratis cuci 1x' + ' code promo: ' + prm.promo_id);
//                                     if ((visit - prmfree) == prm.promo_maxValue) {
//                                         alert('gratis coy');
//                                         var discPrice = parseInt(Obj.item_price) - (parseInt(prm.promo_freeValue) * 100);
//                                         var disc = prm.promo_freeValue * 100;
//                                         var totalPrice = Obj.item_price - (prm.promo_freeValue * Obj.item_price);
//                                         $('#customerInfo').append('<div class="form-group col-3"><input type="text" class="form-control" value="' + prm.promo_id + '"></div>');
//                                         // insert to promo_free table
//                                         // $.ajax({
//                                         //     method: 'POST',
//                                         //     url: '/pos/transaction/promo-free',
//                                         //     data: {
//                                         //         'customer_id': id
//                                         //     }
//                                         // }); 
//                                     } else {
//                                         var discPrice = 0;
//                                         var disc = 0;
//                                         var totalPrice = Obj.item_price;
//                                     }
//                                     $('#customerItems tbody').prepend('<tr><td><div class="form-group"><input type="text" class="form-control item" value="' + Obj.item_name + '" readonly><input type="hidden" name="item[]" value="' + Obj.item_id + '"></div></td><td><div class="form-group"><input type="text" name="item_quantity[]" class="form-control item-quantity" value="1" readonly></div></td><td class="text-right"><div class="form-group"><input type="text" name="item_price[]" class="form-control item-price text-right" value="' + Obj.item_price + '" readonly></div></td><td class="text-right"><div class="form-group"><input type="text" name="item_discount[]" class="form-control item-discount text-right" value="' + disc + '"></div></td><td><div class="form-group"><input type="text" name="item_add_discount[]" class="form-control item-add-discount" value="0"></div></td><td class="text-right"><div class="form-group"><input type="text" " class="form-control text-right total-price" value="' + totalPrice + '" readonly></div></td></tr>');
//                                 });
//                             });
//                         });

//                         $.get('/data/promo/get', function (promo) {
//                             if (visit == promo[0].promo_maxValue) {
//                                 $('#customerItems tbody').prepend('<tr><td><div class="form-group"><input type="text" class="form-control" value="' + Obj.item_name + '" disabled></div></td><td><div class="form-group"><input type="text" class="form-control" value="1" disabled></div></td><td class="text-right"><div class="form-group"><input type="text"class="form-control" value="' + (Obj.item_price) + '"></div></td><td>' + visit + 'x' + '</td></tr>');
//                             }
//                         });

//                     });
//                 });
//             });
//         });
//         // ------------------------------
//         $('#itemSelect').on('change', function () {
//             var id = $(this).val();
//             $('#quantity').prop('disabled', false);
//             $('#quantity').val(1);
//             $('#itemDiscount').val(0);
//             $('#itemAddDiscount').val(0);


//             $.get('/data/items/getitem/' + id, function (item) {
//                 $.get('/data/promo/getpromoitem', function (promo) {
//                     $('#itemPrice').val(item[0].item_price);
//                     $('#itemTotalPrice').val($('#itemPrice').val());
//                     $.each(promo, function (indexP, prm) {
//                         if (prm.item_id == id) {
//                             $('#itemDiscount').val(prm.promo_freeValue * 100);

//                             var disc = ($('#itemPrice').val() * $('#itemDiscount').val()) / 100;
//                             var totalAfterDisc = $('#itemPrice').val() - disc;
//                             $('#itemTotalPrice').val(totalAfterDisc);
//                             $('#itemTotalDiscount').val(disc);
//                             if ($('#promoCode').length == 0) {
//                                 $('#customerInfo').append('<div class="form-group col-3"><input type="text" class="form-control" id="promoCode" value="' + prm.promo_id + '"></div>');
//                             } else {
//                                 $('#promoCode').val(prm.promo_id);
//                             }
//                         };
//                     });
//                 });


//             });
//         });
//     });
// });
// // ------------------------------
// $('#itemSelect').on('change', function () {
//             var id = $(this).val();
//             $('#quantity').prop('readonly', false);
//             $('#quantity').val(1);
//             $('#itemDiscount').val(0);
//             $('#itemAddDiscount').val(0);

//             // PROMO ITEM CONDITION
//             $.get('/data/items/getitem/' + id, function (item) {
//                         $.get('/data/promo/getpromoitem', function (promo) {
//                                 $('#itemPrice').val(item[0].item_price);
//                                 $('#itemTotalPrice').val($('#itemPrice').val());
//                                 $.each(promo, function (indexP, prm) {
//                                         if (prm.item_id == id) {
//                                             $('#itemDiscount').val(prm.promo_freeValue * 100);

//                                             var disc = ($('#itemPrice').val() * $('#itemDiscount').val()) / 100;
//                                             var totalAfterDisc = $('#itemPrice').val() - disc;
//                                             $('#itemTotalPrice').val(totalAfterDisc);
//                                             $('#itemTotalDiscount').val(disc);
//                                             if ($('#promoCode').length == 0) {
//                                                 $('#customerInfo').append('<div class="form-group col-3"><input type="text" class="form-control" id="promoCode" value="' + prm.promo_id + '"></div>');
//                                             } else {
//                                                 $('#itemDiscount').prop('disabled', false);
//                                             }
//                                             if (cashier[0].disc_add_1 <= 0) {
//                                                 $('#itemAddDiscount').prop('disabled', true);
//                                             } else {
//                                                 $('#itemAddDiscount').prop('disabled', false);
//                                             }
//                                         });
//                                 }); $('#quantity').on('keyup', function () {
//                                 $('#itemTotalPrice').val($('#quantity').val() * $('#itemPrice').val());

//                             }); $.get('/data/cashier/getcashierbyid', function (cashier) {
//                                 if (cashier[0].disc_percent <= 0) {
//                                     $('#itemDiscount').prop('readonly', true);
//                                 } else {
//                                     $('#itemDiscount').prop('readonly', false);
//                                 }
//                                 if (cashier[0].disc_add_1 <= 0) {
//                                     $('#itemAddDiscount').prop('readonly', true);
//                                 } else {
//                                     $('#itemAddDiscount').prop('readonly', false);
//                                 }
//                             });
//                         }); $('#quantity').on('keyup', function () {
//                         $('#itemTotalPrice').val($('#quantity').val() * $('#itemPrice').val());

//                     });
//                     // $('#itemDiscount').on('keyup', function () {
//                     //     $.get('/data/cashier/getcashierbyid', function(cashier){
//                     //         if ($('#itemDiscount').val() > cashier[0].disc_percent) {
//                     //             alert('You are not allowed to give discount that much!');
//                     //             $('#itemDiscount').val(0);
//                     //             console.log(cashier[0].disc_percent);
//                     //         }
//                     //     });
//                     //     var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
//                     //     var discount = priceQuantity * $('#itemDiscount').val() / 100;
//                     //     $('#itemTotalPrice').val(priceQuantity - discount);

//                     // });
//                     $('#itemDiscount').on('change', function () {
//                         $.get('/data/cashier/getcashierbyid', function (cashier) {
//                             if ($('#itemDiscount').val() > cashier[0].disc_percent || $('#itemDiscount')
//                                 .val() >= 100) {
//                                 alert('You are not allowed to give discount that much!');
//                                 $('#itemDiscount').val(0);
//                             }
//                             var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
//                             var discount = priceQuantity * $('#itemDiscount').val() / 100;
//                             var priceAfterDisc = priceQuantity - discount;
//                             var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
//                             // $('#itemTotalPrice').val(priceQuantity - discount);
//                             $('#itemTotalPrice').val(priceAfterDisc - addDisc);
//                             var totalWithoutDisc = $('#itemPrice').val() * $('#quantity').val();
//                             var disc = totalWithoutDisc * $('#itemDiscount').val() / 100;
//                             var totalDisc = totalWithoutDisc - disc;
//                             var addDisc = totalDisc * $('#itemAddDiscount').val() / 100;
//                             $('#itemTotalDiscount').val(addDisc + disc);

//                         });
//                     });

//                     $('#itemAddDiscount').on('change', function () {
//                         $.get('/data/cashier/getcashierbyid', function (cashier) {
//                             if ($('#itemAddDiscount').val() > cashier[0].disc_add_1 || $('#itemAddDiscount')
//                                 .val() >= 100) {
//                                 alert('You are not allowed to give discount that much!');
//                                 $('#itemAddDiscount').val(0);
//                             }
//                             // var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
//                             // var discount = priceQuantity * $('#itemDiscount').val() / 100;
//                             // var priceAfterDisc = priceQuantity - discount;
//                             // var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
//                             // $('#itemTotalPrice').val(priceAfterDisc - addDisc);
//                             var priceQuantity = $('#quantity').val() * $('#itemPrice').val();
//                             var discount = priceQuantity * $('#itemDiscount').val() / 100;
//                             var priceAfterDisc = priceQuantity - discount;
//                             var addDisc = priceAfterDisc * $('#itemAddDiscount').val() / 100;
//                             $('#itemTotalPrice').val(priceAfterDisc - addDisc);
//                             var totalWithoutDisc = $('#itemPrice').val() * $('#quantity').val();
//                             var disc = totalWithoutDisc * $('#itemDiscount').val() / 100;
//                             var totalDisc = totalWithoutDisc - disc;
//                             var addDiscount = totalDisc * $('#itemAddDiscount').val() / 100;
//                             $('#itemTotalDiscount').val(addDiscount + disc);
//                         });

//                     });


//                     $('#bankAccountBtn').on('click', function () {
//                         $('#pettyCash').hide();
//                         $('#bankAccount').show(200, 'swing');
//                     }); $('#pettyCashBtn').on('click', function () {
//                         $('#bankAccount').hide();
//                         $('#pettyCash').show(200, 'swing');
//                     }); $(document).on('click', '.remove-row', function () {
//                             var id = $(this).data('id');
//                             $('#row' + id).remove();
//                             $('#Total').val(0);
//                             $('#totalPrice').val(0);
//                             $('#ppn').val(0);
//                             $('#totalAllDiscount').val(0);
//                             $('#ccCharge').val(0);

//                             if ($('#customerItems tbody tr').length <= 1) {
//                                 $('#customerItems tbody tr select').attr('id', 'itemSelect');
//                                 $('#itemSelect').prop('readonly', false);
//                                 $('.item-quantity').prop('readonly', false).attr('id', 'quantity');
//                                 $('.item-discount').prop('readonly', false);
//                                 $('.item-discount').attr('id', 'itemDiscount');
//                                 $('.item-add-discount').prop('readonly', false);
//                                 $('.item-discount').attr('id', 'itemAddDiscount');
//                                 $('#itemSelect').on('change', function () {
//                                     var id = $(this).val();
//                                     $('#quantity').prop('readonly', false);
//                                     $('#quantity').val(1);
//                                     $('#itemDiscount').val(0);
//                                     $('#itemAddDiscount').val(0);

//                                     $('#calculatePrice').on('click', function () {
//                                         $.get('/data/local-setting/getsetting', function (setting) {
//                                             var totalPrice = 0;
//                                             $('.total-price').each(function () {
//                                                 totalPrice += +$(this).val();
//                                             });
//                                             var totalAllDiscount = 0;
//                                             $('.total-discount').each(function () {
//                                                 totalAllDiscount += +$(this).val();
//                                             });

//                                             $('#totalPrice').val(totalPrice);
//                                             if (setting[0].setting_pos_ppn === 0) {
//                                                 $('#ppn').val(0);
//                                             } else {
//                                                 $('#ppn').val(parseFloat($('#totalPrice').val() * 10 /
//                                                     100));
//                                             }
//                                             $('#totalAllDiscount').val(totalAllDiscount);
//                                             $('#Total').html(parseFloat($('#totalPrice').val()) + parseFloat($('#ppn')
//                                                 .val()));
//                                             $('#Balance').val(
//                                                 parseFloat($('#totalPrice').val()) + parseFloat($('#ppn').val()));
//                                         });

//                                     });

//                                     $('#paymentMethod').selectric();
//                                     $('#paymentBank').selectric();
//                                     $('#paymentCC').selectric();
//                                     $('#AddpaymentMethod').selectric();
//                                     $('#AddpaymentBank').selectric();
//                                     $('#AddpaymentCC').selectric();

//                                     $('#Payment').on('keyup', function () {
//                                         var balanceVal = $('#Balance').val();
//                                         $('#Balance').val(balanceVal - $(this).val());

//                                         var value = parseFloat($('#totalPrice').val()) + parseFloat($('#ppn').val()) +
//                                             parseFloat($('#ccCharge').val());
//                                         if ($(this).val() > value) {
//                                             $('#Change').val(Math.abs(value - $(this).val()));
//                                             $('#Balance').val(0);
//                                         } else if ($(this).val() < value) {
//                                             $('#Balance').val(parseFloat($('#totalPrice').val()) + parseFloat($('#ppn').val()) +
//                                                 parseFloat($('#ccCharge').val()) - $(
//                                                     this)
//                                                 .val());
//                                             $('#Change').val(Math.abs(0));
//                                         } else if ($(this).val() == value) {
//                                             $('#Change').val(0);
//                                             $('#Balance').val(0);
//                                         }
//                                     });
//                                     $('#paymentMethod').on('change', function () {
//                                         if ($(this).val() == 3) {
//                                             $('#paymentBank').prop('disabled', false);
//                                             $('#paymentBank').selectric('refresh');
//                                             $('#paymentCC').prop('disabled', false);
//                                             $('#paymentCC').selectric('refresh');
//                                             $('#cardNo').prop('disabled', false);
//                                         } else if ($(this).val() == 2) {
//                                             $('#paymentBank').prop('disabled', false);
//                                             $('#paymentBank').selectric('refresh');
//                                             $('#paymentCC').prop('disabled', true);
//                                             $('#paymentCC').selectric('refresh');
//                                             $('#cardNo').prop('disabled', false);
//                                         } else {
//                                             $('#paymentBank').prop('disabled', true);
//                                             $('#paymentBank').selectric('refresh');
//                                             $('#paymentCC').prop('disabled', true);
//                                             $('#paymentCC').selectric('refresh');
//                                             $('#cardNo').prop('disabled', true);
//                                         }
//                                     });
//                                     $('#paymentCC').on('change', function () {
//                                         $.get('/data/local-setting/getsetting', function (setting) {
//                                             if ($('#paymentCC').val() == 1) {
//                                                 $('#Total').html(parseFloat($('#totalPrice').val()) + parseFloat($(
//                                                         '#ppn')
//                                                     .val()));
//                                                 var CcCharge = parseFloat($('#Total').html()) * parseFloat(setting[0]
//                                                     .setting_pos_ccCharge_mc) / 100;
//                                                 var totalAfterCcCharge = parseFloat($('#Total').html()) + CcCharge;

//                                                 $('#ccCharge').val(CcCharge);
//                                                 $('#Total').html(totalAfterCcCharge);
//                                             } else {
//                                                 $('#Total').html(parseFloat($('#totalPrice').val()) + parseFloat($(
//                                                         '#ppn')
//                                                     .val()));
//                                                 var CcCharge = parseFloat($('#Total').html()) * parseFloat(setting[0]
//                                                     .setting_pos_ccCharge_visa) / 100;
//                                                 var totalAfterCcCharge = parseFloat($('#Total').html()) + CcCharge;

//                                                 $('#ccCharge').val(CcCharge);
//                                                 $('#Total').html(totalAfterCcCharge);
//                                             }
//                                         });
//                                         $('#Total').on('DOMSubtreeModified', function () {
//                                             $('#Balance').val($(this).html());
//                                         });
//                                     });



//                                     $('#addPaymentMethodBtn').on('click', function () {
//                                         $('#addPaymentMethodSection').removeClass('d-none');
//                                         $('#Payment').prop('disabled', true);
//                                         $('#AddPayment').val($('#Balance').val())
//                                     });
//                                     $('#AddpaymentMethod').on('change', function () {
//                                         if ($(this).val() == 3) {
//                                             $('#AddpaymentBank').prop('disabled', false);
//                                             $('#AddpaymentBank').selectric('refresh');
//                                             $('#AddpaymentCC').prop('disabled', false);
//                                             $('#AddpaymentCC').selectric('refresh');
//                                             $('#AddcardNo').prop('disabled', false);
//                                         } else if ($(this).val() == 2) {
//                                             $('#AddpaymentBank').prop('disabled', false);
//                                             $('#AddpaymentBank').selectric('refresh');
//                                             $('#AddpaymentCC').prop('disabled', true);
//                                             $('#AddpaymentCC').selectric('refresh');
//                                             $('#AddcardNo').prop('disabled', false);
//                                         } else {
//                                             $('#AddpaymentBank').prop('disabled', true);
//                                             $('#AddpaymentBank').selectric('refresh');
//                                             $('#AddpaymentCC').prop('disabled', true);
//                                             $('#AddpaymentCC').selectric('refresh');
//                                             $('#AddcardNo').prop('disabled', true);
//                                         }
//                                     });
//                                     $('#AddpaymentCC').on('change', function () {
//                                         $.get('/data/local-setting/getsetting', function (setting) {
//                                             if ($('#AddpaymentCC').val() == 1) {
//                                                 $('#Total').html(parseFloat($('#totalPrice').val()) + parseFloat($(
//                                                         '#ppn')
//                                                     .val()));
//                                                 var CcCharge = parseFloat($('#Total').html()) * parseFloat(setting[0]
//                                                     .setting_pos_ccCharge_mc) / 100;
//                                                 var totalAfterCcCharge = parseFloat($('#Total').html()) + CcCharge;

//                                                 $('#ccCharge').val(CcCharge);
//                                                 $('#Total').html(totalAfterCcCharge);


//                                                 $('#AddPayment').val(parseInt($('#Total').html()) - parseInt($('#Payment')
//                                                     .val()));
//                                                 $('#Balance').val(parseInt($('#Total').html()) - parseInt($('#Payment')
//                                                     .val()));
//                                             } else {
//                                                 $('#Total').html(parseFloat($('#totalPrice').val()) + parseFloat($(
//                                                         '#ppn')
//                                                     .val()));
//                                                 var CcCharge = parseFloat($('#Total').html()) * parseFloat(setting[0]
//                                                     .setting_pos_ccCharge_visa) / 100;
//                                                 var totalAfterCcCharge = parseFloat($('#Total').html()) + CcCharge;

//                                                 $('#ccCharge').val(CcCharge);
//                                                 $('#Total').html(totalAfterCcCharge);

//                                                 $('#AddPayment').val(parseInt($('#Total').html()) - parseInt($('#Payment')
//                                                     .val()));
//                                                 $('#Balance').val(parseInt($('#Total').html()) - parseInt($('#Payment')
//                                                     .val()));
//                                             }
//                                         });
//                                     });
//                                     $('#AddPayment').on('keyup', function () {
//                                         var balanceVal = $('#Balance').val();

//                                         if ($(this).val() > balanceVal) {
//                                             $('#Change').val(Math.abs(balanceVal - $(this).val()));
//                                         }
//                                         // } else if ($(this).val() < balanceVal) {
//                                         //     $('#Balance').val(parseFloat($('#totalPrice').val()) + parseFloat($('#ppn').val()) +
//                                         //         parseFloat($('#ccCharge').val()) - $(
//                                         //             this)
//                                         //         .val());
//                                         //     $('#Change').val(Math.abs(0));
//                                         // } else if ($(this).val() == balanceVal) {
//                                         //     $('#Change').val(0);
//                                         // }
//                                     });

//                                     $(document).on('click', '.use-voucher', function () {
//                                         $('#todaysPromo').modal('hide');
//                                     });

//                                 });
$(document).ready(function () {
    // Select2 Init--------------------------------------------------------------------------------
    $('#checkedInCustomer').select2();
    $('#itemSelect').select2();
    // --------------------------------------------------------------------------------------------
    // Checked In Customer-------------------------------------------------------------------------
    $('#checkedInCustomer').on('change', function (e) {
        e.preventDefault();
        var customer_detail_id = $(this).val();
        $.get('/data/checkin/getcustomer/' + customer_detail_id, function (cst) {
            $('#customerName').val(cst[0].customer_fullName);
            $('#vehicle').val(cst[0].vehicle_brand_name + ' ' + cst[0].vehicle_model_name);
            $('#licensePlate').val(cst[0].customer_detail_licensePlate);
        });
    });
    // ---------------------------------------------------------------------------------------------
    // Items On Select------------------------------------------------------------------------------
    $('#itemSelect').on('select2:opening', function (e) {
        $('#itemSelect').empty();
        $('#itemSelect').append('<option disabled selected>Item Name</option>');
        $.get('/data/items/getitems', function (items) {
            $.each(items, function (index, Obj) {
                $('#itemSelect').append('<option value="' + Obj.item_id + '">' + Obj
                    .item_name + '</option>');
            });
        });
    });
    // ---------------------------------------------------------------------------------------------
    // Items On Change------------------------------------------------------------------------------
    $('#itemSelect').on('change', function () {
        var item_id = $(this).val();
        $('#quantity').prop('readonly', false);
        $('#quantity').val(1);
        $.get('/data/cashier/getcashierbyid', function (cashier) {
            if (cashier[0].disc_percent !== 0.00) {
                $('#itemDiscount').prop('readonly', false);
            }
            if (cashier[0].disc_add_1 !== 0.00) {
                $('#itemAddDiscount').prop('readonly', false);
            }
        });
        $.get('/data/items/getitem/' + item_id, function (item) {
            $('#itemPrice').val(parseInt(item[0].item_price));
            $('#itemTotalPrice').val(parseInt(item[0].item_price));
            var totalPrice = 0;
            $('.total-price').each(function () {
                totalPrice += +$(this).val();
            });
            $('#totalPrice').val(totalPrice);
            // PPN---
            $.get('/data/local-setting/getsetting', function (setting) {
                if (setting[0].setting_pos_ppn == 0) {
                    $('#ppn').val(0);
                } else {
                    var totalPPN = $('#totalPrice').val() * 10 / 100;
                    $('#ppn').val(totalPPN)
                }
            });
            // ------
        });


    });
    // ---------------------------------------------------------------------------------------------
    // Quantity-------------------------------------------------------------------------------------
    $('#quantity').on('input', function (e) {
        var quantityPrice = $('#quantity').val() * $('#itemPrice').val();
        var disc = ($('#itemDiscount').val() / 100) * quantityPrice;
        var discPrice = quantityPrice - disc;
        var addDisc = ($('#itemAddDiscount').val() / 100) * discPrice;
        var addDiscPrice = discPrice - addDisc;
        var totalDiscount = disc + addDisc;
        $('#itemTotalDiscount').val(totalDiscount);
        $('#itemTotalPrice').val(addDiscPrice);

        // total discount
        var totalDiscount = 0;
        $('.total-discount').each(function () {
            totalDiscount += parseInt($(this).val());
        });
        $('#totalAllDiscount').val(totalDiscount);
        // ---
        // total price
        var totalPrice = 0;
        $('.total-price').each(function () {
            totalPrice += +$(this).val();
        });
        $('#totalPrice').val(totalPrice);
        // ---
        $.get('/data/local-setting/getsetting', function (setting) {
            if (setting[0].setting_pos_ppn == 0) {
                $('#ppn').val(0);
            } else {
                var totalPPN = $('#totalPrice').val() * 10 / 100;
                $('#ppn').val(totalPPN)
            }
        });
    });
    // ---------------------------------------------------------------------------------------------
    // Discount
    $('#itemDiscount').on('input', function (e) {
        var quantityPrice = $('#quantity').val() * $('#itemPrice').val();
        var disc = ($('#itemDiscount').val() / 100) * quantityPrice;
        var discPrice = quantityPrice - disc;
        var addDisc = ($('#itemAddDiscount').val() / 100) * discPrice;
        var addDiscPrice = discPrice - addDisc;
        var totalDiscount = disc + addDisc;
        $('#itemTotalDiscount').val(totalDiscount);
        $('#itemTotalPrice').val(addDiscPrice);

        var totalDiscount = 0;
        $('.total-discount').each(function () {
            totalDiscount += parseInt($(this).val());
        });
        $('#totalAllDiscount').val(totalDiscount);
        var totalPrice = 0;
        $('.total-price').each(function () {
            totalPrice += +$(this).val();
        });
        $('#totalPrice').val(totalPrice);
        $.get('/data/local-setting/getsetting', function (setting) {
            if (setting[0].setting_pos_ppn == 0) {
                $('#ppn').val(0);
            } else {
                var totalPPN = $('#totalPrice').val() * 10 / 100;
                $('#ppn').val(totalPPN)
            }
        });
    });
    // ---------------------------------------------------------------------------------------------
    // Add Discount
    $('#itemAddDiscount').on('input', function (e) {
        var quantityPrice = $('#quantity').val() * $('#itemPrice').val();
        var disc = ($('#itemDiscount').val() / 100) * quantityPrice;
        var discPrice = quantityPrice - disc;
        var addDisc = ($('#itemAddDiscount').val() / 100) * discPrice;
        var addDiscPrice = discPrice - addDisc;
        var totalDiscount = disc + addDisc;
        $('#itemTotalDiscount').val(totalDiscount);
        $('#itemTotalPrice').val(addDiscPrice);

        var totalDiscount = 0;
        $('.total-discount').each(function () {
            totalDiscount += parseInt($(this).val());
        });
        $('#totalAllDiscount').val(totalDiscount);
        var totalPrice = 0;
        $('.total-price').each(function () {
            totalPrice += +$(this).val();
        });
        $('#totalPrice').val(totalPrice);
        $.get('/data/local-setting/getsetting', function (setting) {
            if (setting[0].setting_pos_ppn == 0) {
                $('#ppn').val(0);
            } else {
                var totalPPN = $('#totalPrice').val() * 10 / 100;
                $('#ppn').val(totalPPN)
            }
        });
    });
    // ---------------------------------------------------------------------------------------------

});
