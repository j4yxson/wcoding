<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$confirmation_code = $_POST['confirmationCode'];

$reservation = $db->prepare("DELETE FROM reservations where confirmation_code=:confirmation_code");
$reservation->execute(array(
    'confirmation_code' => $confirmation_code
));

echo "Reservation Cancelled";
