<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Content Addition</title>
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    document.getElementById('event_image').value = null;
    document.getElementById('myimage').style.display = "none"; 
    }
    
  </script>
</head>

<!--php codes start-->
<?php
    //Include database files
    include 'db-connector.php';

    //Initialize variables
    $event_image = "";
    $event_name = "";
    $event_location = "";
    $event_contact_person = "";
    $event_contact = "";
    $event_date_start = "";
    $event_date_end = "";
    $event_time_start = "";
    $event_time_end = "";
    $event_content = "";

    // get the values from the record in the database
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $getRecord = "SELECT  * FROM events WHERE event_id = :event_id";
        $stmt = $pdo_obj->prepare($getRecord);
        $stmt->bindParam(':event_id', $id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract values from the fetched event record
        if($event)
        {
            $event_image = $event['event_image'];
            $event_name = $event['event_name'];
            $event_location = $event['event_location'];
            $event_contact_person = $event['event_contact_person'];
            $event_contact = $event['event_contact'];
            $event_date_start = $event['event_date_start'];
            $event_date_end = $event['event_date_end'];
            $event_time_start = $event['event_time_start'];
            $event_time_end = $event['event_time_end'];
            $event_content = $event['event_content'];
        }

    }

?>
<!--php codes end-->


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

    <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link   scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
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
          <li>Content Edit</li>
        </ol>
        <h2 class="header-text-2">Content Edit</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
      <div class="line"></div>
      <form action="editContent.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                    <!-- get user's name -->

                    <div class="container-form">

                        <div class="item2">
                            <label for="event_name" class="textlabel input-head">Event Title</label><br>
                            <input type="text" name="event_name" id="event_name" class="form-control" value="<?php echo $event_name ?>"><br>
                        </div>
                        
                        <!-- Input for image upload -->

                        <div class="item1">
                            <label for="event_image" class="textlabel input-head">Choose Image</label><br>

                            <input type="file" id="event_image" name="event_image" class="form-control" onchange="onFileSelected(event)" style="height: 45px;" accept="image/*">

                            <br>
                            
                            <div>
                                <img id="myimage" class="form-control image-container" src="$event_image">
                            </div><br><br>

                            <div style="text-align: center;">
                                <button class="btn btn-danger my-2 my-sm-0" id="removeimg" type="button" onclick="resetImage()">Remove Image</button>
                            </div>
                            
                        </div>

                        <!-- Input for Event Location -->
                
                        <div class="item3">
                            <label for="event_location" class="textlabel input-head">Location</label><br>
                            <input type="text" name="event_location" id="event_location" class="form-control" value="<?php echo $event_location ?>"><br>
                        </div>

                        <!-- Input for Event Contact Number -->
                
                        <div class="item4">
                            <label for="event_contact" class="textlabel input-head">Contact Number</label><br>
                            <input type="text" name="event_contact" id="event_contact" class="form-control" value="<?php echo $event_contact ?>"><br>
                        </div>

                        <!-- Input for Event Contact Person -->

                        <div class="item5">
                            <label for="event_contact_person" class="textlabel input-head">Contact Person</label><br>
                            <input type="text" name="event_contact_person" id="event_contact_person" class="form-control" value="<?php echo $event_contact_person ?>"><br>
                        </div>

                        <!-- Input for Event Date start -->
                
                        <div class="item6">
                            <label for="event_date_start" class="textlabel input-head">Start Date</label> <br>
                            <input type="date" id="event_date_start" name="event_date_start" class="form-control" value="<?php echo $event_date_start?>"><br>
                        </div>

                        <!-- Input for Event Date end -->

                        <div class="item7">
                            <label for="event_date_end" class="textlabel input-head">End Date</label> <br>
                            <input type="date" id="event_date_end" name="event_date_end" class="form-control" value="<?php echo $event_date_end ?>"><br>
                        </div>

                        <!-- Input for Event Time start -->
  
                        <div class="item8">
                            <label for="event_time_start" class="textlabel input-head">Start time</label> <br>
                            <input type="time" id="event_time_start" name="event_time_start" class="form-control" value="<?php echo $event_time_start ?>"> <br>    
                        </div>

                        <!-- Input for Event Time end -->
                
                        <div class="item9">
                            <label for="event_time_end" class="textlabel input-head">End time</label> <br>
                            <input type="time" id="event_time_end" name="event_time_end" class="form-control" value="<?php echo $event_time_end ?>"> <br>    
                        </div>

                        <!-- Input for Event Description -->
                
                        <div class="item11">
                            <label for="event_content" class="textlabel input-head">Event Description</label><br>
                            <textarea type="text" name="event_content" id="event_content" class="form-control" style="height: 300px;"><?php echo htmlspecialchars($event_content); ?></textarea><br>   
                        </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="submitbutton">
                            <button type="submit" name="bttn" class="btn btn-success my-2 my-sm-0" style="width: 200px; margin-bottom: 20px;">Submit</button>
                    </div>
                </form>
      </div>
    <!-- ======= Storing Input values to database ======= -->
<?php

    if(isset($_POST['bttn']))
    {
        include 'db-connector.php';

        $event_id = $_GET['id'];
        $event_name = htmlspecialchars($_POST['event_name']); //event name
        $event_location = htmlspecialchars($_POST['event_location']); //event location
        $event_contact_person = htmlspecialchars($_POST['event_contact_person']); //contact person
        $event_contact = htmlspecialchars($_POST['event_contact']); //contact number
        $event_date_start = htmlspecialchars($_POST['event_date_start']); //start date
        $event_date_end = htmlspecialchars($_POST['event_date_end']); //end date
        $event_time_start = htmlspecialchars($_POST['event_time_start']); //start time
        $event_time_end = htmlspecialchars($_POST['event_time_end']); //start time
        $event_content = htmlspecialchars($_POST['event_content']); //event description

        // Check if image file was uploaded
        if (isset($_FILES['image_encoded']['tmp_name']) && $_FILES['image_encoded']['error'] === UPLOAD_ERR_OK) {
            // Read image data
            $image_encoded = file_get_contents($_FILES['event_image']['tmp_name']);
            // Encode image data as base64
            $event_image = base64_encode($image_encoded);
        } else {
            // Default value for image if not uploaded
            $event_image = '';
        }

        // Update Events Table
        $updateEvent = "UPDATE events SET 
                        event_image = :event_image, 
                        event_name = :event_name, 
                        event_location = :event_location, 
                        event_contact_person = :event_contact_person, 
                        event_contact = :event_contact, 
                        event_date_start = :event_date_start, 
                        event_date_end = :event_date_end, 
                        event_time_start = :event_time_start, 
                        event_time_end = :event_time_end, 
                        event_content = :event_content
                        WHERE event_id = :event_id";
        // Prepare and execute the statement
       
            $stmt = $pdo_obj->prepare($updateEvent);
            $stmt->bindParam(':event_image', $event_image);
            $stmt->bindParam(':event_name', $event_name);
            $stmt->bindParam(':event_location', $event_location);
            $stmt->bindParam(':event_contact_person', $event_contact_person);
            $stmt->bindParam(':event_contact', $event_contact);
            $stmt->bindParam(':event_date_start', $event_date_start);
            $stmt->bindParam(':event_date_end', $event_date_end);
            $stmt->bindParam(':event_time_start', $event_time_start);
            $stmt->bindParam(':event_time_end', $event_time_end);
            $stmt->bindParam(':event_content', $event_content);
            $stmt->bindParam(':event_id', $event_id);
            $stmt->execute();
            echo 
            "
            <script>
            alert('Event Updated');
            document.location.href = 'contentDashboard.php';
            </script>
            ";




    } 
  ?>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
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