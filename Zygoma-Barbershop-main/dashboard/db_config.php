<?php

$host= "sql312.epizy.com";
$username= "epiz_31892178";
$password = "V0ucZCMaWq";

$db_name = "epiz_31892178_database";

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}


?>
