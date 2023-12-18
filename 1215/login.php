<?php
session_start();

if (isset($_POST['username'])) { // if a user submits a username
    $_SESSION['username'] = $_POST['username']; // the session username becomes the submitted username
}

$username = isset($_POST['username']) ? $_SESSION['username'] : ''; // if the session username is set, the variable $username is now the session username
?>

<form class="usern" action="chat.php" method="post">
    Username: <span><?= $username ?></span>
    <input type='text' name="username" autocomplete="off">
</form>
<script>
    // if the user has inputted a username, delete the input box
    if (document.querySelector("span").innerHTML !== '') {
        document.querySelector(".usern").removeChild(document.querySelector('[name=username]'));
    }
</script>

<style>
    body {
        display: flex;
        justify-content: center;
    }

    input {
        width: 400px;
    }
</style>