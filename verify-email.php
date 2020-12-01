<?php

require_once 'assets/php/session.php';
// 若有Email
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    // 進行驗證
    $cuser->verify_email($email);
    header('location:profile.php');
    exit();
}
else{
    // 沒有的話，回到首頁
    header('location:index.php');
    exit();
}

?>