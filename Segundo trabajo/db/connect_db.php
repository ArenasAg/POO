<?php
$con=mysqli_connect("localhost","root","","db_trabajo");

if (mysqli_connect_errno())
  {
  echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
  }
?>