<!-- Loading Screen (Uses Existing Font) -->
<div id="loading">
    <div class="loader-container">
        <div class="spinner"></div>
        <p>Loading, please wait...</p>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="img/newlogo.png" width="50" alt="TrabahuJuan" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 f16">
        <li class="nav-item border-right">
          <a class="nav-link active font-weight-bold" aria-current="page" href="./index.php"> Home</a>
        </li>
        <li class="nav-item dropdown border-right">
          <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            How it works
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="./how.php?type=Employer">Employer - FAQ</a></li>
            <li><a class="dropdown-item" href="./how.php?type=Jobseeker">Jobseeker - FAQ</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link font-weight-bold" aria-current="page" href="./login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<style>

/* Fullscreen Loading Background */
  #loading {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.9); /* Adjust transparency */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
  }
  #loading.fade-out {
      opacity: 0;
      visibility: hidden;
  }

  /* Loader Container */
  .loader-container {
      display: flex;
      flex-direction: column; /* Stack items vertically */
      align-items: center;
      justify-content: center;
      text-align: center;
  }

  /* Enhanced Spinner */
  .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid rgba(0, 0, 0, 0.1);
      border-top: 5px solid #007bff; /* Use primary color */
      border-radius: 50%;
      animation: spin 1s linear infinite;
  }

  /* Smooth Spinning Animation */
  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

  /* Loading Text */
  p {
      margin-top: 10px;
      font-size: 14px; /* Increased size for visibility */
      font-weight: normal;
      color: hsl(0°, 0%, 80%);
      font-family: 'Arial', sans-serif!important;
  }

</style>

<!-- Loader JavaScript -->
<script>
  window.onload = function () {
      setTimeout(() => {
          document.getElementById("loading").classList.add("fade-out");
      }, 800); // 0.8-second delay before fading out
  };
</script>
