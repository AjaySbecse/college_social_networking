<?php
include("../../auth/config.php");

?>

<?php
$id = $_GET['id'];
$table_name = 'student_post';
$acceptQuery = "UPDATE $table_name SET isaccepted = '1' where id = '$id'";
if (mysqli_query($conn, $acceptQuery)) {
    echo "post accepted";
    header("location:./acceptPost.php");
} else {
    echo mysqli_error($conn);
}

?>