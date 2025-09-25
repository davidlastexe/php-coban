<?php
session_start();
require_once("../connect_db.php");
if (!isset($_SESSION['admin'])) {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST["mssv"])) {
        $mssv = $_REQUEST["mssv"];
    }
    if (isset($_REQUEST["password"])) {
        $password = $_REQUEST["password"];
    }
    if (isset($_REQUEST["hoten"])) {
        $hoten = $_REQUEST["hoten"];
    }
    if (isset($_REQUEST["gioitinh"])) {
        $gioitinh = $_REQUEST["gioitinh"];
    }
    if (isset($_REQUEST["ngaysinh"])) {
        $ngaysinh = $_REQUEST["ngaysinh"];
    }
    if (isset($_REQUEST["cccd"])) {
        $cccd = $_REQUEST["cccd"];
    }
    if (isset($_REQUEST["sdt"])) {
        $sdt = $_REQUEST["sdt"];
    }
    if (isset($_REQUEST["noisinh"])) {
        $noisinh = $_REQUEST["noisinh"];
    }
    if (isset($_REQUEST["diachi"])) {
        $diachi = $_REQUEST["diachi"];
    }
    $conn = connect_db();
    if ($conn) {
        $sql = "INSERT INTO sinh_vien (mssv, mat_khau, ho_ten, ngay_sinh, gioi_tinh, cccd, sdt, noi_sinh, dia_chi) VALUES ";
        $sql .= "('" . $mssv . "', '" . $password . "', '" . $hoten . "', '" . $ngaysinh  . "','" . $gioitinh . "',";
        $sql .= "'" . $cccd . "', '" . $sdt . "', '" . $noisinh . "', '" . $diachi . "')";
        if (mysqli_query($conn, $sql)) {
            header("Location: " . INDEX_URL . "admin");
            exit();
        } else {
            $_SESSION['err_addsv'] = "Lỗi thực thi: $sql <br>" . mysqli_error($conn);
        }
    }
}
?>
<html>

<head>
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <form action="addsv.php" method="POST">
        <h1>Thêm sinh viên</h1>
        <div class="block">
            <label for="">MSSV:</label>
            <input type="text" name="mssv" id="">
        </div>
        <div class="block">
            <label for="">Mật khẩu:</label>
            <input type="password" name="password" id="">
        </div>
        <div class="block">
            <label for="">Họ và tên:</label>
            <input type="text" name="hoten" id="">
        </div>
        <div class="block">
            <label for="" style="float: left;">Giới tính:</label>
            <div class="block" style="float: left;">
                Nam <input type="radio" name="gioitinh" id="" value="0" checked>
                Nữ <input type="radio" name="gioitinh" id="" value="1">
            </div>
        </div>
        <div class="block" style="float: left;">
            <label for="">Ngày sinh:</label>
            <input type="date" name="ngaysinh" id="">
        </div>
        <div class="block">
            <label for="">CCCD:</label>
            <input type="text" name="cccd" id="">
        </div>
        <div class="block">
            <label for="">SĐT:</label>
            <input type="text" name="sdt" id="">
        </div>
        <div class="block">
            <label for="">Nơi sinh:</label>
            <input type="text" name="noisinh" id="">
        </div>
        <div class="block">
            <label for="">Địa chỉ:</label>
            <textarea rows="5" name="diachi" id=""></textarea>
        </div>
        <div class="block" style="float: right;">
            <a href="<?php echo INDEX_URL . "admin" ?>" name="btnBack">Quay về</a>
            <input type="submit" name="btnSubmit" value="Thêm mới">
        </div>
    </form>
    <div class="block">
        <span class="error" id="err_addsv">
            <?php
            if (isset($_SESSION['err_addsv'])) {
                echo $_SESSION['err_addsv'];
                unset($_SESSION['err_addsv']);
            }
            ?>
        </span>
    </div>
</body>

</html>