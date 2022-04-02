<?php
    include("../../auth/config.php");
?>

<?php 
    //change isaccepted to 1
    if(isset($_GET['id'])){
        $table_name = "waiting_registration";
        $email_id = $_GET['id'];
        $changeAcceptQuery = "UPDATE $table_name SET `isaccepted` = 1 where `email_id` = '$email_id'";
        mysqli_query($conn,$changeAcceptQuery);
        
        $selectQuery = "SELECT * from $table_name where `email_id` = '$email_id'";
        $result = mysqli_query($conn,$selectQuery);
        $data = mysqli_fetch_assoc($result);
        $pwd = $data['password'];
        $role = $data['role'];
        $second_table_name = "credential";
        $insertQuery = "INSERT into $second_table_name values('$email_id','$pwd','$role',0)";
        if(mysqli_query($conn,$insertQuery)){
            header("location:./teacher.php");
        }
        else{
            echo mysqli_error($conn);
        }
    }
?>