// Validation
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
        phone: {
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
        }
    },
    errorClass: "invalid",
    errorElement: "em"
});
