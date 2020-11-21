<?php
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
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
// 忘記密碼Ajax request
if(isset($_POST['action'])&&$_POST['action']=='forgot'){
   $email = $user->test_input($_POST['email']);
   $user_found = $user->currentUser($email);
   if ($user_found != null) {
      $token = uniqid();
      $token = str_shuffle($token);
      $user->forgot_password($token,$email);
      try{
         // 忘記密碼自動發信
         $mail->Charset='UTF-8';
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth = true;
         // 寄件者帳號
         $mail->Username = Database::USERNAME;
         // 寄件者帳號的密碼
         $mail->Password = Database::PASSWORD;
         $mail->SMTPSecure= PHPMailer::ENCRYPTION_STARTTLS;
         $mail->Port = 587;
         $mail->setFrom(Database::USERNAME, 'PHP_OOP_CMS');
         $mail->addAddress($email);
         $mail->isHTML(true);
         $mail->Subject =" =?utf-8?B?" . base64_encode("忘記密碼") . "?=";
         $mail->Body = '<h3>請點選連結重置密碼.<br><a href="http://127.0.0.1/PHP_OOP_CMS/reset-pass.php?email='.$email.'&token='.$token.'">http://127.0.0.1/PHP_OOP_CMS/reset-pass.php?email='.$email.'&token='.$token.'</a><br>敬祝順心<br>系統自動發信</h3>';
         $mail->send();
         echo $user->showMessage('success', '請到email認證重置密碼');
      }
      catch(Exception $e){
         echo $user->showMessage('danger','出現錯誤，請再重試一次');
      }
   }else{
      echo $user->showMessage('info', '該e-mail不存在!');
   }
}

?>
