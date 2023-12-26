<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
// PART1

//Q1 WORKS
// $q1 = $db->prepare('SELECT Phones.model, owners.firstname FROM phones,owners where phones.owner_id = owners.id');
// $q1->execute();
// $q1result = $q1->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q1result as $result) {
//     echo $result['firstname'] . " - " . $result['model'] . "<br>";
// }

//Q2 WORKS

// $q2 = $db->prepare('SELECT Phones.model, owners.firstname FROM owners INNER JOIN phones on owners.id = phones.owner_id');
// $q2->execute();
// $q2result = $q2->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q2result as $result) {
//     echo $result['firstname'] . " - " . $result['model'] . "<br>";
// }

//Q3 WORKS

// $q3 = $db->prepare('SELECT Phones.model, owners.firstname FROM owners LEFT JOIN phones on owners.id = phones.owner_id');
// $q3->execute();
// $q3result = $q3->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q3result as $result) {
//     echo $result['firstname'] . " - " . $result['model'] . "<br>";
// }

//Q4 WORKS

// $q4 = $db->prepare('SELECT Phones.model, owners.firstname FROM phones right JOIN owners on phones.owner_id = owners.id');
// $q4->execute();
// $q4result = $q4->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q4result as $result) {
//     echo $result['firstname'] . " - " . $result['model'] . "<br>";
// }


//PART 2

//Q1 WORKS

// $q1 = $db->prepare('SELECT Phones.model, brand.brand_name FROM phones,brand where phones.brand_id = brand.id');
// $q1->execute();
// $q1result = $q1->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q1result as $result) {
//     echo $result['model'] . " - " . $result['brand_name'] . "<br>";
// }

//Q2 WORKS

// $q2 = $db->prepare('SELECT Phones.model, brand.brand_name FROM phones INNER JOIN brand on phones.brand_id = brand.id');
// $q2->execute();
// $q2result = $q2->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q2result as $result) {
//     echo $result['model'] . " - " . $result['brand_name'] . "<br>";
// }

//Q3 WORKS 

// $q3 = $db->prepare('SELECT Phones.model, brand.brand_name FROM phones LEFT JOIN brand on phones.brand_id = brand.id');
// $q3->execute();
// $q3result = $q3->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q3result as $result) {
//     echo $result['model'] . " - " . $result['brand_name'] . "<br>";
// }

//Q4 WORKS

// $q4 = $db->prepare('SELECT Phones.model, brand.brand_name FROM brand right JOIN phones on brand.id = phones.brand_id');
// $q4->execute();
// $q4result = $q4->fetchAll(PDO::FETCH_ASSOC);

// foreach ($q4result as $result) {
//     echo $result['model'] . " - " . $result['brand_name'] . "<br>";
// }
