<?php

include_once('persona.php');

$persona = new Persona("Hola", "K ase", 13);

echo $persona->saludar();

unset($persona);