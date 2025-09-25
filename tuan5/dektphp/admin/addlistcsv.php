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
            <a href="addlistsv.php">Thêm DS sinh viên</a>
        </div>
        <div class="main">
            <h3>THÊM DANH SÁCH SINH VIÊN</h3>
            <form action="addlistsv.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <h4>Chọn file CSV danh sách sinh viên</h4>
                <input type="file" class="custom-file-input" id="file" name="file" accept=".csv">
                <button type="submit" class="btn btn-primary" id="btnSubmitImport" name="btnSubmitImport" class="btn-submit">Upload</button>
            </form>
            <div class="col-lg-6">
                <h3>Định dạng File Upload</h3>
                <ul>
                    <li>File upload phải có đuôi mở rộng là <strong>".csv"</strong></li>
                    <li>Các cột trong file phải được phân tách bởi dấu <strong>phẩy ","</strong></li>
                    <li>Các cột trong file:
                        <ul>
                            <li><strong>mssv</strong>: Cột lưu MSSV của sinh viên, có độ dài tối đa là 13 ký tự</li>
                            <li><strong>hoten</strong>: Cột lưu họ và tên của sinh viên</li>
                            <li><strong>ngaysinh</strong>: Cột lưu ngày sinh của sinh viên và có định dạng "dd/mm/yyyy". Ví dụ: 29/01/2000</li>
                        </ul>
                    </li>
                    <li><a href="<?=INDEX_URL?>file/dssv.csv">File mẫu</a></li>
                </ul>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: " . INDEX_URL . "admin/login.php");
    exit();
}
?>