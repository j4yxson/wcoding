<?php

$password = '806796';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);




echo password_verify($password, $hashed_password);
