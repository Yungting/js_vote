<?php

$dbServer = "140.127.220.232";
$dbUser = "root";
$dbPassword = "group2good";
$dbName = "vote4fun";

$link = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);

mysqli_set_charset($link, "utf8");

?>