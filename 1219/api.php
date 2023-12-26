<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$count = $_POST['count']; // in our AJAX request we pushed the count depending on the value of the radio selected
$response = $db->query("SELECT pseudo, message, date_created FROM Chat ORDER BY date_created DESC LIMIT $count");
$responseData  = $response->fetchAll();
$responseData = array_reverse($responseData);

foreach ($responseData as $response) {
    echo "<div>";
    echo "<span>" . htmlspecialchars($response['pseudo']) . ": </span>";
    echo "<span>" . htmlspecialchars($response['message']) . "</span>";
    echo "<p>" . $response['date_created'] . "</p>";
    echo "</div><br>";
}
