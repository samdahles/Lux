<div class="window-content broadcast">
    <div class="support">

        <?php if(isset($_SERVER['HTTPS'])) { ?>
        <div>
            <p>Sync your screen to the lights</p>
        </div>
        <div>
            <button class="capture-button" type="button">Start capture</button>
        </div>
        <div class="averagecolor">
            <video class="broadcast-dump" autoplay></video>
            <span class="currentcolor"></span>
            <div class="disablednotice">
                <div>
                    <p>Your screen is still broadcasting!</p>
                    <p>Click the screen to view the video.</p>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div>
                <p>This page requires HTTPS to work. Please visit this page again using <a href="https://<?= $_SERVER['SERVER_ADDR'] ?>/broadcast">this link</a>.</p>
            </div>
        <?php } ?>

    </div>    
</div>