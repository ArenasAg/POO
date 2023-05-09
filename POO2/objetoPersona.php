<?php

include_once('Persona.php');

$persona = new Persona("Hola", "K ase", 13);

echo $persona->saludar();

unset($persona);