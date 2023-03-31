<?php
class process{
    function insert($nombre, $apellido, $cedula, $cuenta, $saldo){
        include('connect_db.php');
        $result = mysqli_query($con,"Select * from users where cedula = $cedula");
        $result2 = mysqli_query($con,"Select * from users where cuenta = $cuenta");
        if(mysqli_num_rows($result) > 0){
            header('Location: ../index.php?alerta3=""');
        }else if(mysqli_num_rows($result2) > 0){
            header('Location: ../index.php?alerta4=""');
        }else{
            $result =  mysqli_query($con,"insert into users values(0,'$nombre', '$apellido', '$cedula', '$cuenta', '$saldo')");
            header('Location: ../index.php?alerta1=""');
        }
    }

    public function transac($cuenta1, $cuenta2, $saldo){
        include('connect_db.php');
        $result = mysqli_query($con,"Select * from users where cuenta = $cuenta1");
        $result2 = mysqli_query($con,"Select * from users where cuenta = $cuenta2");
        if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0) {
            $fila = mysqli_fetch_assoc($result);
            $valor1 = $fila['saldo'];
            $saldo1 = intVal($valor1);
            if($saldo1 >= $saldo){
                if($cuenta1 == $cuenta2){
                }else{
                    $rest = $saldo1 - $saldo;
                    $trans = mysqli_query($con,"Update users set saldo = $rest where cuenta = $cuenta1");
                    $fila2 = mysqli_fetch_assoc($result2);
                    $valor2 = $fila2['saldo'];
                    $saldo2 = intVal($valor2);
                    $sum = $saldo2 + $saldo;
                    $trans1 = mysqli_query($con,"Update users set saldo = $sum where cuenta = $cuenta2");
                    $querys = array(
                        'query1' => $trans,
                        'query2' => $trans1
                      );
                }
                header('Location: ../index.php?alerta2=""');
            }else{
                header('Location: ../formTrans.php?alerta1=""');
            }
         }else if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) == 0){
            header('Location: ../formTrans.php?alerta2=""');      
         }else if(mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) > 0){
            header('Location: ../formTrans.php?alerta3=""');
         }else {
            header('Location: ../formTrans.php?alerta4=""');
         }
    }
}

?>