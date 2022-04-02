<?php
    session_start();
    unset($_SESSION['admin_email']);
    header("location:./Login/index.php");
?>