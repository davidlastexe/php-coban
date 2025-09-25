<?php
require_once "../connect_db.php";

if (!empty($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $connect = connect_db_POD();
    $sql = "select * from `quan_tri_vien` where `ten_dang_nhap` = ?";
    $stm = $connect->prepare($sql);
    $stm->execute([$username]);

    $result = $stm->fetch(PDO::FETCH_ASSOC);


    if ($result) {
        if ($username == $result["ten_dang_nhap"]) {
            header("location:index.php");
            setcookie("success", "Đăng ký thành công!", time() + 10000000, "/", "", 0);
            //$_SESSION["username"] = $result["username"];
        } else {
            echo "Login khong cong";
        }
    }


    /*
        setcookie("error", "Đăng nhập không thành công!", time() + 1, "/", "", 0);
    
        $pass = md5($pass1);

        header("location:index.php");
    */
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
        </span>
        <input type="submit" value="Đăng nhập">
    </form>
</body>

</html>