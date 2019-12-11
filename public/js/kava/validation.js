// VALIDATION----------------------------------------------------------
$('.validate-this').validate({
    rules: {
        brand: {
            required: true,
            minlength: 3,
            maxlength: 32
        },
        outlet_name: {
            required: true,
            minlength: 3,
            maxlength: 32
        },
        group_name: {
            required: true,
            minlength: 2,
            maxlength: 32
        },
        customer_name: {
            required: true,
            minlength: 3,
        },
        customer_licensePlate: {
            required: true,
            minlength: 3
        },
        customer_phone: {
            required: true,
            minlength: 7,
            maxlength: 15,
            number: true
        },
        email: {
            required: true,
            minlength: 3,
            email: true
        },
        address: {
            required: true,
            minlength: 3,
        },
        agree: {
            required: true,
        },
        complaint_handling_date: {
            required: true,
        },
        complaint_handling_targetDate: {
            required: true,
        },
        complaint_handling_handler: {
            required: true,
            minlength: 3,
        },
        complaint_handling_status: {
            required: true,
        },
        complaint_handling_desc: {
            required: true,
        },
        complaint_handling_fee: {
            required: true,
        },
        complaint_type_id: {
            required: true,
        },
        vehicle: {
            required: true,
        },
        license_plate: {
            required: true,
        },
    },
    errorClass: "invalid",
    errorElement: "em"
});
// ---------------------------------------------------------------------

// NUMERIC ONLY INPUT---------------------------------------------------
(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop",
            function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
    };
}(jQuery))
$(".numeric-input").inputFilter(function (value) {
    return /^\d*$/.test(value);
});
// ---------------------------------------------------------------------
