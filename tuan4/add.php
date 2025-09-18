<?php
require_once 'connect.php';
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST)) {
        $result = insert("admins", $_POST);
        if ($result) {
            echo "Thêm mới quản trị viên thành công!";
        } else {
            echo "Thêm mới quản trị viên thất bại!";
        }
    }
}