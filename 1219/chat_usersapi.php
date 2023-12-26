<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$inserting = $db->prepare("INSERT INTO chat_users (username, email, password) VALUES (:login, :email, :password)");
$inserting->bindParam(':login', $login, PDO::PARAM_STR);
$inserting->bindParam(':email', $email, PDO::PARAM_STR);
$inserting->bindParam(':password', $hashed_password, PDO::PARAM_STR);
$inserting->execute();



echo "Account Creation Successful" . "<br>";
echo "Please Sign In!" . "<br>";
