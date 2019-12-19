$("#checkAll").on('change', function () {
    $(".checkitem").prop('checked', $(this).is(":checked"));
});
$('.checkitem').on('change', function () {
    if ($('.checkitem:checked').length !== $('.checkitem').length) {
        $('#checkAll').prop('checked', false);
    } else {
        $('#checkAll').prop('checked', true);
    }
});
$(document).ready(function () {
    $('#complaintHandlingDate').val('Handling Date');
    $('#complaintHandlingTargetDate').val('Target Handling');

    $('#complaintCustomer').select2();
    $('#itemName').select2();

    $('#complaintCustomer').on('change', function () {
        var id = $(this).val();
        $.ajax({
            url: '/data/complaint-handling/getcustomer/' + id,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: id,
            success: function (data) {
                if (data['status'] == true) {
                    console.log(data);
                    $('#customerName').val(data['license_plate'][0].customer_fullName);
                    $('#vehicle').val(data['license_plate'][0].vehicle_brand_name +
                        ' ' + data['license_plate'][0].vehicle_model_name);
                    $('#licensePlate').val(data['license_plate'][0]
                        .customer_detail_licensePlate);
                    $('#customerID').val(data['license_plate'][0].customer_id);
                    $('#vehicleModelID').val(data['license_plate'][0].vehicle_model_id);
                    $('#vehicleBrandID').val(data['license_plate'][0].vehicle_brand_id);
                    $('#customerDetailID').val(data['license_plate'][0]
                        .customer_detail_id);

                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    });


    $(document).on('click', '.complaint-handling', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#editComplaintHandlingForm').attr('action',
            '/cs/transaction/complaint-handling/' + id + '/edit');
        $.ajax({
            url: "/data/complaint-handling/get/" + id,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: id,
            success: function (complaint) {
                if (complaint['status'] == true) {
                    console.log(id);
                    $('#editComplaintHandlingID').val(complaint['complaint_customer'][0]
                        .complaint_handling_id);
                    $('#editCustomerName').val(complaint['complaint_customer'][0]
                        .customer_fullName);
                    $('#editVehicle').val(complaint['complaint_customer'][0]
                        .vehicle_brand_name + ' ' + complaint[
                            'complaint_customer'][
                            0
                        ].vehicle_model_name);
                    $('#editLicensePlate').val(complaint['complaint_customer'][0]
                        .customer_detail_licensePlate);
                    $('#editCustomerID').val(complaint['complaint_customer'][0]
                        .customer_id);
                    $('#editVehicleModelID').val(complaint['complaint_customer'][0]
                        .vehicle_model_id);
                    $('#editVehicleBrandID').val(complaint['complaint_customer'][0]
                        .vehicle_brand_id);
                    $('#editCustomerDetailID').val(complaint['complaint_customer'][
                            0
                        ]
                        .customer_detail_id);

                    $('#editCustomerID').val(complaint['complaint_customer'][0]
                        .customer_id);

                    $('#editComplaintHandlingDate').val(complaint[
                        'complaint_customer'][
                        0
                    ].complaint_handling_date);
                    $('#editComplaintHandlingTargetDate').val(complaint[
                            'complaint_customer'][0]
                        .complaint_handling_targetDate);
                    $('#editComplaintHandlingHandler').val(complaint[
                            'complaint_customer'][0]
                        .complaint_handling_handler);
                    $('#editComplaintHandlingStatus').val(complaint['complaint_customer'][0].complaint_handling_status);
                    $('#editComplaintHandlingDesc').val(complaint[
                        'complaint_customer'][
                        0
                    ].complaint_handling_desc);
                    $('#editComplaintHandlingFee').val(complaint[
                            'complaint_customer'][0]
                        .complaint_handling_fee);
                    $('#editComplaintType').val(complaint['complaint_customer'][0]
                        .complaint_type_id);
                    $('#editItemName').val(complaint['complaint_customer'][0]
                        .item_id);

                    $('#editComplaintHandlingModal').modal('show');

                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    });

    $('#deleteBtn').on('click', function () {
        var id = [];
        $('.checkitem:checked').each(function () {
            id.push($(this).val());
        });
        if (id.length == 0) {
            Swal.fire(
                '',
                'Please select at least 1 data!',
                'warning'
            )
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var strIds = id.join(",");

                    $.ajax({
                        url: "/cs/transaction/complaint-handling/delete",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: 'id=' + strIds,
                        success: function (data) {
                            if (data['status'] == true) {
                                $(".checkitem:checked").each(function () {
                                    $(this).parents("tr").remove();
                                });
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                }
            });
        };
    });



});
