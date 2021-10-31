<!--
    Written by Sam Dahles <sam.dahles@falcongroup.ltd>. Published under CC-BY-NC-ND 4.0 <https://creativecommons.org/licenses/by-nc-nd/4.0/>.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux - Dashboard</title>  
        <?= file_get_contents("./php/templating/meta.php"); ?>
    </head>

    <body>
        <iframe id="dummyframe" title="dummyframe" name="dummyframe" height="0" width="0"></iframe>
        <?= file_get_contents("./php/templating/overlays.php"); ?>

        <div class="menu-container divider">
            <?= file_get_contents("./php/templating/menu.php?active=settings") ?>
        </div>

        <div class="window divider">
            <a class="menubutton"><i class="fas fa-chevron-left"></i> Menu</a>

           <?= file_get_contents("./php/templating/dashboard.php"); ?>
        </div>
    </body>

</html>