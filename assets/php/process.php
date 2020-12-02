<?php
require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
// Handle Add New Note Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
    $title = $cuser->test_input($_POST['title']);
    $note = $cuser->test_input($_POST['note']);
    // 新增Note
    $cuser->add_new_note($cid,$title,$note);
    // 新增通知
    $cuser->notification($cid,'admin','Note added');
}
// 列出所有使用者的Note
if (isset($_POST['action']) && $_POST['action'] == 'display_notes') {
    $output = '';
    $notes = $cuser->get_notes($cid);
    // 若有資料的話
    if ($notes) {
        // table-sm datatable間距變小
        $output .='<table class="table table-striped table-sm text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Note</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
        // 列出資料
        foreach ($notes as $row) {
            $output .= '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.substr($row['note'],0,75).'...</td>
            <td>

              <a href="#" id="'.$row['id'].'" title="View Details" class="text-success infoBtn">
                <i class="fas fa-info-circle fa-lg"></i>
              </a>&nbsp;
              <a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn">
                <i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i>
              </a>&nbsp;
              <a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn">
                <i class="fas fa-trash-alt fa-lg"></i>
              </a>
            </td>
          </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }
    else{
        // 若沒有資料的話，顯示沒有資料
        echo '<h3 class="text-center text-secondary">:( 沒有資料</h3>';
    }

}
// Handle Edit Note of An User Ajax Request
if(isset($_POST['edit_id'])){
  $id = $_POST['edit_id'];
  $row = $cuser->edit_note($id);
  echo json_encode($row);
}

// Handle Update Note of An User Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
  $id = $cuser->test_input(($_POST['id']));
  $title = $cuser->test_input(($_POST['title']));
  $note = $cuser->test_input(($_POST['note']));

  $cuser->update_note($id, $title, $note);
  // 新增通知
  $cuser->notification($cid,'admin','Note updated');
}
// 刪除Note
if (isset($_POST['del_id'])) {
  $id = $_POST['del_id'];
  $cuser->delete_note($id);
  // 新增通知
  $cuser->notification($cid,'admin','Note deleted');
}
// 編輯Note
if (isset($_POST['info_id'])) {
  $id = $_POST['info_id'];
  $row = $cuser->edit_note($id);
  echo json_encode($row);
}
// 編輯履歷
if (isset($_FILES['image'])) {
 $name = $cuser->test_input($_POST['name']);
 $gender = $cuser->test_input($_POST['gender']);
 $dob = $cuser->test_input($_POST['dob']);
 $phone = $cuser->test_input($_POST['phone']);

 $oldImage = $_POST['oldimage'];
//  圖片上傳地方
 $folder = 'uploads/';
 if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
   $newImage = $folder.$_FILES['image']['name'];
   move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
   if ($oldImage != null) {
     unlink($oldImage);
   }
 }
 else{
   $newImage = $oldImage;
 }
 $cuser->update_profile($name,$gender,$dob,$phone,$newImage, $cid);
 // 新增通知
 $cuser->notification($cid,'admin','Profile updated');
}
// 更換密碼(履歷)
if(isset($_POST['action']) && $_POST['action'] == 'change_pass'){
  // 舊密碼
  $currentPass = $_POST['curpass'];
  // 新密碼
  $newPass = $_POST['newpass'];
  // 確認新密碼
  $cnewPass = $_POST['cnewpass'];
  $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);
  if($newPass != $cnewPass){
    echo $cuser->showMessage('danger', 'Password did not matched!');
  }
  else{
    if(password_verify($currentPass, $cpass)){
      $cuser->change_password($hnewPass,$cid);
      echo $cuser->showMessage('success','密碼更換成功');
      // 新增通知
      $cuser->notification($cid,'admin','Password changed');

    }
    else{
      echo $cuser->showMessage('danger','Current Password is Wrong!');
    }
  }
}

if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){
  try{
    // 驗證信箱
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
    $mail->addAddress($cemail);
    $mail->isHTML(true);
    // 標題亂碼處理方式
    $mail->Subject =" =?utf-8?B?" . base64_encode("Email驗證") . "?=";
    // 信件內容
    $mail->Body = '<h3>請點選連結驗證信箱.<br><a href="http://127.0.0.1/PHP_OOP_CMS/verify-email.php?email='.$cemail.'">http://127.0.0.1/PHP_OOP_CMS/verify-email.php?email='.$cemail.'</a><br>敬祝順心<br>系統自動發信</h3>';
    $mail->send();
    echo $cuser->showMessage('success', '請到email驗證您的信箱');
 }
 catch(Exception $e){
    echo $cuser->showMessage('danger','出現錯誤，請再重試一次');
 }
}

// Handle Send Feedback to Admin Ajax Request
if (isset($_POST['action']) && $_POST['action']== 'feedback') {
$subject = $cuser->test_input($_POST['subject']);
$feedback = $cuser->test_input($_POST['feedback']);
$cuser->send_feedback($subject, $feedback,$cid);
// 新增通知
$cuser->notification($cid,'admin','Feedback written');
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification') {
  $notification = $cuser->fetchNotification($cid);
  $output = '';
  // 帶出訊息
  if ($notification) {
    foreach ($notification as $row) {
      $output .= '<div class="alert alert-danger" role="alert">
      <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">'.$row['message'].'</p>
      <hr class="my-2">
      <p class="mb-0 float-left">Reply of feedback from Admin</p>
      <p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
      <div class="clearfix"></div>
  </div>';
    }
    echo $output;
  }
  else{
    echo '<h3 class="text-center text-secondary my-5">沒有訊息</h3>';
  }
}
// Check Notification
if (isset($_POST['action']) && $_POST['action']=='checkNotification') {
  if ($cuser->fetchNotification($cid)) {
    echo '<i class="fas fa-circle fa-sm text-danger"></i>';
  }else{
    echo '';
  }
}
// 刪除通知
if(isset($_POST['notification_id'])){
  $id = $_POST['notification_id'];
  $cuser->removeNotification($id);
}
?>