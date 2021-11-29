let video, backgroundInterval;
var isVideoEnabled = false;
var rgb = [0, 0, 0];
var prevRGB = [0, 0, 0];
var isBusy = false;
let addresses;
var difference = function (a, b) { return Math.abs(a - b); }
var displayMediaOptions = {
    video: true,
    audio: false
};

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


$(window).on("DOMContentLoaded", () => {

    addresses = getSettings()['IOHandler']['address'];
    backgroundInterval = setInterval(() => {
        if(isVideoEnabled) {
            setRGB();
            $(".averagecolor").css("background-color", 'rgb('+rgb[0]+','+rgb[1]+','+rgb[2]+')');
            if(document.hasFocus()){
                $(".currentcolor").css("display", "block");
                $(".currentcolor").text("Current color: " + rgbToHex(rgb[0], rgb[1], rgb[2]));
            } else {
                $(".currentcolor").css("display", "none");
            }
        }
    }, 10);

    $(window).on("blur", () => {
        if(isVideoEnabled) {
            hideVideo();
        }
    });

    $(window).on("focus", () => {
        if(isVideoEnabled) {
            showVideo();
        }
    })

    video = $(".broadcast-dump")[0];
    $(".capture-button").on("click", function () {
        if($(this).hasClass("clicked")) {
            disableCapture(this);
        } else {
            enableCapture(this);
        }
    });
});

async function sendAjax(url) {
    try {
        let request = $.ajax({
            url: url,
            method: "get"
        });
        return request;
    } catch(err) {
        console.error(err);
    }

}

async function xhrInterval() {
    if(isVideoEnabled) {
        setRGB();
        // prevRGB = rgb;
        // let interpolated = generateGradient(prevRGB, rgb, 10);

        for(let address of addresses) {
            // for(let entry of interpolated) {
            //    let url = "http://" + address + "?" + "r" + entry[0] + "g" + entry[1] + "b" + entry[2];
            //    await sendAjax(url);
            // }
            let url = btoa("http://" + address + "?" + "r" + rgb[0] + "g" + rgb[1] + "b" + rgb[2]);
            await sendAjax("/endpoint/http?url=" + url);
        }
        xhrInterval();
    }
}

function setRGB() {
    let dict_rgb = getAverageRGB($(".broadcast-dump")[0]);
    rgb = [dict_rgb.r, dict_rgb.g, dict_rgb.b];
}

async function enableCapture(el) {
    console.log("Attempting capture");
    let captureSucceeded = await startCapture();
    if(!captureSucceeded) {
        console.warn("Capture failed");
    } else {
        showVideo();
        $(el).text("Stop capture");
        $(el).addClass("clicked");
        isVideoEnabled = true;
        xhrInterval();
    }
}

async function disableCapture(el) {
    console.log("Stopping capture");
    stopCapture();
    disableVideo();
    $(el).text("Start capture");
    $(el).removeClass("clicked");
    isVideoEnabled = false;
}


async function startCapture() {

    try {
       video.srcObject = await navigator.mediaDevices.getDisplayMedia(displayMediaOptions);
       return true;
    } catch(err) {
        console.error("Error: " + err);
        return false;
    }
}

function disableVideo() {
    $(video).css("display", "none");
    $(".averagecolor").css("display", "none");
    $(".disablednotice").css("display", "none");
}

function hideVideo() {
    $(video).css("display", "block");
    $(".averagecolor").css("display", "block");
    $(".disablednotice").css("display", "flex");
}

function showVideo() {
    $(video).css("display", "block");
    $(".averagecolor").css("display", "block");
    $(".disablednotice").css("display", "none");
}

function stopCapture(evt) {
  let tracks = video.srcObject.getTracks();
  tracks.forEach(track => track.stop());
  video.srcObject = null;
}


function getAverageRGB(imgEl) {
    var blockSize = 5,
        defaultRGB = { r: 0, g: 0, b: 0 },
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        rgb = { r: 0, g: 0, b: 0 },
        count = 0;

    if (!context) {
        return defaultRGB;
    }

    height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
    width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

    context.drawImage(imgEl, 0, 0);
    context.filter = "contrast(150%)";
    try {
        data = context.getImageData(0, 0, width, height);
    } catch (e) {
        console.error(e);
        return defaultRGB;
    }

    length = data.data.length;

    while ((i += blockSize * 4) < length) {
        ++count;
        rgb.r += data.data[i];
        rgb.g += data.data[i + 1];
        rgb.b += data.data[i + 2];
    }

    rgb.r = ~~(rgb.r / count);
    rgb.g = ~~(rgb.g / count);
    rgb.b = ~~(rgb.b / count);

    return rgb;
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

function hexToRGB(hex) {
    var color = [];
    color[0] = parseInt((trim(hex)).substring(0, 2), 16);
    color[1] = parseInt((trim(hex)).substring(2, 4), 16);
    color[2] = parseInt((trim(hex)).substring(4, 6), 16);
    return color;
}

function trim(s) { return (s.charAt(0) == '#') ? s.substring(1, 7) : s }

function generateGradient(rgbStart, rgbEnd, entries) {
    var alpha = 0.0;
    var saida = [];

    for (i = 0; i < entries; i++) {
        var c = [];
        alpha += (1.0 / entries);
        c[0] = Math.floor(rgbStart[0] * alpha + (1 - alpha) * rgbEnd[0]);
        c[1] = Math.floor(rgbStart[1] * alpha + (1 - alpha) * rgbEnd[1]);
        c[2] = Math.floor(rgbStart[2] * alpha + (1 - alpha) * rgbEnd[2]);
        saida.push([c[0], c[1], c[2]]);
    }

    return saida;
}