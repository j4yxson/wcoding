<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "businessdb";
$db_conn = "";



$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);


if ($conn) {
    echo "you are connected";
} else {
    echo "could not connect";
}
