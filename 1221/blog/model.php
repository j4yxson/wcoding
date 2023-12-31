<?php

// article retrieval function
function get_articles($articleID)
{
    $db = dbConnect();
    $articles = $db->prepare("SELECT * from article where id=$articleID");
    $articles->execute();
    $article = $articles->fetch(PDO::FETCH_ASSOC);
    // print_r($article);
    return $article;
};

//comment retrieval function
function get_comments($articleID)
{
    $db = dbConnect();
    $comments = $db->prepare("SELECT * FROM comments where article_id=$articleID order by date_created desc limit 5");
    $comments->execute();
    $commentresults = $comments->fetchAll(PDO::FETCH_ASSOC);
    return $commentresults;
};

//pagination function
function calc_pagination()
{
    $db = dbConnect();
    $articleID = $_GET["article"];
    $totalcomments = $db->prepare("SELECT * FROM comments where  article_id = $articleID");
    $totalcomments->execute();
    $totalnumber = $totalcomments->rowCount();
    return $totalnumber; // THIS IS TOTAL NUMBER OF ROWS FOR THIS ARTICLE
};

// calculating pagination
function numOfPagesNeeded($numberofrows)
{
    if ($numberofrows > 5) {
        $numPagesNeeded = (ceil($numberofrows / 5));
        return $numPagesNeeded;
    } else {
        $numPagesNeeded = 1;
        return $numPagesNeeded;
    };
}

// connecting to the database
function dbConnect()
{
    try {
        return new PDO('mysql:host=localhost;dbname=businessdb;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
};
