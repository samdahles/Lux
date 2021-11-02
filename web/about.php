<!--
    Written by Sam Dahles <sam.dahles@falcongroup.ltd>. Published under CC-BY-NC-ND 4.0 <https://creativecommons.org/licenses/by-nc-nd/4.0/>.
-->
<?php include "./php/authentication.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux</title>  
        <?= file_get_contents("./php/templating/meta.php"); ?>
    </head>

    <body>
        <iframe id="dummyframe" title="dummyframe" name="dummyframe" height="0" width="0"></iframe>
        <?= file_get_contents("./php/templating/overlays.php"); ?>

        <div class="menu-container divider">
            <?php include "./php/templating/menu.php"; ?>
        </div>

        <div class="window divider">
            <a class="menubutton"><i class="fas fa-chevron-left"></i> Menu</a>

           <?= file_get_contents("./php/templating/about.php"); ?>
        </div>
    </body>

</html>