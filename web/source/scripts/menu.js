var isRangeSliderSelected = false;
var settings;

function checkRangeSelect(e) {
    var nodearray = $("input[type=range]").toArray();
    for(var node of nodearray) {
        if(node == e.target){
            isRangeSliderSelected = true;
            break;
        }
        isRangeSliderSelected = false;
    }
}

function getSettings() {
    var settingsJson = [];
    $.ajax({
        url: "/endpoint/get?data=settings",
        async: false,
        dataType: "json",
        success: (json) => {
            settingsJson = json;
        }
    });
    return settingsJson;
}


$(window).on("load", () => {
    settings = getSettings();
    if(settings['isUpdate']) {
        $(".menu-updates").addClass("notification");
    }
    var filename = window.location.pathname.replace("/","").replace(".php", "").toLowerCase();

    if(filename == "dashboard") {
        $(".menu-dashboard").addClass("active");
    } else if(filename == "settings") {
        $(".menu-settings").addClass("active");
    } else if(filename == "link") {
        $(".menu-link").addClass("active");
    } else if(filename == "updates") {
        $(".menu-updates").addClass("active");
    } else if(filename == "about") {
        $(".menu-about").addClass("active");
    }

    $(document).on("touchstart", (e) => {
        checkRangeSelect(e);
    });

    $(document).on("touchend", (e) => {
        isRangeSliderSelected = false;
    });

    $(document).on("mousedown", (e) => {
        checkRangeSelect(e);
    });

    $(document).on("mouseup", (e) => {
        isRangeSliderSelected = false;
    });
    

    $(".window").on("swiped-up", (e) => {
        console.log("Swiped up");
    });


    $(".window").on("swiped-down", (e) => {
        console.log("Swiped down");
    });

    $(".divider").on("swiped-left", (e) => {
        if(!isRangeSliderSelected){
            $(".menu-container.divider").removeClass("show");
            $(".window.divider").removeClass("activesidebar");
            $(".window.divider > .menubutton").removeClass("rotated");
        }
    });


    $(".window.divider").on("swiped-right", (e) => {
        if(!isRangeSliderSelected){
            $(".menu-container.divider").addClass("show");
            $(".window.divider").addClass("activesidebar");
            $(".window.divider > .menubutton").addClass("rotated");
        }
    });

    $(".menubutton").on("click", (e) => {
        $(".menu-container.divider").toggleClass("show");
        $(".window.divider").toggleClass("activesidebar");
        $(".window.divider > .menubutton").toggleClass("rotated");
    });
});




