<?php

class student{
    public $fname;
    public $fsurname;
    public $ssurname;
    public $birth;
    public $document;
    public $group;
    public $array;
    

    function setter($fname, $fsurname, $ssurname, $birth, $document, $group){
        $this->fname = $fname;
        $this->fsurname = $fsurname;
        $this->ssurname = $ssurname;
        $this->birth = $birth;
        $this->document = $document;
        $this->group = $group;
    }

    function array(){
        $this->array = [
                            'fname' => $this->fname,
                            'fsurname' => $this->fsurname,
                            'ssurname' => $this->ssurname,
                            'birth' => $this->birth,
                            'document' => $this->document,
                            'group' => $this->group
                        ];
    }

    function getter(){
        return $this->array;
    }
}

class responsible{
    public $Rfname;
    public $Rfsurname;
    public $Rssurname;
    public $Rdocument;
    public $phone;
    public $array;

    function setter($Rfname, $Rfsurname, $Rssurname, $Rdocument, $phone){
        $this->Rfname = $Rfname;
        $this->Rfsurname = $Rfsurname;
        $this->Rssurname = $Rssurname;
        $this->Rdocument = $Rdocument;
        $this->phone = $phone;
    }

    function array(){
        $this->array = [
                            'fname' => $this->Rfname,
                            'fsurname' => $this->Rfsurname,
                            'ssurname' => $this->Rssurname,
                            'document' => $this->Rdocument,
                            'phone' => $this->phone
                        ];
    }

    function getter(){
        return $this->array;
    }
}

class login{
    public $username;
    public $password;
    public $array;

    function setter($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    function array(){
        $this->array = [
                            'username' => $this->username,
                            'password' => $this->password,
                        ];
    }

    function getter(){
        return $this->array;
    }
}

include_once('../db/db.php');
class StudentResponsibleLogin {
    private $student;
    private $responsible;
    private $login;
    private $db;
    
    public function __construct($fname, $fsurname, $ssurname, $birth, $document, $group,
                                $Rfname, $Rfsurname, $Rssurname, $Rdocument, $phone,
                                $username, $password) {

        $this->db = new db;

        $this->student = new Student();
        $this->student->setter($fname, $fsurname, $ssurname, $birth, $document, $group);
        $this->student->array();
        
        $this->responsible = new Responsible();
        $this->responsible->setter($Rfname, $Rfsurname, $Rssurname, $Rdocument, $phone);
        $this->responsible->array();
        
        $this->login = new Login();
        $this->login->setter($username, $password);
        $this->login->array();
    }

    public function connect(){
        return $this->db->connect();
    }
    
    public function getStudent() {
        return $this->student->getter();
    }
    
    public function getResponsible() {
        return $this->responsible->getter();
    }
    
    public function getLogin() {
        return $this->login->getter();
    }
}

?>