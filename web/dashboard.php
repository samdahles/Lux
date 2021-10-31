<!--
    Written by Sam Dahles <sam.dahles@falcongroup.ltd>. Published under CC-BY-NC-ND 4.0 <https://creativecommons.org/licenses/by-nc-nd/4.0/>.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux - Dashboard</title>

        <link rel="icon" type="image/png" href="./favicon.png" />

        <meta name="charset" content="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
        <meta name="HandheldFriendly" content="true">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="black">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon" href="./favicon.png">
        <link rel="apple-touch-startup-image" href="./favicon.png">

        <script src="source/scripts/jquery.min.js"></script>
        <script src="source/scripts/menu.js"></script>
        <script src="source/scripts/swiped-events.js"></script>
        <script src="source/scripts/hsl.js"></script>

        <link rel="stylesheet" href="source/main.css" />
        <link rel="stylesheet" href="source/fonts/fontawesome/css/all.min.css" />

    </head>

    <body>
        <iframe id="dummyframe" title="dummyframe" name="dummyframe" height="0" width="0"></iframe>

        <div class="minheight-notifier overlaynotification">
            <div class="vacontainer">
                <div class="notificationbox">
                    <div class="icon"></div>
                    <span>Please rotate your device to use this application.</span>
                </div>
            </div>
        </div>

        <div class="menu-container divider">
            <?= file_get_contents("./php/menu.php") ?>
        </div>

        <div class="window divider">
            <a class="menubutton"><i class="fas fa-chevron-left"></i> Menu</a>
            <div class="window-content dashboard">
                <div class="lightbox">
                    <div class="lightbutton">
                        <div class="lightbulb"></div>
                    </div>
                </div>

                <div class="controlbox">
                    <!-- PHP TODO: Get values and set them in the slider -->
                    <form id="lightControlForm" action="./endpoint/set.php" target="dummyframe" method="GET">
                        <input type="hidden" name="type" value="hsl" />
                        <input type="hidden" id="lightControlIsOn" name="isOn" value="true" />
                        <div class="row">
                            <a>Hue (<span id="hueDegrees">0</span>&deg;)</a>
                            <input type="range" oninput="changeInput(event, false)" onchange="changeInput(event, true)" step="1" min="0" max="359" name="h" class="hue" />
                        </div>
                        <div class="row">
                            <a>Saturation (<span id="saturationPercentage">0</span>%)</a>
                            <input type="range" oninput="changeInput(event, false)" onchange="changeInput(event, true)" step="0" min="0" max="100" name="s" class="saturation" />
                        </div>
                        <div class="row">
                            <a>Luminosity (<span id="luminosityPercentage">0</span>%)</a>
                            <input type="range" oninput="changeInput(event, false)" onchange="changeInput(event, true)" step="0" min="0" max="100" name="l" class="luminance" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>