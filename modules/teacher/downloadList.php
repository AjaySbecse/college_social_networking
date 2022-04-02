<?php
include("../../auth/config.php");
?>


<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table_name = 'teacher_event';
    //get the previous array and store it into the result array;
    $getQuery = "SELECT * FROM $table_name WHERE id = '$id'";
    $result = mysqli_query($conn, $getQuery);
    $row = mysqli_fetch_assoc($result);


    $resultArray = json_decode($row['registered_students']);

    $table_name_2 = "waiting_registration";
    $output = '';
    $output .= '
            <table class = "table" bordered = "1">
                <tr>
                    <th>First Name</td>
                    <th>Last Name </th>
                    <th>Email Id</th>
                </tr>
        ';
    foreach ($resultArray as $email) {
        $getDetailsQuery = "SELECT * FROM $table_name_2 WHERE role = 'student' && isaccepted = '1' && email_id = '$email' ";
        $detailsResult = mysqli_query($conn, $getDetailsQuery);
        $detailsRow = mysqli_fetch_assoc($detailsResult);

        $output .= '
            <tr>
                <td>' . $detailsRow['first_name'] . '</td>
                <td>' . $detailsRow['last_name'] . '</td>
                <td>' . $detailsRow['email_id'] . '</td>
            </tr>
        ';
    }
    $output .= '</table>';
    //Set header information to export data in excel format
    $fileName = "studentList-" . date('d-m-Y') . ".xls";
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=' . $fileName);
    echo $output;



    // $resultArray =  json_encode($resultArray);
    // echo $resultArray;

    // header("location:./home.php");
}
?>

