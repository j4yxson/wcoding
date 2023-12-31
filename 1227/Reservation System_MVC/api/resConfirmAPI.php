<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

// GETTING DATA FROM POST
$dateVal = $_POST['date']; // getting the date input
$timeVal = $_POST['time']; // getting the time input
$patronsVal = $_POST['patrons']; // getting the num of guests
$seatingVal = $_POST['seating']; // getting the table they're sitting at
$reservationHolderVal = $_POST['name']; // getting reservation holder name
$phoneNumberVal = $_POST['phone'];


// echo $dateVal . "<br>";
// echo $timeVal . "<br>";
// echo $patronsVal . "<br>";
// echo $seatingVal . "<br>";
// echo $reservationHolderVal . "<br>";
// echo $phoneNumberVal . "<br>";



$newReservation = $db->prepare("INSERT INTO reservations (date, time, num_of_people, table_name,reservation_holder, phone_number,confirmation_code) VALUES (:dateVal, :timeVal, :patronsVal, :seatingVal, :nameVal, :phoneVal,(SUBSTRING(CONCAT(MD5(RAND()), MD5(RAND())), 1, 8)))");
$newReservation->execute(array(
    'dateVal' => $dateVal,
    'timeVal' => $timeVal,
    'patronsVal' => $patronsVal,
    'seatingVal' => $seatingVal,
    'nameVal' => $reservationHolderVal,
    'phoneVal' => $phoneNumberVal
));

$findReservation = $db->prepare("SELECT * FROM reservations WHERE reservation_holder=:name AND phone_number=:phone");
$findReservation->execute(array(
    'name' => $reservationHolderVal,
    'phone' => $phoneNumberVal
));

$confirmationCode = $findReservation->fetch(PDO::FETCH_ASSOC);
echo "RESERVATION CONFIRMED" . "<br>" . "CONFIRMATION CODE: " . $confirmationCode['confirmation_code'];
