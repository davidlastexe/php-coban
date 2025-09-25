<?php
session_start();
if (isset($_POST["btnSubmitImport"])) {
    $fileName = $_FILES["file"]["tmp_name"];
    try {
        $file = fopen($fileName, "r");
        $dssv = array();
        $flag = true;
        $i = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $i++;
            if ($i == 1) {
                continue;
            }

            $mssv = "";
            if (isset($column[0])) {
                $mssv = $column[0];
            }
            $hoten = "";
            if (isset($column[1])) {
                $hoten = $column[1];
            }
            $matkhau = "";
            if (isset($column[2])) {
                $matkhau = $column[2];
            }
            $ngaysinh = "";
            if (isset($column[3])) {
                $ngaysinh = $column[3];
            }
            $gioitinh = "";
            if (isset($column[4])) {
                $gioitinh = $column[4];
            }
            $cccd = "";
            if (isset($column[5])) {
                $cccd = $column[5];
            }
            $sdt = "";
            if (isset($column[6])) {
                $sdt = $column[6];
            }
            $noisinh = "";
            if (isset($column[7])) {
                $noisinh = $column[7];
            }
            $diachi = "";
            if (isset($column[7])) {
                $diachi = $column[7];
            }
            $sv = array($mssv, $matkhau, $hoten, $ngaysinh, $gioitinh, $cccd, $sdt, $noisinh, $diachi);
            array_push($dssv, $sv);
        }
    } catch (Throwable $t) {
        echo $t->$message;
    } finally {
        fclose($file);
    }
}
require_once("../connect_db.php");
if (isset($_POST["btnSubmit"])) {
    $conn = connect_db();
    $err_dssv = array();
    $dssv = $_SESSION['dssv'];
    if ($conn) {
        foreach ($dssv as $sv) {
            $format_ngaysinh = date("Y-m-d", strtotime(str_replace('/', '-', $sv[3])));
            if ($sv[4] == "Nam") {
                $gt_value = "0";
            } else {
                $gt_value = "1";
            }
            $sql = "INSERT INTO sinh_vien (mssv, mat_khau, ho_ten, ngay_sinh, gioi_tinh, cccd, sdt, noi_sinh, dia_chi) VALUES ";
            $sql .= "('" . $sv[0] . "', '" . md5($sv[2]) . "', '" . $sv[1] . "', '" . $format_ngaysinh . "','" . $gt_value . "',";
            $sql .= "'" . $sv[5] . "', '" . $sv[6] . "', '" . $sv[7] . "', '" . $sv[8] . "')";
            try {
                $result = mysqli_query($conn, $sql);
            } catch (Exception $e) {
                array_push($err_dssv, $sv[0]);
            }
        }
        if (count($err_dssv) > 0) {
            $_SESSION['sv_message'] = "Đã thêm danh sách sinh viên, ngoại trừ các sinh viên có mssv là " . implode(', ', $err_dssv);
        } else {
            $_SESSION['sv_message'] = "Đã thêm danh sách sinh viên thành công!";
        }
        header("Location: " . INDEX_URL . "admin");
        exit();
    }
}
if (isset($_SESSION['admin'])) { ?>
    <html>

    <head>
        <title>Thêm danh sách sinh viên</title>
        <link rel="stylesheet" href="../css/style.css">
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td,
            #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #customers tr:hover {
                background-color: #ddd;
            }

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
                text-align: center;
            }

            .sidenav {
                height: 100%;
                width: 220px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
                text-align: left;
            }

            .sidenav a {
                padding: 6px 8px 6px 16px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .main {
                margin-left: 220px;
                /* Same as the width of the sidenav */
                font-size: 28px;
                /* Increased text to enable scrolling */
                padding: 0px 10px;
            }

            .sidenav h2 {
                color: #f2f2f2;
                font-weight: bold;
            }

            .block {
                margin-bottom: 10px;
            }

            .error {
                color: red;
                font-weight: bold;
            }

            form {
                text-align: center;
            }

            @import url(https://fonts.googleapis.com/css?family=Open+Sans);

            body {
                background: #f2f2f2;
                font-family: 'Open Sans', sans-serif;
            }

            .search {
                width: 100%;
                display: flex;
                margin: 0px 150px 30px 150px;
            }

            .searchTerm {
                width: 70%;
                border: 3px solid #00B4CC;
                border-right: none;
                padding: 5px;
                height: 50px;
                border-radius: 5px 0 0 5px;
                outline: none;
                color: #9DBFAF;
            }

            .searchTerm:focus {
                color: #00B4CC;
            }

            .searchButton {
                width: 100px;
                height: 50px;
                border: 1px solid #00B4CC;
                background: #00B4CC;
                text-align: center;
                color: #fff;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
                font-size: 20px;
            }
        </style>
    </head>

    <body>
        <div class="sidenav">
            <h2>Quản trị viên</h2>
            <a href="updateadmin.php">Sửa thông tin</a>
            <a href="changepass.php">Đổi mật khẩu</a>
            <a href="logout.php">Đăng xuất</a>
            <h2>Sinh viên</h2>
            <a href="index.php">Danh sách SV</a>
            <a href="addsv.php">Thêm sinh viên</a>
            <a href="searchsv.php">Tìm kiếm SV</a>
            <a href="addlistcsv.php">Thêm DS sinh viên</a>
        </div>
        <div class="main">
            <h3>THÊM DANH SÁCH SINH VIÊN</h3>
            <table id='customers'>
                <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>HỌ TÊN</th>
                    <th>MẬT KHẨU</th>
                    <th>NGÀY SINH</th>
                    <th>GIỚI TÍNH</th>
                    <th>CCCD</th>
                    <th>SĐT</th>
                    <th>NƠI SINH</th>
                    <th>ĐỊA CHỈ</th>
                </tr>
                <?php
                if (isset($dssv)) {
                    $id = 0;
                    foreach ($dssv as $sv) {
                        $id++;
                        echo "<tr>";
                        echo "<td>" . $id . "</td>"; 
                        echo "<td>" . $sv[0] . "</td>";
                        echo "<td>" . $sv[1] . "</td>";
                        echo "<td>" . $sv[2] . "</td>";
                        echo "<td>" . $sv[3] . "</td>";
                        echo "<td>" . $sv[4] . "</td>";
                        echo "<td>" . $sv[5] . "</td>";
                        echo "<td>" . $sv[6] . "</td>";
                        echo "<td>" . $sv[7] . "</td>";
                        echo "<td>" . $sv[8] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Không đọc được file .csv!";
                }
                ?>
            </table>
            <form action="addlistsv.php" method="post" style="margin-top: 10px; border: none;">
                <div class="block" style="float: right;">
                    <a href="<?php echo INDEX_URL . "admin" ?>" name="btnBack">Quay về trang chủ</a>
                    <?php
                    if (isset($dssv)) {
                        echo "<input type='submit' name='btnSubmit' value='Thêm DS sinh viên'>";
                        $_SESSION['dssv'] = $dssv;
                    }
                    ?>
                </div>
            </form>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
?>