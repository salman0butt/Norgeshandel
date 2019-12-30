
var input = document.querySelector("#phone"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Feil nummer", "Ugyldig landskode", "For kort", "For lenge", "Feil nummer"];
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
            document.querySelector("#valid-msg").innerHTML = "✓ gyldig";
        } else {
            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            document.querySelector("#valid-msg").innerHTML = "";
            errorMsg.classList.remove("hide");
        }
    }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);


