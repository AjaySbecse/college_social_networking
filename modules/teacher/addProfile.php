<?php include("../../auth/config.php"); ?>

<?php

if (!isset($_SESSION['email'])) {
    header("location:../../auth/login.php");
    die();
}

?>

<?php

$Imagemsg = "";
$Emailmsg = "";
if (isset($_POST['submit'])) {

    $user_name = $_POST['user_name'];
    $email_id = $_POST['email_id'];
    //checking they providing the same emailid provided using signin
    $signInEmail = $_SESSION['email'];
    $checkEmailQuery = "SELECT email_id FROM credential where email_id = '$email_id' ";
    $emailCheckResult = mysqli_query($conn, $checkEmailQuery);
    // print_r($emailCheckResult);
    // $row = mysqli_fetch_assoc($emailCheckResult);
    // echo $row['email_id'];
    if (mysqli_num_rows($emailCheckResult) == 0) {
        $Emailmsg = "*Enter the same email Id provided for Login";
    } else {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $faculty_id = $_POST['faculty_id'];
        $dept = $_POST['dept'];
        $college_name = $_POST['college_name'];

        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $phone_number = $_POST['phone_number'];
        $about_me = $_POST['about_me'];

        //to upload the image
        $filename = $_FILES['uploadfile']['name'];
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $folder = "image/" . $filename;
        if (!move_uploaded_file($tempname, $folder)) {
            $Imagemsg = "Image upload failed";
        } else {
            $insertQuery = "INSERT INTO teacher_details(user_name,email_id,first_name,last_name,faculty_id,dept,college_name,profile_picture,address,city,country,phone_number,about_me) values('$user_name','$email_id','$first_name','$last_name','$faculty_id','$dept',
                 '$college_name','$filename','$address','$city','$country','$phone_number','$about_me')";

            if (mysqli_query($conn, $insertQuery)) {
                $query = "UPDATE credential set isProfileadded = '1' where email_id = '$email_id'";
                mysqli_query($conn, $query);
                header("location:./home.php");
            } else {
                echo mysqli_error($conn);
            }
        }
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
                            <h3 class="mb-0 ">Teacher Account</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="addProfile.php" enctype="multipart/form-data">
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-username">Username</label>
                                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" name="user_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" name="email_id" required>
                                        <span style="color:red"><?php if (!empty($Emailmsg)) echo $Emailmsg ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-first-name">First name</label>
                                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-last-name">Last name</label>
                                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-first-name">Faculty ID</label>
                                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Faculty Id" name="faculty_id" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-first-name">Department</label>
                                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Department" name="dept" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-last-name">College Name</label>
                                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="College name" name="college_name" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="profile_picture">Upload profile Picture</label>
                                        <input type="file" id="profile_picture" class="form-control form-control-alternative" name="uploadfile" value="" required />
                                        <p style="color:red"><?php if (!empty($Imagemsg)) echo $Imagemsg ?></p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" name="address" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" name="country" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Mobile Number</label>
                                            <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Mobile number" name="phone_number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group focused">
                                    <label>About Me</label>
                                    <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..." name="about_me" required>Passionated and Focussed...</textarea>
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