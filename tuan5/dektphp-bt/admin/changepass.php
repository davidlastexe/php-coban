<?php
require_once "../connect_db.php";

session_start();

if (!isset($_SESSION['admin']))
  header("location:login.php");

$connect = connect_db_POD();

function getData() {
  global $connect;
  $sql = "SELECT * FROM `quan_tri_vien` WHERE `ten_dang_nhap` = ?";
  $stm = $connect->prepare($sql);
  $stm->execute([$_SESSION['admin']]);

  return $stm->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_POST)) {
  $result = getData();
  if ($result && $result['mat_khau'] == md5($_POST['passwordcu']) && $_POST['passwordmoixn'] == $_POST['passwordmoi']) {
    $data = ['mat_khau' => md5($_POST['passwordmoi']), 'ten_dang_nhap' => $_POST['ten_dang_nhap']];
    $fields = implode(", ", array_map(fn ($key) => "`{$key}` = :{$key}", array_keys($data)));

    $sql = "UPDATE `quan_tri_vien` SET $fields WHERE `ten_dang_nhap` = :ten_dang_nhap";
    $stm = $connect->prepare($sql);
    $_SESSION['toast'] = ($stm->execute($data)) ? "Đổi mật khẩu admin thành công!" : "Đã có lỗi khi đổi mật khẩu admin!";
  } else
    $_SESSION['toast'] = "Sai thông tin mật khẩu!";
}

$result = getData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>Đổi mật khẩu admin</title>
  <link
    rel="stylesheet"
    href="../css/style.css"
  >
  <style>
    input[name="ten_dang_nhap"] {
      background-color: lemonchiffon;
      pointer-events: none;
    }

    form {
      max-width: 300px;
      border: 2px solid dodgerblue;
      padding: 10px;
      align-items: center;
      margin: auto;
      text-align: left;
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
      font-weight: normal;
    }

    .error {
      color: red;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <?php require_once "sidenav.php"; ?>
  <div class="main">
    <form method="post">
      <h2>Đổi mật khẩu quản trị viên</h2>
      <p class="">
        <?php
        if (isset($_SESSION['toast'])) {
          echo $_SESSION['toast'];
          unset($_SESSION['toast']);
        }
        ?>
      </p>
      <label>Tên đăng nhập</label>
      <input
        type="text"
        name="ten_dang_nhap"
        value="<?php echo $result['ten_dang_nhap'] ?>"
      >
      <label>Mật khẩu hiện tại</label>
      <input
        type="password"
        name="passwordcu"
      >
      <label>Mật khẩu mới</label>
      <input
        type="password"
        name="passwordmoi"
      >
      <label>Xác nhận mật khẩu mới</label>
      <input
        type="password"
        name="passwordmoixn"
      >
      <input
        type="submit"
        value="Đổi mật khẩu"
      >
    </form>
  </div>
</body>

</html>