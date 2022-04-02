<?php
include("../../auth/config.php");
?>

<?php

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $last_date = $_POST['last_date'];
    $table_name = 'teacher_event';
    $email_id = $_SESSION['email'];
    $query = "INSERT INTO $table_name(title,description,conducted_by,last_date) values('$title','$description','$email_id','$last_date') ";
    if (mysqli_query($conn, $query)) {
        // echo "Query executed success";
        header("location:./home.php");
    } else {
        mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../student/styles/style.css" rel="stylesheet" />
</head>

<body style="background-color:#DFDFDE">
    <div class="row" style="margin-top:50px;margin-bottom:50px">
        <div class="col-xl-8 m-auto">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0 ">Create an Event</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="createEvent.php">
                        <h6 class="heading-small text-muted mb-4">Create Event</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-username">Title of the Event</label>
                                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Enter your title" name="title" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group focused">
                                        <label>Description</label>
                                        <textarea rows="4" class="form-control form-control-alternative" placeholder="Description About the Event" name="description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label>Last Date</label>
                                        <input type="date" id="input-date" class="form-control form-control-alternative" name="last_date" required>
                                    </div>
                                </div>
                            </div>


                            <center><input type="submit" name="submit" class="btn btn-info" value="Submit" /></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>