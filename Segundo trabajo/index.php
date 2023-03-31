<?php 
if(isset($_GET['alerta1'])) {
  echo "<script>alert('Se han registrado los datos correctamente');</script>";
}elseif(isset($_GET['alerta2'])){
  echo "<script>alert('La transferencia ha sido exitosa');</script>";
}elseif(isset($_GET['alerta3'])){
  echo "<script>alert('Error al resgistrar. Este usuario ya exite');</script>";
}elseif(isset($_GET['alerta4'])){
  echo "<script>alert('Error al resgistrar. Esta cuenta ya existe');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <section class="container">
      <header>Usuarios</header>
      <form action="./db/ClassPoo.php" method="post" class="form">
        <div class="input-box">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Ingrese sus nombres" required />
        </div>

        <div class="input-box">
          <label>Apellido</label>
          <input type="text" name="apellido" id="apellido" placeholder="Ingrese sus apellidos" required />
        </div>

        <div class="input-box">
          <label>Cedula</label>
          <input type="number" name="cedula" id="cedula" placeholder="Ingrese su cedula" required />
        </div>

        <div class="input-box">
          <label>Numero de cuenta</label>
          <input type="number" name="cuenta" id="cuenta" placeholder="Ingrese su numero de cuenta" required />
        </div>

        <div class="input-box">
          <label>Saldo</label>
          <input type="number" name="saldo" id="saldo" placeholder="Ingrese su saldo" required />
        </div>
        <div class="input-box">
          <input type="submit" name="submit1" id="submit1"/>
        </div>
      </form>
      <a href="formTrans.php" style="">Transferir</a>
    </section>
  </body>
</html>
