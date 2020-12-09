<?php
    require_once 'config.php';
    class Admin extends Database{
        // Admin 使用者登入
        public function admin_login($username,$password)
        {
            $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username'=>$username, 'password'=>$password]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        // 計算總數
        public function totalCount($tablename)
        {
            $sql = "SELECT * FROM $tablename";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $count = $stmt->rowCount();
            return $count;
        }
        // 計算驗證使用者總數
        public function verified_users($status)
        {
            $sql = "SELECT * FROM users WHERE verified = :status";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['status'=>$status]);
            $count = $stmt->rowCount();
            return $count;
        }
        // 男女比例
        public function genderPer()
        {
            $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender !='' GROUP BY gender";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            // fetchAll()比較好用，一次取出所有陣列。直接用foreach ()搭配
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        // 驗證人數比例
        public function verifiedPer()
        {
            $sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        // 首頁造訪量
        public function site_hits()
        {
            $sql = "SELECT hits FROM visitors";
            $stmt = $this->conn->prepare($sql);
            $stmt-> execute();
            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            return $count;
        }
        // 使用者數量
        public function fetchAllUsers($val)
        {
            $sql = "SELECT * FROM users WHERE deleted != $val";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        // 使用者詳細資料
        public function fetchUserDetailsByID($id)
        {
            $sql = "SELECT * FROM users WHERE id = :id AND deleted !=0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        // 刪除使用者
        public function userAction($id, $val)
        {
            $sql = "UPDATE users SET deleted = $val WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        }
        public function fetchAllNotes()
        {
            $sql = "SELECT notes.id, notes.title, notes.note, notes.created_at, notes.updated_at, users.name, users.email FROM notes INNER JOIN users ON notes.uid = users.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function deleteNoteOfUser($id)
        {
            $sql = "DELETE FROM notes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return true;
        }
        public function fetchFeedback()
        {
            $sql = "SELECT feedback.id, feedback.subject, feedback.feedback, feedback.created_at, feedback.uid, users.name, users.email FROM feedback INNER JOIN users ON feedback.uid = users.id WHERE replied != 1 ORDER BY feedback.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // 回覆訊息
        public function replyFeedback($uid, $message)
        {
            $sql = "INSERT INTO notification(uid, type, message) VALUES (:uid, 'user', :message)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['uid'=>$uid, 'message'=>$message]);
            return true;
        }
        // 若回覆訊息的話，replied = 1
        public function feedbackReplied($fid)
        {
            $sql = "UPDATE feedback SET replied = 1 WHERE id = :fid";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['fid'=>$fid]);
            return true;
        }
        public function fetchNotification()
        {
            $sql = "SELECT notification.id, notification.message, notification.created_at,users.name, users.email FROM notification INNER JOIN users ON notification.uid = users.id WHERE type = 'admin' ORDER BY notification.id DESC LIMIT 5";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        // 刪除通知
        public function removeNotification($id)
        {
            $sql = "DELETE FROM notification WHERE id = :id AND type = 'admin'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return true;
        }
    }
