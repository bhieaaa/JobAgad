
<?php 
include './config/db.php';
if(!isset($_GET['type'])){
  header('Location:user/index.php');
}
if($_GET['type'] != 'Employer' && $_GET['type'] != 'Jobseeker'){
  header('Location:user/index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Traba-Juan | FAQ</title>
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
  
  <div class="container" style="padding-top: 8rem;">
    <div class="row justify-content-md-center">
      <div class="col-lg-8 col-md-12">
        <div class="text-left mb-30">
          <h4 class="font-weight-bold section-title mb-0">How It Works - <?php echo $_GET['type']; ?></h4>
          <hr class="custom-hr" style="position:absolute;">
          <div class="clearfix"></div>
        </div>
        <?php if($_GET['type'] == "Jobseeker"){ ?>
        <p class="preline-text pt-20">With today's technology, it is super easy to be hired by companies and then do the job from the comfort of your own home with your family. At Traba-Juan we'll help you explore online job opportunities and earn a living.

        All jobs will be salaried, full-time or part-time, work from home jobs. NONE of the jobs are commission based!

        Before we get started, Please read the FAQ's below.</p>
        <?php }else{ ?>
          <h6 class="mb-10 pt-30">STEP 1 : Post a Job</h6>
          <p>Let talented workers come to you and apply for a job.</p>

          <h6 class="mb-10">STEP 2 : Find the perfect staff member</h6>
          <ul>
            <li class="mb-5">Communicate with them via simple email.</li>
            <li class="mb-5">Interview them like you would for a normal staff member.</li>
            <li class="mb-5">Find the perfect fit.</li>
            <li class="mb-5">Offer them a job. Negotiate a salary, work hours, and your expectations.</li>
            <li class="mb-5">Often, the person you’re interviewing is unemployed and can immediately start to work!</li>
          </ul>

          <h6 class="mb-10">STEP 3 : Hire and Manage</h6>
          <ul>
            <li class="mb-5">Write detailed job descriptions that outline responsibilities, qualifications, and expectations. This will help you attract the right candidates.</li>
            <li class="mb-5">Skills can be trained, but a good cultural fit ensures long-term success. Look for candidates who align with your company's values and vision.</li>
            <li class="mb-5">Create a set of questions that you ask all candidates to ensure fair comparison. Include behavioral questions to gauge how they handle real-life scenarios.</li>
            <li class="mb-5">Ensure that each employee knows what is expected of them and how success is measured. Regular feedback is key.</li>
            <li class="mb-5">Encourage an environment where employees feel comfortable sharing ideas, concerns, and feedback. Regular check-ins help you stay informed about progress and issues.</li>
            <li class="mb-5">Offer training and opportunities for career growth. Employees feel more motivated when they see potential for advancement.</li>
          </ul>
          <h4 class="font-weight-bold section-title mb-0 mt-40">Frequently Asked Questions</h4>
          <hr class="custom-hr" style="position:absolute;">
          <div class="clearfix mb-40"></div>
        <?php } ?>
        <div class="accordion" id="accordionExample">
          <?php 
            $get_faq = mysqli_query($conn, "SELECT * FROM frequently_as_question WHERE type = '".$_GET['type']."'");
            while($row_faq = mysqli_fetch_array($get_faq)){
          ?>
            <div class="accordion-item mb-10">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-primary bg-gradient text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $row_faq['id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo $row_faq['question'] ?>
                </button>
              </h2>
              <div id="collapse-<?php echo $row_faq['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <?php echo $row_faq['answer'] ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
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