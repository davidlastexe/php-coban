<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 4 action</title>
</head>

<body>
  <?php
  if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    $numberOne = $_POST["numberOne"];
    $numberTwo = $_POST["numberTwo"];
    $operator = $_POST["operator"];

    $operator_symbol = [
      "add" => "+",
      "subtract" => "-",
      "multiply" => "*",
      "divide" => "/",
    ];

    $calculator = [
      "add" => $numberOne + $numberTwo,
      "subtract" => $numberOne - $numberTwo,
      "multiply" => $numberOne * $numberTwo,
      "divide" => $numberOne / $numberTwo,
    ];

    $result = "{$numberOne}{$operator_symbol[$operator]}{$numberTwo}={$calculator[$operator]}.";

    echo $result;
  }
  ?>

</body>

</html>