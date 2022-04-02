<?php
include("../../auth/config.php");
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $email = $_SESSION['email'];

    $table_name = 'teacher_event';
    //get the previous array and store it into the result array;
    $getQuery = "SELECT * FROM $table_name WHERE id = '$id'";
    $result = mysqli_query($conn, $getQuery);
    $row = mysqli_fetch_assoc($result);


    $resultArray = json_decode($row['registered_students']);

    // echo $resultArray;
    // remove the mailid from the resultArray;
    $resultArray = array_diff($resultArray, array($email));
    // echo $resultArray;

    $previousCount = (int)$row['count'];
    $previousCount -= 1;


    $resultArray =  json_encode($resultArray);
    echo $resultArray;

    $updateQuery = "UPDATE $table_name SET registered_students = '$resultArray',count = '$previousCount' where id = '$id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Updated";
    } else {
        echo mysqli_error($conn);
    }
    header("location:./home.php");
}
?>
