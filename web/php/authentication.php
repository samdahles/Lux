<?php
session_start();

$loginJSON = json_decode(file_get_contents("./php/login.json"), true);
if($loginJSON['enabled']) {
    if(isset($_SESSION['pass_hash'])) {
        if($_SESSION['pass_hash'] != $loginJSON['password']) {
            session_destroy();
            header("Location: /?error=0");
        } else {
            $loginJSON['lastLogin'] = time();
            file_put_contents("./php/login.json", json_encode($loginJSON));
        }
    } else {
        session_destroy();
        header("Location: /?error=1");
    }
} else {
    $_SESSION['pass_hash'] = $loginJSON['password'];
}
?>