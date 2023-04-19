<?php
include_once('Class.php');
include_once('Crud.php');

if(isset($_POST['fname'])
        && isset($_POST['fsurname'])
        && isset($_POST['ssurname'])
        && isset($_POST['birth'])
        && isset($_POST['document'])
        && isset($_POST['group'])
        && isset($_POST['rfname'])
        && isset($_POST['rfsurname'])
        && isset($_POST['rssurname'])
        && isset($_POST['rdocument'])
        && isset($_POST['phone'])) {

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

}else if(isset($_POST['username'])
        && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $fname = '';
    $fsurname = '';
    $ssurname = '';
    $birth = '';
    $document = '';
    $group = '';
    $rfname = '';
    $rfsurname = '';
    $rssurname = '';
    $rdocument = '';
    $phone = '';
}else{
    $fname = '';
    $fsurname = '';
    $ssurname = '';
    $birth = '';
    $document = '';
    $group = '';
    $rfname = '';
    $rfsurname = '';
    $rssurname = '';
    $rdocument = '';
    $phone = '';
    $username = '';
    $password = '';
}

$StudentResponsibleLogin = new StudentResponsibleLogin($fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone, $username, $password);
$crud = new crud($fname, $fsurname, $ssurname, $birth, $document, $group, $rfname, $rfsurname, $rssurname, $rdocument, $phone, $username, $password);

if(isset($_POST['submitLogin'])){

    $crud->login($StudentResponsibleLogin);

}else if(isset($_POST['submitInsert'])){
    
    $crud->insert($StudentResponsibleLogin);

}else if(isset($_POST['submitSearch'])){
    $document = $_POST['docu'];
    $crud->searchByDocument($StudentResponsibleLogin, $document);

}else if(isset($_POST['submitUpdate'])){
    $id = $_POST['id'];
    $crud->update($StudentResponsibleLogin, $id);

}else if(isset($_POST['submitRead'])){
    $crud->Read($StudentResponsibleLogin);

}else if(isset($_POST['submitDelete'])){
    $id = $_POST['id'];
    $crud->Delete($StudentResponsibleLogin, $id);
}





?>