<?php
require_once("../config.php");
session_start();
if (isset($_SESSION['admin'])) { ?>
    <html>

    <head>
        <title>Tìm kiếm sinh viên</title>
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
            <h3>TÌM KIẾM SINH VIÊN</h3>
            <div class="block">
                <span class="error" id="sv_message">
                    <?php
                    if (isset($_SESSION['sv_message'])) {
                        echo $_SESSION['sv_message'];
                    }
                    ?>
                </span>
            </div>
            <form action="searchsv.php" method="GET" class="search">
                <input type="text" name="sv" class="searchTerm" placeholder="Nhập mssv hoặc họ tên sinh viên">
                <button type="submit" class="searchButton">Tìm kiếm</button>
            </form>
            <?php
            if(isset($_REQUEST["sv"])){
                $sv=$_REQUEST["sv"];
                require_once("../connect_db.php");
                $conn = connect_db();
                if ($conn) {
                    $sql = "SELECT * FROM sinh_vien WHERE mssv like '%".$sv."%' OR ho_ten like '%".$sv."%'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table id='customers'>
                                <tr>
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
                        $i=0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $i++;
                            echo "<tr>";
                            echo "<td>" . $i . "</td>"; 
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
                            echo "<td><a href='deletesv.php?mssv=" . $row['mssv'] . "'>Xóa</a></td>";

                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Không tìm thấy sinh viên nào!";
                    }
                }
                mysqli_close($conn);
            }
            ?>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
?>