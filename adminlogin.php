
<?php 
include './config/db.php';

session_start();
if(isset($_SESSION['admin_id'])){
  header('Location:admin/index.php');
}

$message = '';
$hasError = false;

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  // Check if email or password is empty
  if(empty($email) || empty($password)){
    $message = "<div class='alert alert-danger text-center'>Wrong Email or Password!</div>";
    $hasError = true;
  }

  // Check if the email is not valid
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $message = "<div class='alert alert-danger text-center'>Wrong Email or Password!</div>";
    $hasError = true;
  }

  if(!$hasError){
    $run = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
    $count = mysqli_num_rows($run);
    $row = mysqli_fetch_array($run); 

    if($count > 0){
      session_start();
      $session_userlevel = "ADMIN";
      $_SESSION['type'] = $session_userlevel;
      $_SESSION['admin_id'] = $row['id'];
      $_SESSION['admin_name'] = $row['name'];

      if($session_userlevel == "ADMIN"){
        header('Location:admin');
      }
    }else{
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
  <title>Traba-Juan | login</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="./img/newlogo.png" type="image/x-icon">
  <!--bootstrap-->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <!--fontawesom-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/custom.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="./js/jquery.min.js"></script>
</head>

<body>
  <!--navbar-->
  <?php include 'navbar.php'; ?>
  <!-- login  -->
  <div class="container d-flex flex-column flex-lg-row justify-content-evenly" style="padding-top: 10rem;">
    <!-- heading -->
    <div class="text-center text-lg-center mt-lg-5 pt-lg-5">
      <img class="img-fluid" src="./img/newbrandlogo.png" width="580px" alt="TrabahuJuan" />
      <p class="w-75 mx-auto ma-lg-0 fs-4">
      </p>
    </div>
    <!-- form  -->
    <div style="max-width: 30rem; width: 100%; margin-top:2rem;">
      <?php echo $message; ?>
      <div class="bg-white shadow rounded p-3 input-group-lg">
        <form action="adminlogin.php" method="post">
          <h1 class="text-center">Admin Log in</h1>
          <div class="form-floating my-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
              style="background-color: #F4F4F4">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating my-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
              style="background-color: #F4F4F4">
            <label for="floatingPassword">Password</label>
          </div>
          <button type="submit" class="btn btn-primary my-3 w-100">
            Login
          </button>
        </form>
      </div>
      <div class="text-center my-5 pb-5">
        <p>
          Stay focused, stay motivated, and conquer your dream job.
        </p>
      </div>
    </div>
  </div>
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
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 TrabaJuan. All rights reserved Powered by Kenji Izon Cruses & Jayvee Reyes Cruz.</p>
    </div>
</footer>
  <!--bootstrap-->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <!--main js-->
  <script src="./js/global.js"></script>
</body>

</html>