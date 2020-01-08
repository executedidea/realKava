$(document).ready(function () {
    $('#customerSearch').select2();
    $('#customerSearch').on('change', function () {
        var id = $(this).val();
        $.get('/data/checkin/customer/' + id, function (data) {
            $('#checkInCustomerID').val(data[0].customer_detail_id);
            $('#checkInCustomerName').val(data[0].customer_fullName);
            $('#checkInCustomerPhone').val(data[0].customer_phone);
            $('#checkInCustomerLicensePlate').val(data[0].customer_detail_licensePlate);
        });
        $('#customerCheckInModal').modal('show')
    });

    $(document).on('click', '.customer-detail', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.get('/data/checkin/getcustomer/' + id, function (customer) {
            $('#customerName').val(customer[0].customer_fullName);
            $('#customerPhone').val(customer[0].customer_phone);
            $('#customerPlate').val(customer[0].customer_detail_licensePlate);
            $('#checkInTime').html(customer[0].check_in_time);

        });
        $.get('/data/checkin/getcustomerdetail/' + id, function (detail) {
            $('#checkedInDetailTable tbody tr').empty();
            $.each(detail, function (index, Obj) {
                $('#checkedInDetailTable tbody').append('<tr><td>' + (index + 1) +
                    '</td><td>' + Obj.item_name +
                    '</td></tr>');
            });
        });
        $('#customerCheckedInDetailModal').modal('show');
    });

    $(document).on('click', '.check-out-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var cst = $(this).data('customer');
        $.get('/data/checkin/getcustomerdetail/' + cst, function (detail) {
            if (detail[0].paid !== 1) {
                Swal.fire({
                    title: 'Action can not be proceeded!',
                    text: 'Please pay first',
                    type: 'warning'
                })
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    confirmButtonText: 'Check Out',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $('#keamanan').rateYo({
                            fullStar: true,
                            onSet: function (rating) {
                                $('#keamananRating').val(rating);
                            }
                        });
                        $('#kebersihan').rateYo({
                            fullStar: true,
                            onSet: function (rating) {
                                $('#kebersihanRating').val(rating);
                            }
                        });
                        $('#pelayanan').rateYo({
                            fullStar: true,
                            onSet: function (rating) {
                                $('#pelayananRating').val(rating);
                            }
                        });
                        $('#kualitas').rateYo({
                            fullStar: true,
                            onSet: function (rating) {
                                $('#kualitasRating').val(rating);
                            }
                        });
                        $('#kenyamanan').rateYo({
                            fullStar: true,
                            onSet: function (rating) {
                                $('#kenyamananRating').val(rating);
                            }
                        });
                        $('#customerDetailID').val(cst);
                        $('#feedbackForm').attr('action',
                            '/cs/transaction/check-in-out/checkout/' +
                            id);
                        $('#feedbackModal').modal('show');
                    }
                })
            }
        })

    });




    // var count = 0;

    // $('#btnCheckIn').click(function () {
    //     count++;
    //     $("#testPrint").val(count);
    //     console.log(count);
    // });


    $('#btnCheckIn').click(function () {
        $.ajax({
            url: '/cs/transaction/check-in-out/print',
            type: 'GET',
        })
    });


});
