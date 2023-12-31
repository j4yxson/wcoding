<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}


// GETTING DATA FROM POST

$date = $_POST['date'];
$time = $_POST['time'];
$num_of_people = $_POST['people'];
$name = $_POST['name'];
$phone_number = $_POST['phone'];
$confirmationCode = $_POST['confirmation_code']; // getting the confirmation code

if ($num_of_people == 1) {
    $table_name = "bar";
} else if ($num_of_people > 2 && $num_of_people <= 4) {
    $table_name =  "table";
} else if ($num_of_people > 4 && $num_of_people <= 7) {
    $table_name = "booth";
} else $table_name = "party_room";


$findReservation = $db->prepare("UPDATE reservations set date=:date, time=:time,num_of_people:num,table_name=:table_name,reservation_holder=:resHolder,phone_number=:phone,confirmation_code=:confCode where confirmation_code=:confCode");
$findReservation->execute(array(
    'date' => $date,
    'time' => $time,
    'num' => $num_of_people,
    'table_name' => $table_name,
    'resHolder' => $name,
    'phone' => $phone_number,
    'confCode' => $confirmationCode
));

echo "RESERVATION UPDATE COMPLETE";
