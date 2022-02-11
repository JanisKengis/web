<?php

require 'vendor/autoload.php';

$faker = Faker\Factory::create();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fake person</title>

</head>
<h1>Fake person business card</h1>
<body>
<div style="display:inline-block;vertical-align:top;">
    <img src='<?php echo $faker->imageUrl(120,120) ?>' alt="random picture">
</div>
<div style="display:inline-block;vertical-align:top;">
    <ul style="list-style-type: none">
        <li> Name: <?php echo $faker->name() ?></li>
        <li>Age: <?php echo $faker->randomNumber(2) ?></li>
        <li>Address: <?php echo $faker->address() ?></li>
        <li>E-mail: <?php echo $faker->email() ?></li>
        <li>Phone Number: <?php echo $faker->phoneNumber() ?></li>
    </ul>
</div>
</body>
</html>

