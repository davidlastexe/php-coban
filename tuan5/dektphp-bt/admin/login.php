<?php
require_once "../connect_db.php";
date_default_timezone_set("Asia/Ho_Chi_Minh");
session_start();

if (isset($_SESSION['admin']))
  header("location:index.php");

if (!empty($_POST)) {
  $username = $_POST["ten_dang_nhap"];
  $password = $_POST["mat_khau"];

  $connect = connect_db_POD();
  $sql = "SELECT * FROM `quan_tri_vien` WHERE `ten_dang_nhap` = ? AND `mat_khau` = ?";
  $stm = $connect->prepare($sql);
  $stm->execute([$username, md5($password)]);

  $result = $stm->fetch(PDO::FETCH_ASSOC);


  if (!empty($result)) {
    if ($result['ten_dang_nhap'] == $username && $result['mat_khau'] == md5($password)) {
      $sql = "UPDATE `quan_tri_vien` SET `lan_dang_nhap_cuoi`= :lan_dang_nhap_cuoi WHERE `ten_dang_nhap` = :ten_dang_nhap";
      $stm = $connect->prepare($sql);
      $stm->execute(['lan_dang_nhap_cuoi' => date('Y:m:d H:i:s'), 'ten_dang_nhap' => $username]);

      $_SESSION['admin'] = $username;
      header("location:index.php");
    }
  } else
    $_SESSION['err_admin'] = 'Lỗi sai tên đăng nhập hoặc mật khẩu!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
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
  <form
    action="login.php"
    method="post"
  >
    <h2>Đăng nhập Quản trị viên</h2>
    <p class="error">
      <?php
      if (isset($_SESSION['err_admin'])) {
        echo $_SESSION['err_admin'];
        unset($_SESSION['err_admin']);
      }
      ?>
    </p>
    <label>Tên đăng nhập</label>
    <input
      type="text"
      name="ten_dang_nhap"
    >
    <label>Mật khẩu</label>
    <input
      type="password"
      name="mat_khau"
    >
    <input
      type="submit"
      value="Đăng nhập"
    >
  </form>
</body>

</html>