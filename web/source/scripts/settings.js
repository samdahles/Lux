var settings = [];


$(window).on("DOMContentLoaded", () => {
    settings = getSettings();

    if(!settings['isUpdate']) {
        $(".window-content.updates").addClass("noupdate");
    }

    $(".latestVersion").text(settings['latest']);
    $(".buttonbox .latestVersion").text(settings['latest'] + ".rar");

    var href = "https://github.com/samdahles/Lux/releases/download/" + settings['latest'] + "/" + settings['latest'] + ".rar";
    $(".buttonbox a").attr("href", href);
    $(".currentVersion").text(settings['build']);
});