<?php
require_once 'assets/php/session.php';

?>
<!DOCTYPE html>
<html lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | Kuei</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css" />
  <style type="text/css">
    <!--
    @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap');
    -->
    *
    {
      font-family:
      'Maven Pro',
      sans-serif;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;Kuei</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php") ? "active" : ""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp; 首頁</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php") ? "active" : ""; ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;履歷</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "feedback.php") ? "active" : ""; ?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;回饋意見</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "notification.php") ? "active" : ""; ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;通知訊息&nbsp;<span id="checkNotification"></span></a>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
            <i class="fas fa-user-cog"></i>

            &nbsp;您好! <?= $cname; ?>
          </a>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item"><i class="fas fa-cog">&nbsp;設定</i></a>
            <a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt">&nbsp;登出</i></a>
          </div>
        </li>
      </ul>
    </div>
  </nav>