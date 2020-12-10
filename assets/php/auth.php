<?php
require_once 'config.php';
class Auth extends Database
{
    // 註冊新使用者
    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'pass' => $password]);
        return true;
    }
    // 確認email是否存在
    public function user_exist($email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // 使用者登入(存在未刪除)
    public function login($email)
    {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Current User In Session
    public function currentUser($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    

    // 忘記密碼
    public function forgot_password($token, $email)
    {
        // 十分鐘以內重置密碼(token)
        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW() , INTERVAL 10 MINUTE) WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token, 'email' => $email]);
        return true;
    }
    // 重置密碼使用者驗證
    public function reset_pass_auth($email, $token)
    {
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    // 重置密碼(更新密碼)
    public function update_new_pass($pass, $email)
    {
        $sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass' => $pass, 'email' => $email]);
        return true;
    }
    // 新增Note
    public function add_new_note($uid, $title, $note)
    {
        $sql = "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid, 'title' => $title, 'note' => $note]);
        return true;
    }
    // 列出所有Note
    public function get_notes($uid)
    {
        $sql = "SELECT * FROM notes WHERE uid = :uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $uid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Edit Note of An User
    public function edit_note($id)
    {
        $sql = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        // json_encode data需使用fetch,若用fetchAll要使用data[0]來撈取資料
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // 更新Note
    public function update_note($id, $title, $note)
    {
        $sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title' => $title, 'note' => $note, 'id' => $id]);
        return true;
    }
    // 刪除Note
    public function delete_note($id)
    {
        $sql = "DELETE FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
    // 編輯履歷
    public function update_profile($name, $gender, $dob, $phone, $photo, $id)
    {
        $sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $photo, 'id' => $id]);
        return true;
    }
    // 更換密碼(履歷)
    public function change_password($pass, $id)
    {
        $sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass' => $pass, 'id' => $id]);
        return true;
    }
    // 驗證使用者信箱
    public function verify_email($email)
    {
        $sql = "UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0 ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return true;
    }
    // Send Feedback to Admin
    public function send_feedback($sub, $feed,$uid)
    {
        $sql = "INSERT INTO feedback (uid, subject, feedback) VALUES (:uid, :sub,:feed) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'sub'=>$sub,'feed'=>$feed]);
        return true;
    }
    // 插入訊息
    public function notification($uid, $type, $message)
    {
        $sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid, 'type'=>$type, 'message'=>$message]);
        return true;
    }
    public function fetchNotification($uid)
    {
        $sql = "SELECT * FROM notification WHERE uid = :uid AND type='user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // 刪除通知
    public function removeNotification($id){
        $sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

}
