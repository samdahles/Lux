<?php include "./php/authentication.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux</title>  
        <?= file_get_contents("./php/templating/meta.php"); ?>
        <script src="source/scripts/broadcast.js"></script>
        <link rel="stylesheet" href="source/settings.css" />
        <link rel="stylesheet" href="source/broadcast.css" />
    </head>

    <body>
        <iframe id="dummyframe" title="dummyframe" name="dummyframe" height="0" width="0"></iframe>
        <?= file_get_contents("./php/templating/overlays.php"); ?>

        <div class="menu-container divider">
            <?php include "./php/templating/menu.php"; ?>
        </div>

        <div class="window divider">
            <a class="menubutton"><i class="fas fa-chevron-left"></i> Menu</a>

           <?php include "./php/templating/broadcast.php" ?>
        </div>
    </body>

</html>