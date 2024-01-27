//registration.js
$(document).ready(function () {
    console.log("Document ready!");

    // Function to check if passwords match and enable/disable the button
    function checkPasswordMatch() {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirmation').val();

        // Check if passwords match
        if (password !== confirmPassword || password === '') {
            $('#password_confirmation').css('border-color', 'red');
            $('#signup-btn').prop('disabled', true);
        } else {
            $('#password_confirmation').css('border-color', 'green');
            $('#signup-btn').prop('disabled', false);
        }
    }

    // Function to toggle password visibility based on checkbox state
    function togglePasswordVisibility() {
        var isCheckboxChecked = $('#checkbox').prop('checked');
        var passwordInputs = $('#password, #password_confirmation');

        // Toggle the type attribute for password inputs
        passwordInputs.attr('type', isCheckboxChecked ? 'text' : 'password');
    }

    // Attach the function to the change event of the checkbox
    $('#checkbox').on('change', togglePasswordVisibility);
});
