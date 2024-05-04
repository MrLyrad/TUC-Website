<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: ../authentication/adminLogin.php");
    }  else {
        $admin = $_SESSION["admin"];
        $admin_fullname = $admin["admin_fullname"];
        $admin_role = $admin["admin_role"];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Volunteers</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/adminFavicon.png" rel="icon">
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
<style>
  #footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      color: white;
      text-align: center;
    }
</style>


</head>


<?php
    require_once("../db-connector.php");

    $event_id = $_GET['id'];
    $event_name = $_GET['event'];
    $query = "SELECT volunteer_id FROM volunteer_events WHERE event_id = $event_id";
    $stmt = $pdo_obj->query($query);

    $volunteer_ids = array();
    while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
    $volunteer_ids[] = $row; // Add event_id to the array
    }
?>


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="adminHome.php" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="adminHome.php">Content Dashboard</a></li>
        <li><a class="nav-link scrollto active" href="userDashboard.php">Volunteers</a></li>
        <?php
          if($admin_role == "s_admin"){
            echo "<li><a class='nav-link scrollto' href='editOrgInfo.php'>Edit Details</a></li>";
          }
        ?>
        <li><a class="nav-link scrollto" href="allAdmin.php">Admin List</a></li>
        <li><a class="nav-link scrollto" href="adminProfile.php">Account</a></li>
        <li><a class="login" href="../authentication/adminLogout.php">Log Out</a></li>
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
        <li><a href="userDashboard.php">Volunteers</a></li>
        <li>All Volunteers</li>
      </ol>
        <h2 class="header-text-2">Volunteers</h2>
        <?php
            echo "Welcome <b>".$admin_fullname."</b>";
        ?>
      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
      <div class="line"></div>

    <!-- Table for Events -->
    <div class="container table-container">
<br>
<br>
<?php
    $all_volunteers = array(); // Store fetched events for efficient display
    if($event_id==0){
            $query = "SELECT * FROM volunteers"; // Use prepared statement
      
            $stmt = $pdo_obj->prepare($query);

            // Execute the statement (no need for separate execution)
            $stmt->execute();

            // Create an empty array to store volunteers
            $all_volunteers = [];

             // Loop through each row and add it to the array
             while ($volunteer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $all_volunteers[] = $volunteer;
            }
    }else{
        foreach ($volunteer_ids as $id) {
            $query = "SELECT * FROM volunteers WHERE volunteer_id = :volunteer_id"; // Use prepared statement
      
            $stmt = $pdo_obj->prepare($query);
            $stmt->bindValue(':volunteer_id', $id, PDO::PARAM_INT); // Bind ID as integer
            $stmt->execute();
      
            $volunteer = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single event
      
            if ($volunteer) { // Check if event was found
              $all_volunteers[] = $volunteer; // Add event to array for efficient display
            } 
          }
    }
    $numVolunteers = count($all_volunteers);
?>
  <div class="d-flex justify-content-between align-items-center">
    <h2 style="color:#e78000"> <?php echo $event_name ?> Volunteers    <?php echo $numVolunteers ?></h2>
  </div>
  <br>
  <table style="margin-bottom:60px;" class="table">
    <thead>
      <tr>
        <th>Full Name</th>
        <th style="text-align: center;">Email</th>
        <th style="text-align: right;">Contact Number</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($all_volunteers  as $volunteer): ?>
        <tr>
          <td><?php echo $volunteer['full_name']; ?></td>
          <td style="text-align: center;"><?php echo $volunteer['email']; ?></td>
          <td style="text-align: right;"><?php echo $volunteer['contact']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


      <div class="line"></div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
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
<!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
</body>

</html>