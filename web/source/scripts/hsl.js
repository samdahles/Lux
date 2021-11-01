var hue, saturation, luminance, isOn;

function updateHSLValues(){
    hue = $("input.hue").val();
    saturation = $("input.saturation").val();
    luminance = $("input.luminance").val();
    isOn = ($("input#lightControlIsOn").val() == "true");

    $("#hueDegrees").text(hue);
    $("#saturationPercentage").text(saturation);
    $("#luminosityPercentage").text(luminance);

    setCorrectLightbulbColor();
}


function setCorrectLightbulbColor() {
    if(isOn) {
        $(".lightbutton").css("background-color", "hsl(" + hue + "," + saturation + "%," + luminance + "%)");
    } else {
        $(".lightbutton").css("background-color", "#161618");
    }
}

function updateFromEndpoint() {
    $.getJSON("endpoint/get?data=hsl", function(data) {
        $("input.hue").val(data[0]);
        $("input.saturation").val(data[1]);
        $("input.luminance").val(data[2]);
        $("#lightControlIsOn").val(data[3]);
        updateHSLValues();
    });
}

function toggleLightPower() {
    if(isOn) {
        $("#lightControlIsOn").val("false");
        $("#lightControlForm").submit();
    } else {
        $("#lightControlIsOn").val("true");
        $("#lightControlForm").submit();
    }
    setCorrectLightbulbColor();
    updateHSLValues();
}

$(window).on("DOMContentLoaded", () => {
    setInterval(() => {
        if(!isRangeSliderSelected) {
            updateFromEndpoint();
        }
    }, 200);

    $(".lightbutton").on("click", () => {
        toggleLightPower();
    });

    updateFromEndpoint();
});


function changeInput(e, submit) {
    updateHSLValues();
    if(isOn){
        $(".lightbutton").css("background-color", "hsl(" + hue + "," + saturation + "%," + luminance + "%)");
    } else {
        $(".lightbutton").css("background-color", "#161618");
    }

    if(submit) {
        $("#lightControlForm").submit();
    }
}