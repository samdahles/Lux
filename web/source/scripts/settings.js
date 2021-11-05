/// <reference path="jquery-3.6.0.js" />
var settings = [];

$(window).on("DOMContentLoaded", () => {
    settings = getSettings();
    if(settings['isLoginEnabled']) {
        $(".enablePassword").prop("checked", true);
    }

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

    $($(".codeentry")[0].form).on("submit", (event) => {
        event.preventDefault();
        var question = confirm("Are you sure you want to set your password to " + $(".code.entry-A").val() + "?");
        if(!question) {
            return;
        }

        var form = event.currentTarget;
        var url = $(form).attr("action");

        $.ajax({
            type: "GET",
            url: url,
            data: $(form).serialize(),
            success: function(data)
            {
                console.log(data);
                try {
                    json = JSON.parse(data);
                } catch (error) {
                    json = [];
                    console.log(error);
                }
                if(typeof json['error'] !== 'undefined') {
                    $("span.message").css("color", "#ffbbbb");
                    $("span.message").text(json['error']);
                } else if(typeof json['success'] !== 'undefined') {
                    $("span.message").text(json['success']);
                }
            }
        });
    });

});

function submitForm(element) {
    $(element.form).children().last().children().last().click();
    window.location.href = window.location.href;
}