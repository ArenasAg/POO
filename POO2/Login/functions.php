<?php

include_once('session.php');

if(isset($_POST["login"])){
    $session = new Session($_POST['username'], $_POST['password']);
    $session->login();
    header("Location: home.php");
}else if(isset($_POST["sign_off"])){
    setcookie("sign_off","true", time()+3600, "/");
    unset($session);
    header("Location: home.php");
}else{
    header("Location: home.php");
}

?>