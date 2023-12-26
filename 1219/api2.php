<?php
session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$username = $_POST['pseudo'];
$message = $_POST['message'];

$sentdata = $db->prepare('INSERT INTO Chat (pseudo, message) VALUES (:pseudo, :message)');
$sentdata->execute(array(
    'pseudo' => $username,
    'message' => $message
));

$response = $db->query("SELECT * FROM Chat ORDER BY date_created DESC LIMIT 1");
$responseData  = $response->fetch(PDO::FETCH_ASSOC);

echo "<span>" . htmlspecialchars($responseData['pseudo']) . ": </span>";
echo "<span>" . htmlspecialchars($responseData['message']) . "</span>";
echo "<p>" . $responseData['date_created'] . "</p>";
echo "<br>";

$_SESSION['currentmessage'] = $responseData['id'];
