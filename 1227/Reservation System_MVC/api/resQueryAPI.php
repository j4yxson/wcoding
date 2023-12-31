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


// querying for EXISTING reservations using variables above
$reservations = $db->prepare("SELECT * FROM reservations WHERE date=:dateVal AND time=:timeVal AND table_name=:seatingVal");
$reservations->execute(array(
    'dateVal' => $dateVal,
    'timeVal' => $timeVal,
    'seatingVal' => $seatingVal
));

// Fetch the results, you can use fetch methods such as fetch(), fetchAll(), etc.


//$takenReservationsNumber returns a numerical value
$takenReservationsNumber = $reservations->rowCount();


// next have to write conditionals based off number of rows returned and seating
// basically my seating takes care of the # of guests for me
// i have 4 4 tops, 2, 6 tops, 6 1 tops, and 1 12 top

if ($seatingVal == "bar" && $takenReservationsNumber < 6) {
    echo (6 - $takenReservationsNumber);
} else if ($seatingVal == "table" && $takenReservationsNumber < 4) {
    echo (4 - $takenReservationsNumber);
} else if ($seatingVal == "booth" && $takenReservationsNumber < 2) {
    echo (2 - $takenReservationsNumber);
} else if ($seatingVal == "party_room" && $takenReservationsNumber < 1) {
    echo (1 - $takenReservationsNumber);
} else echo "No Reservations Currently Available";
