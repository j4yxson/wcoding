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


$articleID = $_GET["article"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
            $title = $db->prepare("SELECT * from article where id=$articleID");
            $title->execute();
            $response = $title->fetch(PDO::FETCH_ASSOC);
            echo $response['title'];
            ?></title>
    <style>
        .main {
            /* height: 100vh; */
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            font-family: sans-serif;
        }

        h6,
        h3 {
            margin: 0;
        }

        .top,
        .commentsPages {
            display: flex;
            justify-content: center;
        }

        hr {
            width: 80vw;

        }

        .article {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        a {
            text-decoration: none;
            color: cornflowerblue
        }

        .author {
            font-weight: bold;
        }

        .addComment {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .commentInput {
            height: 150px;
            width: 500px;
        }

        button {
            height: 50px;
            width: 200px;
        }

        .login {
            position: absolute;
            display: flex;
            flex-direction: column;
            top: 5px;
            right: 5px;
        }

        .commenttime {
            margin: 0;
            font-size: 10px;
        }

        .commentsArea {
            border: 2px solid;
        }

        .commentsPages ul {
            display: flex;
            gap: 10px;
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="main">
        <form method="post">
            <div class="login">
                <input type="text" name="username" autocomplete="off">
                <?= $username ?>
            </div>
        </form>
        <div class="top">
            <h1><a href="blog.php">Jason's Blog</a></h1>
        </div>
        <hr>
        <div class="article">
            <h2><?= $response['title'] ?></h2>
            <h6><?= $response['tag'] ?></h6>
            <h3><?= $response['author'] ?></h3>
            <p><?= $response['content'] ?>
            </p>
        </div>
    </div>
    <div class="commentssection">
        <h3>Comments</h3>
        <div class="reply">
            <form method="post" class="addComment">
                <input class="commentInput" type="text" autocomplete="off" onkeydown="return event.key !== 'Enter';">
                <button type="submit" class="submit">Submit</button>
            </form>
            <br>
        </div>
        <div class="commentsArea">
            <?php
            $comments = $db->prepare("SELECT * FROM comments where article_id=$articleID order by date_created desc limit 5");
            $comments->execute();
            $results = $comments->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                echo '<div class="comment">';
                echo '<div class="author">' . $result['author'] . '</div>';
                echo '<div class="commenttime">' . $result['date_created'] . '</div>';
                echo '<br>';
                echo '<div class="commentdesc">' . $result['comment'] . '</div>';
                echo '<br>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="commentsPages">
        </div>
    </div>

    <?php
    $totalcomments = $db->prepare("SELECT * FROM comments where  article_id = $articleID");
    $totalcomments->execute();
    $totalnumber = $totalcomments->rowCount();
    echo "total number: " . $totalnumber . "<br>"; // THIS IS TOTAL NUMBER OF ROWS FOR THIS ARTICLE

    if ($totalnumber > 5) {
        $numPagesNeeded = (ceil($totalnumber / 5));
    } else ($numPagesNeeded = 1);
    echo "number of pages needed: " . $numPagesNeeded;

    ?>
</body>

</html>
<script>
    // script to submit a new comment
    commentSubmit = document.querySelector(".addComment");
    commentSubmit.addEventListener("submit", function(event) {
        event.preventDefault();
        fetch('api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'comment=' + document.querySelector('.commentInput').value + '&username=<?= $username ?>' + '&articleid=<?= $articleID ?>'
        })

        document.querySelector(".commentInput").value = ''; //clearing the input box
    })

    // pagination
    // default is page 1
    // at page 2, still look for 5 comments, however need to offset at every interval
    // have the pagination number be automatically created by # of comments/5
    // ex. 25 comments  = 5 pages

    paginationSection = document.querySelector('.commentsPages'); // identifying section to place the unordered list
    counter = 0; // initializing a counter to have out pages go up from 1-however

    function createPages() { //creating a function to run this shit
        newUL = document.createElement("ul"); // creating the unordered lists
        searchLeft = document.createElement("li"); // creating search left pager
        searchLeft.innerHTML = "&lt";
        newUL.appendChild(searchLeft);

        //next section is identifying how many comments we have in our database, so we can create that many pages

        for (i = 0; i < <?= $numPagesNeeded ?>; i++) {
            newLI = document.createElement("li");
            newA = document.createElement("a");
            newA.href = "article.php?article=" + <?= $articleID ?> + "&commentpage=" + (i + 1);
            newA.textContent = (i + 1);
            newLI.appendChild(newA);
            newUL.appendChild(newLI);
        }

        searchRight = document.createElement("li"); // creating search right pager
        searchRight.innerHTML = "&gt"
        newUL.appendChild(searchRight);
        paginationSection.appendChild(newUL);
    }

    createPages();

    if (<?= $_GET['commentpage'] ?> !== 1) {
        document.querySelector('.commentsArea').innerHTML = "";

        fetch('api2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'articleid=' +
                    <?= $articleID ?> + '&commentpage=' + <?= $_GET['commentpage'] ?>
            })

            .then(response => response.text())
            .then(data => {
                document.querySelector('.commentsArea').innerHTML = data;
            })
    }
</script>