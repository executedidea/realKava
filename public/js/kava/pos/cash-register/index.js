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
    // Rupiah Format

    // Select2 Init--------------------------------------------------------------------------------
    $('#checkedInCustomer').select2();
    $('#itemSelect').select2();
    $('#paymentMethod').select2();
    $('#paymentCC').select2();
    $('#paymentBank').select2();
    // --------------------------------------------------------------------------------------------
    // Checked In Customer-------------------------------------------------------------------------
    $('#checkedInCustomer').on('change', function (e) {
        e.preventDefault();
        var customer_detail_id = $(this).val();
        $.get('/data/checkin/getcheckedincustomer/' + customer_detail_id, function (customers) {
            //     $('#customerName').val(customers[0].customer_fullName);
            //     $('#vehicle').val(customers[0].vehicle_brand_name + ' ' + customers[0].vehicle_model_name);
            //     $('#licensePlate').val(customers[0].customer_detail_licensePlate);
            if ($('#customerItems tbody tr').length > 0) {
                $('#customerItems tbody tr').remove();
            }
            //     $.each(customers, function (indexCustomer, customer) {
            //         $.get('/data/promo/getvisitpromo/', function (visitPromos) {
            //             $.get('/data/checkin/countVisitItem/' + customer_detail_id + '/' + customer.item_id, function (customerVisit) {
            //                 if (visitPromos.length !== 0) {
            //                     $.each(visitPromos, function (indexVisitPromos, visitPromo) {
            //                         $.get('/data/promo/getpromofree/' + visitPromo.promo_id + '/' + customer_detail_id, function (promoFree) {
            //                             if (customer.item_id == visitPromo.item_id) {
            //                                 if ((customerVisit - promoFree) == visitPromo.promo_maxValue) {
            //                                     var discount = visitPromo.promo_freeValue * 100;
            //                                     var discountPrice = visitPromo.promo_freeValue * customer.item_price;
            //                                 } else {
            //                                     var discount = 0;
            //                                     var discountPrice = 0;
            //                                 }
            //                             }
            //                             $('#customerItems tbody').prepend('<tr id="row"><td class="pt-3" width="20%"><div class="form-group mx-auto"><select class="items px-3"><option value="" readonly selected>Item Name</option></select><input type="hidden" name="item[]" value="' + customer.item_id + '"></div></td><td class="pt-3" width="10%"><div class="form-group"><input type="text" name="item_quantity[]" class="form-control numeric-input text-right item-quantity" value="1" readonly></div></td><td class="pt-3"><div class="form-group"><input type="text" name="item_price[]" class="form-control text-right item-price" value="' + parseFloat(customer.item_price) + '" readonly></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" name="item_discount[]" class="form-control text-right item-discount" value="' + discount + '" readonly><div class="input-group-append"><div class="input-group-text"> <i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" class="form-control text-right item-add-discount" name="item_add_discount[]" value="0" readonly><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-price" placeholder="0" readonly></div></td><td></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-discount" value="' + discountPrice + '" readonly></div></td></tr>');
            //                         });
            //                     });
            //                 }
            //             });
            //         });
            //     });
            $.get('/data/promo/get', function (promo) {
                $.each(customers, function (index, Obj) {
                    $.get('/data/checkin/countVisitItem/' + customer_detail_id + '/' + Obj.item_id, function (visit) {
                        $.get('/data/promo/get', function (promo) {
                            $.each(promo, function (indexP, prm) {
                                $.get('/data/promo/getpromofree/' + prm.promo_id + '/' + customer_detail_id, function (prmfree) {
                                    console.log(Obj.item_name + ' ' + visit + 'x' + ' promo: ' + prm.promo_maxValue + ' x gratis cuci 1x' + ' code promo: ' + prm.promo_id);
                                    if ((visit - prmfree) == prm.promo_maxValue) {
                                        alert('gratis coy');
                                        var discPrice = parseFloat(Obj.item_price) - (parseFloat(prm.promo_freeValue) * 100);
                                        var disc = prm.promo_freeValue * 100;
                                        var totalPrice = Obj.item_price - (prm.promo_freeValue * Obj.item_price);
                                        $('#customerInfo').append('<div class="form-group col-3"><input type="text" class="form-control" value="' + prm.promo_id + '"></div>');
                                        // insert to promo_free table
                                        // $.ajax({
                                        //     method: 'POST',
                                        //     url: '/pos/transaction/promo-free',
                                        //     data: {
                                        //         'customer_id': id
                                        //     }
                                        // }); 
                                    } else {
                                        var discPrice = 0;
                                        var disc = 0;
                                        var totalPrice = Obj.item_price;
                                    }
                                    // $('#customerItems tbody').prepend('<tr><td><div class="form-group"><input type="text" class="form-control item" value="' + Obj.item_name + '" readonly><input type="hidden" name="item[]" value="' + Obj.item_id + '"></div></td><td><div class="form-group"><input type="text" name="item_quantity[]" class="form-control item-quantity" value="1" readonly></div></td><td class="text-right"><div class="form-group"><input type="text" name="item_price[]" class="form-control item-price text-right" value="' + Obj.item_price + '" readonly></div></td><td class="text-right"><div class="form-group"><input type="text" name="item_discount[]" class="form-control item-discount text-right" value="' + disc + '"></div></td><td><div class="form-group"><input type="text" name="item_add_discount[]" class="form-control item-add-discount" value="0"></div></td><td class="text-right"><div class="form-group"><input type="text" " class="form-control text-right total-price" value="' + totalPrice + '" readonly></div></td></tr>');

                                    $('#customerItems tbody').prepend('<tr id="row"><td><div class="form-group"><input type="text" class="form-control item" value="' + Obj.item_name + '" readonly><input type="hidden" name="item[]" value="' + Obj.item_id + '"></div></td><td class="pt-3" width="10%"><div class="form-group"><input type="text" name="item_quantity[]" class="form-control numeric-input text-right item-quantity" value="1" readonly></div></td><td class="pt-3"><div class="form-group"><input type="text" name="item_price[]" class="form-control text-right item-price" value="' + parseFloat(Obj.item_price) + '" readonly></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" name="item_discount[]" class="form-control text-right item-discount" value="' + disc + '" readonly><div class="input-group-append"><div class="input-group-text"> <i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" class="form-control text-right item-add-discount" name="item_add_discount[]" value="0" readonly><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-price" value="' + parseFloat(totalPrice) + '" readonly></div></td><td></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-discount" value="0" readonly></div></td></tr>');

                                });
                                var totalPrice = 0;
                                $('.total-price').each(function () {
                                    totalPrice += +$(this).val();
                                });
                                $('#totalPrice').val(totalPrice);
                                var totalDiscount = 0;
                                $('.total-discount').each(function () {
                                    totalDiscount += +$(this).val();
                                });
                                $('#totalAllDiscount').val(totalDiscount);
                                var totalPriceValue = parseFloat($('#totalPrice').val());
                                var ppn = parseFloat($('#ppn').val());
                                var totalDiscountValue = parseFloat($('#totalDiscount').val());
                                var ccCharge = parseFloat($('#ccCharge').val());

                                $('#Total').val(totalPriceValue + ppn + ccCharge);
                            });
                        });
                    });
                });
            });
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
        var customer_detail_id = $('#checkedInCustomer').val();
        $('#quantity').prop('readonly', false);
        $('#quantity').val(1);
        $('#itemValue').val(item_id);

        $.get('/data/items/getitem/' + item_id, function (item) {
            $('#itemPrice').val(parseFloat(item[0].item_price));
            // getPromos---
            $.get('/data/promo/get', function (promos) {
                if (promos.length !== 0) {
                    if (promos.length > 1) {
                        $('#todaysPromo table tbody').empty();
                        $.each(promos, function (indexPromo, promo) {
                            $('#todaysPromo table tbody').append('<tr><td>' + promo.promo_name + '</td></tr>');
                        });
                        $('#todaysPromo').modal('show');
                    } else {
                        if (item_id == promos[0].item_id || promos[0].item_id == 0) {
                            var disc = promos[0].promo_freeValue * parseFloat($('#itemPrice').val());
                            $('#itemDiscount').val(promos[0].promo_freeValue * 100);
                            $('#itemTotalPrice').val(parseFloat(item[0].item_price) - disc);
                            $('#itemTotalDiscount').val(disc);
                            $('#itemDiscount').prop('readonly', true);
                        }
                    }
                }
                var totalPrice = 0;
                $('.total-price').each(function () {
                    totalPrice += +$(this).val();
                });
                // total discount
                var totalDiscount = 0;
                $('.total-discount').each(function () {
                    totalDiscount += parseFloat($(this).val());
                });
                $('#totalAllDiscount').val(totalDiscount);
                $('#totalPrice').val(totalPrice);
                var totalPriceValue = parseFloat($('#totalPrice').val());
                var ppn = parseFloat($('#ppn').val());
                var totalDiscountValue = parseFloat($('#totalDiscount').val());
                var ccCharge = parseFloat($('#ccCharge').val());

                $('#Total').val(totalPriceValue + ppn + ccCharge);
            });
            // -------------
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
        $.get('/data/cashier/getcashierbyid', function (cashier) {
            if (cashier[0].disc_percent !== 0.00) {
                $('#itemDiscount').prop('readonly', false);
            }
            if (cashier[0].disc_add_1 !== 0.00) {
                $('#itemAddDiscount').prop('readonly', false);
            }
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
            totalDiscount += parseFloat($(this).val());
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
            var totalPriceValue = parseFloat($('#totalPrice').val());
            var ppn = parseFloat($('#ppn').val());
            var totalDiscount = parseFloat($('#totalDiscount').val());
            var ccCharge = parseFloat($('#ccCharge').val());

            $('#Total').val(totalPriceValue + ppn + ccCharge);
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
            totalDiscount += parseFloat($(this).val());
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
            var totalPriceValue = parseFloat($('#totalPrice').val());
            var ppn = parseFloat($('#ppn').val());
            var totalDiscount = parseFloat($('#totalDiscount').val());
            var ccCharge = parseFloat($('#ccCharge').val());

            $('#Total').val(totalPriceValue + ppn + ccCharge);
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
            totalDiscount += parseFloat($(this).val());
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
            var totalPriceValue = parseFloat($('#totalPrice').val());
            var ppn = parseFloat($('#ppn').val());
            var totalDiscount = parseFloat($('#totalDiscount').val());
            var ccCharge = parseFloat($('#ccCharge').val());

            $('#Total').val(totalPriceValue + ppn + ccCharge);
        });
    });
    // ---------------------------------------------------------------------------------------------
    // $('#totalPrice').on('change', function () {
    //     var totalPrice = parseFloat($('#totalPrice').val());
    //     var ppn = parseFloat($('#ppn').val());
    //     var totalDiscount = parseFloat($('#totalDiscount').val());
    //     var ccCharge = parseFloat($('#ccCharge').val());

    //     $('#Total').val(totalPrice + ppn + ccCharge);
    //     $('#Balance').val($('#Total').val());
    // });



    // Add Row--------------------------------------------------------------------------------------
    $('#addRow').on('click', function (e) {
        $('#itemValue').val($('#itemSelect').val());
        $('#itemValue').removeAttr('id');
        $('#itemSelect').prop('disabled', true);
        $('#itemSelect').removeAttr('id');
        $('#quantity').prop('readonly', true);
        $('#quantity').removeAttr('id');
        $('#itemPrice').prop('readonly', true);
        $('#itemPrice').removeAttr('id');
        $('#itemDiscount').prop('readonly', true);
        $('#itemDiscount').removeAttr('id');
        $('#itemAddDiscount').prop('readonly', true);
        $('#itemAddDiscount').removeAttr('id');
        $('#itemTotalPrice').removeAttr('id');
        $('#itemTotalDiscount').removeAttr('id');

        var i = 0;
        $('#customerItems tbody').prepend('<tr id="row"><td class="pt-3" width="20%"><div class="form-group mx-auto"><select class="items px-3" id="itemSelect"><option value="" readonly selected>Item Name</option></select><input type="hidden" name="item[]" id="itemValue"></div></td><td class="pt-3" width="10%"><div class="form-group"><input type="text" name="item_quantity[]" class="form-control numeric-input text-right item-quantity" value="0" id="quantity" readonly></div></td><td class="pt-3"><div class="form-group"><input type="text" name="item_price[]" class="form-control text-right item-price" placeholder="0" id="itemPrice" readonly></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" name="item_discount[]" class="form-control text-right item-discount" id="itemDiscount" value="0" readonly><div class="input-group-append"><div class="input-group-text"> <i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3" width="10%"><div class="form-group"><div class="input-group"><input type="text" class="form-control text-right item-add-discount" name="item_add_discount[]" id="itemAddDiscount" value="0" readonly><div class="input-group-append"><div class="input-group-text"><i class="fas fa-percent"></i></div></div></div></div></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-price" placeholder="0" id="itemTotalPrice" readonly></div></td><td></td><td class="pt-3"><div class="form-group"><input type="text" class="form-control text-right total-discount" placeholder="0" id="itemTotalDiscount" readonly></div></td></tr>');

        $('#itemSelect').select2();
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
            var customer_detail_id = $('#checkedInCustomer').val();
            $('#quantity').prop('readonly', false);
            $('#quantity').val(1);
            $('#itemValue').val(item_id);


            $.get('/data/items/getitem/' + item_id, function (item) {
                $('#itemPrice').val(parseFloat(item[0].item_price));

                // getPromos---
                $.get('/data/promo/get', function (promos) {
                    if (promos.length == 0) {
                        alert('gaada promo');
                    } else {
                        if (promos.length > 1) {
                            $('#todaysPromo table tbody').empty();
                            $.each(promos, function (indexPromo, promo) {
                                $('#todaysPromo table tbody').append('<tr><td>' + promo.promo_name + '</td></tr>');
                            });
                            $('#todaysPromo').modal('show');
                        } else {
                            if (item_id == promos[0].item_id || promos[0].item_id == 0) {
                                var disc = promos[0].promo_freeValue * parseFloat($('#itemPrice').val());
                                $('#itemDiscount').val(promos[0].promo_freeValue * 100);
                                $('#itemTotalPrice').val(parseFloat(item[0].item_price) - disc);
                                $('#itemTotalDiscount').val(disc);
                                $('#itemDiscount').prop('readonly', true);

                            }
                        }
                    }
                    var totalPrice = 0;
                    $('.total-price').each(function () {
                        totalPrice += +$(this).val();
                    });
                    $('#totalPrice').val(totalPrice);
                    var totalPriceValue = parseFloat($('#totalPrice').val());
                    var ppn = parseFloat($('#ppn').val());
                    var totalDiscount = parseFloat($('#totalDiscount').val());
                    var ccCharge = parseFloat($('#ccCharge').val());

                    $('#Total').val(totalPriceValue + ppn + ccCharge);
                });
                // -------------
                // PPN---
                $.get('/data/local-setting/getsetting', function (setting) {
                    if (setting[0].setting_pos_ppn == 0) {
                        $('#ppn').val(0);
                    } else {
                        var totalPPN = $('#totalPrice').val() * 10 / 100;
                        $('#ppn').val(totalPPN)
                    }
                    var totalPriceValue = parseFloat($('#totalPrice').val());
                    var ppn = parseFloat($('#ppn').val());
                    var totalDiscount = parseFloat($('#totalDiscount').val());
                    var ccCharge = parseFloat($('#ccCharge').val());

                    $('#Total').val(totalPriceValue + ppn + ccCharge);
                });
                // ------
            });
            $.get('/data/cashier/getcashierbyid', function (cashier) {
                if (cashier[0].disc_percent !== 0.00) {
                    $('#itemDiscount').prop('readonly', false);
                }
                if (cashier[0].disc_add_1 !== 0.00) {
                    $('#itemAddDiscount').prop('readonly', false);
                }
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
                totalDiscount += parseFloat($(this).val());
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
                var totalPrice = parseFloat($('#totalPrice').val());
                var ppn = parseFloat($('#ppn').val());
                var totalDiscount = parseFloat($('#totalDiscount').val());
                var ccCharge = parseFloat($('#ccCharge').val());

                $('#Total').val(totalPrice + ppn + ccCharge);
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
                totalDiscount += parseFloat($(this).val());
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
                var totalPriceValue = parseFloat($('#totalPrice').val());
                var ppn = parseFloat($('#ppn').val());
                var totalDiscount = parseFloat($('#totalDiscount').val());
                var ccCharge = parseFloat($('#ccCharge').val());

                $('#Total').val(totalPriceValue + ppn + ccCharge);
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
                totalDiscount += parseFloat($(this).val());
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
                var totalPriceValue = parseFloat($('#totalPrice').val());
                var ppn = parseFloat($('#ppn').val());
                var totalDiscount = parseFloat($('#totalDiscount').val());
                var ccCharge = parseFloat($('#ccCharge').val());

                $('#Total').val(totalPriceValue + ppn + ccCharge);
            });
        });
        // ---------------------------------------------------------------------------------------------
    });
    // ---------------------------------------------------------------------------------------------

    $('#payBtn').on('click', function () {
        var customer_detail_id = $('#checkedInCustomer').val();
        $('#paymentMethodSection').toggle();
        $('#cashDrawerForm').attr('action', '/pos/transaction/cash-drawer/pay/' + customer_detail_id);
        var balance = $('#Total').val();
        $('#Balance').val(balance);
    });



    // ---------------------------------PAYMENT-----------------------------------------------------
    // Payment Method-------------------------------------------------------------------------------
    $('#paymentMethod').on('change', function () {
        var value = $(this).val();
        if (value == 1) {
            $('#Payment').prop('disabled', false);
            $('#paymentBank').prop('disabled', true);
            $('#cardNo').prop('disabled', true);
            $('#paymentCC').prop('disabled', true);
        } else if (value == 2) {
            $('#paymentBank').prop('disabled', false);
            $('#paymentCC').prop('disabled', true);
        } else if (value == 3) {
            $('#paymentCC').prop('disabled', false);
            $('#paymentBank').prop('disabled', true);
        } else if (value == 4) {

        } else if (value == 5) {

        }
    });
    // Bank
    $('#paymentBank').on('change', function () {
        $('#cardNo').prop('disabled', false);
    });
    // CC
    $('#paymentCC').on('change', function () {
        var value = $(this).val();
        $('#Payment').prop('disabled', false);
        $('#paymentBank').prop('disabled', false);
        $.get('/data/local-setting/getsetting', function (setting) {
            if (value == 1) {
                if (setting[0].setting_pos_ccCharge_mc > 0.00) {
                    var totalPrice = parseFloat($('#totalPrice').val());
                    var ppn = parseFloat($('#ppn').val());
                    var totalDiscount = parseFloat($('#totalDiscount').val());
                    var ccCharge = (setting[0].setting_pos_ccCharge_mc / 100) * (totalPrice + ppn);
                    $('#ccCharge').val(ccCharge);
                    var ccCharge = parseFloat($('#ccCharge').val());
                    $('#Total').val(totalPrice + ppn + ccCharge);
                } else {
                    $('#ccCharge').val(0);
                }
            } else {
                if (setting[0].setting_pos_ccCharge_visa > 0.00) {
                    var totalPrice = parseFloat($('#totalPrice').val());
                    var ppn = parseFloat($('#ppn').val());
                    var totalDiscount = parseFloat($('#totalDiscount').val());
                    var ccCharge = (setting[0].setting_pos_ccCharge_visa / 100) * (totalPrice + ppn);
                    $('#ccCharge').val(ccCharge);
                    var ccCharge = parseFloat($('#ccCharge').val());
                    $('#Total').val(totalPrice + ppn + ccCharge);
                } else {
                    $('#ccCharge').val(0);
                }
            }
        });
    });
    // ----------------------------------------------------------------------------------------------
    // Payment
    $('#Payment').on('input', function () {
        var balance = $('#Total').val();
        var payment = $(this).val();

        $('#Balance').val(balance - payment);
        if ($('#Balance').val() < 0) {
            $('#Balance').val(0);
            $('#Change').val(Math.abs(parseFloat(balance - payment)));
        } else {
            $('#Change').val(0);

        }
    });
    $('#AddpaymentMethod').selectric();
    $('#AddpaymentBank').selectric();
    $('#AddpaymentCC').selectric();
    $('#addPaymentMethodBtn').on('click', function () {
        $('#addPaymentMethodSection').removeClass('d-none');
        $('#Payment').prop('disabled', true);
        $('#AddPayment').val($('#Balance').val())
    });

});
