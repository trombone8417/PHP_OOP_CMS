<?php
session_start();
require_once 'auth.php';
$cuser = new Auth();
if(!isset($_SESSION['user'])){
    header('location:index.php');
    die;
}
$cemail = $_SESSION['user'];
$data = $cuser->currentUser($cemail);
?>