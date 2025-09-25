<?php
require_once "../connect_db.php";

session_start();

if (!isset($_SESSION["admin"]))
  header("location:login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <?php require_once "sidenav.php" ?>
  <div class="main">
    <h3>DANH SÁCH SINH VIÊN</h3>
    <div class="block">
      <p
        class="error"
        id="sv_message"
      >
      </p>
    </div>
    <table id='customers'>
      <?php
      $html = "<tbody>";
      echo "<tr>
              <th>STT</th>
              <th>MSSV</th>
              <th>HỌ TÊN</th>
              <th>NGÀY SINH</th>
              <th>GIỚI TÍNH</th>
              <th>CCCD</th>
              <th>SĐT</th>
              <th>NƠI SINH</th>
              <th>ĐỊA CHỈ</th>
              <th colspan='2'>Action</th>
            </tr>";
      $connect = connect_db_POD();
      $sql = "SELECT * FROM `sinh_vien`";
      $stm = $connect->prepare($sql);
      $stm->execute();

      $result = $stm->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $k => $row) {
        echo "<tr>";
        echo "<td>".($k + 1)."</td>";
        echo "<td>".$row["mssv"]."</td>";
        echo "<td>".$row["ho_ten"]."</td>";
        echo "<td>".date("d-m-Y", strtotime($row["ngay_sinh"]))."</td>";
        echo "<td>";
        echo $row["gioi_tinh"] == "0" ? "Nam" : "Nữ";
        echo "</td>";
        echo "<td>".$row["cccd"]."</td>";
        echo "<td>".$row["sdt"]."</td>";
        echo "<td>".$row["noi_sinh"]."</td>";
        echo "<td>".$row["dia_chi"]."</td>";
        echo "<td><a href='updatesv.php?mssv=".$row['mssv']."'>Sửa</a></td>";
        echo "<td><a href='deletesv.php?mssv=".$row['mssv']."'";
        echo "onclick=\"return confirm('Bạn có chắc muốn xóa sinh viên ".$row['ho_ten']."(".$row['mssv'].")?')\"";
        echo ">Xóa</a></td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>
</body>

</html>