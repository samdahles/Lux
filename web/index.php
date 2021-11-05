<?php
session_start();

$loginJSON = json_decode(file_get_contents("./php/login.json"), true);
if($loginJSON['enabled']) {
    if(isset($_SESSION['pass_hash'])) {
        if($_SESSION['pass_hash'] != $loginJSON['password']) {
            session_destroy();
        } else {
            header("Location: ./dashboard");
        }
    }
} else {
    header("Location: ./dashboard");
}


if(isset($_GET['error'])) {
    $errors = json_decode(file_get_contents("./php/error.json"));
    if(isset($errors[$_GET['error']])){
       $error = $errors[$_GET['error']];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lux</title>  
        <?= file_get_contents("./php/templating/meta.php"); ?>
        <script src="./source/scripts/login.js"></script>
        <link rel="stylesheet" href="./source/login.css" />
        <?php
        if(isset($error)){
        ?>
        <script>
            $(window).on("DOMContentLoaded", () => {
                displayError("<?= htmlspecialchars($error) ?>");
            });
        </script>
        <?php
        }
        ?>
    </head>
    <body>
        <div class="vacontainer">
            <span class="message">Please enter your access code.</span>
            <form action="./login" method="POST" target="_self">
                <input type="hidden" class="code" name="code" value="0000" />
                <input type="number" maxlength="1" autofocus min="0" class="codeentry entry-1" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-2" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-3" placeholder="_" />
                <input type="number" maxlength="1" min="0" class="codeentry entry-4" placeholder="_" />
            </form>
        </div>
    </body>
</html>