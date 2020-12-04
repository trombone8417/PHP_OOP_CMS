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
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        // 23 32:05
        public function verifiedPer()
        {
            $sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

?>