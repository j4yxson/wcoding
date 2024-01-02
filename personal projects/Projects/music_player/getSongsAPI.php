<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$songs = $db->prepare('SELECT * FROM spotify');
$songs->execute();
$results = $songs->fetchAll(PDO::FETCH_ASSOC);

// foreach ($results as $result) {
//     echo "title: " . $result['song_title'] . "<br>" . "artist: " . $result['artist'] . "<br>" . "<br>";
// }
$jsonData = json_encode($results);
header('Content-Type: application/json');
echo $jsonData;
