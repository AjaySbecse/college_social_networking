<?php include("../../auth/config.php"); ?>

<?php

if (!isset($_SESSION['email'])) {
    header("location:../../auth/login.php");
    die();
}

?>

<?php
$email_id = $_SESSION['email'];
$profileQuery = "SELECT * FROM student_details WHERE email_id = '$email_id'";

$result = mysqli_query($conn, $profileQuery);
$row = mysqli_fetch_assoc($result);
?>

<!-- get student post count -->
<?php

$table_name = 'student_post';
$getStudentPostQuery = "SELECT * from $table_name WHERE email_id = '$email_id'";
$totalPost = mysqli_num_rows(mysqli_query($conn, $getStudentPostQuery));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="./styles/style.css" rel="stylesheet" />
</head>

<body>
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./home.php"><i class="bi bi-arrow-left-short" style="font-size:25px;"></i> Go to Dashboard</a>
                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">

                    </div>
                </form>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="./image/<?php echo $row['profile_picture'] ?>" style="width:38px; height:38px">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $row['first_name'] ?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>Settings</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span>Activity</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#!" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://raw.githubusercontent.com/creativetimofficial/argon-dashboard/gh-pages/assets-old/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello <?php echo $row['first_name'] ?>,</h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                        <a href="./editProfile.php" class="btn btn-info">Edit profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="./image/<?php echo $row['profile_picture'] ?>" class="rounded-circle" style="width:150px;height:150px">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <!-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a> -->
                                <!-- <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <!-- <div>
                                            <span class="heading"></span>
                                            <span class="description">Friends</span>
                                        </div> -->
                                        <div>
                                            <span class="heading"><?php echo $totalPost ?></span>
                                            <span class="description">Post</span>
                                        </div>
                                        <!-- <div>
                                            <span class="heading"></span>
                                            <span class="description">Comments</span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    <?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?>
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i><?php echo $row['city'] ?>, <?php echo $row['country'] ?>
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i><?php echo $row['dept'] ?>
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i><?php echo $row['college_name'] ?>
                                </div>
                                <hr class="my-4">
                                <p><?php echo $row['about_me'] ?></p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 m-auto">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0 ">Student Account</h3>
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
                                                <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" name="user_name" value="<?php echo $row['user_name'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" name="email_id" value="<?php echo $row['email_id'] ?>" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" name="first_name" value="<?php echo $row['first_name'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" name="last_name" value="<?php echo $row['last_name'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">Roll Number</label>
                                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Roll Number" name="roll_number" value="<?php echo $row['roll_number'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">Department</label>
                                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Department" name="dept" value="<?php echo $row['dept'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">College Name</label>
                                                <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="College name" name="college_name" value="<?php echo $row['college_name'] ?>" readonly>
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
                                                    <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" name="address" value="<?php echo $row['address'] ?>" type="text" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-city">City</label>
                                                    <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" name="city" value="<?php echo $row['city'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-country">Country</label>
                                                    <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" name="country" value="<?php echo $row['country'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">Mobile Number</label>
                                                    <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Mobile number" name="phone_number" value="<?php echo $row['phone_number'] ?>" readonly>
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
                                            <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..." name="about_me" readonly><?php echo $row['about_me'] ?></textarea>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>