<?php
session_start();

if(isset($_GET['error'])) {
    $errors = json_decode(file_get_contents("./php/error.json"));
    if(isset($errors[$_GET['error']])){
        echo $errors[$_GET['error']] . "<br />";
    }
}

?>
<form action="./login" method="POST">
    <input name="code" type="number" placeholder="Your access code" />
    <input type="submit" />
</form>