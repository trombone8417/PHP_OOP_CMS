<?php
// vscode會報錯請記得下載phpcs
class Database
{
    // Email自動寄信帳號
    const USERNAME = 'ttuttu834@gmail.com';
    const PASSWORD = 'Aa12345*';
    // sql資料
    private $dsn = "mysql:host=127.0.0.1;dbname=db_user_system";
    private $dbuser = "root";
    private $dbpass = "";
    public $conn;
    public function __construct()
    {
        try {
            // 連接sql
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            // echo "連接成功";
        } catch (PDOException $e) {
            // sql錯誤顯示
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
    // 字串處理
    public function test_input($data){
        // 清除字串前後空白
        $data = trim($data);
        // 去除字串中多餘的反斜線（\）
        $data = stripslashes($data);
        // 轉換 HTML 特殊符號為僅能顯示用的編碼
        $data = htmlspecialchars($data);
        return $data;
    }
    // bootstrap alert   
    public function showMessage($type,$message){
        return '<div class="alert alert-'.$type. ' alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong class="text-center">'.$message.'</strong>
        </div>';
    }
    // 顯示多久前
    public function timeInAgo($timestamp)
    {
        // apache php.ini 也要調整時區 (date.timezone=Asia/Taipei)
        date_default_timezone_get("Asia/Taipei");
        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
        $time = time() - $timestamp;
        switch($time){
            // 秒
            case $time <= 60:
                return '現在';
            // 分鐘
            case $time >= 60 && $time < 3600:
                return (round($time/60) == 1)?'1 分鐘前':round($time/60).' 分鐘前';
            // 小時
            case $time >= 3600 && $time < 86400:
                return (round($time/3600) == 1)?'1 小時前':round($time/3600).' 小時前';
            // 天
            case $time >= 86400 && $time < 2600640:
                return (round($time/86400) == 1)?'1 天前':round($time/86400).' 天前';
            // 月
            case $time >= 2600640 && $time < 631207680:
                return (round($time/2600640) == 1)?'1 月前':round($time/2600640).' 月前';
            // 年
            case $time >= 31207680 :
                return (round($time/31207680) == 1)?'1 年前':round($time/31207680).' 年前';
        }

    }
}

