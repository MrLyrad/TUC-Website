<?php
  session_start();
  ob_start();
  if(isset($_SESSION["admin"])) {
    $admin = $_SESSION["admin"];
    $admin_id = $admin["admin_id"];
    $admin_email = $admin["admin_email"];
    $admin_fullname = $admin["admin_fullname"];
    $admin_role = $admin["admin_role"];
  } else {
    $admin_id = null;
    $email = null;
    $fullname = null;
    $role = null;
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
      left: 0;
      bottom: 0;
      width: 100%;
      color: white;
      text-align: center;
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
          <li><a href="adminProfile.php">Account</a></li>
          <li>Edit Account</li>
        </ol>
        <h2 class="header-text-2">Edit Account</h2>
        <?php
            echo "Welcome <b>".$admin_fullname."</b>";
        ?>
      </div>
    </section>

    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <div class="container-form">
        <?php 
            
            echo   "<form method='post'>
                        <div class='item1'>
                            <label for='fullname' class='textlabel input-head'>New Full Name</label><br>
                            <input type='text' name='new_fullname' value='$admin_fullname' class='form-control' required>
                        </div>
                        <div class='item2'>
                            <label for='email' class='textlabel input-head'>New Email</label><br>
                            <input type='email' name='new_email' value='$admin_email' class='form-control' required>
                        </div>
                        <div class='item2'>
                            <label for='password' class='textlabel input-head'>New Password</label><br>
                            <input type='password' name='password' class='form-control' required>
                        </div>
                        <br><br><input type='submit' class='btn btn-success' name='confirm_changes' value='Confirm Changes'>


                    </form>";

            if(isset($_POST["confirm_changes"])){
                $new_fullname = $_POST['new_fullname'];
                $new_email = $_POST['new_email'];
                $new_password = $_POST['password'];

                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                //store errors
                $errs = array();

                //check if email format valid
                if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errs,"Enter a valid email");
                }

                require_once("../db-connector.php");    //connector file
                // Check for duplicate email and fullname
                $email_query = $connection->prepare("SELECT admin_id FROM admins WHERE admin_email = ?");
                $email_query->bind_param("s", $new_email);
                $email_query->execute();
                $email_query_result = $email_query->get_result();
                $email_query_row = $email_query_result->fetch_assoc();
                $existing_email_id = $email_query_row ? $email_query_row['admin_id'] : null;
                $email_query->close();

                $fullname_query = $connection->prepare("SELECT admin_id FROM admins WHERE admin_fullname = ?");
                $fullname_query->bind_param("s", $new_fullname);
                $fullname_query->execute();
                $fullname_query_result = $fullname_query->get_result();
                $fullname_query_row = $fullname_query_result->fetch_assoc();
                $existing_fullname_id = $fullname_query_row ? $fullname_query_row['admin_id'] : null;
                $fullname_query->close();

                // Check if email and username are already used by another volunteer
                if ($existing_email_id !== null && $existing_email_id != $admin_id) {
                    array_push($errs,"Email already exists!");
                }

                if ($existing_fullname_id !== null && $existing_fullname_id != $admin_id) {
                    array_push($errs,"Fullname already exists!");
                }

                //checks error counter
                if(count($errs) > 0) {  //errors are detected
                    foreach($errs as $err) {
                        //!!! please provide class name for customizing div !!!
                        echo "<div>$err</div>";
                    }
                } else {    //input requirements fulfilled, initiate connection
                    //SQL statment for insertion of inputs to DB
                    $sql = "UPDATE admins SET admin_fullname = ?, admin_email = ?, admin_password = ? WHERE admin_id = ?"; //Values are abstracted to prevent SQL injection

                    $stmt = mysqli_stmt_init($connection);  //create statement
                    $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                    //Save volunteer registration
                    if ($prepare) {  
                        // Complete the preparation statement and execute it
                        mysqli_stmt_bind_param($stmt, "sssi", $new_fullname, $new_email, $password_hash, $admin_id);
                        mysqli_stmt_execute($stmt);
                    
                        // Fetch updated volunteer details
                        $sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
                        $result = mysqli_query($connection, $sql);
                        $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $_SESSION["admin"] = $admin;
                    
                        header("Location: adminProfile.php");
                        exit(); 
                    } else {
                        die("Something went wrong"); //database connection unsuccessful
                    }
                }
            }
            ob_end_flush();
        ?>
      </div>

      <div class="line"></div>
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