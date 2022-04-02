<?php
include('./config.php');
?>
<?php

// $error = "";
if (isset($_POST['submit'])) {
  $first_name = $_POST['first-name'];
  $last_name = $_POST['last-name'];
  $email = trim($_POST['email']);
  $pwd = $_POST['password'];
  $role = $_POST['stud_or_teacher'];

  $query = "SELECT * from waiting_registration where email_id = '" . $_POST['email'] . "'";
  $select = mysqli_query($conn, $query);
  if (mysqli_num_rows($select)) {
    echo '<script>alert("This email address is already used!")</script>';
    // $error = 'This email address is already used!' ;
  } else {
    $table_name = 'waiting_registration';
    $query = "INSERT into $table_name values('$first_name','$last_name','$email','$pwd','$role',0)";
    if (mysqli_query($conn, $query)) {
      // echo "data stored successfully";
      echo "
                    <script>
                        alert('Your data is send to admin. You need to wait for the admin approval');
                    </script>
                ";
      // header('Location: ../welcome.php');

    } else {
      echo "failed" . mysqli_error($conn);
    }
  }
}

?>
<html>

<head>
  <title>Register</title>
  <link rel="stylesheet" href="../styles/loginStyle.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Section: Design Block -->
  <section class="text-center text-lg-start">
    <style>
      .cascading-right {
        margin-right: -50px;
      }

      @media (max-width: 991.98px) {
        .cascading-right {
          margin-right: 0;
        }
      }
    </style>

    <!-- Jumbotron -->


    <center><a class="btn btn-dark mx-auto mt-5" href="../index.php">Go to Home page</a></center>

    <div class="container py-4 ">
      <div class="row g-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card cascading-right" style="
                   background: hsla(0, 0%, 100%, 0.55);
                   backdrop-filter: blur(30px);
                   ">
            <div class="card-body p-5 shadow-5  add-shadow">
              <h2 class="fw-bold mb-5 " id="change-color">Sign up now</h2>
              <form action="register.php" method="POST">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1" class="form-control" name="first-name" required />
                      <label class="form-label" for="form3Example1">First name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example2" class="form-control" name="last-name" required />
                      <label class="form-label" for="form3Example2">Last name</label>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3" class="form-control" name="email" required />
                  <label class="form-label" for="form3Example3">Email address</label>
                  <!-- <span style="color:red;margin-left:30px" >
                                   
                </span> -->
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4" class="form-control" name="password" required />
                  <label class="form-label" for="form3Example4">Password</label>
                </div>
                <div class="form-outline mb-4 text-start">
                  <p>Select Your role : </p>
                  <input type="radio" id="student" name="stud_or_teacher" value="student" required>
                  <label for="student">Student</label><br>
                  <input type="radio" id="teacher" name="stud_or_teacher" value="teacher">
                  <label for="teacher">Teacher</label><br>
                </div>

                <!-- Submit button -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block  mb-4" id="btn-color" name="submit">
                    Sign up
                  </button>
                </div>

                <!-- Register buttons -->
                <div class="text-center">
                  <span>Already Have an account? <a href="./login.php">Login</a></span>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-5 d-none d-lg-block">
          <img src="../images/signup.jpg" class="w-100 rounded-4 shadow-4" alt="sign up" style="height: 100%;" />
        </div>
      </div>
    </div>

    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->
</body>

</html>