<?php
include('./config.php');
?>

<?php
$msg = "";
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pwd = $_POST['password'];
  $role = $_POST['stud_or_teacher'];

  if ($email != "" && $pwd != "" && $role != "") {
    $query = "SELECT * from credential where email_id = '$email' && password = '$pwd' && role = '$role'";
    $sql = mysqli_query($conn, $query);
    $num = mysqli_num_rows($sql);
    if ($num > 0) {
      $row = mysqli_fetch_assoc($sql);
      $_SESSION['email'] = $row['email_id'];
      if ($row['role'] == "student") {
        header('location:../modules/student/home.php');
      } else {
        header('location:../modules/teacher/home.php');
      }
    } else {
      $msg = "* Please Enter a valid details..";
    }
  }
}
?>

<html>

<head>
  <title>LOGIN</title>
  <link rel="stylesheet" href="../styles/loginStyle.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <center><a class="btn btn-dark mx-auto mt-5" href="../index.php">Go to Home page</a></center>
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="../images/image2.jpg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 p-5 col-lg-5 col-xl-5 offset-xl-1 add-shadow">
          <form action="./login.php" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <center>
                <h2 id="change-color">LOGIN</h2>
              </center>
            </div>

            <div class="form-outline m-3">
              <span style="color:red"><?php if (!empty($msg)) echo $msg ?></span>
            </div>

            <div class="form-outline mb-4">
              <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" required />
              <label class="form-label" for="form1Example13">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" required />
              <label class="form-label" for="form1Example23">Password</label>
            </div>

            <div class="form-outline mb-4 ">
              <p>Select Your role : </p>
              <input type="radio" id="student" name="stud_or_teacher" value="student" required>
              <label for="student">Student</label><br>
              <input type="radio" id="teacher" name="stud_or_teacher" value="teacher">
              <label for="teacher">Teacher</label><br>
            </div>

            <!-- Submit button -->
            <div class="text-center my-5">
              <input type="submit" class="btn btn-primary btn-block" id="btn-color" value="Sign in" name="submit" />
            </div>

            <div class="text-center">
              <span>Don't have an account? <a href="./register.php">Register</a></span>
            </div>


          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>