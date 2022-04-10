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
    echo "credential table deleted\n";
    $student_details_table = 'student_details';
    if (mysqli_query($conn, "DELETE FROM $student_details_table WHERE email_id = '$email_id'")) {
        echo "student details deleted\n";
    } else {
        echo "Failed" . mysqli_error($conn);
    }

    if (mysqli_query($conn, $query)) {
        echo "waiting registration deleted\n";
    } else {
        echo "failed" . mysqli_error($conn);
    }
    header("location:./index.php");
}
?>