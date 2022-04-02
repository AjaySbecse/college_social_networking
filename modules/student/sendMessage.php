<?php
include("../../auth/config.php");
?>

<?php

if (isset($_POST['send-msg'])) {
    $msg = $_POST['msg'];
    $email_id = $_SESSION['email'];
    $table_name = 'message';
    $query = "INSERT INTO $table_name(message,sent_by) VALUES('$msg','$email_id')";
    if (mysqli_query($conn, $query)) {
        header("location:./message.php");
    } else {
        echo mysqli_error($conn);
    }
}

?>
