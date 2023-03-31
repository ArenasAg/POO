<?php 
if(isset($_GET['alerta1'])) {
  echo "<script>alert('No puede enviar este valor. Saldo insuficiente')</script>";
}elseif(isset($_GET['alerta2'])){
  echo "<script>alert('La segunda cuenta no exite')</script>";
}elseif(isset($_GET['alerta3'])){
  echo "<script>alert('La primera cuenta no exite')</script>";
}elseif(isset($_GET['alerta4'])){
  echo "<script>alert('Ninguna de las cuentas existe')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <section class="container">
      <header>Transpaso</header>
      <form action="./db/ClassPoo.php" method="post" class="form">
      <div class="input-box">
          <label>Mi cuenta</label>
          <input type="text" name="cuenta1" id="cuenta1" placeholder="Numero de cuenta" required />
        </div>

        <div class="input-box">
          <label>Enviar a</label>
          <input type="text" name="cuenta2" id="cuenta2" placeholder="Numero de cuenta" required />
        </div>

        <div class="input-box">
          <label>Saldo a enviar</label>
          <input type="number" name="saldo" id="saldo" placeholder="Ingrese su cedula" required />
        </div>
        <div class="input-box">
          <input type="submit" name="submit2" id="submit2"/>
        </div>
      </form>
      <a href="index.php" style="">Regresar</a>
    </section>
  </body>
</html>