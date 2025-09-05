<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 5</title>
</head>

<body>
  <?php
  $result = 0;
  function isPrime(int $n): bool {
    if ($n < 2)
      return FALSE;
    for ($i = 2; $i <= sqrt(num: $n); $i++) {
      if ($n % $i == 0)
        return FALSE;
    }
    return TRUE;
  }
  for ($i = 0; $i <= 9999; ++$i) {
    if (isPrime(n: $i))
      $result += $i;
  }

  echo "Tổng các số nguyên tố từ 1 đến 9999 là: $result";
  ?>
</body>

</html>