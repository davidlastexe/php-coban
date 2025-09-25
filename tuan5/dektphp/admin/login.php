<?php
require_once("../config.php");
session_start();
require_once("../connect_db.php");
if (isset($_SESSION['admin'])) {
    header("Location: " . INDEX_URL . "admin");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST["username"])) {
        $username = $_REQUEST["username"];
    }
    if (isset($_REQUEST["password"])) {
        $password = $_REQUEST["password"];
    }
    if (isset($username) && isset($password)) {
        $conn = connect_db();
        if ($conn) {
            $sql = "SELECT * FROM quan_tri_vien WHERE ten_dang_nhap='" . $username;
            $sql .= "' AND mat_khau='" . md5($password) . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['admin'] = $username;
                $sql = "UPDATE quan_tri_vien SET lan_dang_nhap_cuoi=now()";
                mysqli_query($conn, $sql);
                header("Location: " . INDEX_URL . "admin");
                exit();
            } else {
                $_SESSION['err_admin'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Quản trị viên</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
        }

        form {
            max-width: 300px;
            border: 2px solid dodgerblue;
            padding: 10px;
            align-items: center;
            margin: auto;
        }

        input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid #ccc;
            border-radius: .1875rem;
            box-sizing: border-box;
            display: block;
            font-size: .875rem;
            margin-bottom: 1rem;
            padding: .275rem;
            width: 100%;
        }

        input[type="password"] {
            margin-bottom: .5rem;
        }

        input[type="submit"] {
            background-color: #015294;
            border: none;
            color: #fff;
            font-size: 1rem;
            padding: .5rem 1rem;
        }

        label {
            color: #666;
            font-size: .875rem;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <form action="login.php" method="post">
        <h2>Đăng nhập Quản trị viên</h2>
        <label>Tên đăng nhập</label>
        <input type="text" name="username">
        <label>Mật khẩu</label>
        <input type="password" name="password">
        <span class="error" id="err_login">
            <?php
            if (isset($_SESSION['err_admin'])) {
                echo $_SESSION['err_admin'];
                unset($_SESSION['err_admin']);
            }
            ?>
        </span>
        <input type="submit" value="Đăng nhập">
    </form>
</body>

</html>