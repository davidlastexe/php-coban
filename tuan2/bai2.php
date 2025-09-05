<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bài 2</title>
</head>

<body>
  <?php
  $countryList = ["Tokyo", "Mexico City", "New York City", "Mumbai", "Seoul", "Shanghai", "Lagos", "Buenos Aires", "Cairo", "London"];

  echo "Câu 1:<br>";
  for ($i = 0; $i < count($countryList); $i++) {
    if ($i == count($countryList) - 1) {
      echo "{$countryList[$i]}.";
    }
    else
      echo "{$countryList[$i]}, ";
  }

  echo "<br>";

  echo "Câu 2:<br>";
  sort($countryList);
  $result = "<ul>";
  foreach ($countryList as $country) {
    $result .= "<li>{$country}</li>";
  }
  $result .= "</ul>";

  echo $result;

  echo "Câu 3:<br>";
  array_push($countryList, "Los Angeles", "Calcutta", "Osaka", "Beijing");
  sort($countryList);
  $result = "<ul>";
  foreach ($countryList as $country) {
    $result .= "<li>{$country}</li>";
  }
  $result .= "</ul>";

  echo $result;
  ?>
</body>

</html>