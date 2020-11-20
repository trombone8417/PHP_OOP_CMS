<?php
session_start();
require_once 'auth.php';
$user = new Auth();
// 註冊Ajax
if (isset($_POST['action']) && $_POST['action'] == 'register') {
   $name = $user->test_input($_POST['name']);
   $email = $user->test_input($_POST['email']);
   $pass = $user->test_input($_POST['password']);
   $hpass = password_hash($pass, PASSWORD_DEFAULT);

   if ($user->user_exist($email)) {
      echo $user->showMessage('warning', 'Email 已經註冊過了');
   } else {

      if ($user->register($name, $email, $hpass)) {
         echo 'register';
         $_SESSION['user'] = $email;
      } else {
         echo $user->showMessage('danger', 'Something went wrong! try again later!');
      }
   }
}
// 登入Ajax
if (isset($_POST['action']) && $_POST['action'] == 'login') {
   $email = $user->test_input($_POST['email']);
   $pass = $user->test_input($_POST['password']);
   $loggedInUser = $user->login($email);
   if($loggedInUser!=null){
      if (password_verify($pass, $loggedInUser['password'])) {
         if (!empty($_POST['rem'])) {
            setcookie("email",$email,time()+(30*24*60*60),'/');
            setcookie("password",$pass,time()+(30*24*60*60),'/');
         }
         else{
            setcookie("email","",1,'/');
            setcookie("password","",1,'/');
         }
         echo 'login';
         $_SESSION['user'] = $email;
      }
      else{
         echo $user->showMessage('danger','密碼不正確');
      }
   }
   else{
      echo $user->showMessage('danger','找不到使用者');
   }
}

