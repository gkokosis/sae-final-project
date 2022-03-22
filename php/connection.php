<?php
/* Here we establish a connection with the database. This script is included 
almost in every page in the website. */
$host= "host";
$db_username= "username";
$db_password= "password";
$db= "db";

$connection= new mysqli($host, $db_username, $db_password, $db);
?>