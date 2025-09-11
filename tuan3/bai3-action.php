<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 3 action</title>
</head>

<body>
  <?php
  if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    $current_year = date("Y");
    $yearOlds = $current_year - $_POST["yearOfBirth"];

    $result = "
      <div>
        <p>Chào mừng bạn {$_POST["fullName"]}!</p>
        <p>Bạn có tuổi là {$yearOlds}.</p>
      </div>
    ";

    echo $result;
  }
  ?>
</body>

</html>