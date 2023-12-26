<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$inBrand = $_GET['brand'];

$response = $db->query("SELECT brand,model FROM phones where brand='$inBrand'"); // BAD vulnerable to sql injections
$response2 = $db->query('SELECT brand,model FROM phones where brand="Nokia"');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Demo</title>
</head>


<!-- using fetch -->

<body>
    <table border="1">
        <tr>
            <td>Make</td>
            <td>Model</td>
        </tr>
        <?php while ($phone = $response->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?= $phone['brand'] ?></td>
                <td><?= $phone['model'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <!-- using fetchall -->

    <table border="1">
        <tr>
            <td>Make</td>
            <td>Model</td>
        </tr>
        <?php

        $allPhones1 = $response2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones1 as $phone) {
        ?>
            <tr>
                <td><?= $phone['brand'] ?></td>
                <td><?= $phone['model'] ?></td>
            </tr>
        <?php
        } ?>
    </table>
</body>




</html>