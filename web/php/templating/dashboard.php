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