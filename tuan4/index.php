<?php
require_once 'connect.php';
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h2>Danh sách các tài khoản quản trị viên</h2>

    <table>
        <tr>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Email</th>
            <th>Họ tên</th>
            <th>Câu lạc bộ</th>
            <th></th>
        </tr>
        <?php
        $result = getAll("SELECT * FROM `admins`");
        $htmlFinal = "";
        foreach($result as $key => $value) {
            //$html = "<tr>";

            $username = $value["username"];
            $password = $value["password"];
            $email = $value["email"];
            $fullname = $value["fullname"];
            $club = $value["club_id"] == 1 ? 'Âm nhạc' : 'Công nghệ thông tin';
            
            $html .= "<tr><td>{$username}</td>"."<td>{$password}</td>"."<td>{$email}</td>"."<td>{$fullname}</td>"."<td>{$club}</td>";
            $htmlFinal .= $html;
            $htmlFinal .= "<td><a href=\"#\">Sửa</a> | <a href=\"#\">Xoá</a></td>";
        }
        echo $htmlFinal;
        ?>
    </table>
</body>

</html>