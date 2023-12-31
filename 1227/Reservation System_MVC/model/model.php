<?php
// SHOULD ONLY RETURN STANDARD PHP DATA STRUCTURES



//querying database for existing reservations
function getExistingReservations()
{
    $db = dbConnect();
    // GETTING DATA FROM POST
    $dateVal = $_POST['date']; // getting the date input
    $timeVal = $_POST['time']; // getting the time input
    $patronsVal = $_POST['patrons']; // getting the num of guests
    $seatingVal = $_POST['seating']; // getting the table they're sitting at
    // querying for EXISTING reservations using variables above
    $reservations = $db->prepare("SELECT * FROM reservations where date='$dateVal' AND time='$timeVal' AND table_name='$seatingVal'");
    $reservations->execute();

    //$takenReservationsNumber returns a numerical value
    $takenReservationsNumber = $reservations->rowCount();


    // next have to write conditionals based off number of rows returned and seating
    // basically my seating takes care of the # of guests for me
    // i have 4 4 tops, 2, 6 tops, 6 1 tops, and 1 12 top
    $available = NULL;

    if ($seatingVal == "bar" && $takenReservationsNumber < 6) {
        $available = (6 - $takenReservationsNumber);
        return $available;
    } else if ($seatingVal == "table" && $takenReservationsNumber < 4) {
        $available = (4 - $takenReservationsNumber);
        return $available;
    } else if ($seatingVal == "booth" && $takenReservationsNumber < 2) {
        $available = (2 - $takenReservationsNumber);
        return $available;
    } else if ($seatingVal == "party_room" && $takenReservationsNumber < 1) {
        $available = (1 - $takenReservationsNumber);
        return $available;
    } else {
        $notavailable = "No Reservations Currently Available";
        return $notavailable;
    }
}

//confirming reservations and pushing into database
function confirmReservation()
{
    $db = dbConnect();
    // GETTING DATA FROM POST
    $dateVal = $_POST['date']; // getting the date input
    $timeVal = $_POST['time']; // getting the time input
    $patronsVal = $_POST['patrons']; // getting the num of guests
    $seatingVal = $_POST['seating']; // getting the table they're sitting at
    $reservationHolderVal = $_POST['name']; // getting reservation holder name
    $phoneNumberVal = $_POST['phone'];

    $newReservation = $db->prepare("INSERT INTO reservations (date, time, num_of_people, table_name,reservation_holder, phone_number) VALUES ('$dateVal','$timeVal','$patronsVal','$seatingVal','$reservationHolderVal','$phoneNumberVal')");
    $newReservation->execute();

    $confirmed = 'RESERVATION CONFIRMED';

    return $confirmed;
}


// connecting to the database
function dbConnect()
{
    try {
        return new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
};
