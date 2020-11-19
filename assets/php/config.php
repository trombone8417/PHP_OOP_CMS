<?php
// vscode會報錯請記得下載phpcs
class Database
{
    private $dsn = "mysql:host=127.0.0.1;dbname=db_user_system";
    private $dbuser = "root";
    private $dbpass = "";
    public $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            // echo "連接成功";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }

    public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    public function showMessage($type,$message){
        return '<div class="alert alert-'.$type. ' alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong class="text-center">'.$message.'</strong>
        </div>';
    }
}

// 記得new一個新物件測試
// $ob = new Database;

