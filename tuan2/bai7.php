<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 7</title>
</head>

<body>
  <?php
  function kn(int $n, int $k): int {
    if ($n === $k || $k === 0)
      return 1;
    return kn($n - 1, $k - 1) + kn($n - 1, $k);
  }

  $result = kn(12, 2);

  echo "Tổ hợp chập 2 của 12 là: $result";
  ?>
</body>

</html>