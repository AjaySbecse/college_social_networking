<?php
include("../../auth/config.php");

?>

<?php
$id = $_GET['id'];
$table_name = 'student_post';
$acceptQuery = "DELETE FROM $table_name WHERE id = '$id'";
if (mysqli_query($conn, $acceptQuery)) {
    echo "post deleted";
    header("location:./acceptPost.php");
} else {
    echo mysqli_error($conn);
}

?>