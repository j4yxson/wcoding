<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$logininput = $_POST['logininput'];

$userdata = $db->prepare("SELECT * FROM chat_users WHERE username='$logininput'");
// $userdata->bindParam(':logininput', $logininput, PDO::PARAM_STR);
$userdata->execute();

$rows = $userdata->rowCount();
$unique_login = ($rows == 0);

echo $unique_login;
