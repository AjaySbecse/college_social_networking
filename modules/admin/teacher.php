<?php
include('../../auth/config.php');
?>
<?php
$number_of_row = 0;
$table_name = 'waiting_registration';
$query = "SELECT * from $table_name where isaccepted = 0 && role = 'teacher'";
$result = mysqli_query($conn, $query);
$number_of_row = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Teacher Request</title>
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

          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="#!">Logout</a></li>
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
          <?php
          if ($number_of_row > 0) {
            echo '
                        <h3 class="mt-4">Student Registration Pending</h3>
                    ';
          } else {
            echo '<center><h3 class="mt-4">No pending Request</h3></center>';
          }
          ?>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
          </ol>
          <div class="row">

            <?php
            if ($number_of_row <= 0) {
              echo '
                            <center><img src = "./assets/img/done.gif" alt = "No pending approval"/></center>
                        ';
            } else {
              while ($row = mysqli_fetch_array($result)) {
                echo '
                                <div class="col-xl-3 col-md-6">
                                    <div class="card text-white mb-4" id="color4">
                                        <div class="card-body text-center" style="font-weight: bold;">
                                            <h4>' . $row["first_name"] . ' ' . $row['last_name'] . '</h4>
                                            <p>' . $row['email_id'] . '</p>                            
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="btn btn-success" href="./teacherAccept.php?id=' . $row["email_id"] . '">Accept</a>
                                        <a class="btn btn-danger" href="./teacherReject.php?id=' . $row["email_id"] . '">Reject</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            ';
              }
            }

            ?>


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