<?php
session_start();
require_once("../connect_db.php");
if (!isset($_SESSION['admin'])) {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_REQUEST["mssv"])) {
        $mssv = $_REQUEST["mssv"];
        $conn = connect_db();
        if ($conn) {
            $sql = "DELETE FROM sinh_vien WHERE mssv='" . $mssv . "'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['sv_message'] = "*Xóa sinh viên có mssv là ". $mssv . " thành công!";
                header("Location: " . INDEX_URL . "admin");
                exit();
            } else {
                $_SESSION['sv_message'] = "*Lỗi xóa: " . mysqli_error($conn);
                header("Location: " . INDEX_URL . "admin");
                exit();
            }
        }
    } else {
        $_SESSION['sv_message'] = "Không tìm thấy mssv cần xóa!";
        header("Location: " . INDEX_URL . "admin");
        exit();
    }
}
