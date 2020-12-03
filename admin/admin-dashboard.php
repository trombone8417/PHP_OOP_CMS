<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
?>

<a href="assets/php/logout.php">Logout</a>