<?php 
session_start();

if(isset($_SESSION['admin']) || isset($_SESSION['normal'])) {
    unset($_SESSION['admin']);
    unset($_SESSION['normal']);
}
?>