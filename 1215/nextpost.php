<?php

$thing = "fish";
if (isset($_POST["fruit"])) $thing = htmlspecialchars($_POST['fruit']);

$inDate = new DateTime('now');
if (isset($_POST['expiration'])) $inDate = new DateTime(htmlspecialchars($_POST['expiration']));
echo "Date: " . $inDate->format("Y-m-d");
?>

<div>Your <?= $thing ?> is not expired yet</div>