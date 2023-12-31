<?php
session_start();
try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

//check if username is posted and session username is not set
if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
};

// if the session username is set, use it
$username = "";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // assigning the session username to the variable "username"
    // echo $username;
} else {
    // if username is not set in session
    echo "Username not set";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="blog.css">
</head>

<body>

    <div class="main">
        <div class="top">
            <h1><a href="blogView.php">Jason's Blog</a></h1>
        </div>
        <hr>
        <div class="articles">
            <div class="article">
                <h2><a href="index.php?article=1&commentpage=1">Article 1</a>
                    <h2>
            </div>
            <div class=" article">
                <h2><a href="index.php?article=2&commentpage=1">Article 2</a>
                    <h2>
            </div>
            <div class="article">
                <h2><a href="index.php?article=3&commentpage=1">Article 3</a>
                    <h2>
            </div>
        </div>
    </div>

</body>

</html>