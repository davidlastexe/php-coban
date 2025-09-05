<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 4</title>

  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    td {
      width: 30px;
      height: 30px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  $result = "<table>";
  for ($i = 0; $i < 8; $i++) {
    $result .= "<tr>";
    for ($j = 0; $j < 8; $j++) {
      $color = (($i + $j) % 2 !== 0) ? "black" : "white";
      $result .= "<td style='background-color: $color;'></td>";
    }
    $result .= "</tr>";
  }
  $result .= "</table>";

  echo $result;
  ?>
</body>

</html>