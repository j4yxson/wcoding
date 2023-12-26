<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$articleID = $_POST['articleid'];

$currentCommentPage = $_POST['commentpage'];

if ($currentCommentPage !== 1) {
    $offset = ($currentCommentPage - 1) * 5;
} else $offset = 0;

$newComments = $db->prepare("SELECT * FROM comments where article_id = $articleID order by date_created desc limit 5 offset $offset");
$newComments->execute();
$newResults = $newComments->fetchAll(PDO::FETCH_ASSOC);

foreach ($newResults as $result) {
    echo '<div class="comment">';
    echo '<div class="author">' . $result['author'] . '</div>';
    echo '<div class="commenttime">' . $result['date_created'] . '</div>';
    echo '<br>';
    echo '<div class="commentdesc">' . $result['comment'] . '</div>';
    echo '<br>';
    echo '</div>';
}
