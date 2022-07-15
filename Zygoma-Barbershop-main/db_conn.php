<?php

$dbhost = "sql312.epizy.com";
$dbuser = "epiz_31892178";
$dbpass = "V0ucZCMaWq";
$dbname = "epiz_31892178_database";

$conn = mysqli_connect($dbhost , $dbuser , $dbpass , $dbname);

if(!isset($conn)){
    echo die("Database connection failed");
}
?>