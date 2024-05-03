<?php
  session_start();
  if(isset($_SESSION["admin"])) {
    $admin = $_SESSION["admin"];
    $admin_id = $admin["admin_id"];
    $admin_email = $admin["admin_email"];
    $admin_fullname = $admin["admin_fullname"];
    $admin_role = $admin["admin_role"];
  } else {
    $admin_id = null;
    $admin_email = null;
    $admin_fullname = null;
    $admin_role = null;
    header("Location: ../authentication/adminLogin.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/adminFavicon.png" rel="icon">

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
    #footer {
          position: fixed;
          bottom: 0;
          width: 100%;
          padding: 20px 0; /* Adjust padding as needed */
    }
  </style>

</head>


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="adminHome.php" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="adminHome.php">Content Dashboard</a></li>
        <li><a class="nav-link scrollto" href="userDashboard.php">Volunteers</a></li>
        <?php
          if($admin_role == "s_admin"){
            echo "<li><a class='nav-link scrollto' href='addAdmin.php'>Add Admin</a></li>";
          }
        ?>
        <li><a class="nav-link scrollto" href="allAdmin.php">Admin List</a></li>
        <li><a class="nav-link scrollto active" href="adminProfile.php">Account</a></li>
        <li><a class="nav-link scrollto" href="../authentication/adminLogout.php">Log Out</a></li>
      </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <h2 class="header-text-2">Account</h2>
        <?php
            echo "Welcome <b>".$admin_fullname."</b>";
        ?>
      </div>
    </section>

    <section class="inner-page" style="margin-bottom: 200px;">
      <div class="container">
      <div class="line"></div>
      <div class="container-form">
      <?php 
            echo   "<div class='item1'>
                        <label for='fullname' class='textlabel input-head'>Full Name</label><br>
                        <input type='text' name='fullname' value='$admin_fullname' class='form-control' readonly>
                    </div>
                    <div class='item2'>
                        <label for='email' class='textlabel input-head'>Email</label><br>
                        <input type='text' name='email' value='$admin_email' class='form-control' readonly>
                    </div>
                    <div class='item3'>
                        <label for='role' class='textlabel input-head'>Role</label><br>
                        ";
            
            $role = "";                        
            if ($admin_role == "s_admin"){
                $role = "Super Admin";
            } else {
                $role = "Admin";
            }
                        
            echo "<input type='text' name='role' value='$role' class='form-control' readonly>";
        ?>
      </div>

      <div class="line"></div>
      <center>
        <a class="btn btn-success" href="editAdminProfile.php">Change Account Details</a>
      </center>
    </section>


    </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
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
<!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
</body>

</html>