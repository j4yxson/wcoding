<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

//Q1
$q1 = $db->query('SELECT upper(brand) AS UPPER_BRAND, lower(model) AS lower_model FROM Phones');

echo "UPPER_BRAND" . " " . "lower_model" . "\n" . "<br>";
// while ($q1Res = $q1->fetch(PDO::FETCH_ASSOC)) {
//     echo $q1Res['UPPER_BRAND'] . '<br />';
// }

$q1Res = $q1->fetchAll(PDO::FETCH_ASSOC);
foreach ($q1Res as $res) {
    echo $res['UPPER_BRAND'] . '         ' . $res['lower_model'] . '<br>';
}
echo "<br>";

//Q2
$q2 = $db->query('SELECT CONCAT(owner, " ----- ", model, "(", brand, ")", price, "$") AS "Phone List" FROM Phones');
$q2Res = $q2->fetchAll(PDO::FETCH_ASSOC);

echo "Phone List" . "<br>";
foreach ($q2Res as $res) {
    echo $res["Phone List"] . "<br>";
}
echo "<br>";

//Q3
$q3 = $db->query('SELECT model, LENGTH(comment) AS "COMMENT LENGTH" FROM Phones');
$q3Res = $q3->fetchAll(PDO::FETCH_ASSOC);

echo "model" . " " . "comment length" . "<br>";
foreach ($q2Res as $res) {
    echo $res["Phone List"] . "<br>";
}
echo "<br>";

//Q4
$q4 = $db->query('SELECT AVG(weight) AS "Average Weight" FROM Phones where owner="Brad"');
$q4Res = $q4->fetch(PDO::FETCH_ASSOC);

echo "Average Weight of Brad's Phones" . "<br>";
echo $q4Res['Average Weight'] . "<br>" . "<br>";

//Q5
$q5 = $db->query('SELECT SUM(price) AS "TOTAL PRICE", owner FROM Phones where owner in ("Brad", "Roland") GROUP BY OWNER');
$q5Res = $q5->fetchAll(PDO::FETCH_ASSOC);

echo "owner" . " " . "total price" . "<br>";
foreach ($q5Res as $res) {
    echo $res['owner'] . " " . $res["TOTAL PRICE"] . "<br>";
}
echo "<br>";


//Q6
$q6 = $db->query('SELECT MAX(price) as max_price from phones where owner="richard"');
$q6Res = $q6->fetch(PDO::FETCH_ASSOC);

echo "PRICE OF RICHARDS MOST EXPENSIVE PHONE" . "<br>";
echo $q6Res['max_price'] . "<br>" . "<br>";

//Q7
$q7 = $db->query('SELECT MIN(price) as min_price from phones where owner="frank"');
$q7Res = $q7->fetch(PDO::FETCH_ASSOC);

echo "PRICE OF FRANKS MOST CHEAP PHONE" . "<br>";
echo $q7Res['min_price'] . "<br>" . "<br>";

//Q8
$q8 = $db->query('SELECT COUNT(*) AS "total_amount",owner from phones where owner in ("brad","stacy") group by owner');
$q8Res = $q8->fetchAll(PDO::FETCH_ASSOC);

echo "owner" . " " . "total amount" . "<br>";
foreach ($q8Res as $res) {
    echo $res['owner'] . " " . $res["total_amount"] . "<br>";
}
echo "<br>" . "<br>";

//Q9
$q9 = $db->query('SELECT COUNT(*) AS "total_amount",owner from phones group by owner');
$q9Res = $q9->fetchAll(PDO::FETCH_ASSOC);

echo "owner" . " " . "total amount" . "<br>";
foreach ($q9Res as $res) {
    echo $res['owner'] . " " . $res["total_amount"] . "<br>";
}
echo "<br>" . "<br>";

//Q10
$q10 = $db->query('SELECT COUNT(*) AS "total_amount",brand from phones group by brand');
$q10Res = $q10->fetchAll(PDO::FETCH_ASSOC);

echo "owner" . " " . "total amount" . "<br>";
foreach ($q10Res as $res) {
    echo $res['brand'] . " " . $res["total_amount"] . "<br>";
}
echo "<br>" . "<br>";

//Q11
$q11 = $db->query('SELECT AVG(price) AS avg_price, brand, count(*) AS phone_amount from phones group by brand having avg_price <125');
$q11Res = $q11->fetchAll(PDO::FETCH_ASSOC);

echo "brand" . " " . "average price" . " " . "phone amount" . "<br>";
foreach ($q11Res as $res) {
    echo $res['brand'] . " " . $res["avg_price"] . " " . $res["phone_amount"] . "<br>";
}
echo "<br>" . "<br>";

//Q12
$q12 = $db->query('SELECT count(*) AS phone_amount, brand from phones where weight>175 group by brand having phone_amount > 3 ');
$q12Res = $q12->fetchAll(PDO::FETCH_ASSOC);

echo "brand " . "phone amount" . "<br>";
foreach ($q12Res as $res) {
    echo $res['brand'] . " " . $res['phone_amount'] . " ";
}
