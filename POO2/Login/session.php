<?php

include_once('db.php');

class Session extends Db{
    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function __destruct(){
        echo 'Destruido';
    }

    public function login() {
        try{
            $db = $this->connect();
            $query = $db->prepare("SELECT * FROM user WHERE username = :username AND pass = :pass");
            $query->bindParam(":username", $this->username);
            $query->bindParam(":pass", $this->password);
            $query->execute();

            if($query->rowCount() == 0){
                setcookie("error","true", time()+3600, "/");
            }else{
                setcookie("login","true", time()+3600, "/");
            }
            header("Location: home.php");
        }catch(Exception $e){
            return "Ocurrió algo con la base de datos: " . $e->getMessage();
        }
    }
}