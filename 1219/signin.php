<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
        }


        .main {
            display: flex;
            width: 100vw;
        }

        .left,
        .right {
            width: 50%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right {
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

        button {
            border-radius: 50px;
            height: 50px;
            width: 200px;
            font-weight: bold;
        }

        .signup {
            border-color: white;
            background-color: transparent;
        }

        .signin {
            background-color: rgb(203, 195, 227);
            border-color: transparent
        }

        .signup a {
            text-decoration: none;
            color: white;
        }

        .signin a {
            text-decoration: none;
            color: black;
        }

        #remember {
            height: 15px;
            width: 15px;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="results"></div>
        <div class="left">
            <form method="post" action="signinapi.php" class="signinform">
                <input type="text" placeholder="Login" class="login" onkeydown="return event.key !== 'Enter';">
                <input type="password" placeholder="Password" class="password" onkeydown="return event.key !== 'Enter';">
                <div class="rememberme"><input type="checkbox" id="remember"><label for="remember">Remember Me?</label></div>
                <h3><a href="#">Forgot your password?</a></h3>
                <button type="submit" class="signinbutton">SIGN IN</button>
            </form>
        </div>
        <div class="right">
            <h1>Hello!</h1>
            <h3>Not a member of the fun yet?</h3>
            <h3> Sign in and start to chat with your friends</h3>
            <button class="signup"><a href="home.php">SIGN UP</a></button>
        </div>
    </div>
</body>

</html>
<script>
    loginbox = document.querySelector(".login");
    signinform = document.querySelector(".signinform");
    passwordbox = document.querySelector(".password");


    signinform.addEventListener("submit", function(event) {
        event.preventDefault();

        loginvalue = loginbox.value;
        passwordvalue = passwordbox.value;

        if (loginvalue.length !== "" && passwordvalue !== "") {
            fetch('signinapi.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'login=' + loginvalue + '&password=' + passwordvalue
                })
                .then(response => response.text())
                .then(data => {
                    document.querySelector(".results").innerHTML = data;
                    if (data == 1) {
                        document.querySelector(".results").innerHTML = "Login Successful";
                        window.location.href = 'chat2v2.php';
                        <?php
                        session_start();
                        $username = $_SESSION['username'];
                        if (isset($_SESSION['username'])) {
                            header("Location: chat2v2.php");
                        }
                        ?>
                    } else {
                        document.querySelector(".results").innerHTML = "Login Unsuccessful"
                    }
                })
        }
    })
</script>