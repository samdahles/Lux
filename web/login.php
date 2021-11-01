<?php
session_start();

if(!isset($_POST['code'])) {header("Location: /");}
$_SESSION['pass_hash'] = hash("sha256", $_POST['code']);
header("Location: /dashboard");

?>