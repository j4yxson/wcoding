<?php
// create a chat program
// once a username is set, make that session for them
// once a message is sent, on send, have that data be sent to a database
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
    echo $username . " - ";
} else {
    // if username is not set in session
    echo "Username not set";
}


if (isset($_POST['message'])) {
    if (($_POST['message']) == "") {
        $_POST['message'] = null;
    }
    $message = $_POST['message'];
};

echo $message;

// pushing values into db if both username/message are set
if (isset($message) && isset($username)) {
    $db->exec("INSERT INTO Chat (message,pseudo) VALUES ('$message','$username')");
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .inputarea {
            display: flex;
            flex-direction: column;
            gap: 15px;
            justify-content: center;
            align-items: center;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .messagearea {
            width: 500px;
            height: 300px;
            border: 2px solid;
            overflow: auto;
        }

        .username {
            height: 20px;
            width: 250px;
            border-radius: 10px;
        }

        .message {
            height: 20px;
            width: 500px;
            border-radius: 10px;
        }

        p {
            margin: 0;
            font-size: 10px;
        }

        #username {
            display: none;
        }
    </style>
</head>

<body>
    <div class="main">
        <form class="usernameinput" action=chat2.php method="post">
            <input name="username" type="text" class="username" placeholder="username" autocomplete="off">
            <div id="username"><?php if (isset($username)) echo $username ?></div>
        </form>
        <form class="inputarea" action="chat2.php" method="post">
            <input name="message" type="text" class="message" placeholder="type message" autocomplete="off" onkeydown="return event.key !== 'Enter';">
            <button type="submit" value="submit" class="send">Send</button>
        </form>
        <div class="buttons">
            <div class="pagination">
                <button class="refresh" value="Refresh">Refresh</button>
                <button value="Show More">Show More</button>
            </div>
            <div class="pages">
                <input type="radio" id="ten" name="pages" value=10 checked="true">
                <label for="ten">10</label>
                <input type="radio" id="twenty" name="pages" value=20>
                <label for="twenty">20</label>
                <input type="radio" id="all" name="pages" value="999">
                <label for="all">All</label>
            </div>
        </div>
        <div class="messagearea" id="messageDisplay">
        </div>
    </div>
</body>

</html>

<script>
    // on the click of the refresh button, depending on if the selected radio is 10,20, or all, return the most recent results from the database

    refreshButton = document.querySelector(".refresh"); // identify the refresh button
    refreshButton.addEventListener("click", function() { // creating event listener for things to happen when the button is clicked
        radios = document.getElementsByName("pages"); // getting all the radios, returns an array
        selectedRadio = 0; // initializing a variable for the selected radio
        for (i = 0; i < radios.length; i++) {
            if (radios[i].checked) { // if the radio is checked
                selectedRadio = parseInt(radios[i].value); // assign the value to the variable 
                break;
            }
        }


        fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'count=' + selectedRadio // sending info over thru the body
            })

            .then(response => response.text())
            .then(data => {
                document.getElementById('messageDisplay').innerHTML = data;
            })
    });

    //have to stop the page from reloading on submit
    // then submit the message via api?

    formSubmit = document.querySelector(".inputarea");
    formSubmit.addEventListener("submit", function(event) {
        event.preventDefault(); // prevents the submit from happening

        fetch('api2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'message=' + document.querySelector(".message").value + '&pseudo=' + document.getElementById("username").innerHTML
            })
            .then(response => response.text())
            .then(data => {
                newDiv = document.createElement("div"); // Create the new div here
                newDiv.innerHTML = data; // Set the inner HTML of the new div with the response data
                document.querySelector(".message").value = '';
                document.getElementById('messageDisplay').appendChild(newDiv); // Append the new div
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    })
</script>