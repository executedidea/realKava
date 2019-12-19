$(document).ready(function () {
    $('#bankOutDate').val('Date');
    $('#cashBankDate').val('Date');
    $('#bankName').prop('disabled', true);
    $('.bank-out-type').prop('disabled', true);

    $('#paymentSource').on('change', function () {
        if ($('#paymentSource').val() == 'b') {
            $('.cash-bank-saldo').val('Saldo');
            $('#bankName').prop('disabled', false);
            // $('.bank-out-type').prop('disabled', false);
            // $('#rupiah').autoNumeric('init');
            $('.bank-account-number').prop('disabled', false);

            $('.bank-name').on('change', function (e) {
                var bank_id = e.target.value;
                $.get('/data/cash-bank-out/getbankaccountnumber?bank_id=' + bank_id, function (data) {
                    console.log(data);

                    $('.bank-account-number').empty();
                    $('.bank-account-number').prop("disabled", false);
                    $('.bank-account-number').append(
                        '<option value="" disabled selected>Select Account Number</option>'
                    );

                    $.each(data, function (index, accountNumberObj) {
                        $('.bank-account-number').append(
                            '<option class="text-center" value="' +
                            accountNumberObj.bank_account_id + '">' + accountNumberObj
                            .bank_account_number + '</option>');
                    })
                });
            });

            $('.bank-account-number').on('change', function () {
                var bank_account_id = $(this).val();
                // console.log(bank_account_id);

                $.get('/data/cash-bank-out/getbankaccountbeginingbalance?bank_account_id=' + bank_account_id, function (data) {
                    $('.cash-bank-saldo').val(formatNumber(parseInt(data[0].bank_account_openingBalanced)));
                });
            });


        } else if ($('#paymentSource').val() == 'pc') {
            var petty_cash_id = $(this).val();
            $.get('/data/cash-bank-out/getPettyCashID?petty_cash_id=' + petty_cash_id, function (data) {
                console.log(petty_cash_id);
                $('.cash-bank-saldo').val(formatNumber(parseInt(data.petty_cash_last_date[0].saldo)));
            });

            $('#bankName').prop('disabled', true);
            $('#bankAccountNumber').prop('disabled', true);
            // $('.bank-out-type').prop('disabled', true);
        }

        $('#cashBankAmount').on('input', function () {
            var cashBankAmount = $('#cashBankAmount').val();
            var cashBankSaldo = $('.cash-bank-saldo').val();
            console.log(cashBankAmount);
            if (cashBankAmount == cashBankSaldo) {

                alert('asd');
            }
        });

    });

    function formatNumber(numero) {
        return (numero).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$&,');
    }
    // var amount = $('#pettyCashDetailAmount').val();
    // var remaining = $('#pettyCashRemainingBalance').val();
    // $('#pettyCashDetailAmount').on('keyup', function () {
    //     console.log(parseFloat(remaining));
    //     if (amount > remaining) {
    //         alert('sad');
    //     }
    // });

    // $.ajax({
    //     url: "/data/cash-bank-out/getpettycashremainingbalance",
    //     type: 'GET',
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    //             'content')
    //     },
    //     success: function (remainingBalance) {
    //         if (remainingBalance['status'] == true) {
    //             console.log(remainingBalance);

    //             $('#pettyCashRemainingBalance').val(remainingBalance['petty_cash_remaining_balance'][0].pettyCashRemainingBalance);

    //         } else {
    //             alert('Whoops Something went wrong!!');
    //         }
    //     },
    //     error: function (data) {
    //         alert(data.responseText);
    //     }
    // });



    // $('#pettyCashDetailAmount').on('keyup', function () {
    //     var result = parseFloat($(this).val(), 10);
    //     var pettyCashRemainingBalance = parseFloat($('#pettyCashRemainingBalance').val(), 10);
    //     $('#pettyCashRemainingBalance').val(pettyCashRemainingBalance - result);
    // });

    // $('#pettyCashDetailAmount').on('keyup', function () {
    //     var totalSum = 0;
    //     $('#pettyCashDetailAmount').each(function () {
    //         var inputVal = parseFloat($(this).val(), 10);
    //         if ($.isNumeric(inputVal)) {
    //             totalSum += parseFloat(inputVal);
    //         }
    //     });
    //     $('#pettyCashRemainingBalance').val(totalSum);
    // });

    // var autoNumericInstance = new AutoNumeric('#pettyCashDetailAmount', AutoNumeric.getPredefinedOptions().numericPos.dotDecimalCharCommaSeparator);
    // autoNumericInstance.getNumericString()
    // $('#pettyCashDetailAmount').on('keyup', function () {
    //     var result = parseFloat($(this).val(), 10);
    //     var pettyCashRemainingBalance = parseFloat($('#pettyCashRemainingBalance').val(), 10);
    //     $('#pettyCashRemainingBalance').val(pettyCashRemainingBalance - result);
    // });

});
