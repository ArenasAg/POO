<?php
include_once('Crud.php');


$crud = new Crud();

if(isset($_POST['submitLogin'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $crud->login($username, $password);

}else if(isset($_POST['submitInsert'])){

    $fname = $_POST['fname'];
    $fsurname = $_POST['fsurname'];
    $ssurname = $_POST['ssurname'];
    $birth = $_POST['birth'];
    $document = $_POST['document'];
    $group = $_POST['group'];
    $rfname = $_POST['rfname'];
    $rfsurname = $_POST['rfsurname'];
    $rssurname = $_POST['rssurname'];
    $rdocument = $_POST['rdocument'];
    $phone = $_POST['phone'];
    
    $crud->insert($fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone);

}else if(isset($_POST['submitSearch'])){
    $document = $_POST['docu'];
    $crud->searchByDocument($document);

}else if(isset($_POST['submitUpdate'])){

    $fname = $_POST['fname'];
    $fsurname = $_POST['fsurname'];
    $ssurname = $_POST['ssurname'];
    $birth = $_POST['birth'];
    $document = $_POST['document'];
    $group = $_POST['group'];
    $rfname = $_POST['rfname'];
    $rfsurname = $_POST['rfsurname'];
    $rssurname = $_POST['rssurname'];
    $rdocument = $_POST['rdocument'];
    $phone = $_POST['phone'];
    $id = $_POST['id'];

    $crud->update($id, $fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone);

}else if(isset($_POST['submitRead'])){
    $crud->Read();

}else if(isset($_POST['submitDelete'])){
    $id = $_POST['id'];
    $crud->Delete($id);
}





?>