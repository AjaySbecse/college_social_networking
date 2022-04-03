<?php
session_start();
// Developement server
// $hostname = "localhost";
// $username = "root";
// $pwd = "";
// $dbname = "college_social_network";

//production server
$hostname = "remotemysql.com";
$username = "5w9D71QdwF";
$pwd = "R3bFgnsed2";
$dbname = "5w9D71QdwF";

$conn = mysqli_connect($hostname, $username, $pwd, $dbname);
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    echo '<script>console.log("Database connected successfully");</script>';
}
