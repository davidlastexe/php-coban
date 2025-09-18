<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm quản trị viên</title>
    <style>
        .form {
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-item {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">
        <h1>Thêm mới quản trị viên</h1>
        <form action="add.php" method="post" class="form">
            <div class="form-item">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-item">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-item">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-item">
                <label for="fullname">Họ tên:</label>
                <input type="text" name="fullname" id="fullname">
            </div>
            <div class="form-item">
                <label for="club_id">Câu lạc bộ:</label>
                <select name="club_id" id="clubs">
                    <option value="1">Âm nhạc</option>
                    <option value="2">Công nghệ thông tin</option>
                </select>
            </div>
            <div class="form-item">
                <label></label>
                <button>Thêm mới</button>
            </div>
        </form>
    </div>
</body>

</html>