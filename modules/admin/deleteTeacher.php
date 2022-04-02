<?php
include('../../auth/config.php');
?>
<?php
if (isset($_GET['id'])) {
    $email_id = $_GET['id'];
    $table_name = 'waiting_registration';
    $credential_table = 'credential';
    $query = "DELETE FROM $table_name WHERE `email_id` = '$email_id'";
    $credentialQuery = "DELETE FROM $credential_table WHERE email_id = '$email_id'";
    mysqli_query($conn, $credentialQuery);
    mysqli_query($conn, "DELETE FROM 'teacher_details' where email_id = '$email_id'");
    if (mysqli_query($conn, $query)) {
    } else {
        echo "failed" . mysqli_error($conn);
    }
    header("location:./index.php");
}
?>