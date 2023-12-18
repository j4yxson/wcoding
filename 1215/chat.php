<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $_SESSION['username'] = $_POST['username'];
        $username = $_SESSION['username'];
    };

    if (isset($_POST['chat'])) {
        $response = ($username . " : " . $_POST['chat'] . "<br>");
        $filename = 'active_responses.txt';
        $newData = $response . "\n";
        file_put_contents($filename, $newData, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        .main {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }


        .window {
            height: 400px;
            width: 400px;
            border: 2px solid;
            position: relative;
            overflow: auto;
        }

        .usern {
            position: relative;
            width: 100%
        }

        .chat {
            position: sticky;
            bottom: 0;
            width: 100%;
        }

        input {
            width: 100%;
            height: 40px;
        }

        .usern {
            width: 400px;
        }
    </style>
</head>

<body>
    <div class="main">
        <h1>Chat</h1>
        <form class="usern" action="chat.php" method="post">
            Username: <span><?= $username ?></span>
            <input type='text' name="username" autocomplete="off">
        </form>
        <div class="window">
            <div class="responses">
                <?php
                $responses_file = file_get_contents("active_responses.txt");
                echo $responses_file;
                ?>
            </div>
            <form class="chat" action="chat.php" method="post">
                <input type='text' name="chat" autocomplete="off">
            </form>

        </div>
    </div>

</body>

<script>
    // Wait for the DOM to fully load before executing the script
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the username span and input elements
        var usernameSpan = document.querySelector("span");
        var usernameInput = document.querySelector('[name=username]');

        // Check if the username is not empty and the input element exists
        if (usernameSpan.innerHTML !== '' && usernameInput) {
            // Remove the username input element
            usernameInput.remove();
        }
    });
</script>


</html>