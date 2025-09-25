<?php
session_start();
require_once("../connect_db.php");
if (!isset($_SESSION['admin'])) {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION['admin'])) {
        $ten_dang_nhap = $_SESSION['admin'];
        $conn = connect_db();
        if ($conn) {
            $sql = "SELECT * FROM quan_tri_vien WHERE ten_dang_nhap='" . $ten_dang_nhap . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sv = mysqli_fetch_assoc($result);
                $hoten = $sv["ho_ten"];
                $email = $sv["email"];
            }
        }
    }
}
if (isset($_POST["btnSubmit"])) {
    if (isset($_REQUEST["ten_dang_nhap"])) {
        $ten_dang_nhap = $_REQUEST["ten_dang_nhap"];
    }
    if (isset($_REQUEST["hoten"])) {
        $hoten = $_REQUEST["hoten"];
    }
    if (isset($_REQUEST["email"])) {
        $email = $_REQUEST["email"];
    }
    $conn = connect_db();
    if ($conn) {
        $sql = "UPDATE quan_tri_vien SET ho_ten='" . $hoten . "', email='" . $email . "'";
        $sql .= " WHERE ten_dang_nhap='" . $ten_dang_nhap . "'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message_updateadmin'] = "*Sửa thông tin quản trị viên " . $ten_dang_nhap . " thành công!";
            header("Location: " . INDEX_URL . "admin/updateadmin.php");
            exit();
        } else {
            $_SESSION['message_updateadmin'] = "*Lỗi cập nhật: " . mysqli_error($conn);
            header("Location: " . INDEX_URL . "admin/updateadmin.php");
            exit();
        }
    }
}
?>
<html>

<head>
    <title>Sửa thông tin quản trị viên</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        input[name="ten_dang_nhap"] {
            background-color: lemonchiffon;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <form action="updateadmin.php" method="POST">
        <h1>Sửa thông tin quản trị viên</h1>

        <div class="block">
            <label for="">Tên đăng nhập:</label>
            <input type="text" name="ten_dang_nhap" id="" value="<?php if (isset($ten_dang_nhap)) {
                                                            echo $ten_dang_nhap;
                                                        } ?>">
        </div>
        <div class="block">
            <label for="">Họ và tên:</label>
            <input type="text" name="hoten" id="" value="<?php if (isset($hoten)) {
                                                                echo $hoten;
                                                            } ?>">
        </div>
        <div class="block">
            <label for="">Email:</label>
            <input type="text" name="email" id="" value="<?php if (isset($email)) {
                                                                echo  $email;
                                                            } ?>">
        </div>
        <div class="block" style="float: right;">
            <a href="<?php echo INDEX_URL . "admin" ?>" name="btnBack">Quay về</a>
            <input type="submit" name="btnSubmit" value="Sửa">
        </div>
    </form>
    <div class="block">
        <span class="error" id="message_updatesv">
            <?php
            if (isset($_SESSION['message_updateadmin'])) {
                echo $_SESSION['message_updateadmin'];
                unset($_SESSION['message_updateadmin']);
            }
            ?>
        </span>
    </div>
</body>

</html>