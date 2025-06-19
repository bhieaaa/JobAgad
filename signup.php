<?php 
include './config/db.php';
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

$current_date = date("Y-m-d");
$verification_code = random_int(0, 999999);
$verification_code = str_pad($verification_code, 6, 0, STR_PAD_LEFT);
if (isset($_POST['type'])) {
    // Sanitize input
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $education = mysqli_real_escape_string($conn, $_POST["education"]);
    $jobposition = mysqli_real_escape_string($conn, $_POST["jobposition"]);
    $about = mysqli_real_escape_string($conn, $_POST["about"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format!")</script>';
        exit;
    }

    // Check if the email already exists
    $run = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $count = mysqli_num_rows($run);

    if ($count > 0) {
        echo '<script>alert("Email already exists!")</script>';
    } else {
        // Hash password
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $insert = mysqli_query($conn, "INSERT INTO users (fname, lname, email, gender, dob, phone, password, address, education, jobposition, about, status, type, photo, created_date) VALUES 
        ('$fname', '$lname', '$email', '$gender', '$dob', '$phone', '$password', '$address', '$education', '$jobposition', '$about', 'Active', '$type', '', '$current_date')");
        if ($insert) {
            $user_id = mysqli_insert_id($conn); //get user id after sign up

            //insert job connects
            if($type == "Jobseeker"){
              $inert_connect = mysqli_query($conn, "INSERT INTO user_job_connects (user_id, available_connects, created_date) VALUES('$user_id', '20', '$current_date')");
            }else if($type == "Employer"){
              $inert_connect = mysqli_query($conn, "INSERT INTO user_job_connects (user_id, available_connects, created_date) VALUES('$user_id', '5', '$current_date')");
            }

            $inert_email_verification = mysqli_query($conn, "INSERT INTO user_verification (user_id, file_name, code, verification_type, status, decline_reason, created_date) VALUES('$user_id', '', '$verification_code', 'Email', 'Not Verified', '', '$current_date')");
            
            //send verification in email
            sendEmail($email, "Traba-Juan - Verify Email", sendVerificationEmailBody($verification_code, 'Use the verification code below to complete your sign-in:'));
            session_start();
            $_SESSION['email'] = $email;

            echo '<script>location.href = "./verifycode.php?success=1"; </script>';
        } else {
            echo '<script>alert("Error: Could not register user.")</script>';
        }
    }
}
?>

<!-- userModal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-lg-down">
    <div class="modal-content">
        <div class="modal-header">
            <div class="">
                <h4 class="modal-title text-dark" id="modalLabel"> Sign up as jobseeker </h4>
                <small class="text-muted">Join with us to discover something</small>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="userForm" method="POST">
                <input type="hidden" name="type" id="type" value="Jobseeker" class="form-control" placeholder="User Type" />
                <div class="row mb-10">
                    <div class="col">
                        <div class="form-group">
                          <label>First name</label>
                          <input type="text" maxlength="20" name="fname" id="fname" class="form-control" placeholder="First name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Last name</label>
                          <input type="text" maxlength="20" name="lname" id="lname" class="form-control" placeholder="Last name" />
                        </div>
                    </div>
                </div>
                <div class="form-group mb-10">
                  <label>Email</label>
                  <input type="email" name="email" maxlength="30" class="form-control" placeholder="Email" id="email" />
                </div>
                <div class="row mb-10">
                    <div class="col">
                        <div class="form-group">
                          <label>Gender</label>
                          <select class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Date of birth</label>
                          <input type="date" name="dob" max='2005-12-31' class="form-control" id="dob" />
                        </div>
                    </div>
                </div>
                <div class="form-group mb-10">
                  <label>Phone Number</label>
                  <input type="text" name="phone" maxlength="20" class="form-control"  placeholder="Phone Number" id="phone" />
                </div>
                <div class="row mb-10">
                    <div class="col">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" maxlength="20" name="password" class="form-control" placeholder="Password" id="password" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" maxlength="20" name="cpassword" class="form-control" placeholder="Confirm Password" id="cpassword" />
                        </div>
                    </div>
                </div>
                <div class="form-group mb-10">
                  <label>Complete Address</label>
                  <input type="text" name="address" maxlength="50" class="form-control" placeholder="Address" id="address" />
                </div>
                <div class="form-group mb-10">
                  <label>Education Level</label>
                  <select class="form-control" name="education" id="education">
                    <option value="Elementary Graduate">Elementary Graduate</option>
                    <option value="I did not graduate from hisgschool">I did not graduate from hisgschool</option>
                    <option value="High School Diploma">High School Diploma</option>
                    <option value="Associates Degree">Associates Degree</option>
                    <option value="Bachelors Degree">Bachelors Degree</option>
                    <option value="Postgraduate Degree">Postgraduate Degree (Masters, Doctorate, etc.)</option>
                  </select>
                </div>
                <div class="row mb-10">
                    <div class="col jobseeker-only">
                      <div class="form-group">
                        <label>Job Position / Profession</label>
                        <textarea class="form-control" rows="4" id="jobposition" name="jobposition" placeholder="EG: Electrician, Carpenter, Gardener, Painter, Handyman, etc." maxlength="255"></textarea>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label>About me</label>
                        <textarea class="form-control" rows="4" id="about" name="about" placeholder="About me" maxlength="1200"></textarea>
                      </div>
                    </div>
                </div>
                <div class="tacbox">
                  <input type="checkbox" id="termsCheckbox" />
                  I agree to these <a href="terms.php">Terms and Conditions</a>.
                </div>

                <div class="d-grid gap-2">
                  <button type="button" id="btn-user-signup" class="btn btn-block btn-primary my-3" disabled>
                    Sign Up
                  </button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<script>
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

function ValidateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

function validatePassword(password) {
  // Check minimum length
  if (password.length < 6) {
    return false;
  }
  
  // Check for at least one uppercase letter
  if (!/[A-Z]/.test(password)) {
    return false;
  }
  
  return true;
}

$(document.body).on("click", ".btn-signup", function(){
  let type = $(this).attr("data-type");
  $("#type").val(type);
  $("#modalLabel").text("Sign up as " + type.toLowerCase());
  
  // Show/hide job position field based on user type
  if(type === "Employer") {
    $(".jobseeker-only").hide();
    $("#jobposition").val(""); // Clear the field when hidden
  } else {
    $(".jobseeker-only").show();
  }
  
  $("#userModal").modal("show");
});

$("#btn-user-signup").click(function(){
  let returnfalse = 0;
  let type = $("#type").val();

  if($("#fname").val().length == 0){
    $("#fname").addClass("border-danger")
    returnfalse = 1
  }
  if($("#lname").val().length == 0){
    $("#lname").addClass("border-danger")
    returnfalse = 1
  }
  if($("#email").val().length == 0){
    $("#email").addClass("border-danger")
    returnfalse = 1
  }
  else if($("#email").val().length > 0 && !ValidateEmail($("#email").val())){
    $("#email").addClass("border-danger")
    alert('Invalid Email')
    returnfalse = 1
  }
  if($("#dob").val().length == 0){
    $("#dob").addClass("border-danger")
    returnfalse = 1
  }
  if($("#phone").val().length == 0){
    $("#phone").addClass("border-danger")
    returnfalse = 1
  }
  if($("#password").val().length == 0){
    $("#password").addClass("border-danger")
    returnfalse = 1
  }
  else if (!validatePassword($("#password").val())) {
    $("#password").addClass("border-danger")
    alert('Password must be at least 6 characters long and contain at least one uppercase letter')
    returnfalse = 1
  }
  if($("#cpassword").val().length == 0){
    $("#cpassword").addClass("border-danger")
    returnfalse = 1
  }
  if($("#password").val().length > 0 && $("#cpassword").val().length > 0){
    if($("#password").val() != $("#cpassword").val()){
      $("#password").addClass("border-danger")
      $("#cpassword").addClass("border-danger")
      alert('Password not match')
      returnfalse = 1
    }
  }
  if($("#address").val().length == 0){
    $("#address").addClass("border-danger")
    returnfalse = 1
  }

  // Only validate jobposition for Jobseekers
  if(type === "Jobseeker" && $("#jobposition").val().length == 0){
    $("#jobposition").addClass("border-danger")
    returnfalse = 1
  }
  
  if($("#about").val().length == 0){
    $("#about").addClass("border-danger")
    returnfalse = 1
  }
  
  if(returnfalse == 1){
    return false
  }
  
  if (confirm('Are you sure? click OK to continue.')) {
    $("#userForm").submit()
  }
});

// Terms checkbox functionality
const termsCheckbox = document.getElementById('termsCheckbox');
const signupButton = document.getElementById('btn-user-signup');

termsCheckbox.addEventListener('change', () => {
  signupButton.disabled = !termsCheckbox.checked;
});

// Remove red border when user starts typing
$("input, textarea, select").on("input", function(){
  $(this).removeClass("border-danger");
});
</script>

