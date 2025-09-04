<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3</title>
</head>
<body>
    <?php 
        $countryList = ["Italy" => "Rome", "Luxembourg" => "Luxembourg", "Belgium" => "Brussels", "Denmark" => "Copenhagen",
"Finland" => "Helsinki", "France" => "Paris", "Slovakia" => "Bratislava",
"Slovenia" => "Ljubljana", "Germany" => "Berlin", "Greece" => "Athens",
"Ireland" => "Dublin", "Netherlands" => "Amsterdam", "Austria" => "Vienna",
"Poland" => "Warsaw"];
        foreach($countryList as $country => $capital) {
            echo "Thủ đô của {$country} là {$capital}.<br>";
        }
    ?>
</body>
</html>