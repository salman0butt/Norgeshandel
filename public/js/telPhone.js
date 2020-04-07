
var input = document.querySelector("#phone"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = [
    "Ikke gyldig",
    "Ugyldig landskode",
    "For kort",
    "Ikke gyldig",
    "Ikke gyldig",
    "Ikke gyldig",
];
// initialise plugin
var iti = window.intlTelInput(input, {
    utilsScript: "public/js/utils.js?1562189064761",
    initialCountry:"no",
});

var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
    reset();
    if (input.value.trim()) {
        if (iti.isValidNumber()) {
            validMsg.classList.remove("hide");
            document.querySelector("#valid-msg").innerHTML = "✓ Gyldig";
        } else {
            input.classList.add("error");
            var errorCode = iti.getValidationError();
            if ($('.iti .error-msg') == "undefined") {
                errorMap[errorCode] = "test";
                 document.querySelector(".iti .error-msg").innerHTML = "";
            }
            errorMsg.innerHTML = errorMap[errorCode];
            document.querySelector("#valid-msg").innerHTML = "";
            errorMsg.classList.remove("hide");
        }
    }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);


