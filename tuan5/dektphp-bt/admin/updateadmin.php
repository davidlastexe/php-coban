<?php
require_once "../connect_db.php";

session_start();

$previous_url = $_SERVER['HTTP_REFERER'];

if (!isset($_SESSION['admin']))
  header("location:login.php");

$connect = connect_db_POD();

if (!empty($_POST)) {
  $fields = implode(", ", array_map(fn ($key) => "`{$key}` = :{$key}", array_keys($_POST)));
  $sql = "UPDATE `quan_tri_vien` SET $fields WHERE `ten_dang_nhap` = :ten_dang_nhap";
  $stm = $connect->prepare($sql);
  $params = array_merge($_POST, ['ten_dang_nhap' => $_SESSION['admin']]);
  $_SESSION['toast'] = ($stm->execute($params)) ? "Update thông tin admin thành công!" : "Đã có lỗi khi update thông tin admin!";
}

$sql = "SELECT * FROM `quan_tri_vien` WHERE `ten_dang_nhap` = ?";
$stm = $connect->prepare($sql);
$stm->execute([$_SESSION['admin']]);

$result = $stm->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>Update admin</title>
  <link
    rel="stylesheet"
    href="../css/style.css"
  >
</head>

<body>
  <?php require_once "sidenav.php"; ?>
  <div class="main">
    <form
      method="POST"
    >
      <h1>Sửa thông tin quản trị viên</h1>

      <p class="">
        <?php
        if (isset($_SESSION['toast'])) {
          echo $_SESSION['toast'];
          unset($_SESSION['toast']);
        }
        ?>
      </p>

      <div class="block">
        <label for="ten_dang_nhap">Tên đăng nhập:</label>
        <input
          type="text"
          name="ten_dang_nhap"
          value="<?php echo $result['ten_dang_nhap'] ?>"
        >
      </div>
      <div class="block">
        <label for="ho_ten">Họ và tên:</label>
        <input
          type="text"
          name="ho_ten"
          value="<?php echo $result['ho_ten'] ?>"
        >
      </div>
      <div class="block">
        <label for="">Email:</label>
        <input
          type="text"
          name="email"
          value="<?php echo $result['email'] ?>"
        >
      </div>
      <div
        class="block"
        style="float: right;"
      >
        <a
          href="<?php echo $previous_url ?>"
          name="btnBack"
        >Quay về</a>
        <input
          type="submit"
          value="Sửa"
        >
      </div>
    </form>
  </div>
</body>

</html>