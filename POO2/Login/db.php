<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_user");

class Db{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    function connect() {
        try{

            $base_de_datos = new PDO('mysql:host='. $this->host .';dbname=' . $this->dbname, $this->user, $this->pass);
            if ($base_de_datos) {
                return $base_de_datos;
            }
        }catch(Exception $e){
            return "Ocurrió algo con la base de datos: " . $e->getMessage();
        }
    }
}
?>