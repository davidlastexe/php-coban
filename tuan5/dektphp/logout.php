<?php
    require_once("config.php");
    session_start();
    unset($_SESSION['sinhvien']);
    header("Location: ".INDEX_URL);
    exit();
?>