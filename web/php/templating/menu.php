<div class="menu">
    <div class="menu-title">
        <span class="title-icon">&nbsp;</span>
        <span class="title-name">Lux</span>
    </div>
    <div class="menu-items">
        <a class="menu-item menu-dashboard" href="./dashboard">
            <span class="menu-icon"><i class="fas fa-sliders-h"></i></span>
            <span class="menu-name">Dashboard</span>
        </a>
        <a class="menu-item menu-settings" href="./settings">
            <span class="menu-icon"><i class="fas fa-cogs"></i></span>
            <span class="menu-name">Settings</span>
        </a>
        <a class="menu-item menu-link" href="./link">
            <span class="menu-icon"><i class="fas fa-broadcast-tower"></i></span>
            <span class="menu-name">Link</span>
        </a>
        <a class="menu-item menu-updates" href="./updates">
            <span class="menu-icon"><i class="fas fa-sync-alt"></i> </span>
            <span class="menu-name">Updates</span>
        </a>
        <a class="menu-item menu-about" href="./about">
            <span class="menu-icon"><i class="fas fa-info-circle"></i></span>
            <span class="menu-name">About</span>
        </a>

        <?php
            $loginJSON = json_decode(file_get_contents("./php/login.json"), true);
            if($loginJSON['enabled'] == true) {
        ?>
        <a class="menu-item menu-exit" href="./logout">
            <span class="menu-icon"><i class="fas fa-sign-out-alt"></i></span>
            <span class="menu-name">Logout</span>
        </a>
        <?php
            }
        ?>

    </div>
</div>