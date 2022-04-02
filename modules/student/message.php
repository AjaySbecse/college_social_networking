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

<!-- get the messages from the table -->
<?php

$table_name = 'message';
$table_name_2 = 'waiting_registration';
$msgQuery = "SELECT w.first_name as first_name, w.last_name as last_name, m.message as message, m.sent_by as sent_by FROM $table_name m INNER JOIN $table_name_2 w ON m.sent_by = w.email_id";
$msgResult = mysqli_query($conn, $msgQuery);



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <!-- <link href="./styles/style.css" rel="stylesheet" /> -->
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        #chat1 .form-outline .form-control~.form-notch div {
            pointer-events: none;
            border: 1px solid;
            border-color: #eee;
            box-sizing: border-box;
            background: transparent;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-leading {
            left: 0;
            top: 0;
            height: 100%;
            border-right: none;
            border-radius: .65rem 0 0 .65rem;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-middle {
            flex: 0 0 auto;
            max-width: calc(100% - 1rem);
            height: 100%;
            border-right: none;
            border-left: none;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-trailing {
            flex-grow: 1;
            height: 100%;
            border-left: none;
            border-radius: 0 .65rem .65rem 0;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-left: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-leading {
            border-right: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle {
            border-bottom: 0.125rem solid;
            border-color: #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-middle {
            border-top: none;
            border-right: none;
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-right: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-trailing {
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-label {
            color: #39c0ed;
        }

        #chat1 .form-outline .form-control~.form-label {
            color: #bfbfbf;
        }

        #scroll {
            height: 600px;
            overflow-x: hidden;
            overflow-y: auto;
            position: relative;
        }

        /* for message send button */
        .searchBox {
            background: #2f3640;
            height: 60px;
            border-radius: 50px;
            padding: 10px;
            margin-left: 10px;
        }

        .searchBox:hover>.searchInput {
            width: 250px;
            padding: 0 6px;
        }

        .searchBox:hover>.searchButton {
            background: #fff;
            color: #2f3640;
        }

        .searchButton {
            color: white;
            float: right;
            width: 40px;
            height: 40px;
            padding: 10px;
            border-radius: 50%;
            background: #2f3640;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.4s;
        }

        .searchInput {
            border: none;
            background: none;
            outline: none;
            float: left;
            padding-top: 0px;
            color: white;
            font-size: 16px;
            transition: 0.4s;
            line-height: 50px;
            margin-top: -5px;
            width: 80%;
            margin-left: 10px;
        }

        @media screen and (max-width: 620px) {
            .searchBox:hover>.searchInput {
                width: 150px;
                padding: 0 6px;
            }
        }
    </style>
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
            <main class="p-3">

                <section>
                    <div class="py-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8 col-lg-6">
                                <div class="card" id="chat1" style="border-radius: 15px;">
                                    <div class="card-header d-flex justify-content-between align-items-center p-3 bg-dark text-white border-bottom-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <!-- <i class="fas fa-angle-left"></i> -->
                                        <p class="mb-0 fw-bold">Live chat</p>
                                        <!-- <i class="fas fa-times"></i> -->
                                    </div>
                                    <div class="card-body" id="scroll" style="padding-bottom: 70px;">

                                        <?php

                                        while ($row = mysqli_fetch_assoc($msgResult)) {
                                            if ($row['sent_by'] == $_SESSION['email']) {
                                                echo '
                                                <div class="d-flex flex-row justify-content-end mb-4">
                                                    <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                                                        <p class="small mb-0">' . $row['message'] . '</p>
                                                        
                                                    </div>
                                                    <span style="font-size:13px;color:red">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
                                                    <!-- <img src="" alt="avatar 1" style="width: 45px; height: 100%;"> -->
                                                </div>
                                                ';
                                            } else {
                                                echo '
                                                <div class="d-flex flex-row justify-content-start mb-4">
                                                    <span style="font-size:13px;color:red">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
                                                    <!--<img src="./image/citry.jpg" alt="avatar 1" style="width: 45px;height:45px ;border-radius:50%"> -->
                                                    <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                                                        <p class="small mb-0">' . $row['message'] . '</p>
                                                    </div>
                                                    
                                                </div>
                                                ';
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="searchBox" style="position: absolute;bottom:5;width:95%">
                                        <form action="./sendMessage.php" method="POST">
                                            <input class="searchInput" type="search" name="msg" placeholder="Type here....">
                                            <button class="searchButton" type="submit" name="send-msg">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>





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