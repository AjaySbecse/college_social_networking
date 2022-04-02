<?php
    session_start();
    $hostname = "localhost";
    $username = "root";
    $pwd = "";
    $dbname = "college_social_network";

    $conn = mysqli_connect($hostname,$username,$pwd,$dbname);
    if(!$conn){
        echo 'Connection error: '.mysqli_connect_error();
    }
    else{
        echo '<script>console.log("Database connected successfully");</script>';
    }
?>