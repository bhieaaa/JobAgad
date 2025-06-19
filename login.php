
<?php 
include './config/db.php';

session_start();

if(isset($_SESSION['user_type']) == "Jobseeker"){
  header('Location:user/index.php');
} 
else if(isset($_SESSION['user_type']) == "Employer"){
  header('Location:user/employer.php');
}

$message = "";
$hasError = false;
if(isset($_GET['success']) == 1){
  $message = "<div class='alert alert-success text-center'>Verification success! You can now sign in</div>";
}

if(isset($_POST['login_email']) && isset($_POST['login_password'])){
  $email = mysqli_real_escape_string($conn, $_POST["login_email"]);
  $password = mysqli_real_escape_string($conn, $_POST["login_password"]);

  if(empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $message = "<div class='alert alert-danger text-center'>Wrong Email or Password!</div>";
    $hasError = true;
  }

  if(!$hasError){
    $run = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    $row = mysqli_fetch_array($run); 
    
    if($row){
        if($row['status'] == 'Inactive') {
            $message = "<div class='alert alert-danger text-center'>Your account has been blocked. Please contact the admin.</div>";
        } else {
            $check_email_verification = mysqli_query($conn, "SELECT * FROM user_verification WHERE user_id = " . $row['id'] . " AND status = 'Not Verified' AND verification_type = 'Email'");
            $count_email_verification = mysqli_num_rows($check_email_verification);
            
            if($count_email_verification > 0){
                $_SESSION['email'] = $row['email'];
                header('Location: verifycode.php');
                exit();
            } else {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_type'] = $row['type'];
                $_SESSION['full_name'] = $row['fname'] . ' ' . $row['lname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['is_verified'] = "Verified";

                if($row['type'] == "Jobseeker"){
                    header('Location:user/index.php');
                } else if($row['type'] == "Employer"){
                    header('Location:user/employer.php');
                }
                exit();
            }
        }
    } else {
        $message = "<div class='alert alert-danger text-center'>Wrong Email or Password!</div>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>TrabaJuan | Login</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="./img/header-logo.png" type="image/x-icon">
  <!--bootstrap-->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <!--fontawesom-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/custom.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <script src="./js/jquery.min.js"></script>
</head>

<body>
  <!--navbar-->
  <?php include 'navbar.php'; ?>
  <!-- login  -->
  <div class="container d-flex flex-column flex-lg-row justify-content-evenly" style="padding-top: 7rem;">
    <!-- heading -->
    <div class="text-center text-lg-center mt-lg-5 pt-lg-5">
      <img class="img-fluid" src="./img/newbrandlogo.png" width="580px" alt="TrabahuJuan" />
      <p class="w-75 mx-auto ma-lg-0 fs-4">
        
      </p>
    </div>
    <!-- form  -->
    <div style="max-width: 30rem; width: 100%">
      <?php echo $message; ?>
      <div class="bg-white shadow rounded p-3 input-group-lg">
        <form action="login.php" method="post">
          <h1 class="text-center">SIGN IN</h1>
          <div class="form-floating my-3">
            <input type="email" name="login_email" class="form-control" id="floatingInput" placeholder="name@example.com"
              style="background-color: #F4F4F4">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating my-3 position-relative">
              <input type="password" name="login_password" class="form-control" id="floatingPassword" placeholder="Password"
                  style="background-color: #F4F4F4; padding-right: 40px;">
              <label for="floatingPassword">Password</label>
              <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword"
                  style="cursor: pointer; font-size: 1.2rem;"></i>
          </div>
          <button type="submit" class="btn btn-primary my-3 w-100">
            Sign in
          </button>
          <div class="text-center">
          <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a> </div>

        </form>
        <!-- <a href="#" class="text-decoration-none text-center">
          <p>Forgotten password?</p>
        </a> -->
        <hr />
        <div class="my-4">
          <div class="btn-group d-flex bd-highlight" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-secondary btn-signup" data-type="Jobseeker">Sign up as Jobseeker</button>
            <button type="button" class="btn btn-outline-secondary btn-signup" data-type="Employer">Sign up as Employer</button>
          </div>
        </div>
      </div>
      <div class="text-center my-5 pb-5">
        <p>
          Stay focused, stay motivated, and conquer your dream job.
        </p>
      </div>
    </div>
  </div>
  <?php
    include 'signup.php'
  ?>
  <!-- footer  -->
  <footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>About us</h3>
            <p>TrabaJuan is an online platform designed to connect individuals seeking casual jobs with employers, making the job search and hiring process efficient and secure. It emphasizes ease of use, inclusivity, and transparency, helping users find or fill positions quickly while maintaining trust and accessibility.</p>
        </div>

        <div class="footer-section">
            <h3>Contacts</h3>
            <ul class="contact-info">
                <li>
                    <i class="fas fa-phone"></i>
                    <span>+639778476991</span>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Camino st, Sto Domingo Orion Bataan</span>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <span>peso_orionbataan@yahoo.com</span>
                </li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Partnership</h3>
            <img src="./img/peso.png" alt="" class="partnership">
        </div>

        <div class="footer-section">
            <h3>Socials</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/peso.orion"><i class="fab fa-facebook"></i></a>
                
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 TrabaJuan. All rights reserved Powered by Kenji Izon Cruses & Jayvee Reyes Cruz.</p>
    </div>
</footer>
<script>
          document.getElementById("togglePassword").addEventListener("click", function() {
              var passwordInput = document.getElementById("floatingPassword");
              if (passwordInput.type === "password") {
                  passwordInput.type = "text";
                  this.classList.remove("bi-eye");
                  this.classList.add("bi-eye-slash");
              } else {
                  passwordInput.type = "password";
                  this.classList.remove("bi-eye-slash");
                  this.classList.add("bi-eye");
              }
          });
          </script>
  <!--bootstrap-->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <!--main js-->
  <script src="./js/global.js"></script>
</body>

</html>