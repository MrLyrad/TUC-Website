<?php
  session_start();
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $volunteer_id = $user["volunteer_id"];
    $email = $user["email"];
    $username = $user["username"];
    $fullname = $user["full_name"];
    $contact = $user["contact"];
  } else {
    $user = null;
    $email = null;
    $username = null;
    $full_name = null;
    $contact = null;
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Account</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/font.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center">

        <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto " href="index.php#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                <li><a class="nav-link scrollto" href="index.php#activities">Activities</a></li>
                <li><a class="nav-link scrollto" href="index.php#events">Events</a></li>
                <?php
                if(!isset($_SESSION["user"])){
                } else {
                    echo "<li><a class='nav-link scrollto' href='my-events.php'>My Events</a></li>";
                }
                ?>
                <li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
                <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                <?php
                if(!isset($_SESSION["user"])){
                    echo "<li><a class='login' href='authentication/login.php'>LOGIN</a></li>";
                } else {
                    echo "<li><a class='nav-link scrollto active' href='account-details.php'>Account</a></li>";
                    echo "<li><a class='login' href='authentication/logout.php'>LOGOUT</a></li>";
                }
                ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Account Details</li>
        </ol>
        <h2 class="header-text-2">Account Details</h2>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <div class="container-form">
      <?php 
            echo   "<div class='item2'>
                        <label for='username' class='textlabel input-head'>Username</label><br>
                        <input type='text' value='$username' class='form-control' readonly>
                    </div>
                    <div class='item1'>
                        <label for='fullname' class='textlabel input-head'>Full Name</label><br>
                        <input type='text' value='$fullname' class='form-control' readonly>
                    </div>
                    <div class='item3'>
                        <label for='email' class='textlabel input-head'>Email</label><br>
                        <input type='text' value='$email' class='form-control' readonly>
                    </div>
                    <div class='item4'>
                        <label for='contact' class='textlabel input-head'>Contact Number</label><br>";
                    if(is_null($contact)){
                        echo "<input type='text' value='No Contact Number' class='form-control' readonly>"."</div>";
                    } else {
                        echo "<input type='text' value='$contact' class='form-control' readonly>"."</div>";
                    }
                    
        ?>
      </div>

    <div class="line"></div>
    </section>
    <center>
        <a class="btn btn-success" href="edit-account.php">Change Account Details</a>
    </center>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                <h3 class="header-text-2">Tanglaw University Center</h3>
                <p>
                    A108 Adam Street <br>
                    New York, NY 535022<br>
                    United States <br><br>
                    <strong>Phone:</strong> +1 5589 55488 55<br>
                    <strong>Email:</strong> info@example.com<br>
                </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                <h4 class="header-text-2">Useful Links</h4>
                <ul class="body-text">
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                <h4 class="header-text-2">Our Social Networks</h4>
                <p class="body-text">Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                <div class="social-links mt-3">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
                </div>

            </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
            &copy; Copyright <strong><span>Tanglaw University Center</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>