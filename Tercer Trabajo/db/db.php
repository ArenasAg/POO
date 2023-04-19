<?php
class db{
    function connect() {
        $pdo = new PDO('mysql:host=localhost;dbname=db_colegio', 'root', '');
        return $pdo;
    }
}
?>