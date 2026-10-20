<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "kycfinserv_dbnew";

$connect = mysqli_connect($servername, $username, $password, $database);

if (!$connect) {
    die("Connect Error: " . mysqli_connect_error());
}

date_default_timezone_set("Asia/Kolkata");
$currentTime = date("h:i:s A");

?>