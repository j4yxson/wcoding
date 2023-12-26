<?php
session_start();


try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}


$currentmessage = $_GET['lastmessage'];

$newMessages = $db->prepare("SELECT * FROM chat ORDER BY date_created DESC WHERE id > $currentmessage ");
$newMessages->execute();

$responses = $newMessages->fetchAll(PDO::FETCH_ASSOC);

foreach ($responses as $response) {
    echo "<span>" . htmlspecialchars($response['pseudo']) . ": </span>";
    echo "<span>" . htmlspecialchars($response['message']) . "</span>";
    echo "<p>" . $response['date_created'] . "</p>";
    echo "<br>";
}

$newestmessageID = $response['id'];

$_SESSION['currentmessage'] = $newestmessageID;
