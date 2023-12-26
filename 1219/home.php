<?php
// This is the default home page you'll see when you first hit the website
// Going to be adding actions to when you hit sign up because that is really the only actionable part of this page
// First check is going to be if login doesn't exist already
// Next check is going to be if password's match

// If both are good, create a successful signup, show success, and automatically send over to the actual chat website

try {
    $db = new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }


        .main {
            display: flex;
            width: 100vw;
        }

        .welcomeback,
        .createaccount {
            width: 50%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .welcomeback {
            background-color: rgb(203, 195, 227);
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            justify-content: center;
            align-items: center;
        }

        input {
            height: 40px;
            width: 300px;
            border-radius: 10px;
        }

        .signupbutton,
        .signinbutton {
            border-radius: 50px;
            height: 50px;
            width: 200px;
            font-weight: bold;
        }

        .signinbutton {
            border-color: white;

            background-color: transparent;
        }

        .signupbutton {
            background-color: rgb(203, 195, 227);
            border-color: transparent;
        }

        .signinbutton a {
            text-decoration: none;
            color: white;
        }

        .signup a {
            text-decoration: none;
            color: black;
        }

        .login button {
            position: absolute;
        }

        .test {
            text-align: center;
            color: cornflowerblue;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <div class="test"></div>
    <div class="main">
        <div class="welcomeback">
            <h1>Welcome Back!</h1>
            <h3>Already have an account?</h3>
            <h3> Sign in and start to chat with your friends</h3>
            <button class="signinbutton"><a href="signin.php">SIGN IN</a></button>
        </div>
        <div class="createaccount">
            <h1>Create Account</h1>
            <form method="post" action="chat_usersapi.php" class="signup">
                <div class="login">
                    <input type="text" placeholder="Login" onkeydown="return event.key !== 'Enter';" class="logininput">
                    <button class="loginbutton">Check</button><span></span>
                </div>
                <input type="email" placeholder="Email" onkeydown="return event.key !== 'Enter';" class="email">
                <input type="password" placeholder="Password" onkeydown="return event.key !== 'Enter';" class="password">
                <input type="password" placeholder="Password Confirm" onkeydown="return event.key !== 'Enter';" class="passwordconfirm">
                <div class="alert"></div>
                <button type="submit" class="signupbutton">SIGN UP</button>
                <div class="bad"></div>
            </form>
        </div>

    </div>
</body>

</html>
<script>
    // 1st step basically is sending over all my data that has not been initially checked in the sign up form to the database to check
    // 1st check is checking if login exists. If it does, then rest of form doesn't matter because a login username already exists, needs to be unique
    // 2nd check is password criteria (password == password confirm and > 6 characters




    // login check
    loginbutton = document.querySelector(".loginbutton"); // login button
    login = document.querySelector(".logininput"); // login input
    let result; // initializing result
    let spanElement = document.querySelector("span"); // span to fill with good user or bad user


    loginbutton.addEventListener("click", () => { // creating event listener on the button
        logininput = login.value; // the value of the input box gets assigned to logininput at time of click

        if (logininput.length > 3) {
            fetch('logincheckapi.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'logininput=' + logininput
                })
                .then(response => response.text())
                .then(data => {
                    result = data;
                    if (result == true) {
                        spanElement.innerHTML = "Valid Login";
                        spanElement.style.color = "green";
                    } else {
                        spanElement.innerHTML = "Login already taken";
                        spanElement.style.color = "red";
                    }
                })
        } else {
            spanElement.innerHTML = "Must be at least 4 characters";
            spanElement.style.color = "red";
        }
    });


    // password check
    alert = document.querySelector(".alert"); // identifying my alert div
    passwordconfirminputbox = document.querySelector(".passwordconfirm"); // identifying my password confirm input box

    passwordconfirminputbox.addEventListener("input", () => { // creating an eventlistener to check passwords LIVE
        passwordinput = document.querySelector(".password").value; // finding the value of each input
        passwordconfirminput = passwordconfirminputbox.value; // assigning the value of password confirm to a variable

        if (passwordinput.length > 5) { // if password is greater than 5 characters
            alert.innerHTML = "Password is sufficient length";
            alert.style.color = "red"
            if (passwordinput == passwordconfirminput) {
                alert.innerHTML = "Passwords Match";
                alert.style.color = "green"
            } else {
                alert.innerHTML = "Passwords Do Not Match";
                alert.style.color = "red"
            }
        } else {
            alert.innerHTML = "Password must be at least 6 characters";
            alert.style.color = "red"
        }
    });

    // sign up
    signupform = document.querySelector(".signup"); // identifying the sign up form

    signupform.addEventListener("submit", function(event) { // adding event listener, so on submit it does something 
        event.preventDefault(); // prevents the form from submitting, instead need it to submit it to an API which uploads to database if all criteria prior are fulfilled
        email = document.querySelector(".email").value;
        signupchecks = document.querySelector(".bad");

        if (spanElement.innerHTML == "Valid Login" && email !== "" && alert.innerHTML == "Passwords Match") {
            fetch('chat_usersapi.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'login=' + logininput + '&email=' + email + '&password=' + passwordinput
                })
                .then(response => response.text())
                .then(data => document.querySelector(".test").innerHTML = data)
        } else if (spanElement.innerHTML == "Valid Login" && alert.innerHTML !== "Passwords Match") {
            signupchecks.innerHTML = "Fix Password!"
        } else if (spanElement.innerHTML !== "Valid Login" && alert.innerHTML == "Passwords Match") {
            signupchecks.innerHTML = "Verify Login!"
        } else if (spanElement.innerHTML !== "Valid Login" && alert.innerHTML !== "Passwords Match") {
            signupchecks.innerHTML = "Enter Valid Login and Password!"
        } else {
            signupchecks.innerHTML = "Enter Valid Email"
        }
    });
</script>