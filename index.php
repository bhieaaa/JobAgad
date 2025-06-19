<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Traba-Juan | Home Page</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./img/newlogo.png" type="image/x-icon">
    <!--bootstrap-->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!--fontawesom-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/custom.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/sign.css" />
    <link rel="stylesheet" href="./css/reg.css" />
    <link rel="stylesheet" href="./css/feature.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/jquery.min.js"></script>
    <script src="./js/reg.js"></script>
      <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="7rpSgoFUnHfq62RFJltg6";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</head>
<body>
    <!--navbar-->
    <?php include 'navbar.php'; ?>
  
    <section class="creative-hero--section">
        <div class="bg bg-image" style="background-image: url('./img/bg.jpg');"></div>
        <div class="bg-overlay"></div>
        <div class="auto-container">
            <div class="content-box">
                <span class="hero-subtitle">Welcome to TrabaJuan</span>
                <h1 class="hero-title">Find Work. Find Talent. All in One Place</h1>
                <div class="hero-desc">
                Join us in supporting the community by providing hope and employment opportunities for EVERYJUAN!.
                </div>
                <div class="btn-box">
                    <a class="hero-cta" href="./login.php">
                        <span class="cta-title">LOG IN <i class="fa fa-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <br>
    <br>
    <br>
    <!--slider-->
    <div class="container">
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="signup-card">
                <h2>Join us for free!</h2>
                <div class="toggle-container">
                    <div class="toggle-option selected" data-role="jobseeker">
                        <i class="fas fa-user"></i>
                        <div>Jobseeker</div>
                    </div>
                    <div class="toggle-option" data-role="employer">
                        <i class="fas fa-briefcase"></i>
                        <div>Employer</div>
                    </div>
                </div>
                <button class="create-button" onclick="handleSignup()">Create account</button>
            </div>
        </div>
        <!-- Hidden links that will be triggered via JavaScript -->
        <div style="display: none;">
            <a id="jobseekerLink" class="btn btn-primary btn-lg mt-3 btn-signup" data-type="Jobseeker" href="javascript:void(0)" role="button">AS JOBSEEKER</a>
            <a id="employerLink" class="btn btn-primary btn-lg mt-3 btn-signup" data-type="Employer" href="javascript:void(0)" role="button">AS EMPLOYER</a>
        </div>
        <br>
        <div class="col-md-7">
            <div class="features">
                <h1>Enhance your skills the easy way.</h1>
                <div class="feature">
                    <h3>No cost to Register</h3>
                    <p>Sign up to connect, whether you're a jobseeker or an employer</p>
                </div>
                <div class="feature">
                    <h3>Post a job and hire top talent</h3>
                    <p>Finding Jobseeker made easy—post a job or let us find the perfect match for you!</p>
                </div>
                <div class="feature">
                    <h3>Quality talent, budget-friendly solutions</h3>
                    <p>Elevate your work without the high costs—Trabajuan keeps it budget-friendly.</p>
                </div>
                <div class="buttons">
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
    
    <br>
    <br>
    <br>
    <section class="features-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Feature Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="./img/search.png" alt="Search icon" class="img-fluid">
                    </div>
                    <div class="feature-content">
                        <h2>Find Your Job Easier</h2>
                        <p>At TrabaJuan, we understand that finding the right job can be a challenging process. That's why we've developed a suite of powerful tools and features to make your job search easier, faster, and more efficient.</p>
                    </div>
                </div>
            </div>

            <!-- Feature Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="./img/sign-language.png" alt="Application icon" class="img-fluid">
                    </div>
                    <div class="feature-content">
                        <h2>Easy Application Process</h2>
                        <p>Applying for jobs shouldn't be a time-consuming and complicated process. We've revolutionized the application experience to make it easier and more efficient. Discover how our job application portal simplifies the application process, giving you more time to focus on what matters – landing your dream job.</p>
                    </div>
                </div>
            </div>

            <!-- Feature Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="./img/shield.png" alt="Security icon" class="img-fluid">
                    </div>
                    <div class="feature-content">
                        <h2>Trust and Security</h2>
                        <p>We understand that your trust and security are of utmost importance when using a job application portal. We take this responsibility seriously and have implemented robust measures to ensure a safe and secure environment for your job search.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
    <!--bootstrap-->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/global.js"></script>
</html>