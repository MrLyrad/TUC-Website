<?php
  session_start();
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $volunteer_id = $user["volunteer_id"];
    $email = $user["email"];
    $username = $user["username"];
  } else {
    $user = null;
    $email = null;
    $username = null;
  }
?>

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

  <style>
#register-event {
  font-family: "Bugaki";
  font-weight: 500;
  font-size: 16px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 10px 28px 11px 28px;
  border-radius: 50px;
  transition: 0.5s;
  margin: 10px 0 0 0;
  border-style: none;
  color: #fff;
  background: #e78000;
}

#register-event:hover {
  background: #ffc95b;
}
  </style>

</head>

<body>

  <?php
  ob_start();
    include 'db-connector.php';
    //get the values from db
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $type = $_GET['type'];

      if($type=="archive"){
        $getContent = "SELECT  * FROM archived_events WHERE event_id = :eventID";
      }else{
        $getContent = "SELECT  * FROM events WHERE event_id = :eventID";
      }
      $stmt = $pdo_obj->prepare($getContent);
      $stmt->bindParam(':eventID', $id);
      $stmt->execute();
      $event = $stmt->fetch(PDO::FETCH_ASSOC);
      
    }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php#activities">Services</a></li>
          <li><a class="nav-link  active scrollto" href="index.php#events">Events</a></li>
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
              echo "<li><a class='nav-link scrollto' href='account-details.php'>Account</a></li>";
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
                  <?php
                  if (strlen($event['event_image']) > 0){
                      echo '<div class="portfolio-img"><img src="data:image/*;base64,' . $event['event_image'] . '" class="img-fluid" alt="image"></div>';
                   }else{
                      echo '<div class="portfolio-img"><img src="assets/img/placeholder.jpg" class="img-fluid" alt="image"></div>';
                   }
                  ?>
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

            <div>
              <form method="post">
                <input id="register-event" type="submit" name="register-event" value="Register">
              </form>
              <?php 
                if(isset($_POST["register-event"])){
                  if(isset($_SESSION["user"])){
                    $registration_query = "SELECT * FROM volunteer_events WHERE volunteer_id = ? AND event_id = ?";
                    $stmt = mysqli_prepare($connection, $registration_query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ii", $volunteer_id, $id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $registration_rows = mysqli_stmt_num_rows($stmt);

                        if ($registration_rows > 0) {
                            echo "You have already registered for this event.";
                        } else {
                            // User is not registered, proceed to register the user
                            $reg_to_event = "INSERT INTO volunteer_events (volunteer_id, event_id) VALUES (?,?)";

                            $stmt2 = mysqli_prepare($connection, $reg_to_event);

                            if ($stmt2) {
                                mysqli_stmt_bind_param($stmt2, "ii", $volunteer_id, $id);
                                mysqli_stmt_execute($stmt2);
                                echo "Registration Succesful.";

                                mysqli_stmt_close($stmt2);
                            } else {
                                echo "Something went wrong.";
                            }
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Something went wrong.";
                    }
                  } else {
                    header("Location: authentication/login.php");
                    ob_end_flush();
                    die;
                  }
                }
              ?>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

<!-- ======= Footer ======= -->
    <?php
          include 'db-connector.php';

          $query = "SELECT * FROM org_info";
          $statement = $pdo_obj->query($query);
          $rowsReturned = $statement->rowCount();

          if ($rowsReturned > 0) {
              while ($org_details = $statement->fetch(PDO::FETCH_ASSOC)) {
                  $org_addressnum = $org_details["org_addressnum"];
                  $org_street = $org_details["org_street"];
                  $org_brgy_mncplty = $org_details["org_brgy_mncplty"];
                  $org_city_state_province = $org_details["org_city_state_province"];
                  $org_country = $org_details["org_country"];
                  $org_email = $org_details["org_email"];
                  $org_map = $org_details["org_map"];
                  $org_contactnum = $org_details["org_contactnum"];
              }
          } else {
              $org_addressnum = "";
              $org_street = "";
              $org_brgy_mncplty = "";
              $org_city_state_province = "";
              $org_country = "";
              $org_email = "";
              $org_map = "";
              $org_contactnum = "";
          }
    ?>

<footer id="footer">


<div class="footer-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 footer-contact">
        <h3>Tanglaw University</h3>
        <?php
          echo  "<p>
                  ".$org_addressnum." ".$org_street."<br>
                  ".$org_brgy_mncplty."<br>
                  ".$org_city_state_province."<br>
                  ".$org_country."<br>
                  <strong>Phone:</strong>".$org_contactnum."<br>
                  <strong>Email:</strong>".$org_email."<br>
                </p>";
        ?>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Social Networks</h4>
        <p>Feel free to reach us using our socials!</p>
        <div class="social-links mt-3">
        <a href="https://www.facebook.com/TanglawUniversityCenter/" class="facebook"><i class="bx bxl-facebook"></i></a>
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