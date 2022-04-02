<?php include("../../auth/config.php"); ?>
<?php

if (!isset($_SESSION['email'])) {
    header("location:../../auth/login.php");
    die();
}

?>

<?php

$email = $_SESSION['email'];
$checkQuery = "SELECT isProfileadded FROM credential where email_id = '$email'";
$result = mysqli_query($conn, $checkQuery);
$row = mysqli_fetch_assoc($result);
$isProfileAdded = trim($row['isProfileadded']);
// echo $isProfileAdded;
?>

<!-- to display the post created by this user -->
<?php

$table_name = "teacher_event";
$email_id = $_SESSION['email'];
$myEventQuery = "SELECT * FROM $table_name where conducted_by = '$email_id'";
$myEventResult = mysqli_query($conn, $myEventQuery);

?>

<!-- to close the event -->
<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <!-- <link href="./styles/style.css" rel="stylesheet" /> -->
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #172b4d;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home.php">Teacher Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li style="color:white;margin:5px 10px 0px 0px"><?php echo $_SESSION['email'] ?></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" <?php if ($isProfileAdded == '0') echo "href='./addProfile.php'";
                                                    else echo "href='./profile.php'"; ?>>View Profile</a></li>
                    <li><a class="dropdown-item" href="../../auth/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="background-color: #172b4d;">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Create Event
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="./post.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            View Post
                        </a>
                        <!-- <a class="nav-link" href="./message.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Message
                        </a> -->
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main class="p-5">

                <center><a class="btn btn-dark" href="./createEvent.php">Create Event</a></center>
                <!-- <div>
                    <div class="card shadow mb-5 bg-white rounded" style="width: 60%;">

                        <div class="card-body">
                            <h5 class="card-title">Event Title</h5>
                            <p class="text-muted">Conducting by : xxx</p>
                            <p class="card-text">discription of the event</p>

                        </div>
                        <div class="card-footer text-muted">
                            <a href="#" class="btn btn-primary">Register</a>
                            <span style="margin-left:50%">Last Date : 03/03/2022</span>
                        </div>
                    </div>
                </div> -->

                <?php

                if (mysqli_num_rows($myEventResult) > 0) {
                    while ($row = mysqli_fetch_assoc($myEventResult)) {
                        echo '
                            <div style="margin:10px">
                                <div class="card shadow mb-5 bg-white rounded" style="width: 60%;">

                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['title'] . '</h5>
                                        <p class="text-muted">Conducting by : ' . $row['conducted_by'] . '</p>
                                        <p> Total Count : ' . $row['count'] . '</p>
                                        <p class="card-text">' . $row['description'] . '</p>

                                    </div>
                                    <div class="card-footer text-muted d-flex justify-content-around align-items-center" >
                                        <form method="POST" action = "downloadList.php?id=' . $row['id'] . '">
                                            <input type="submit" name="download-list" class="btn btn-primary" value="Download Student List" />
                                        </form>
                            ';
                        if ($row['isLive']) {
                            echo '
                                    <form method="POST" action = "closeEvent.php?id=' . $row['id'] . '">
                                        <input type="submit" name="close-event" class="btn btn-dark" value="Close Event" />
                                    </form>
                                    ';
                        }

                        echo '
                                <span>Last Date : ' . $row['last_date'] . '</span>
                                    </div>
                                </div>
                            <div>
                        ';
                    }
                }

                ?>


            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>