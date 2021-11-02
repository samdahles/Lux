/// <reference path="jquery-3.6.0.js" />
var settings = [];

console.log(getSettings());

$(window).on("DOMContentLoaded", () => {
    settings = getSettings();
    console.log(settings);
    if(settings['isLoginEnabled']) {
        $(".enablePassword").prop("checked", true);
    }

    $("form").on("submit", () => {
        var url = new URL(window.location.href);
        url.searchParams.append("time", new Date().now());
        window.location = url;
    });
});