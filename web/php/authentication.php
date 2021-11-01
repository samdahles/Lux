<?php
session_start();

$loginJSON = json_decode(file_get_contents("./php/login.json"), true);
if($loginJSON['enabled']) {
    if(isset($_SESSION['pass_hash'])) {
        if($_SESSION['pass_hash'] != $loginJSON['password']) {
            session_destroy();
            header("Location: /?error=0");
        }
    } else {
        session_destroy();
        header("Location: /?error=1");
    }
}

?>