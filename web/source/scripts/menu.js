var isRangeSliderSelected = false;

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


$(window).on("load", () => {

    $(document).on('touchmove', (e) => {
        if(e.scale !== 1) { e.preventDefault(); }
    });

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




