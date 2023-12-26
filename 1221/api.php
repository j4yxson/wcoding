<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}


// Getting the data from the post
// Data is being pushed when I hit the submit button
$comment = $_POST['comment']; // receiving comment
$author = $_POST['username']; // receiving username
$articleid = $_POST['articleid']; // receiving article id

$newComment = $db->prepare('INSERT INTO comments (article_id, author,comment) VALUES (:articleid, :author, :comment)');
$newComment->execute(array(
    'articleid' => $articleid,
    'author' => $author,
    'comment' => $comment
));
