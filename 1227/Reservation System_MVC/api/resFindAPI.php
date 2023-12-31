<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

// GETTING DATA FROM POST
$confirmationCode = $_POST['confirmation_code']; // getting the confirmation code


$findReservation = $db->prepare("SELECT * FROM reservations where confirmation_code=:confirm");
$findReservation->execute(array(
    'confirm' => $confirmationCode
));
$results = $findReservation->fetch(PDO::FETCH_ASSOC);

if ($results) {
    echo "Reservation Holder: " . $results['reservation_holder'] . "<br>";
    echo "Phone Number: " . $results['phone_number'] . "<br>";
    echo "Confirmation Code: " . $results['confirmation_code'] . "<br>";
    echo "<br>";
    // $results;
} else echo "A Reservation with that Confirmation Code does not Exist";
