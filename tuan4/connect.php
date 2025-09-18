<?php
require_once 'config.php';

try {
  if (class_exists("PDO")) {
    $options = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8;",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    $dsn_template = "%s:host=%s;port=%s;dbname=%s";
    $dsn = sprintf($dsn_template, _DRIVER, _HOST, _PORT, _DB);
    $connect = new PDO($dsn, _USER, _PASS, $options);
  }
} catch (Exception $ex) {
  echo "Lỗi kết nối: ".$ex->getMessage();
}
