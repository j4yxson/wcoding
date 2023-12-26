<?php
// create a chat program
// once a username is set, make that session for them
// once a message is sent, on send, have that data be sent to a database
session_start();

$username = $_SESSION['username']; // assigning the session username to the variable "username"
$currentmessage = $_SESSION['currentmessage']; //getting currentmessage id

// echo $currentmessage;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        span {
            font-weight: bold;
            color: cornflowerblue
        }

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

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <button class="logout">Logout</button>
    <div class="main">
        <div class="welcome">Welcome, <span><?= $username ?></span> !</div>
        <div class="messagearea" id="messageDisplay"></div>
        <form class="inputarea" action="chat2.php" method="post">
            <input name="message" type="text" class="message" placeholder="type message" autocomplete="off">
            <button type="submit" value="submit" class="send">Send</button>
        </form>
    </div>
</body>

</html>

<script>
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
                body: 'message=' + document.querySelector(".message").value + '&pseudo=' + document.querySelector("span").innerHTML
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
    });


    // // fetching new messages automatically

    // function fetch_messages() {
    //     fetch('fetch_messages.php?lastmessage=' + <?= $currentmessage ?>)
    //         .then(response => response.text())
    //         .then(data => {
    //             document.querySelector(".messagearea").innerHTML = data
    //         })
    // }

    // setInterval(fetch_messages, 1000);






    // destroy session

    logoutbutton = document.querySelector(".logout");
    logoutbutton.addEventListener("click", () => {
        fetch('logout.php', {
                method: "POST",
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            })
    })
</script>