<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <?php
    include 'db-connector.php';
    //get the values from db
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $getContent = "SELECT  * FROM events WHERE event_id = :eventID";
      $stmt = $pdo_obj->prepare($getContent);
        $stmt->bindParam(':eventID', $id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
    }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.html#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="index.html#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.html#activities">Services</a></li>
          <li><a class="nav-link  active scrollto" href="index.html#events">Events</a></li>
          <li><a class="nav-link scrollto" href="index.html#team">Team</a></li>
          <li><a class="nav-link scrollto" href="index.html#contact">Contact</a></li>
          <li><a class="login" href="Authentication/login.php">LOGIN</a></li>
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
          <li><a href="index.html">Home</a></li>
          <li>Event Details</li>
        </ol>
        <h2 class="header-text-2">Event Details</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">


                <!-- Event Image -->
                <div class="swiper-slide">
                  <?php echo '<img src="data:image/*;base64,' . $event['event_image'] . '" alt="image">'; ?>
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          
          <!-- Event Details -->
          <div class="col-lg-4">
          <h2 class="header-text-2"><?php echo $event['event_name']; ?></h2>
            <div class="portfolio-info" style="margin-top: 40px">
              <h3 class="header-text-2">Event information</h3>
              <ul class="body-text">
              <li><strong>Location</strong>:  <?php echo $event['event_location']; ?></li>
              <li><strong>Representative</strong>:  <?php echo $event['event_contact_person']; ?></li>
              <li><strong>Contact Number</strong>:  <?php echo $event['event_contact']; ?></li>
              <li><strong>Date</strong>: <?php echo date("F j, Y", strtotime($event['event_date_start'])); ?> - <?php echo date("F j, Y", strtotime($event['event_date_end'])); ?></li>
              <li><strong>Time</strong>: <?php echo date("h:i A", strtotime($event['event_time_start'])); ?> - <?php echo date("h:i A", strtotime($event['event_time_end'])); ?></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <p class="body-text">
              <?php echo $event['event_content']; ?>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

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