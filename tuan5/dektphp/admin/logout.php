<?php
    require_once("../config.php");
    session_start();
    unset($_SESSION['admin']);
    header("Location: ".INDEX_URL."admin/login.php");
    exit();
?>