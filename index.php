<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Social Network</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/welcomeStyle.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light px-5 py-3">
        <a class="navbar-brand fs-1 ms-5" href="">Title<span id="title-dot">.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav" id="auth-btn">
                <li class="nav-item mx-3">
                    <a class="btn" href="./modules/admin/Login/index.php" id="login-btn">ADMIN</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="btn " href="./auth/login.php" id="login-btn">LOGIN</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" id="join-now" href="./auth/register.php">JOIN NOW</a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="landing-section">
        <div class="container-fluid row">
            <div class="col-md-6" id="intro-section">
                <h3 class="py-3" id="wel-tit-1">One place for all needs!</h3>
                <p class="px-5 fs-5">
                    You can do your college work more productively and more organized
                    with the help of the student and teacher community.
                </p>
                <a class="nav-link py-2 px-3" id="join-now" href="./auth/register.php">JOIN NOW<i class="bi bi-arrow-right-short fs-5 align-middle"></i></a>
            </div>

            <div class="col-md-6 py-5" id="landing-image">
                <img src="./images/landing-image.jpg" alt="landing image" id="lan-img" style="width: 100%;" />
            </div>
        </div>
    </section>
</body>

</html>