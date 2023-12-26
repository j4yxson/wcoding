<?php


try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

//Q1 insert an entry without prepared queries
if ($db->query('SELECT * FROM Phones WHERE owner="Alexis"')->rowCount() == 0) {
    $db->exec('INSERT INTO Phones (brand, model, owner, weight, comment, price) VALUES ("Samsung", "s8", "Alexis", 173, "Good for watching videos", 80)');
}

//Q2 insert an entry using prepared queries
if ($db->query('SELECT * FROM Phones WHERE model="iPhone 12"')->rowCount() == 0) {
    $response =  $db->prepare('INSERT INTO Phones (brand, model, owner, weight, comment, price) VALUES (:brand, :model, :owner, :weight, :comment, :price)');
    $response->execute(array(
        'brand' => 'Apple',
        'model' => 'iPhone 12',
        'owner' => 'Alex',
        'weight' => 164,
        'comment' => 'my company provided a phone i don’t need this one anymore, brand new',
        'price' => 700
    ));
}

//Q3 update without using prepared queries
$db->exec('UPDATE Phones SET price=690 WHERE model="iPhone 12"');

//Q4 update using prepared queries
$commentResponse = $db->query('SELECT comment from Phones where owner="Alexis"');
$commentData = $commentResponse->fetch();
$commentValue = $commentData['comment'];
// echo $commentValue;

if ($commentValue !== 'Good for watching videos And listening to music') {
    $response2 = $db->prepare('UPDATE Phones SET comment=CONCAT(comment," ",:comment) WHERE owner=:owner');
    $response2->execute(array(
        'comment' => 'And listening to music',
        'owner' => 'Alexis'
    ));
}

//Q5 delete an entry
if ($db->query('SELECT * FROM phones WHERE owner="Alexis1"')->rowCount() !== 0) {
    $db->exec('DELETE FROM Phones where owner="Alexis1"');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Exercise in PHP</title>
</head>

<body>
    <h1>Hello Bitches</h1>

</body>

</html>