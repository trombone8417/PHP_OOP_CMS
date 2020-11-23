<?php
    session_start();
    // unset 用來移除變數的值
    unset($_SESSION['user']);
    header('location:../../index.php');
?>