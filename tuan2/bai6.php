<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 6</title>
</head>

<body>
  <?php
  function ucln(int $a, int $b): int {
    while ($b !== 0) {
      $r = $a % $b;
      $a = $b;
      $b = $r;
    }
    return $a;
  }

  function bcnn(int $a, int $b): int {
    return $a * $b / ucln($a, $b);
  }

  $result = bcnn(5, 10);

  echo "Bội chung nhỏ nhất của 5,10 là: $result";
  ?>
</body>

</html>