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
            dataType: "json",
            success: function(json)
            {
                console.log(json);
                if(typeof json['error'] !== 'undefined') {
                    $("span.message").css("color", "#ffbbbb");
                    $("span.message").text(json['error']);
                } else if(typeof json['success'] !== 'undefined') {
                    $("span.message").text(json['success']);
                }
            }
        });
    });

    $(".IOHandlerAddressHelp").on("click", () => {
        alert("Enter the IP Address or hostname of the IO Handler.");
    });


    for(var address of settings['IOHandler']['address']) {
        createAddressRow(address);
    }


    $(".item .address").on("click", (event) => {
        var address = "http://" + $(event.target).text() + "/";
        var stages = ["r255g0b0", "r0g255b0", "r0g0b255"];
        var i = 0;
        for(i=0; i<stages.length; i++) {
            setTimeout($.ajax, i * 300, ({
                type: "GET",
                url: address,
                data: stages[i],
                complete: (data) => {}
            }));
        }
        
        setTimeout(resetAll, (stages.length * 300))
    });

});

function checkForEnterClick(event, button) {
    if (event.keyCode === 13) {
        button.click();
      }
}

function submitForm(element) {
    $(element.form).children().last().children().last().click();
    window.location.href = window.location.href;
}

function addIOHandler(itemElement) {
    var address = $(itemElement).children().first().children().first().val();
    if(address.trim() != "") {
        $.ajax({
            type: "GET",
            url: "./endpoint/set",
            data: "type=addIOHandlerAddress&address=" + address,
            dataType: "json",
            
            complete: function(json) {
                var exp = !("error" in json.responseJSON);
                console.log(exp);
                if(exp) {
                    $(itemElement).children().first().children().first().val("");
                    createAddressRow(address);
                    console.log(json.responseText);
                } else {
                    $(".IOHandlerbox").addClass("wrong");
                    setTimeout(() => {
                        $(".IOHandlerbox").removeClass("wrong");
                    }, 1000);
                }
            }
        });
    }
}

function removeIOHandler(itemElement) {
    var address = $(itemElement).children().first().text();
    if(!confirm("Are you sure you want to remove " + address + "?")){ return; }
    $.ajax({
        type: "GET",
        url: "./endpoint/set",
        data: "type=removeIOHandlerAddress&address=" + address,
        dataType: "json",
        
        complete: function(json) {
            $(itemElement).remove();
            console.log(json.responseText);
        }
    });
}


function getHSL() {
    var endpoint;
    var hsl;
    if(settings['forward']['enabled']) {
        endpoint = "http://" + settings['forward']['to'] + "/endpoint/get?data=hsl";
    } else {
        endpoint = "endpoint/get?data=hsl";
    }

    $.ajax({
        url: endpoint,
        async: false,
        dataType: "json",
        beforeSend: (request) => {
            request.withCredentials = true;
            request.setRequestHeader("Authorization", "Basic " + btoa('admin' + ":" + 'password'));
        },
        complete: (json) => {
            hsl = json.responseJSON;
        }
    });
    return hsl;
}

function resetAll() {
    var endpoint;

    if(settings['forward']['enabled']) {
        endpoint = "http://" + settings['forward']['to'] + "/endpoint/set";
    } else {
        endpoint = "endpoint/set";
    }

    var hsl = getHSL();
    var hue = hsl[0];
    var saturation = hsl[1];
    var luminance = hsl[2];
    var isOn = hsl[3];

    $.ajax({
        url: endpoint,
        async: false,
        dataType: "json",
        data: "type=hsl&isOn=" + isOn + "&h=" + hue + "&s=" + saturation + "&l=" + luminance,
        beforeSend: (request) => {
            request.withCredentials = true;
            request.setRequestHeader("Authorization", "Basic " + btoa('admin' + ":" + 'password'));
        },
        complete: () => {}
    });

}

function createAddressRow(address) {
    $(".IOHandlerbox .scrollbox").prepend(`<div class="item"><span class="address">` + address + `</span><i onclick="removeIOHandler(this.parentNode);" class="fas fa-times-circle"></i></div>`); 
}