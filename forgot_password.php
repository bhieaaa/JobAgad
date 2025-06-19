<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

include './config/db.php';
session_start();
$message = "";

if(isset($_POST['reset_email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['reset_email']);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        $user = mysqli_fetch_assoc($query);

        if($user) {
            $password = $user['password']; // Assuming passwords are stored as plain text (not recommended)
            
            // PHPMailer setup
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'no.reply1092024@gmail.com'; // Replace with your email
                $mail->Password = 'thrcjabgjbldsepn'; // Use App Password for Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('no-reply@trabajuan.click', 'TrabaJuan');
                $mail->addAddress($email);
                $mail->Subject = "Password Recovery - TrabaJuan";
                $mail->Body = "Hello, your password is: $password\nPlease log in and change your password.";
                
                $mail->send();
                $message = "<div class='alert alert-success text-center'>Password has been sent to your email.</div>";
            } catch (Exception $e) {
                $message = "<div class='alert alert-danger text-center'>Failed to send email. Error: {$mail->ErrorInfo}</div>";
            }
        } else {
            $message = "<div class='alert alert-danger text-center'>Email not found!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger text-center'>Invalid email format!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | TrabaJuan</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2 class="text-center">Forgot Password</h2>
        <?php echo $message; ?>
        <form action="forgot_password.php" method="post">
            <div class="form-floating my-3">
                <input type="email" name="reset_email" class="form-control" id="floatingInput" placeholder="Enter your email">
                <label for="floatingInput">Email address</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
