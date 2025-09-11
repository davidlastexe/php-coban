<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 1</title>
</head>
<body>
  <?php
    echo "<p>{$_SERVER["HTTP_X_REAL_IP"]}</p>";
    echo "<p>{$_SERVER["HTTP_X_FORWARDED_FOR"]}</p>";
    echo "<p>{$_SERVER["REMOTE_ADDR"]}</p>";
  ?>
</body>
</html>