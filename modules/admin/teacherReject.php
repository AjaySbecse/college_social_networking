<?php 
    include('../../auth/config.php');
?>
<?php
    if(isset($_GET['id'])){
        $email_id = $_GET['id'];
        $table_name = 'waiting_registration';
        $query = "DELETE FROM $table_name WHERE `email_id` = '$email_id'";
        if(mysqli_query($conn,$query)){
            
        }
        else{
            echo "failed".mysqli_error($conn);
        }
        header("location:./teacher.php");
    }
?>