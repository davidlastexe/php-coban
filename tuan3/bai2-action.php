<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 2 Action</title>
</head>

<body>
  <h1>Thông tin đã nhận được</h1>
  <?php
  if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";

    $countryList = [
      "hanoi" => "Hà Nội",
      "hochiminh" => "Hồ Chí Minh",
      "vungtau" => "Vũng Tàu",
    ];

    $gioiTinh = $_REQUEST["gioiTinh"] === "male" ? "Nam" : "Nữ";
    $country = $countryList[$_REQUEST["country"]];
    $programming_language = "";

    foreach ($_REQUEST["programming_language"] as $item) {
      $programming_language .= $item;
    }

    $result = "
      <div>
        <p>MSSV: {$_REQUEST["mssv"]}</p>
        <p>Họ tên: {$_REQUEST["fullName"]}</p>
        <p>Giới tính: {$gioiTinh}</p>
        <p>Ngôn ngữ lập trình: {$programming_language}</p>
        <p>Thành phố: {$country}</p>
        <p>Tin nhắn: {$_REQUEST["message"]}</p>
      </div>
    ";

    echo $result;
  }
  ?>
</body>

</html>