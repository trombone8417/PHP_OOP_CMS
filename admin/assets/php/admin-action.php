<?php
require_once 'admin-db.php';
$admin = new Admin();
session_start();
// 管理者登入Ajax
if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);
    // 使用SHA1加密
    $hpassword = sha1($password);
    // 使用者登入
    $loggedInAdmin = $admin->admin_login($username, $hpassword);
    // 若登入成功
    if ($loggedInAdmin != null) {
        echo 'admin_login';
        // 儲存SESSION username
        $_SESSION['username'] = $username;
    } else {
        // 登入失敗， 顯示警訊
        echo $admin->showMessage('danger', 'Username or Password is Incorrect!');
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers') {
    $output = '';
    // 顯示未刪除帳號使用者
    $data = $admin->fetchAllUsers(0);
    $path = '../assets/php/';
    if ($data) {
        $output .= '<table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Phones</th>
                                    <th>Gender</th>
                                    <th>Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($data as $row) {
            // 確認使用者是否有上傳照片
            if ($row['photo'] != '') {
                // 有的話顯示使用者照片的相對路徑
                $uphoto = $path . $row['photo'];
            } else {
                // 沒有的話顯示預設照片的相對路徑
                $uphoto = '../assets/img/profile.png';
            }

            $output .=
                '<tr>
                <td>' . $row['id'] . '</td>
                <td><img src="' . $uphoto . '" class="rounded-circle" width="40px"></td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $row['verified'] . '</td>
                <td><a href="#" id="' . $row['id'] . '" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailModal"><i class="fas fa-info-circle fa-lg">
                </i></a>&nbsp;&nbsp;
                <a href="#" id="' . $row['id'] . '" title="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash-alt fa-lg">
                </i></a>&nbsp;&nbsp;
                </td>                                    
            </tr>';
        }
        $output .=
            '</tbody>
            </table>';

        echo $output;
    } else {
        // 沒有使用者的註冊資訊，顯示alert
        echo '<h3 class="text-center text-secondary">:( No any user registered yet!</h3>';
    }
}

// 使用者詳細資料
if (isset($_POST['details_id'])) {
    $id = $_POST['details_id'];
    $data = $admin->fetchUserDetailsByID($id);
    echo json_encode($data);
}

// 刪除使用者
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $admin->userAction($id, 0);
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers') {
    $output = '';
    // 顯示已刪除帳號使用者
    $data = $admin->fetchAllUsers(1);
    $path = '../assets/php/';
    if ($data) {
        $output .= '<table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Phones</th>
                                    <th>Gender</th>
                                    <th>Verified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($data as $row) {
            // 確認使用者是否有上傳照片
            if ($row['photo'] != '') {
                // 有的話顯示使用者照片的相對路徑
                $uphoto = $path . $row['photo'];
            } else {
                // 沒有的話顯示預設照片的相對路徑
                $uphoto = '../assets/img/profile.png';
            }

            $output .=
                '<tr>
                <td>' . $row['id'] . '</td>
                <td><img src="' . $uphoto . '" class="rounded-circle" width="40px"></td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $row['verified'] . '</td>
                <td>
                <a href="#" id="' . $row['id'] . '" title="Restore User" class="text-white restoreUserIcon badge badge-dark p-2">Restore</a>
                </td>                                    
            </tr>';
        }
        $output .=
            '</tbody>
            </table>';

        echo $output;
    } else {
        // 沒有使用者的註冊資訊，顯示alert
        echo '<h3 class="text-center text-secondary">:( No any user deleted yet!</h3>';
    }
}

if (isset($_POST['res_id'])) {
    $id = $_POST['res_id'];
    $admin->userAction($id, 1);
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes') {
    $output = '';
    // 顯示已刪除帳號使用者
    $note = $admin->fetchAllNotes();
    if ($note) {
        $output .= '<table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>User E-Mail</th>
                                    <th>Note Title</th>
                                    <th>Note</th>
                                    <th>Written On</th>
                                    <th>Updated On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($note as $row) {
            $output .=
                '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['title'] . '</td>
                <td>' . $row['note'] . '</td>
                <td>' . $row['created_at'] . '</td>
                <td>' . $row['updated_at'] . '</td>
                <td>
                <a href="#" id="' . $row['id'] . '" title="Delete Note" class="text-danger deleteNoteIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                </td>                                    
            </tr>';
        }
        $output .=
            '</tbody>
            </table>';

        echo $output;
    } else {
        // 沒有使用者的註冊資訊，顯示alert
        echo '<h3 class="text-center text-secondary">:( No any note wirtten yet!</h3>';
    }
}

//    刪除Note
if (isset($_POST['note_id'])) {
    $id = $_POST['note_id'];
    $admin->deleteNoteOfUser($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback') {
    $output = '';
    // 顯示已刪除帳號使用者
    $feedback = $admin->fetchFeedback();
    if ($feedback) {
        $output .= '<table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>FID</th>
                                    <th>UID</th>
                                    <th>User Name</th>
                                    <th>User E-Mail</th>
                                    <th>Subject</th>
                                    <th>Feedback</th>
                                    <th>Sent On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($feedback as $row) {
            $output .=
                '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['uid'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['subject'] . '</td>
                <td>' . $row['feedback'] . '</td>
                <td>' . $row['created_at'] . '</td>
                <td>
                <a href="#" fid="'.$row['id'].'" id="' . $row['uid'] . '" title="Replay" class="text-primary replyFeedbackIcon" data-toggle="modal" data-target="#showReplyModal"><i class="fas fa-reply fa-lg"></i></a>
                </td>                                    
            </tr>';
        }
        $output .=
            '</tbody>
            </table>';

        echo $output;
    } else {
        // 沒有使用者的註冊資訊，顯示alert
        echo '<h3 class="text-center text-secondary">:( No any feedback wirtten yet!</h3>';
    }
}
if (isset($_POST['message'])) {
    $uid = $_POST['uid'];
    $message = $admin->test_input($_POST['message']);
    $fid = $_POST['fid'];
    $admin->replyFeedback($uid, $message);
    $admin->feedbackReplied($fid);

}