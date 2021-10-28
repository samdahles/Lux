<!--
    Written by Sam Dahles <sam.dahles@falcongroup.ltd>. Published under CC-BY-NC-ND 4.0 <https://creativecommons.org/licenses/by-nc-nd/4.0/>.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux - Dashboard</title>

        <link rel="icon" type="image/png" href="./favicon.png" />

        <meta name="charset" content="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <script src="source/scripts/jquery.min.js"></script>
        
        <link rel="stylesheet" href="source/main.css" />
        <link rel="stylesheet" href="source/fonts/fontawesome/css/all.min.css" />

    </head>

    <body>
        <div class="menu-container divider">
            <?= file_get_contents("./php/menu.php") ?>
        </div>

        <div class="window divider">
            <div class="window-content dashboard">
                <div class="lightbox">
                    
                </div>
            </div>
        </div>
    </body>
</html>