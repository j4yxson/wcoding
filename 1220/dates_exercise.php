<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

// Question 1 : Select messages for which the date is today 

$q1 = $db->query('SELECT message,date_created FROM chat WHERE DATE(date_created) =  CURDATE()');
$q1Res = $q1->fetchAll(PDO::FETCH_ASSOC);

foreach ($q1Res as $res) {
    echo $res['message'] . " " . $res['date_created'] . "<br>" . "<br>";
}


// Question 2 : Select messages from a specific time

$q2 = $db->prepare('SELECT message, date_created FROM chat where date_created="2023-12-21 10:19:30"'); // SQL statement
$q2->execute(); //executing the prepare
$result = $q2->fetch(PDO::FETCH_ASSOC); // fetching the result

echo $result['message'] . " " . $result['date_created'] . "<br>"; //echoing out the result

// Question 3 : Select messages with a date between hours

$q3 = $db->prepare('SELECT message,hour(date_created) as hour from chat where hour(date_created) between "10:00" and "11:00"');
$q3->execute();
$resultq3 = $q3->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultq3 as $result) {
    echo $result['message'] . " " . $result['hour'] . "<br>";
}

// Question 4 :  insert messages as if it was from 2 days ago


// if ($db->query('SELECT * FROM phones WHERE date_created="2023-12-19 13:13:13"')->rowCount() == 0) {
//     $q3 = $db->prepare('INSERT INTO chat (pseudo,message,date_created) VALUES (:pseudo,:message,:date_created)');
//     $q3->execute(array(
//         'pseudo' => 'jason',
//         'message' => 'this message was from 2 days ago',
//         'date_created' => '2023-12-19 13:13:13'
//     ));
// };

// Question 5 : Retrieve the messages from 2 days ago
echo "<br>";

$q5 = $db->prepare('SELECT message,day(date_created) as day from chat where day(date_created) ="19"');
$q5->execute();
$resultq5 = $q5->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultq5 as $result) {
    echo $result['message'] . " " . $result['day'] . "<br>";
}

// Question 6 : Retrieve the messages from 2 days ago with a specific time
echo "<br>";

$q6 = $db->prepare('SELECT message,date_created from chat where day(date_created) = "19" AND time(date_created) = "13:13:13"');
$q6->execute();
$resultq6 = $q6->fetch(PDO::FETCH_ASSOC);

echo $resultq6['message'] . " " . $resultq6['date_created'];

// Question 7 : Change the date format (DAY/MONTH/YEAR) and display the first 20 messages without the DATE_FORMAT function

$q7 = $db->prepare('SELECT message, day(date_created) as day, month(date_created) as month, year(date_created) as year from chat limit 5');
$q7->execute();
$resultq7 = $q7->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultq7 as $result) {
    echo $result['message'] . " " . "(" . $result['day'] . "/" . $result['month'] . "/" . $result['year'] . ")" . "<br>";
}

// Question 8: Change the date format (DAY/MONTH/YEAR) and display the first 15 messages with the DATE_FORMAT function
echo "<br>";

$q8 = $db->prepare('SELECT message, date_format(date_created, "%d/%m/%Y") as formatted_date from chat limit 5');
$q8->execute();
$resultq8 = $q8->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultq8 as $result) {
    echo $result['message'] . " " . $result['formatted_date'] . "<br>";
}

// Question 9 : Add an expiration date to your messages (2 months after the date added)

// $q9part1 = $db->exec('ALTER TABLE chat ADD expiration_date datetime'); //creating additional column

$date_created = $db->prepare('SELECT date_created as og_date, DATE_ADD(date_created, INTERVAL 2 MONTH) as expiration_date from chat');
$date_created->execute();
$result1 = $date_created->fetchAll(PDO::FETCH_ASSOC);

foreach ($result1 as $result) {
    $q9part2 = $db->prepare('UPDATE chat SET expiration_date = :expiration_date WHERE date_created = :og_date');
    $q9part2->execute(array(
        'expiration_date' => $result['expiration_date'],
        'og_date' => $result['og_date']
    ));
};






// → update every fields into the database with a request (not manually).

// your chatbox practical work should still work the same and manage also this expiration date when we type a new message.