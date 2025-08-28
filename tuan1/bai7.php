<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 7</title>

  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
      background-color: yellow;
    }

    td {
      width: 70px;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  $result = "<table>";
  for ($i = 1; $i <= 7; $i++) {
    $result .= "<tr>";
    for ($j = 1; $j <= 7; $j++) {
      $data = $i * $j;
      $result .= "<td>$data</td>";
    }
    $result .= "</tr>";
  }
  $result .= "</table>";

  echo $result;
  ?>
</body>

</html>