<?php
require_once 'config.php';
class Auth extends Database{
    // 註冊新使用者
public function register($name,$email,$password){
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name'=>$name,'email'=>$email, 'pass'=>$password]);
    return true;
}
public function user_exist($email){
    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email'=>$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

}
