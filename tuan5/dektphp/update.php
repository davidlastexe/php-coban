<?php
session_start();
require_once("connect_db.php");
if (!isset($_SESSION['sinhvien'])) {
    header("Location: " . INDEX_URL . "login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
}
if (isset($_POST["btnSubmit"])) {
    if (isset($_REQUEST["mssv"])) {
        $mssv = $_REQUEST["mssv"];
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
        $sql = "UPDATE sinh_vien SET ho_ten='" . $hoten . "', gioi_tinh='" . $gioitinh . "',";
        $sql .= "ngay_sinh='" . $ngaysinh . "',cccd='" . $cccd . "',sdt='" . $sdt . "',noi_sinh='" . $noisinh . "',dia_chi='" . $diachi . "'";
        $sql .= " WHERE mssv='" . $mssv . "'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message_updatesv'] = "*Sửa thông tin sinh viên " . $hoten . "(" . $mssv . ") thành công!";
            header("Location: " . INDEX_URL . "update.php");
            exit();
        } else {
            $_SESSION['message_updatesv'] = "*Lỗi cập nhật: " . mysqli_error($conn);
            header("Location: " . INDEX_URL . "update.php");
            exit();
        }
    }
}
?>
<html>

<head>
    <title>Sửa thông tin sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        input[name="mssv"] {
            background-color: lemonchiffon;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <form action="update.php" method="POST">
        <h1>Sửa thông tin sinh viên</h1>

        <div class="block">
            <label for="">MSSV:</label>
            <input type="text" name="mssv" id="" value="<?php if (isset($mssv)) {
                                                            echo $mssv;
                                                        } ?>">
        </div>
        <div class="block">
            <label for="">Họ và tên:</label>
            <input type="text" name="hoten" id="" value="<?php if (isset($hoten)) {
                                                                echo $hoten;
                                                            } ?>">
        </div>
        <div class="block">
            <label for="" style="float: left;">Giới tính:</label>
            <div class="block" style="float: left;">
                Nam <input type="radio" name="gioitinh" id="" value="0" <?php if (isset($gioitinh)) {
                                                                            if ($gioitinh == "0") {
                                                                                echo "checked";
                                                                            }
                                                                        } ?>>
                Nữ <input type="radio" name="gioitinh" id="" value="1" <?php if (isset($gioitinh)) {
                                                                            if ($gioitinh == "1") {
                                                                                echo "checked";
                                                                            }
                                                                        } ?>>
            </div>
        </div>
        <div class="block" style="float: left;">
            <label for="">Ngày sinh:</label>
            <input type="date" name="ngaysinh" id="" value="<?php if (isset($ngaysinh)) {
                                                                echo $ngaysinh;
                                                            } ?>">
        </div>
        <div class="block">
            <label for="">CCCD:</label>
            <input type="text" name="cccd" id="" value="<?php if (isset($cccd)) {
                                                            echo $cccd;
                                                        } ?>">
        </div>
        <div class="block">
            <label for="">SĐT:</label>
            <input type="text" name="sdt" id="" value="<?php if (isset($sdt)) {
                                                            echo  $sdt;
                                                        } ?>">
        </div>
        <div class="block">
            <label for="">Nơi sinh:</label>
            <input type="text" name="noisinh" id="" value="<?php if (isset($noisinh)) {
                                                                echo  $noisinh;
                                                            } ?>">
        </div>
        <div class="block">
            <label for="">Địa chỉ:</label>
            <textarea rows="5" name="diachi" id=""><?php if (isset($diachi)) {
                                                        echo htmlspecialchars($diachi);
                                                    } ?></textarea>
        </div>

        <div class="block" style="float: right;">
            <a href="<?php echo INDEX_URL?>" name="btnBack">Quay về</a>
            <input type="submit" name="btnSubmit" value="Sửa">
        </div>
    </form>
    <div class="block">
        <span class="error" id="message_updatesv">
            <?php
            if (isset($_SESSION['message_updatesv'])) {
                echo $_SESSION['message_updatesv'];
                unset($_SESSION['message_updatesv']);
            }
            ?>
        </span>
    </div>
</body>

</html>