$(document).ready(function () {
    $('#bankOutDate').val('Date');
    $('#pettyCashDetailDate').val('Date');

    $("#pettyCashDetailCategory").change(function () {
        $(".bank-name").hide();
    });

    $('#pettyCashDetailAmount').on('keyup', function () {
        var result = parseInt($(this).val(), 10);
        var pettyCashAmount = parseInt($('#pettyCashAmount').val(), 10);
        $('#pettyCashDetailBalanced').val(pettyCashAmount - result);
    });

    // $('.bank-name').selectric({
    //     disableOnMobile: false,
    //     nativeOnMobile: false
    // });
    $('.bank-account-number').selectric();

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
            $('.bank-account-number').selectric('refresh');
        });
    });

});

// var rupiah = document.getElementByClassName("petty-cash-detail-amount");
// rupiah.addEventListener("keyup", function (e) {
//     // tambahkan 'Rp.' pada saat form di ketik
//     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
//     rupiah.value = formatRupiah(this.value, "Rp. ");
// });

// /* Fungsi formatRupiah */
// function formatRupiah(angka, prefix) {
//     var number_string = angka.replace(/[^,\d]/g, "").toString(),
//         split = number_string.split(","),
//         sisa = split[0].length % 3,
//         rupiah = split[0].substr(0, sisa),
//         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

//     // tambahkan titik jika yang di input sudah menjadi angka ribuan
//     if (ribuan) {
//         separator = sisa ? "." : "";
//         rupiah += separator + ribuan.join(".");
//     }

//     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
//     return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
// }
