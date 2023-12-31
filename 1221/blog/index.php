<?php
session_start();

error_reporting(E_ALL);
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
};

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

require('model.php');
$article = get_articles($articleID);
$commentresults = get_comments($articleID);
$numberofrows = calc_pagination();
$numPagesNeeded = numOfPagesNeeded($numberofrows);
require('indexView.php');
