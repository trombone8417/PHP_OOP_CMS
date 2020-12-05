<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $title = basename($_SERVER['PHP_SELF'], '.php');
        // explode() 函數把字符串分割為數組
        $title = explode('-',$title);
        // 首字符轉換為大寫(Dashboard)
        $title = ucfirst($title[1]);
        
    ?>
    <title><?= $title; ?> | Admin Panel</title>
    <!-- datatable css套件 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous" ></script>
    <!-- defer 也會非同步請求外部腳本 但是等待瀏覽器解析完才執行 (而且早於DOMContentLoaded -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        // 點選漢堡選單，開啟或關閉sidebar
        $("#open-nav").click(function(){
            $(".admin-nav").toggleClass('animate');
        });
    });
    </script>
    <style type="text/css" defer >
    .admin-nav{
        width: 220px;
        min-height: 100vh;
        overflow: hidden;
        background-color: #343a40;
        transition: 0.3s all ease-in-out;
    }
    .admin-link{
        background-color: #343a40;

    }
    .admin-link:hover, .nav-active{
        background-color: #212529;
        text-decoration: none;
    }
    .animate{
        width: 0;
        transition: 0.3s all ease-in-out;
    }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="admin-nav p-0">
            <h4 class="text-light text-center p-2">Admin Panel</h4>
            <div class="list-group list-group-flush">
                <a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"nav-active":"";?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Dashboard</a>
                <a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php')?"nav-active":"";?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Users</a>
                <a href="admin-notes.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notes.php')?"nav-active":"";?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp;Notes</a>
                <a href="admin-feedback.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php')?"nav-active":"";?>"><i class="fas fa-comment"></i>&nbsp;&nbsp;Feedback</a>
                <a href="admin-notification.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php')?"nav-active":"";?>"><i class="fas fa-bell"></i>&nbsp;&nbsp;Notification</a>
                <a href="admin-deleteduser.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php')?"nav-active":"";?>"><i class="fas fa-user-slash"></i>&nbsp;&nbsp;Deleted Users</a>
                <a href="" class="list-group-item text-light admin-link"><i class="fas fa-table"></i>&nbsp;&nbsp;Export Users</a>
                <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-id-card"></i>&nbsp;&nbsp;Profile</a>
                <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-cog"></i>&nbsp;&nbsp;Setting</a>
            </div>

        </div>
        <div class="col">
            <div class="row">
                <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">
                    <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars">
                    </i></h3></a>
                    <h4 class="text-light"><?= $title; ?></h4>
                    <a href="assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </div>
            </div>