<?php
require_once("config.php");
require_once("connect_db.php");
session_start();
if (isset($_SESSION['sinhvien'])) {
    $mssv = $_SESSION['sinhvien'];
    $conn = connect_db();
    if ($conn) {
        $sql = "SELECT * FROM sinh_vien WHERE mssv='" . $mssv . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sv = mysqli_fetch_assoc($result);
            $hoten = $sv["ho_ten"];
            $gioitinh = $sv["gioi_tinh"];
            $ngaysinh = $sv["ngay_sinh"];
            $cccd = $sv["cccd"];
            $sdt = $sv["sdt"];
            $noisinh = $sv["noi_sinh"];
            $diachi = $sv["dia_chi"];
        }
    }
} else {
    header("Location: " . INDEX_URL . "login.php");
    exit();
}
?>
<html>

<head>
    <title>Thông tin sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        input[name="mssv"] {
            background-color: lemonchiffon;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <form action="updatesv.php" method="POST" style="text-align: left;">
        <h1>Thông tin sinh viên</h1>
        <p for=""><b>MSSV:</b><?php if (isset($mssv)) {echo $mssv;} ?></p>
        <p for=""><b>Họ tên:</b><?php if (isset($hoten)) {echo $hoten;} ?></p>
        <p for=""><b>Giới tính:</b><?php if (isset($gioitinh)) {
                                                if($gioitinh=="0"){
                                                    echo "Nam";
                                                }else{
                                                    echo "Nữ";
                                                }
                                    } ?></p>
        <p for=""><b>Ngày sinh:</b><?php if (isset($ngaysinh)) {echo date("d-m-Y", strtotime($ngaysinh));} ?></p>
        <p for=""><b>CCCD:</b><?php if (isset($cccd)) {echo $cccd;} ?></p>
        <p for=""><b>SĐT:</b><?php if (isset($sdt)) {echo $sdt;} ?></p>
        <p for=""><b>Nơi sinh:</b><?php if (isset($noisinh)) {echo $noisinh;} ?></p>
        <p for=""><b>Địa chỉ:</b><?php if (isset($diachi)) {echo $diachi;} ?></p>
        <div class="block" style="float: right; margin-top: 30px;">
            <a href="<?php echo INDEX_URL . "changepass.php" ?>" name="btnBack">Đổi mật khẩu</a>
            <a href="<?php echo INDEX_URL . "update.php" ?>" name="btnBack">Sửa</a>
            <a href="<?php echo INDEX_URL . "logout.php" ?>" name="btnBack">Đăng xuất</a>
        </div>
    </form>
</body>

</html>