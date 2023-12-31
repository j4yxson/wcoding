<?php
$articleID = $_GET["article"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title'] ?></title>
    <link rel="stylesheet" href="article.css">
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
            <h1><a href="blogView.php">Jason's Blog</a></h1>
        </div>
        <hr>
        <div class="article">
            <h2><?= $article['title'] ?></h2>
            <h6><?= $article['tag'] ?></h6>
            <h3><?= $article['author'] ?></h3>
            <p><?= $article['content'] ?>
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
            <?php foreach ($commentresults as $result) : ?>
                <div class="comment">
                    <div class="author"><?= $result['author'] ?></div>
                    <div class="commenttime"><?= $result['date_created'] ?></div>
                    <br>
                    <div class="commentdesc"><?= $result['comment'] ?></div>
                    <br>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="commentsPages">
        </div>
    </div>
    <?=
    $numberofrows;
    ?>
</body>

</html>
<script>
    // script to submit a new comment
    commentSubmit = document.querySelector(".addComment");
    commentSubmit.addEventListener("submit", function(event) {
        event.preventDefault();
        fetch('../api.php', {
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
            newA.href = "index.php?article=" + <?= $articleID ?> + "&commentpage=" + (i + 1);
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

        fetch('../api2.php', {
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