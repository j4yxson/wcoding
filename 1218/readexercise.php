<?php
error_reporting(E_ALL);
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
};

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

//Q1
$response = $db->prepare('SELECT model,brand,owner,price FROM phones where owner="Stacy"');
$response->execute();

//Q2
$response2 = $db->prepare('SELECT model,brand,weight,owner,price FROM phones where weight=295');
$response2->execute();

//Q3
$response3 = $db->prepare('SELECT model,brand,owner,price FROM phones where brand="Nokia"');
$response3->execute();

//Q4
$response4 = $db->prepare('SELECT model,brand,owner,price FROM phones where brand="Nokia" OR brand="Apple"');
$response4->execute();

//Q5
$response5 = $db->prepare('SELECT model,brand,owner,price FROM phones where price=115');
$response5->execute();

//Q6
$response6 = $db->prepare('SELECT model,brand,owner,weight,price FROM phones ORDER BY weight ASC LIMIT 5');
$response6->execute();

//Q7
$response7 = $db->prepare('SELECT model,brand,owner,price FROM phones where owner="Victoria" LIMIT 5');
$response7->execute();

//Q8
$response8 = $db->prepare('SELECT model,brand,owner,price FROM phones where owner="Nina" AND weight <295 order by price DESC LIMIT 5');
$response8->execute();

// MARKERS SECTION
//Q1,Q2,Q3,Q5
$owner = $_GET['owner'];
$model = $_GET['model'];
$price = $_GET['price'];
$weight = $_GET['weight'];
$brand = $_GET['brand'];
$response10 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where owner=? OR model=? OR price=? OR weight=? OR brand=?');
$response10->execute(array($owner, $model, $price, $weight, $brand));

//Q4 bind with an if(isset()) to make sure it doesn't run without a given value. if brand wasn't specified the select statements turns into brand in (), which errors out in sql
// $brands = isset($_GET['brand']) ? explode(',', $_GET['brand']) : []; // explode creates an array of the brands csv because were having the brand parameters being taken in by commas ex. brand=nokia,apple
// $response11 = $db->prepare('SELECT owner, model, price, weight, brand FROM phones WHERE brand IN (' . implode(',', array_fill(0, count($brands), '?')) . ')'); //  <= ex ("apple","nokia") implode creates string from array
// $response11->execute($brands);
// print_r($brands);

//Q7 WORKS NOW BY BINDING THE LIMIT PARAMETER TO AN INTEGER
// $limit = ($_GET['limit']);

// $response12 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where owner=? LIMIT ?');
// // $response12->execute(array($owner, $limit));
// $response12->bindValue(1, $owner); // 1 based
// $response12->bindValue(2, $limit, PDO::PARAM_INT); // keeping limit as an int
// $response12->execute(); //prebinded so don't have to specify

//Q8
// $response13 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where owner=? AND price=? ORDER BY price DESC');
// $response13->execute(array($owner, $price));

//Nominative Markers Section
//Q1 = All phones from Stacy
$response20 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where owner=:owner');
$response20->execute(array('owner' => $owner));

//Q2 = All phones w/ weight of 295g
$response21 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where weight=:weight');
$response21->execute(array('weight' => $weight));

//Q3 = All phones brand = Nokia
$response22 = $db->prepare('SELECT owner,model,price,weight,brand FROM phones where brand=:brand');
$response22->execute(array('brand' => $brand));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Exercise using SQL</title>
</head>

<body>
    <ul>
        <?php

        $allPhones = $response->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>

        <br>

        <?php

        $allPhones2 = $response2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones2 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone['weight'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        $allPhones3 = $response3->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones3 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>


        <?php

        $allPhones4 = $response4->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones4 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        $allPhones5 = $response5->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones5 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>


        <?php

        $allPhones6 = $response6->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones6 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone['weight'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        $allPhones7 = $response7->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones7 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        $allPhones8 = $response8->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones8 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>
        <h3> ? Markers </h3>
        <!-- ? markers section -->

        <?php

        $allPhones10 = $response10->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones10 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        // $allPhones11 = $response11->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($allPhones11 as $phone) {
        ?>
        <li>Model: Question 7 with Markers<?php
                                            //  $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" 
                                            ?>
        </li>
        <?php
        // } 
        ?>
        <br>

        <?php

        // $allPhones12 = $response12->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($allPhones12 as $phone) {
        ?>
        <li>Model: Question 8 with Markers (using limits)
            <?php
            // $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" 
            ?></li>
        <?php
        // } 
        ?>
        <br>

        <!-- nominative markers section -->
        <h3> Nominative Markers </h3>

        <?php

        $allPhones20 = $response20->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones20 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

        <?php

        $allPhones21 = $response21->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones21 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>


        <?php

        $allPhones22 = $response22->fetchAll(PDO::FETCH_ASSOC);
        foreach ($allPhones22 as $phone) {
        ?>
            <li>Model: <?= $phone['model'] . " Brand: " . $phone['brand'] . " Weight: " . $phone["weight"] . " Owned by: " . $phone['owner'] . " Price: " . "(" . $phone['price'] . ")" ?></li>
        <?php
        } ?>
        <br>

    </ul>
</body>


</html>