<?php
include('../../auth/config.php');
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table_name = 'teacher_event';
    $query = "UPDATE $table_name SET isLive = '0' WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
    } else {
        echo "failed" . mysqli_error($conn);
    }
    header("location:./home.php");
}
?>