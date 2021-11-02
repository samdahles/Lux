<?php
session_start();

if(!isset($_POST['code'])) {header("Location: /?error=3");}
$_SESSION['pass_hash'] = hash("sha256", $_POST['code']);
header("Location: /dashboard");

?>