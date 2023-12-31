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



$newReservation = $db->prepare("INSERT INTO reservations (date, time, num_of_people, table_name,reservation_holder, phone_number) VALUES ('$dateVal','$timeVal','$patronsVal','$seatingVal','$reservationHolderVal','$phoneNumberVal')");
$newReservation->execute();

echo "RESERVATION CONFIRMED";
