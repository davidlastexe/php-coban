<?php
require_once "../connect_db.php";

if (!isset($_COOKIE["success"]))
    header("location:login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h3>DANH SÁCH SINH VIÊN</h3>
        <div class="block">
            <span class="error" id="sv_message">
            </span>
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
            $sql = "select * from `sinh_vien`";
            $stm = $connect->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $k => $row) {
                echo "<tr>";
                echo "<td>" . $k + 1 . "</td>";
                echo "<td>" . $row["mssv"] . "</td>";
                echo "<td>" . $row["ho_ten"] . "</td>";
                echo "<td>" . date("d-m-Y", strtotime($row["ngay_sinh"])) . "</td>";
                echo "<td>";
                if ($row["gioi_tinh"] == "0") {
                    echo "Nam";
                } else {
                    echo "Nữ";
                }
                echo "</td>";
                echo "<td>" . $row["cccd"] . "</td>";
                echo "<td>" . $row["sdt"] . "</td>";
                echo "<td>" . $row["noi_sinh"] . "</td>";
                echo "<td>" . $row["dia_chi"] . "</td>";
                echo "<td><a href='updatesv.php?mssv=" . $row['mssv'] . "'>Sửa</a></td>";
                echo "<td><a href='deletesv.php?mssv=" . $row['mssv'] . "'";
                echo "onclick=\"return confirm('Bạn có chắc muốn xóa sinh viên " . $row['ho_ten'] . "(" . $row['mssv'] . ")?')\"";
                echo ">Xóa</a></td>";

                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>