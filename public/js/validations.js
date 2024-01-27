window.onload = function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    if(document.getElementById("date-of-birth")) {
        document.getElementById("date-of-birth").setAttribute("max", today);
        document.getElementById("date-of-birth").value = "2000-01-01";
    }
}

function onlyNumbersCommaDot(elem) {
    elem.value = elem.value.replace(/[^0-9.,]/g, '');
}


function onlyLettersAndSpaces(event) {
    var regex = /^[a-zA-Z\s\.\-ñÑ]*$/;
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}

function removeExtraSpaces(input) {
    var inputField = input;
    inputField.value = inputField.value.trim().replace(/\s{2,}/g, ' '); // Replace two or more spaces with one
}

function handlePaste(event) {
    var pastedText = (event.clipboardData || window.clipboardData).getData('text');
    if (!/^[a-zA-Z\s\.\-ñÑ]*$/.test(pastedText)) {
        event.preventDefault();
    }
}

function validateContact(event) {
    var regex = /^09\d{9}$/; // Matches "09" followed by 9 digits
    var input = event.target.value;

    if (!regex.test(input) && input != "") {
        alert("Invalid contact number format. Please use 09#########.");
        event.target.value = ""; // Clear the input
    }
}
