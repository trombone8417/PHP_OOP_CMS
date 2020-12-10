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
   // 輸入密碼
   $pass = $user->test_input($_POST['password']);
   // 密碼加密
   $hpass = password_hash($pass, PASSWORD_DEFAULT);
   // 察看使用者是否被註冊過
   if ($user->user_exist($email)) {
      // 已註冊過，發出警告
      echo $user->showMessage('warning', 'Email 已經註冊過了');
   } else {
      // 若未註冊過，sql新增使用者資料
      if ($user->register($name, $email, $hpass)) {
         echo 'register';
         $_SESSION['user'] = $email;
         $mail->Charset = 'UTF-8';
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth = true;
         // 寄件者帳號
         $mail->Username = Database::USERNAME;
         // 寄件者帳號的密碼
         $mail->Password = Database::PASSWORD;
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
         $mail->Port = 587;
         // 寄件者名稱
         $mail->setFrom(Database::USERNAME, 'PHP_OOP_CMS');
         $mail->addAddress($email);
         $mail->isHTML(true);
         // 標題亂碼處理方式
         $mail->Subject = " =?utf-8?B?" . base64_encode("Email驗證") . "?=";
         // 信件內容
         $mail->Body = '<h3>請點選連結驗證信箱.<br><a href="http://127.0.0.1/PHP_OOP_CMS/verify-email.php?email=' . $email . '">http://127.0.0.1/PHP_OOP_CMS/verify-email.php?email=' . $email . '</a><br>敬祝順心<br>系統自動發信</h3>';
         $mail->send();
      } else {
         // 其他錯誤
         echo $user->showMessage('danger', 'Something went wrong! try again later!');
      }
   }
}
// 登入Ajax
if (isset($_POST['action']) && $_POST['action'] == 'login') {
   $email = $user->test_input($_POST['email']);
   $pass = $user->test_input($_POST['password']);
   // 使用者登入，sql撈資料
   $loggedInUser = $user->login($email);
   // 若有資料的話
   if($loggedInUser!=null){
      // 驗證密碼
      if (password_verify($pass, $loggedInUser['password'])) {
         // 若使用者勾選記住密碼
         if (!empty($_POST['rem'])) {
            // cookie記住資料，30天過期
            setcookie("email",$email,time()+(30*24*60*60),'/');
            setcookie("password",$pass,time()+(30*24*60*60),'/');
         }
         else{
            // 若未勾選，清空cookie
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
   // 使用者是否存在
   $user_found = $user->currentUser($email);
   if ($user_found != null) {
      // 函式生成唯一ID
      $token = uniqid();
      // 隨機打亂字符串中的所有字符
      $token = str_shuffle($token);
      // sql重置密碼插入token
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
         // 寄件者名稱
         $mail->setFrom(Database::USERNAME, 'PHP_OOP_CMS');
         $mail->addAddress($email);
         $mail->isHTML(true);
         // 標題亂碼處理方式
         $mail->Subject =" =?utf-8?B?" . base64_encode("忘記密碼") . "?=";
         // 信件內容
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
// 確認使用者是否刪除帳號，若刪除帳號的話，導回登入頁面
if (isset($_POST['action']) && $_POST['action'] == 'checkUser') {
   if (!$user->currentUser($_SESSION['user'])) {
       echo 'bye';
       unset($_SESSION['user']);
   }
}
