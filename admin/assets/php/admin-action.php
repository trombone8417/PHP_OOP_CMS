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
        $loggedInAdmin =$admin->admin_login($username,$hpassword);
        // 若登入成功
        if ($loggedInAdmin != null) {
            echo 'admin_login';
            // 儲存SESSION username
            $_SESSION['username'] = $username;
        }
        else{
            // 登入失敗， 顯示警訊
            echo $admin->showMessage('danger', 'Username or Password is Incorrect!');
        }
    }
?>