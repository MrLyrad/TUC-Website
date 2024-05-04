<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Content Addition</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/font.css" rel="stylesheet">
  
  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script>
    function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById("myimage");
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
        imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
    document.getElementById('myimage').style.display = ""
    }

    function resetImage() {
    document.getElementById('event_image').value = '';
    document.getElementById('myimage').style.display = "none"; 
    }
  </script>
   <style>
    .container-form {
          grid-template-areas:
            'name'
            'image'
            'location'
            'contact'
            'person'
            'startdate'
            'enddate'
            'timestart'
            'timeend'
            'instructions'
            'description';
          grid-template-columns: 1fr;  /* Single column for all items */
        }
    </style>
</head>


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
    <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../index.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="../index.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="../index.php#activities">Activities</a></li>
          <li><a class="nav-link scrollto" href="../index.php#events">Events</a></li>
          <li><a class="nav-link scrollto" href="../index.php#team">Team</a></li>
          <li><a class="nav-link scrollto" href="../index.php#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <h2 class="header-text-2">Volunteer Registration</h2>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <form method="POST" enctype="multipart/form-data">

      <?php
                //Run once form is submitted
                if (isset($_POST["register"])) {
                    //initiate input variables
                    $fullname = $_POST["full_name"];
                    $email = $_POST["email"];
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $password_confirmation = $_POST["password_rep"];
                    
                    //store errors
                    $errs = array();
                    
                    //secure the password
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    //check if complete inputs
                    if(empty($fullname) OR empty($email) OR empty($username) OR empty($password)) {
                        array_push( $errs,"All fields are required");
                    }

                    //check if email format valid
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push( $errs,"Enter a valid email");
                    }

                    //check if passwords match
                    if($password!=$password_confirmation){
                        array_push( $errs,"Password does not match");
                    }

                    require_once("../db-connector.php");    //connector file
                    
                    $email_query = "SELECT * FROM volunteers WHERE email = '$email'";
                    $username_query = "SELECT * FROM volunteers WHERE username = '$username'";
                    $email_data = mysqli_query($connection, $email_query);
                    $username_data = mysqli_query($connection, $username_query);
                    $email_rows = mysqli_num_rows($email_data);
                    $username_rows = mysqli_num_rows($username_data);

                    if ($email_rows>0){
                        array_push($errs, "Email already exists!");
                    }

                    if ($username_rows>0){
                        array_push($errs, "Username already exists!");
                    }


                    //checks error counter
                    if(count($errs) > 0) {  //errors are detected
                        foreach($errs as $err) {
                            //!!! please provide class name for customizing div !!!
                            echo "<div>$err</div>";
                        }
                    } else {    //input requirements fulfilled, initiate connection
                        //SQL statment for insertion of inputs to DB
                        $sql = "INSERT INTO volunteers (full_name, email, username, password) VALUES (?,?,?,?)"; //Values are abstracted to prevent SQL injection

                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                        //Save volunteer registration
                        if($prepare) {  //connection successful, complete the parameter details

                            //complete preparation statement
                            mysqli_stmt_bind_param($stmt,"ssss", $fullname, $email, $username, $password_hash); //Define input variables here for storing to DB
                            mysqli_stmt_execute($stmt); //execute the statment

                            echo "<div>Registration Successful!</div>"; //success confirmation
                        } else {
                            die("Something went wrong"); //database connection unsuccessful
                        }
                    }
                }
            ?>

            <div class="container-form">

                        <div class="item2">
                            <label for="full_name" class="textlabel input-head">Full Name</label><br>
                            <input type="text" id="full_name" name="full_name" class="form-control" required>
                        </div>

                        <div class="item1">
                            <label for="email" class="textlabel input-head">Email</label><br>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                
                        <div class="item3">
                            <label for="username" class="textlabel input-head">Username</label><br>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                
                        <div class="item4">
                            <label for="password" class="textlabel input-head">Confirm Password</label><br>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="item5">
                            <label for="password_rep" class="textlabel input-head">Confirm Password</label><br>
                            <input type="password" id="password_rep" name="password_rep" class="form-control" required>
                        </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="submitbutton">
                        <button type="submit" id="register-button" name="register" value="register" class="btn btn-success my-2 my-sm-0" style="width: 200px; margin-bottom: 20px;">Register</button>
                    </div>
                </form>
                <br />
                <center>
                    <p>Already have an account?</p>
                    <!-- Redirect to Registration -->
                    <button onclick="window.location.href='login.php';" class="btn btn-success my-2 my-sm-0" style="width: 100px; margin-bottom: 20px;">login</button>
                    <button onclick="window.location.href='../index.php';" class="btn btn-success my-2 my-sm-0" style="width: 200px; margin-bottom: 20px;">Back to Home Page</button>
                </center>
      </div>


    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
          include '../db-connector.php';

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
        <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
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
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>