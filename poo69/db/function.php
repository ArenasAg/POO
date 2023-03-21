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
                header("Location: ../home.php");
            }
        }
    }
?>