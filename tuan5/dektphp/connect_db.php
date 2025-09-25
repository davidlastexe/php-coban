<?php
require_once("config.php");
function connect_db(){
    $host 		= DB_HOST;
    $username 	= DB_USERNAME;
    $password 	= DB_PASSWORD;
    $dbname 	= DB_NAME;
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Kết nối CSDL thất bại: ". mysqli_connect_error());
    }
    return $conn;
}
?>