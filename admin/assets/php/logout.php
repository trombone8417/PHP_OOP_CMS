<?php 
    session_start();
    // 清空username SESSION
    unset($_SESSION['username']);
    // 回到Admin首頁
    header('location:../../index.php');
?>