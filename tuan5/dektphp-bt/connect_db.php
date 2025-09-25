<?php
require_once "config.php";
function connect_db()
{
    $host = DB_HOST;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $dbname = DB_NAME;
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Kết nối CSDL thất bại: " . mysqli_connect_error());
    }
    return $conn;
}

function connect_db_POD()
{
    try {
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $dsn_template = "%s:host=%s;port=%s;dbname=%s";
        $dsn = sprintf($dsn_template, "mysql", DB_HOST, "3306", DB_NAME);
        $connect = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
        return $connect;
    } catch (Exception $ex) {
        echo "Lỗi kết nối: " . $ex->getMessage();
        exit();
    }
}