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

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $table_name = 'student_post';
    $postQuery = "INSERT INTO $table_name(title,content,email_id) values('$title','$content','$email')";
    if (mysqli_query($conn, $postQuery)) {
        echo "
                    <script>
                        alert('Your Post will be verified by admin.');
                    </script>
                ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<?php

$getPostDetailsQuery = "SELECT sd.first_name as first_name, sd.last_name as last_name, sd.user_name as user_name, sd.email_id as email_id, sd.profile_picture as profile_picture, sp.title as title,sp.content as content,sp.id as id FROM student_details as sd INNER JOIN student_post as sp on sd.email_id = sp.email_id WHERE sp.isaccepted = '1' ORDER BY sp.id DESC";
$result = mysqli_query($conn, $getPostDetailsQuery);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create | view Post</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <!-- <link href="./styles/style.css" rel="stylesheet" /> -->
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #172b4d;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home.php">Student Dashboard</a>
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
                            Events
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="./post.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Post
                        </a>
                        <a class="nav-link" href="./message.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Message
                        </a>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?php
                if ($isProfileAdded == 1) {
                    echo '<center><a href="#" class="btn btn-info my-5" style="color:white;font-weight:500" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create new post </a></center>';
                }

                ?>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button> -->


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="./post.php" method="POST">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Title</label>
                                        <input type="text" class="form-control" id="recipient-name" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Content</label>
                                        <textarea class="form-control" id="message-text" name="content" required></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-success">Publish</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- displaying the post -->

                <?php

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card  m-3">
                                        <div class=" card-header">
                                            <img src="./image/' . $row["profile_picture"] . '" alt="user image" style="width: 40px;height:40px" class="avatar avatar-sm rounded-circle" />
                                            <span style="font-size:20px;font-weight:500;margin-left:20px;">' . $row['first_name'] . " " . $row['last_name'] . '</span>
                                            <span> (' . $row["email_id"] . ')</span>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">' . $row['title'] . '</h5>
                                            <p class="card-text">' . $row['content'] . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
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