<?php
include("../../auth/config.php");

if (!isset($_SESSION['admin_email'])) {
  header("location:./Login/index.php");
  die();
}
?>

<?php

$number_of_students = 0;
$number_of_teachers = 0;
$number_of_pending_request = 0;
$table_name = 'credential';
$waiting_table_name = 'waiting_registration';

$studentQuery = "SELECT * from $table_name where role = 'student'";
$teacherQuery = "SELECT * from $table_name where role = 'teacher'";
$pendingQuery = "SELECT * from $waiting_table_name where isaccepted = 0";
$studentresult = mysqli_query($conn, $studentQuery);
$teacherresult = mysqli_query($conn, $teacherQuery);
$pendingersult = mysqli_query($conn, $pendingQuery);
$number_of_students = mysqli_num_rows($studentresult);
$number_of_teachers = mysqli_num_rows($teacherresult);
$number_of_pending_request = mysqli_num_rows($pendingersult);
?>

<?php

$total_accepted_post = 0;
$pending_post = 0;
$table_name = "student_post";
$total_post_query = "SELECT * FROM $table_name WHERE isaccepted = '1'";
$pending_query = "SELECT * FROM $table_name WHERE isaccepted = '0'";

$total_accepted_post = mysqli_num_rows(mysqli_query($conn, $total_post_query));
$pending_post = mysqli_num_rows(mysqli_query($conn, $pending_query));

?>

<?php

$table_name = "waiting_registration";
$studentListQuery = "SELECT * FROM $table_name where role = 'student'";
$studentResult = mysqli_query($conn, $studentListQuery);

$teacherListQuery = "SELECT * FROM $table_name where role = 'teacher'";
$teacherResult = mysqli_query($conn, $teacherListQuery);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="css/customStyle.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">Admin Dashboard</a>
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

          <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Register Request</div>
            <a class="nav-link" href="./student.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Student
            </a>
            <a class="nav-link" href="./teacher.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Teacher
            </a>

            <div class="sb-sidenav-menu-heading">Post Confirmation</div>
            <a class="nav-link" href="./acceptPost.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Student Post
            </a>

      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>

        <div class="container-fluid px-4">
          <h1 class="mt-4">Dashboard</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
          </ol>

          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card text-white mb-4" style="background-color: #FF0075;">
                <div class="card-body" style="font-weight: bold;">Students Count</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <h1><?php echo $number_of_students ?></h1>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card text-white mb-4" style="background-color: #018383;">
                <div class="card-body" style="font-weight: bold;">Teachers Count</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <h1><?php echo $number_of_teachers; ?></h1>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6">
              <div class="card text-white mb-4" style="background-color: #FF0075;">
                <div class="card-body" style="font-weight: bold;">Pending Request</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <h1><?php echo $number_of_pending_request; ?></h1>
                </div>
              </div>
            </div>
          </div>
          <!-- end of row -->
          <br><br><br>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card text-white mb-4" style="background-color: #AE4CCF;">
                <div class="card-body" style="font-weight: bold;">Total Accepted Post</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <h1><?php echo $total_accepted_post ?></h1>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card text-white mb-4" style="background-color: #9C19E0;">
                <div class="card-body" style="font-weight: bold;">Pending Post</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <h1><?php echo $pending_post ?></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of statistics -->
        <hr>
        <h4 style="margin-left:30px">List of students</h4>
        <div class="row">
          <!-- <div class="col-1"></div> -->
          <div class="col-8">
            <table class="table table-hover" style="margin-left:30px;margin-top:20px;margin-bottom:30px">
              <thead class="bg-dark" style="color:white">
                <tr>
                  <th scope="col">First name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email Id</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>

                <?php

                if (mysqli_num_rows($studentResult) > 0) {
                  while ($row = mysqli_fetch_assoc($studentResult)) {
                    echo '
                      <tr>
                        <td>' . $row['first_name'] . '</td>
                        <td>' . $row['last_name'] . '</td>
                        <td>' . $row['email_id'] . '</td>
                        <td>
                          <form method="POST" action="./deleteStudent.php?id=' . $row['email_id'] . '">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger" />
                          </form>
                        </td>
                      </tr>
                    
                    ';
                  }
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>
        <!-- end of listing students -->

        <hr>
        <h4 style="margin-left:30px">List of Teachers</h4>
        <div class="row">
          <!-- <div class="col-1"></div> -->
          <div class="col-8">
            <table class="table table-hover" style="margin-left:30px;margin-top:20px;margin-bottom:30px">
              <thead class="bg-dark" style="color:white">
                <tr>
                  <th scope="col">First name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email Id</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>

                <?php

                if (mysqli_num_rows($teacherResult) > 0) {
                  while ($row = mysqli_fetch_assoc($teacherResult)) {
                    echo '
                      <tr>
                        <td>' . $row['first_name'] . '</td>
                        <td>' . $row['last_name'] . '</td>
                        <td>' . $row['email_id'] . '</td>
                        <td>
                          <form method="POST" action="./deleteTeacher.php?id=' . $row['email_id'] . '">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger" />
                          </form>
                        </td>
                      </tr>
                    
                    ';
                  }
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>
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