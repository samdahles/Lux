$(window).on("DOMContentLoaded", () => {
    $(".codeentry").val("");
    $(".codeentry").on("keyup", (event) => {
        var latestKeypress = event.key;
        if(event.keyCode == 8) {
            latestKeypress = "BACKSPACE";
        }
        if(!event.key.match(/[0-9]/) && latestKeypress != "BACKSPACE") {
            return;
        }
        var input = event.currentTarget;
        var currentDataEntry = parseInt($(input)[0].classList[1].split("-").pop());
        var value = $(input).val();
        if(value.length == 0) {
            $(".entry-" + (currentDataEntry - 1)).focus();
        } else if (value.length == 1) {
            $(input).val(latestKeypress);
            $(".entry-" + (currentDataEntry + 1)).focus();
        } else {
            $(input).val(latestKeypress);
            $(".entry-" + (currentDataEntry + 1)).focus();
        }

        var currentCode = $(".code").val().split("");
        if(latestKeypress != "BACKSPACE") {
            currentCode[currentDataEntry - 1] = latestKeypress;
        }
        $(".code").val(currentCode.join(""));

        if(currentDataEntry == 4) {
            input.parentNode.submit();
        }
    });

});

function displayError(error) {
    $(".message").html(error);
}