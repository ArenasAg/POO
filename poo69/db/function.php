<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>
</html>
<?php

    if(isset($_POST['submit'])){

        if(isset($_POST['user'])){
            include_once('ClassPoo.php');
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $loguin = new Loguin();
            $loguin -> entrarDatos($user, $pass);
            $loguin->loguear();
            $response = $loguin->Loguear();

            if($response === 'true'){
                header("Location: ../home.php");
            }else{
                 header("Location: ../index.php");
            }
        }
    }
?>