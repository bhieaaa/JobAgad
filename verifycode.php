
<?php 
include './config/db.php';

session_start();

if(!isset($_SESSION['email'])){
  header('Location:user/index.php');
} 

include './config/emailtemplate.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendEmail($email, $subject, $body){
  include_once "./PHPMailer/src/PHPMailer.php";
  include_once "./PHPMailer/src/Exception.php";
  include_once "./PHPMailer/src/SMTP.php";

  $mail = new PHPMailer(true);  

  try {
    //Server settings   
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                         
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'no.reply1092024@gmail.com';       
    $mail->Password = 'thrcjabgjbldsepn';                      
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                            
    $mail->Port = 587;                                    

    //Recipients
    $mail->setFrom('no.reply1092024@gmail.com', 'Traba-Juan');
    $mail->addAddress($email); 
    
    //Attachments
    // $file_name = "document/" . $_FILES["file"]["name"];
    // move_uploaded_file($_FILES["file"]["tmp_name"], $file_name);
    // $mail->addAttachment($file_name);

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
  } catch (Exception $e) {
    echo "<script>console.log('Message could not be sent. Mailer Error: ".$mail->ErrorInfo."')</script>";
  }   
}

$message = "";
$email = $_SESSION['email'];
$getuser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
$row = mysqli_fetch_array($getuser);
$user_id =  $row['id'];

if(isset($_GET['success']) == 1){
  $message = "<div class='alert alert-success text-center'>You have successfully registered! Enter verification code sent to your email to continue sign in.</div>";
}

if(isset($_POST['resend'])){
  $verification_code = random_int(0, 999999);
  $verification_code = str_pad($verification_code, 6, 0, STR_PAD_LEFT);

  $update_verification_status = mysqli_query($conn, "UPDATE user_verification SET code = '$verification_code' WHERE user_id = '$user_id' AND verification_type = 'Email'");

  sendEmail($_SESSION['email'], "Traba-Juan - Verify Email", sendVerificationEmailBody($verification_code, 'Use the verification code below to complete your sign-in:'));
}

if(isset($_POST['submit']) && isset($_POST['code'])){
  $verifycode = mysqli_real_escape_string($conn, $_POST["code"]);

  $check_code = mysqli_query($conn, "SELECT * FROM user_verification WHERE user_id = '$user_id' AND code = '$verifycode' AND verification_type = 'Email'");
  $count_check_code = mysqli_num_rows($check_code);
  
  if($count_check_code > 0){
    $update_verification_status = mysqli_query($conn, "UPDATE user_verification SET status = 'Verified' WHERE user_id = '$user_id'");

    echo '<script>location.href = "./login.php?success=1"; </script>';
  }else{
    $message = "<div class='alert alert-danger text-center'>Invalid verification code.</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Traba-Juan | Verification Code</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="./img/header-logo.png" type="image/x-icon">
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
  <div class="container d-flex flex-column flex-lg-row justify-content-evenly" style="padding-top: 15rem;">
    <!-- form  -->
    <div style="max-width: 28rem; width: 100%">
      <?php echo $message; ?>
      <div class="bg-white shadow rounded p-3 input-group-lg">
        <form method="post">
          <h4 class="text-center">Verify code sent to your email</h4>
          <div class="form-floating my-3">
            <input type="text" name="code" class="form-control" id="floatingInput" placeholder="000000"
              style="background-color: #F4F4F4">
            <label for="floatingInput">Verification Code</label>
          </div>
          <div class="d-grid gap-2">
            <input type="submit" name="submit" class="btn btn-primary w-100" value="Submit">
            <input type="submit" name="resend" class="btn btn-success w-100" value="Resend">
          </div>
        </form>
      </div>
    </div>
  </div>

  <br>
  <br>

  <br>
  <br>
  <br>
  <br>
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
  <!--bootstrap-->
  <script src="./js/bootstrap.bundle.min.js"></script>
  <!--main js-->
  <script src="./js/global.js"></script>
  <script>
      if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
      }
  </script>
</body>

</html>