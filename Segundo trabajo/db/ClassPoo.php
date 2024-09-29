<?php
include_once('process.php');

$process = new process();
if(isset($_POST['submit1'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $cuenta = $_POST['cuenta'];
    $saldo = $_POST['saldo'];
    $insert = $process->insert($nombre, $apellido, $cedula, $cuenta, $saldo);
}else if(isset($_POST['submit2'])){
    $cuenta1 = $_POST['cuenta1'];
    $cuenta2 = $_POST['cuenta2'];
    $saldo = $_POST['saldo'];
    $tranpaso = $process->transac($cuenta1, $cuenta2, $saldo);
}
?>