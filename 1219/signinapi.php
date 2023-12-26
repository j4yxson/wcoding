<?php
session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$username = $_POST['login']; // inputted login
$password = $_POST['password']; // inputted password 

$userexists = $db->prepare("SELECT * FROM chat_users WHERE username = '$username'");
$userexists->execute();
$results = $userexists->fetch(PDO::FETCH_ASSOC);
// echo "number of results: " . $userexists->rowCount() . "<br>";

if ($results) {
    $correctpassword = password_verify($password, $results['password']);
    echo $correctpassword;
    $_SESSION['username'] = $username;

    // echo "password verify results: " . $correctpassword . "<br>" . "<br>";
} else {
    echo 'false';
}



// echo "inputted username: " . $username . "<br>";
// echo "inputted password: " . $password . "<br>";


// echo "username from database: " . $results['username'] . "<br>";
// echo "hashed password from database: " . $results['password'] . "<br>";

//<?php header("Location: chat2v2.php"); 
