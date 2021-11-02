$(window).on("DOMContentLoaded", () => {
    $(".codeentry").val("");
    $(".codeentry").on("input", (event) => {
        var input = event.currentTarget;
        var currentDataEntry = parseInt($(input)[0].classList[1].split("-").pop());
        var value = $(input).val();
        if(value.length == 0) {
            $(".entry-" + (currentDataEntry - 1)).focus();
        } else if (value.length == 1) {
            $(".entry-" + (currentDataEntry + 1)).focus();
        } else {
            $(input).val(value[0]);
            $(".entry-" + (currentDataEntry + 1)).focus();
        }

        var currentCode = $(".code").val().split("");
        currentCode[currentDataEntry - 1] = value;
        $(".code").val(currentCode.join(""));

        if(currentDataEntry == 4) {
            input.parentNode.submit();
        }
    });

});

function displayError(error) {
    $(".message").html(error);
}