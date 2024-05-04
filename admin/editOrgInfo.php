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

  <title>Content Addition</title>
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
  .image-container{
    height: 300px; 
    object-fit: contain;
  }
    #footer {
          position: static;
          bottom: 0;
          width: 100%;
          padding: 20px 0; /* Adjust padding as needed */
    }

    .container-form {
    display: grid;
    grid-template-areas:
        'image image name'
        'location location instructions'
        'description description description'
        'contact person startdate'
        'enddate enddate timestart';
    }

    @media only screen and (max-width: 768px) {
        .container-form {
          grid-template-areas:
            'name'
            'image'
            'organization'
            'location'
            'instructions'
            'description'
            'contact'
            'person'
            'startdate'
            'enddate'
            'timestart'
            'timeend';
          grid-template-columns: 1fr;  /* Single column for all items */
        }
    }
    .textlabel{
        font-size: 20px;
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
        <li><a class="nav-link scrollto active" href="adminHome.php">Content Dashboard</a></li>
        <li><a class="nav-link scrollto" href="userDashboard.php">Volunteers</a></li>
        <?php
          if($admin_role == "s_admin"){
            echo "<li><a class='nav-link scrollto' href='addAdmin.php'>Add Admin</a></li>";
            echo "<li><a class='nav-link scrollto' href='editOrgInfo.php'>Edit Organization Details</a></li>";
          }
        ?>
        <li><a class="nav-link scrollto" href="allAdmin.php">Admin List</a></li>
        <li><a class="nav-link scrollto" href="adminProfile.php">Account</a></li>
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

        <ol>
          <li><a href="adminHome.php">Content Dashboard</a></li>
          <li>Edit Organization Inofrmation</li>
        </ol>
        <h2 class="header-text-2">Edit Organization Inofrmation</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <?php
        require_once("../db-connector.php");
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

    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <form method="POST" enctype="multipart/form-data">
                    <!-- get user's name -->

                    <div class="container-form">

                        <div class="item1">
                            <label for='org_email' class='textlabel input-head'>Email</label><br>
                            <input type='email' name='org_email' class='form-control' value='<?php echo $org_email ?>' required>
                            <br>
                        </div>

                        <div class="item2">
                            <label for='org_contactnum' class='textlabel input-head'>Contact Number</label><br>
                            <input type='tel' name='org_contactnum' pattern='\d{11}' class='form-control' value='<?php echo $org_contactnum ?>' required>
                        </div>

                        <div class="item3">
                        <input type='url' class ="form-control" name='org_map' id='mapLinkInput' placeholder='Enter map URL here' value='<?php echo $org_map ?>' required>
                    
                        </div>

                        <div class="item10">
                            <button type='button' class="btn btn-success my-2 my-sm-0 form-control" onclick='updateMap()'>Update Map</button>
                        </div>

                        <div class="item11">
                        <br>
                            <div class="form-control" style='
                                padding: 10px; /* Adds padding inside the div */
                                height: 300px; /* Sets the height of the div */'>
                                <iframe src='<?php echo $org_map ?>' width='100%' height='280px' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade' id='mapDisplay'></iframe>
                            </div>
                         </div>

                        <div class="item4">
                            <label for='org_addressnum' class='textlabel input-head'>Address Number</label><br>
                            <input type='text' name='org_addressnum' class='form-control' value='<?php echo $org_addressnum ?>'>
                        </div>

                        <div class="item5">
                            <label for='org_street' class='textlabel input-head'>Street</label><br>
                            <input type='text' name='org_street' class='form-control' value='<?php echo $org_street ?>' required>
                        </div>

                        <div class="item6">
                            <label for='org_brgy_mncplty' class='textlabel input-head'>Barangay/Municipality</label><br>
                            <input type='text' name='org_brgy_mncplty' class='form-control' value='<?php echo $org_brgy_mncplty ?>' required>
                        </div>

                        <div class="item7">
                            <label for='org_city_state_province' class='textlabel input-head'>City, State/Province</label><br>
                            <input type='text' name='org_city_state_province' class='form-control' value=' <?php echo $org_city_state_province ?>' required>
                        </div>

                        <div class="item8">
                            <label for='org_country' class='textlabel input-head'>Country</label><br>
                            <input type='text' name='org_country' class='form-control' value='<?php echo $org_country ?>' required>
                        </div>
                        
                    </div>
                    <div class="line"></div>
                    
                    <div class="submitbutton">
                            <button type="submit" name="update" class="btn btn-success my-2 my-sm-0" style="width: 200px; margin-bottom: 20px;">Submit</button>
                    </div>
                </form>
      </div>

      <?php
      if(isset($_POST["update"])){
                    $org_addressnum = $_POST["org_addressnum"];
                    $org_street = $_POST["org_street"];
                    $org_brgy_mncplty = $_POST["org_brgy_mncplty"];
                    $org_city_state_province = $_POST["org_city_state_province"];
                    $org_country = $_POST["org_country"];
                    $org_email = $_POST["org_email"];
                    $org_map = $_POST["org_map"];
                    $org_contactnum = $_POST["org_contactnum"];

                    if($rowsReturned>0){
                        $sql = "UPDATE org_info SET org_addressnum = ?, 
                                org_street = ?, org_brgy_mncplty = ?, 
                                org_city_state_province = ?, org_country = ?, 
                                org_contactnum = ?, org_email = ?, 
                                org_map = ? WHERE info_id = '1'"; //Values are abstracted to prevent SQL injection
                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                    } else {
                        $sql = "INSERT INTO org_info (org_addressnum, org_street, org_brgy_mncplty, 
                                org_city_state_province, org_country, org_contactnum, org_email, org_map) 
                                VALUES (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement
                    }

                    if($prepare){
                        mysqli_stmt_bind_param($stmt, "sssssiss", $org_addressnum, $org_street, $org_brgy_mncplty, $org_city_state_province, $org_country, $org_contactnum, $org_email, $org_map);
                        mysqli_stmt_execute($stmt);
                        header("Location: editOrgInfo.php");
                        die();
                    } else {
                        echo "Something went wrong";
                        header("Location: editOrgInfo.php");
                        die();
                    }
                }
      ?>

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

  <script>
        function updateMap() {
            var mapLink = document.getElementById('mapLinkInput').value;
            var mapDisplay = document.getElementById('mapDisplay');
            mapDisplay.src = mapLink;
        }
    </script>

</body>

</html>