<?php
  session_start();
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $volunteer_id = $user["volunteer_id"];
    $username = $user["username"];
    $full_name = $user["full_name"];
    $email = $user["email"];
    $contact = $user["contact"];
  } else {
    $volunteer_id = null;
    $username = null;
    $full_name = null;
    $email = null;
    $contact = null;
    header("Location: index.php");
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit Account</title>
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
          <li><a href="account-details.php">Edit Account Details</a></li>
          <li>Edit Account Details</li>
        </ol>
        <h2 class="header-text-2">Account Details</h2>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <div class="container-form">
        <?php 
            ob_start();
            echo   "<form method='post'>
                        <div class='item1'>
                            <label for='username' class='textlabel input-head'>New Username</label><br>
                            <input type='text' name='new_username' value='$username' class='form-control' required>
                        </div>
                        <div class='item2'>
                            <label for='fullname' class='textlabel input-head'>New Full Name</label><br>
                            <input type='text' name='new_fullname' value='$full_name' class='form-control' required>
                        </div>
                        <div class='item3'>
                            <label for='email' class='textlabel input-head'>New Email</label><br>
                            <input type='email' name='new_email' value='$email' class='form-control' required>
                        </div>
                        <div class='item4'>
                            <label for='contact' class='textlabel input-head'>New Contact Number</label><br>
                            <input type='tel' name='new_cnum' value='$contact' pattern='\d{11}' class='form-control'>
                        </div>
                        <input type='submit' name='confirm_changes' value='Confirm Changes'>
                    </form>";

            if(isset($_POST["confirm_changes"])){
                $new_username = $_POST['new_username'];
                $new_fullname = $_POST['new_fullname'];
                $new_email = $_POST['new_email'];
                $new_contact = $_POST['new_cnum'];

                //store errors
                $errs = array();

                //check if email format valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errs,"Enter a valid email");
                }

                require_once("db-connector.php");    //connector file
                // Check for duplicate email and username
                $email_query = $connection->prepare("SELECT volunteer_id FROM volunteers WHERE email = ?");
                $email_query->bind_param("s", $new_email);
                $email_query->execute();
                $email_query_result = $email_query->get_result();
                $email_query_row = $email_query_result->fetch_assoc();
                $existing_email_id = $email_query_row ? $email_query_row['volunteer_id'] : null;
                $email_query->close();

                $username_query = $connection->prepare("SELECT volunteer_id FROM volunteers WHERE username = ?");
                $username_query->bind_param("s", $new_username);
                $username_query->execute();
                $username_query_result = $username_query->get_result();
                $username_query_row = $username_query_result->fetch_assoc();
                $existing_username_id = $username_query_row ? $username_query_row['volunteer_id'] : null;
                $username_query->close();

                // Check if email and username are already used by another volunteer
                if ($existing_email_id !== null && $existing_email_id != $volunteer_id) {
                    array_push($errs,"Email already exists!");
                }

                if ($existing_username_id !== null && $existing_username_id != $volunteer_id) {
                    array_push($errs,"Username already exists!");
                }

                if($contact == 0 OR $contact == null){
                    $contact = null;
                }

                //checks error counter
                if(count($errs) > 0) {  //errors are detected
                    foreach($errs as $err) {
                        //!!! please provide class name for customizing div !!!
                        echo "<div>$err</div>";
                    }
                } else {    //input requirements fulfilled, initiate connection
                    //SQL statment for insertion of inputs to DB
                    $sql = "UPDATE volunteers SET full_name = ?, email = ?, username = ?, contact = ? WHERE volunteer_id = ?"; //Values are abstracted to prevent SQL injection

                    $stmt = mysqli_stmt_init($connection);  //create statement
                    $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                    //Save volunteer registration
                    if ($prepare) {  
                        // Complete the preparation statement and execute it
                        mysqli_stmt_bind_param($stmt, "ssssi", $new_fullname, $new_email, $new_username, $new_contact, $volunteer_id);
                        mysqli_stmt_execute($stmt);
                    
                        // Fetch updated volunteer details
                        $sql = "SELECT * FROM volunteers WHERE volunteer_id = $volunteer_id";
                        $result = mysqli_query($connection, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $_SESSION["user"] = $user;
                    
                        // Redirect the user to the account-details.php page
                        header("Location: account-details.php");
                        exit(); // Make sure to exit the script
                    } else {
                        die("Something went wrong"); //database connection unsuccessful
                    }
                }
            }
            ob_end_flush();
        ?>      
      </div>

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