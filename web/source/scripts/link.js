var settings = [];

$(window).on("DOMContentLoaded", () => {
    settings = getSettings();
    if(settings['forward']['enabled']) {
        $(".enableForward").prop("checked", true);
    }

    $(".forwardingAddress").val(settings['forward']['to']);

    let forwardCode = settings['forward']['code'];

    $(".code.entry-A").val(forwardCode);
    for(i=0; i<forwardCode.split("").length; i++) {
        $(".codeentry.entry-A-" + (i + 1)).attr("placeholder", forwardCode.split("")[i]);
    }

    $(".submitAllFormsButton").on("click", () => {
        $("form").submit();
        location.reload();
    });

    $(".forwardingAddressHelp").on("click", () => {
        alert(`Please enter the IP address or domain name, without 'http://' or 'https://' and do not end with a trailing slash.`);
    });

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
        var currentDataEntry = parseInt($(input)[0].classList[1].split("-")[2]);
        var currentGroup = $(input)[0].classList[1].split("-")[1];
        var correspondingCodeInput = $(".code.entry-" + currentGroup);
        var value = $(input).val();
        if(value.length == 0 || latestKeypress == "BACKSPACE") {
            $(".entry-" + currentGroup + "-" + (currentDataEntry - 1)).focus();
        } else if (value.length == 1) {
            $(input).val(latestKeypress);
            $(".entry-" + currentGroup + "-" + (currentDataEntry + 1)).focus();
        } else {
            $(input).val(latestKeypress);
            $(".entry-" + currentGroup + "-" + (currentDataEntry + 1)).focus();
        }

        var currentCode = correspondingCodeInput.val().split("");
        if(latestKeypress != "BACKSPACE") {
            currentCode[currentDataEntry - 1] = latestKeypress;
        }
        correspondingCodeInput.val(currentCode.join(""));
    });

});