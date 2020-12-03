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
    }

?>